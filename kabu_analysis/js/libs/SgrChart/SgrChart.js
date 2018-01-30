(function($) {
	var methods = {
		// ------------------------------------------------------------
		// 基礎DOM生成
		// ------------------------------------------------------------
		createSvg : function(datas, settings) {
			var count = datas.length;
			settings.max = methods.getMaxByProperty(datas, 'takane');
			settings.min = methods.getMinByProperty(datas, 'yasune');

			settings.svgWidth = count * settings.gridWidth;
			settings.svgHeight = Math.abs(settings.max - settings.min) || 0;

			var $svg = $((function() {/*
				<svg class="sgr_chart"></svg>
			 */}).toString().match(/\/\*([^]*)\*\//)[1]);

			var $bg = $(document.createElementNS("http://www.w3.org/2000/svg", "rect"));
			$bg
					.attr('fill', settings.backgroundColor)
					.attr('width', '100%')
					.attr('height', '100%');
			$svg.append($bg);

			return $svg
					.attr('width', settings.svgWidth)
					.attr('height', settings.svgHeight);
		},
		// ------------------------------------------------------------
		// 情報表示領域生成
		// ------------------------------------------------------------
		createInfoArea : function(datas, settings) {
			var $dom = $((function() {/*
				<ul class="info_area">
					<li class="shijo"></li>
					<li class="shoken_code"></li>
					<li class="torihiki_date"></li>
					<li class="kaishamei"></li>
					<li class="hajimene"></li>
					<li class="takane"></li>
					<li class="yasune"></li>
					<li class="owarine"></li>
				</ul>
			 */}).toString().match(/\/\*([^]*)\*\//)[1]);

			if (datas && datas.length > 0) {
				var data = datas[0];
				$dom.find('.shijo').text("[" + data['shijo'] + "]");
				$dom.find('.shoken_code').text(data['shoken_code']);
				$dom.find('.kaishamei').text(data['kaishamei']);
			}

			return $dom;
		},
		// ------------------------------------------------------------
		// ローソク足生成
		// ------------------------------------------------------------
		createBar : function(i, data, settings) {
			// グラフの座標用に値を変換。minで減算しているのは最小値を画面下部に表示するため。
			var open = settings.svgHeight - (data['hajimene'] - settings.min) || 0;
			var close = settings.svgHeight - (data['owarine'] - settings.min) || 0;
			var high = settings.svgHeight - (data['takane'] - settings.min) || 0;
			var low = settings.svgHeight - (data['yasune'] - settings.min) || 0;

			var color = open > close ? '#f99' : '#99f';

			var $g = $(document.createElementNS("http://www.w3.org/2000/svg", "g"));
			$g
					.attr('fill', color)
					.append(methods.createBarBody(i, open, close, settings))
					.append(methods.createBarShadow(i, high, low, settings));

			// onmouseoverで情報を表示するための領域を設定
			settings.wrapper.append(methods.createBarInfo(i, data, settings));

			return $g;
		},
		// ------------------------------------------------------------
		// ローソク足生成（本体）
		// ------------------------------------------------------------
		createBarBody : function(i, open, close, settings) {

			var x = i * settings.gridWidth + (settings.gridWidth / 2 - settings.barBodyWidth / 2) + 1;
			var y = open < close ? open : close;

			var bodyHeight = Math.abs(open - close) || 1;

			var $body = $(document.createElementNS("http://www.w3.org/2000/svg", "rect"));
			$body
					.attr('width', settings.barBodyWidth)
					.attr('height', bodyHeight)
					.attr('x', x)
					.attr('y', y);

			return $body;
		},
		// ------------------------------------------------------------
		// ローソク足生成（ひげ）
		// ------------------------------------------------------------
		createBarShadow : function(i, high, low, settings) {

			var x = i * settings.gridWidth + (settings.gridWidth / 2 - settings.barShadowWidth / 2) + 1;
			var y = high < low ? high : low;

			var shadowHeight = Math.abs(high - low);
			var color = open > close ? '#f99' : '#99f';

			var $shadow = $(document.createElementNS("http://www.w3.org/2000/svg", "rect"));
			$shadow
					.attr('width', settings.barShadowWidth)
					.attr('height', shadowHeight)
					.attr('x', x)
					.attr('y', y);

			return $shadow;
		},
		// ------------------------------------------------------------
		// 情報表示用透明オブジェクト生成
		// ------------------------------------------------------------
		createBarInfo : function(i, data, settings) {
			var $div = $('<div class="vertical_line"></div>');
			$div
					.css({
						'top': 0,
						'left': i * settings.gridWidth + 1,
						'width': settings.gridWidth,
						'height': settings.svgHeight
					})
					.on('click', function() {
						methods.onBarEvent($div, data, settings);
					});
					//.on('click', function() { alert(data) })

			return $div;
		},
		// ------------------------------------------------------------
		// ローソク足にマスウが乗った時のイベントです.
		// ------------------------------------------------------------
		onBarEvent : function($div, data, settings) {
			$('.active_bar').removeClass('active_bar')
			$div.addClass('active_bar');
			settings.$infoArea.find('li').each(function(i, dom) {
				var $dom = $(dom);
				var dataName = $dom.attr('class');
				$dom.text(data[dataName]);
			});
		},
		// ------------------------------------------------------------
		// グリッド生成
		// ------------------------------------------------------------
		createGrid : function(datas, settings) {
			var $g = $(document.createElementNS("http://www.w3.org/2000/svg", "g"));
			$g.append(methods.createGridVertical(datas, settings));
			$g.append(methods.createGridHorizontal(datas, settings));

			return $g;
		},
		// ------------------------------------------------------------
		// グリッド生成（垂直線）
		// ------------------------------------------------------------
		createGridVertical : function(datas, settings) {
			var $g = $(document.createElementNS("http://www.w3.org/2000/svg", "g"));
			$g
					.attr('stroke', '#666')
					.attr('stroke-width', 1)
					.attr('stroke-dasharray', '10 4');

			for (var i = 1; i < datas.length; i++) {
				if (i % 5 !== 0) continue;
				var $line = $(document.createElementNS("http://www.w3.org/2000/svg", "line"));
				$line
						.attr('x1', i * settings.gridWidth + 1)
						.attr('y1', 0)
						.attr('x2', i * settings.gridWidth + 1)
						.attr('y2', settings.svgHeight);
				$g.append($line);
			}

			return $g;
		},
		// ------------------------------------------------------------
		// グリッド生成（水平線）
		// ------------------------------------------------------------
		createGridHorizontal : function(datas, settings) {
			var $g = $(document.createElementNS("http://www.w3.org/2000/svg", "g"));
			$g
					.attr('stroke', '#666')
					.attr('stroke-width', 1)
					.attr('stroke-dasharray', '10 4');

			settings.gridHeight = settings.svgHeight / settings.gridHorizontalCount;
			for (var i = 1; i < settings.gridHorizontalCount; i++) {
				var $line = $(document.createElementNS("http://www.w3.org/2000/svg", "line"));
				$line
						.attr('x1', 0)
						.attr('y1', i * settings.gridHeight)
						.attr('x2', settings.svgWidth)
						.attr('y2', i * settings.gridHeight);
				$g.append($line);
			}

			return $g;
		},
		// ------------------------------------------------------------
		// オブジェクトの配列から特定のプロパティの最小値を取得します.
		// ------------------------------------------------------------
		getMinByProperty(datas, propName) {
			var min = null;
			$.each(datas, function() {
				var target = Number(this[propName]);
				if (min == null) min = target; // 初回は必ず代入する
				min = min < target ? min : target;
			});
			return min;
		},
		// ------------------------------------------------------------
		// オブジェクトの配列から特定のプロパティの最大値を取得します.
		// ------------------------------------------------------------
		getMaxByProperty(datas, propName) {
			var max = null;
			$.each(datas, function() {
				var target = Number(this[propName]);
				max = max > target ? max : target;
			});
			return max;
		}
	};

	// ------------------------------------------------------------
	// CandleChart
	// ------------------------------------------------------------
	$.fn.sgrChart = function(datas, options) {
		var settings = $.extend({
			barBodyWidth: 10,
			barShadowWidth: 3,
			gridWidth: 16, // グリッドの幅
			gridHorizontalCount: 12, // 水平線の数
			backgroundColor: '#333', // 背景色
			maxWidth: '100%', // グラフ表示領域の幅
			maxHeight: '100%' // グラフ表示領域の高さ
		}, options);

		this.addClass('sgr_chart');

		// グラフ表示領域
		var $wrapper = $('<div class="graph_wrapper"></div>');
		$wrapper.css({
			'max-width': settings.maxWidth,
			'max-height': settings.maxHeight,
		});
		this.append($wrapper);
		settings.wrapper = $wrapper;

		// 情報エリア生成
		var $infoArea = methods.createInfoArea(datas, settings);
		this.append($infoArea);
		settings.$infoArea = $infoArea;

		// グラフ生成
		var $graph = methods.createSvg(datas, settings);
		$wrapper.append($graph);

		// ローソク足生成
		var $bars = $(document.createElementNS("http://www.w3.org/2000/svg", "g"));
		$.each(datas, function(i) {
			var $bar = methods.createBar(i, this, settings);
			$bars.append($bar);
		});
		$graph.append($bars);

		// 枠生成
		var $grid = methods.createGrid(datas, settings);
		$graph.append($grid);
	};
}(jQuery));