$(function() {
	var methods = {
		//----------------------------------------------------------------------
		// ランダムな数字を返します.
		//----------------------------------------------------------------------
		createRandNum : function() {
			return Math.floor(Math.random() * 10);
		},
		//----------------------------------------------------------------------
		// 指定桁数のランダムな数字の配列を返します.
		//----------------------------------------------------------------------
		createRandNumByCount : function(count) {
			var result = [];
			for (var i = 0; i < count; i++) {
				result.push(methods.createRandNum());
			}
			return result;
		},
		//----------------------------------------------------------------------
		// 渡されたDOMの配列を指定の秒数でfadeIn, fadeOutします.
		// @param list [{dom : jQueryObject, fadeTime : fadeInOutの時間, waitTime: fadeOutまでの時間}]
		//----------------------------------------------------------------------
		fadeInOutForDoms : function(list, callback) {
			var func = callback;
			$.each(list.reverse(), function(i, d) {
				func = methods.fadeInOut(d.dom, d.fadeTime, d.waitTime, func);
			});
			func();
		},
		//----------------------------------------------------------------------
		// 渡されたDOMのFadeInOut処理を返します.
		//----------------------------------------------------------------------
		fadeInOut : function($dom, fadeTime, waitTime, callback) {
			return function() {
				$dom.fadeIn(fadeTime, function() {
					setTimeout(function() {
						$dom.fadeOut(fadeTime, function() {
							if (callback) callback();
							$dom.remove();
						});
					}, waitTime);
				}).css('display', 'inline-block');
			}
		}
	};

	var $view = $('.view').first();
	var doms = [];

	// メッセージ
	var $msg = $('<div class="msg">今から連続で表示される数字を覚えてください。</div>');
	$view.append($msg);
	doms.push({dom: $msg, fadeTime: 500, waitTime: 1500});

	var $mondai = $('<div></div>');
	var mondaiNumList = methods.createRandNumByCount(9);
	$.each(mondaiNumList, function(i, d) {
		// 問題をdataに保存
		var strMondai = $mondai.data('mondai') || "";
		$mondai.data('mondai', strMondai + d);

		// 問題DOMを生成
		$msg = $('<div class="number">' + d + '</div>');
		$view.append($msg);
		doms.push({dom: $msg, fadeTime: 250, waitTime: 500});
	});

	// メッセージ
	$msg = $('<div class="msg">表示された数字を順番通りに入力してください。</div>');
	$view.append($msg);
	doms.push({dom: $msg, fadeTime: 900, waitTime: 2000});

	// 表示開始
	methods.fadeInOutForDoms(doms, function() {
		$('.num_pad').fadeIn(300);
	});

	var $inputView = $('.input_view');

	// 数値ボタンイベント設定
	$('[data-num]').click(function() {
		var num = $(this).data('num');
		var input = ($mondai.data('input') || "") + num;
		$mondai.data('input', input);
		$inputView.html(input);
	});
	// クリアボタンイベント設定
	$('#btnClear').click(function() {
		$mondai.data('input', '');
		$inputView.html('&nbsp;');
	});
	// OKボタンイベント設定
	$('#btnOk').click(function() {
		if ($mondai.data('mondai') === $mondai.data('input')) {
			$msg = $('<div class="msg">おめでとうございます。正解です！</div>');
			$view.append($msg);
			methods.fadeInOutForDoms([{dom: $msg, fadeTime: 1000, waitTime: 3000}]);
		} else {
			$msg = $('<div class="msg">残念ながら、違います。</div>');
			$view.append($msg);
			methods.fadeInOutForDoms([{dom: $msg, fadeTime: 1000, waitTime: 3000}]);
		}
	});
});
