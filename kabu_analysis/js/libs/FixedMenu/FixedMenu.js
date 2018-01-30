(function($) {
	/**
	 * 画面左から表示するメニューを生成する.
	 */
	$.fn.FixedMenu = function(options) {
		var id = $(this).attr('id');

		var settings = {
				defaultOpenFlg: false, // 初期表示フラグ
				menuButtonSelector: '#' + id + "_button" // 表示切替ボタンのセレクタ
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
			// ボタンの表示非表示制御.
			// ------------------------------------------------------------
			visibleControl: function($wrapper, settings) {
				if (settings.defaultOpenFlg) {
					$wrapper.show();
				} else {
					$wrapper.hide();
				}
			},
			// ------------------------------------------------------------
			// イベント設定.
			// ------------------------------------------------------------
			addEvent: function($wrapper, settings) {
				$(settings.menuButtonSelector).click(function() {
					methods.toggle($wrapper, settings);
				});
			},
			// ------------------------------------------------------------
			// 表示非表示切替.
			// ------------------------------------------------------------
			toggle: function($wrapper, settings) {
				if (methods.isVisible($wrapper)) {
					$wrapper.hide();
				} else {
					$wrapper.show();
				}
			},
			// ------------------------------------------------------------
			// 表示状態取得.
			// ------------------------------------------------------------
			isVisible: function($wrapper) {
				return $wrapper.is(':visible');
			}
		};
		methods.init($(this), settings);

		return this;
	};
}(jQuery));