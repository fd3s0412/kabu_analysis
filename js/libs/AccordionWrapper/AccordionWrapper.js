(function($) {
	/**
	 * 表示非表示を切り替える.
	 */
	$.fn.AccordionWrapper = function(options) {
		var settings = {
				defaultOpenFlg: false, // 初期表示フラグ
				btnOpenSelector: "#btnAccordionOpen", // 表示ボタンなどのセレクタ
				btnCloseSelector: "#btnAccordionClose" // 非表示ボタンなどのセレクタ
		};
		if (options) $.extend(settings, options);

		var methods = {
				// ------------------------------------------------------------
				// 初期処理.
				// ------------------------------------------------------------
				init: function($wrapper, settings) {
					methods.visibleControlButton($wrapper, settings);
					methods.addEvent($wrapper, settings);
				},
				// ------------------------------------------------------------
				// ボタンの表示非表示制御.
				// ------------------------------------------------------------
				visibleControlButton: function($wrapper, settings) {
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