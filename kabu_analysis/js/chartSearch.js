window.APP_METHODS = {};
//----------------------------------------------------------------------
// 取引実施タイミングデータ抽出.
//----------------------------------------------------------------------
window.APP_METHODS.riekiKeisan = function() {
	var list = [];
	if (window.DATAS) {
		var addBuyFlg = true;
		var preBuyPrice = 0;
		var songiriPrice = 0;
		var ruikei = 0;
		var songiriritsu = parseInt($('[name="songiriritsu"]').val());
		$.each(window.DATAS, function(i, data) {
			// 売フェーズの時は損切判定を実施
			var isSongiri = false;
			if (!addBuyFlg && APP_METHODS.isSongiri(preBuyPrice, songiriritsu, data['yasune'])) {
				isSongiri = true;
			}
			// 取引発生判定
			if (!addBuyFlg) {
				// 売フェーズ
				if (isSongiri) {
					// 損切
					data['ararieki'] = songiriPrice - preBuyPrice;
					ruikei += data['ararieki'];
					data['ruikei'] = ruikei;
					list.push(data);
					addBuyFlg = !addBuyFlg;
				} else if (data['sell_flg'] != 0) {
					// 売条件に一致
					data['ararieki'] = parseInt(data['owarine'] || 0) - preBuyPrice;
					ruikei += data['ararieki'];
					data['ruikei'] = ruikei;
					list.push(data);
					addBuyFlg = !addBuyFlg;
				}
			} else if (addBuyFlg && data['buy_flg'] != 0) {
				// 買フェーズ、かつ、買条件に一致
				data['ararieki'] = null;
				data['ruikei'] = null;
				preBuyPrice = parseInt(data['owarine'] || 0);
				songiriPrice = APP_METHODS.calcSongiriPrice(preBuyPrice, songiriritsu) - 1; // すべりを考慮
				list.push(data);
				addBuyFlg = !addBuyFlg;
			}
		});
	}
	return list;
};
//----------------------------------------------------------------------
// 損切判定.
//----------------------------------------------------------------------
window.APP_METHODS.isSongiri = function(buyPrice, songiriritsu, yasune) {
	var songiriPrice = APP_METHODS.calcSongiriPrice(buyPrice, songiriritsu);
	return yasune <= songiriPrice;
};
//----------------------------------------------------------------------
// 損切価格を計算する.
//----------------------------------------------------------------------
window.APP_METHODS.calcSongiriPrice = function(buyPrice, songiriritsu) {
	return parseInt((buyPrice * (100 - songiriritsu)) / 100);
};
