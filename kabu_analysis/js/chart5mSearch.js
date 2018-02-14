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
			// 利益計算ボタン
			$('#btnRiekiKeisan').click(methods._generate);
			// 表示領域調整
			$('.scroll_wrapper').ResizeInner();
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
			var resultList = methods._riekiKeisan();
			$('#torihiki_table')
					.find('tbody')
					.empty()
					.append(methods._createTr(resultList));
		},
		//----------------------------------------------------------------------
		// 取引実施タイミングデータ抽出.
		//----------------------------------------------------------------------
		_riekiKeisan: function() {
			var list = [];
			if (window.DATAS) {
				var addBuyFlg = true;
				var preOwarine = 0;
				var ruikei = 0;
				$.each(window.DATAS, function(i, data) {
					if (addBuyFlg && data['buy_flg'] != 0 || !addBuyFlg && data['sell_flg'] != 0) {
						if (!addBuyFlg) {
							data['ararieki'] = parseInt(data['owarine'] || 0) - parseInt(preOwarine || 0);
							ruikei += data['ararieki'];
							data['ruikei'] = ruikei;
						} else {
							preOwarine = data['owarine'];
						}
						list.push(data);
						addBuyFlg = !addBuyFlg;
					}
				});
			}
			return list;
		},
		//----------------------------------------------------------------------
		// 表の内部のDOMを生成する.
		//----------------------------------------------------------------------
		_createTr: function(list) {
			var tag = "";
			$.each(list, function(i, data) {
				tag += '<tr class="' + (data ['buy_flg'] != 0 ? ' buy_row' : '') + (data ['sell_flg'] != 0 ? ' sell_row' : '') + '">';
				tag += '<td>' + data ['torihiki_date'] + '</td>';
				tag += '<td>' + data ['torihiki_time'] + '</td>';
				tag += '<td class="align_right">' + data ['hajimene'] + '</td>';
				tag += '<td class="align_right">' + data ['takane'] + '</td>';
				tag += '<td class="align_right">' + data ['yasune'] + '</td>';
				tag += '<td class="align_right">' + data ['owarine'] + '</td>';
				tag += '<td class="align_right">' + data ['dekidaka'] + '</td>';
				tag += '<td class="align_right">' + data ['macd'] + '</td>';
				tag += '<td class="align_right">' + data ['signal'] + '</td>';
				tag += '<td class="align_right">' + data ['osci'] + '</td>';
				tag += '<td class="align_right">' + data ['rsi'] + '</td>';
				tag += '<td class="align_right">' + (data ['ema_kairiritsu_12'] || '') + '</td>';
				tag += '<td class="align_right">' + (data ['ema_kairiritsu_26'] || '') + '</td>';
				tag += '<td class="align_right">' + data ['ema_12'] + '</td>';
				tag += '<td class="align_right">' + data ['ema_26'] + '</td>';
				tag += '<td class="align_right' + ((data['ararieki'] || 0) < 0 ? ' minus' : '') + '">' + (data ['ararieki'] === 0 ? 0 : (data ['ararieki'] || '')) + '</td>';
				tag += '<td class="align_right' + ((data['ruikei'] || 0) < 0 ? ' minus' : '') + '">' + (data ['ruikei'] === 0 ? 0 : (data ['ruikei'] || '')) + '</td>';
				tag += '</tr>';
			});
			return tag;
		},
	};
	methods.init();
});
