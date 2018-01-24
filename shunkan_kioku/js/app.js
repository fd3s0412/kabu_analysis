$(function() {
	var methods = {
		//----------------------------------------------------------------------
		// ランダムな数字を返します.
		//----------------------------------------------------------------------
		createRandNum : function() {
			return Math.floor(Math.random() * 10);
		},
		//----------------------------------------------------------------------
		// 渡されたDOMの配列を指定の秒数でfadeIn, fadeOutします.
		// @param list [{dom : jQueryObject, time : fadeInOutの時間}]
		//----------------------------------------------------------------------
		fadeInOutForDoms : function(list) {
			var func = null;
			$.each(list.reverse(), function(i, d) {
				func = methods.fadeInOut(d.dom, d.time, func);
			});
			func();
		},
		//----------------------------------------------------------------------
		// 渡されたDOMのFadeInOut処理を返します.
		//----------------------------------------------------------------------
		fadeInOut : function($dom, time, callback) {
			return function() {
				$dom.fadeIn(time, function() {
					$dom.fadeOut(time, function() {
						if (callback) callback();
					});
				});
			}
		}
	};

	var doms = [];

	var $msg = $('<div class="msg">今から連続で表示される数字を覚えてください。</div>');
	$view.append($view);
	doms.push({dom: $msg, time: 500});

	methods.fadeInOutForDoms(doms);
});
