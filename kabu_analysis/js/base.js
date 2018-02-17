window.BASE = {};
// ----------------------------------------------------------------------
// formタグにhiddenを追加する.
// ----------------------------------------------------------------------
window.BASE.appendHiddenDom = function($form, params) {
	var tag = "";
	$.each(params, function(key, val){
		tag += '<input type="hidden" name="' + key + '" value="' + val + '" />';
	});
	$form.append($(tag));
};
$(function() {
	// メニュー設定
	$('.fixed_menu').FixedMenu();
});