(function($) {
	/**
	 * 表示非表示を切り替える.
	 * 対象のDOMにはIDを付与すること.
	 */
	$.fn.AccordionWrapper = function(options) {
		var id = $(this).attr('id');

		var settings = {
				defaultOpenFlg: false, // 初期表示フラグ
				btnOpenSelector: '#' + id + "_open", // 表示ボタンのセレクタ
				btnCloseSelector: '#' + id + "_close" // 非表示ボタンのセレクタ
		};
		if (options) $.extend(settings, options);

		var methods = {
				// ------------------------------------------------------------
				// 初期処理.
				// ------------------------------------------------------------
				init: function($wrapper, settings) {
					methods.visibleControl($wrapper, settings);
					methods.addEvent($wrapper, settings);
				},
				// ------------------------------------------------------------
				// ボタンと領域の表示非表示制御.
				// ------------------------------------------------------------
				visibleControl: function($wrapper, settings) {
					if (settings.defaultOpenFlg) {
						$wrapper.show();
						$(settings.btnOpenSelector).hide();
						$(settings.btnCloseSelector).show();
					} else {
						$wrapper.hide();
						$(settings.btnOpenSelector).show();
						$(settings.btnCloseSelector).hide();
					}
				},
				// ------------------------------------------------------------
				// イベント設定.
				// ------------------------------------------------------------
				addEvent: function($wrapper, settings) {
					$(settings.btnOpenSelector).click(function() {
						methods.open($wrapper, settings);
					});
					$(settings.btnCloseSelector).click(function() {
						methods.close($wrapper, settings);
					});
				},
				// ------------------------------------------------------------
				// 表示.
				// ------------------------------------------------------------
				open: function($wrapper, settings) {
					$wrapper.show();
					$(settings.btnOpenSelector).hide();
					$(settings.btnCloseSelector).show();
				},
				// ------------------------------------------------------------
				// 非表示.
				// ------------------------------------------------------------
				close: function($wrapper, settings) {
					$wrapper.hide();
					$(settings.btnOpenSelector).show();
					$(settings.btnCloseSelector).hide();
				}
		};
		methods.init($(this), settings);

		return this;
	};
}(jQuery));