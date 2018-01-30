(function($) {
	/**
	 * ウィンドウの縦幅をフルに使うように高さを調整する.
	 */
	$.fn.ResizeInner = function() {

		var windowHeight = $(window).innerHeight();
		var posY = $(this).position().top;

		$(this).css('height', windowHeight - posY);

		return this;
	};
}(jQuery));