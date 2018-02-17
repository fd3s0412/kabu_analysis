$(function() {
	var methods = {
		//----------------------------------------------------------------------
		// 初期処理.
		//----------------------------------------------------------------------
		init: function() {
			// 日足取込
			$('#insertDailyChartByCsv').click(methods.insertDailyChartByCsv);
		},
		//----------------------------------------------------------------------
		// 日足取込ボタン押下処理.
		//----------------------------------------------------------------------
		insertDailyChartByCsv: function() {
			var params = {
				inserDalilyCharttByCsv : true
			};
			var $form = $('#kanri');
			BASE.appendHiddenDom($form, params);
			$form.submit();
		},
	};
	methods.init();
});
