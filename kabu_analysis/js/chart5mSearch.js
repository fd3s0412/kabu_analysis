$(function() {
	var methods = {
		init: function() {
			// アコーディオン設定
			$('#search_field').AccordionWrapper({defaultOpenFlg: false});
			$('#kikan_field').AccordionWrapper({defaultOpenFlg: false});
			$('#buy_field').AccordionWrapper({defaultOpenFlg: false});
			$('#sell_field').AccordionWrapper({defaultOpenFlg: false});
			$('#songiri_field').AccordionWrapper({defaultOpenFlg: false});
			// 検索ボタン
			$('.btn_search').click(methods._clickSearch);
			// 表示領域調整
			$('.scroll_wrapper').ResizeInner();
			// 結果表示
			methods._generate();
		},
		//----------------------------------------------------------------------
		// 検索ボタン押下処理.
		//----------------------------------------------------------------------
		_clickSearch: function() {
			$('#chart5mSearch').submit();
		},
		//----------------------------------------------------------------------
		// 表生成.
		//----------------------------------------------------------------------
		_generate: function() {
			var resultList = methods._getResultList();
			$('#torihiki_table')
					.find('tbody')
					//.empty()
					//.append(methods._createTr(resultList));
		},
		//----------------------------------------------------------------------
		// 取引実施タイミングデータ抽出.
		//----------------------------------------------------------------------
		_getResultList: function() {
			var list = [];
			if (window.DATAS) {
				$.each(window.DATAS, function(i, d) {
					list.push(d);
				});
			}
			return list;
		},
		//----------------------------------------------------------------------
		// 表の内部のDOMを生成する.
		//----------------------------------------------------------------------
		_createTr: function(list) {
			var tag = "";
			$.each(list, function(i, d) {

			});
			return tag;
		},
	};
	methods.init();
});
