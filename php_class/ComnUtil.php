<?php
class ComnUtil {
	/**
	 * SQL実行結果をもとに<tr>タグを生成します。
	 *
	 * @param unknown $row
	 * @param unknown $numColList
	 * @param unknown $percentColList
	 * @return string
	 */
	public static function createTagTr($row, $numColList, $percentColList) {
		$result = "<tr>";
		$i = 0;
		foreach ( $row as $key => $val ) {
			$addClass = "";

			// 数値列判定
			if (in_array ( $key, $numColList )) {
				$addClass = " align_right";

				// マイナス判定
				$minusFlg = ($val < 0);

				// パーセント列判定
				if (in_array ( $key, $percentColList )) {
					// 100倍する。
					$val = $val * 100;
					// 「%」を末尾に付ける。
					$val = $val . " %";
				} else {
					// 数値フォーマット
					$val = number_format ( $val );
				}

				// マイナスの場合は赤字にする。
				if ($minusFlg) {
					$val = "<span class=\"minus\">{$val}</span>";
				}
			}

			// 描画
			if (($i % 2) == 0) {
				$result .= "<td class=\"{$key}{$addClass}\">{$val}</td>";
			}
			$i ++;
		}
		$result .= "</tr>";

		return $result;
	}
	/**
	 * マップを元に<tr>タグを生成します。
	 *
	 * @param unknown $resultList
	 * @param unknown $numColList
	 * @param unknown $percentColList
	 * @return string
	 */
	public static function createTagTrByMapList($resultList, $numColList, $percentColList, $decimalColList) {
		$result = "";
		foreach ( $resultList as $row ) {
			$result .= "<tr>";
			foreach ( $row as $key => $val ) {
				$addClass = "";
				$formatVal = $val;

				// 数値列判定
				if (in_array ( $key, $numColList )) {
					$addClass = " align_right";

					// パーセント列判定
					if (in_array ( $key, $percentColList )) {
						// 四捨五入
						$formatVal = round ( $val, 5 );
						// 100倍する。
						$formatVal = $formatVal * 100;
						// 0埋め
						$formatVal = number_format ( $formatVal, 3 );
						// 「%」を末尾に付ける。
						$formatVal = $formatVal . " %";
					} // 小数
elseif (in_array ( $key, $decimalColList )) {
						// 四捨五入
						$formatVal = number_format ( $formatVal, 3 );
					}  // 整数
else {
						// 数値フォーマット
						$formatVal = number_format ( $formatVal );
					}

					// マイナスの場合は赤字にする。
					if ($val < 0) {
						$formatVal = "<span class=\"minus\">{$formatVal}</span>";
					}
				}

				// 描画
				$result .= "<td class=\"{$key}{$addClass}\">{$formatVal}</td>";

				// pips指数バー表示
				if ($key == "pips_shisu") {
					$barWidth = 0;
					// データ数が一定数未満の場合はバーを表示しない。
					if ($row ['count'] >= 0)
						$barWidth = $val * 20;

						// 0以下の場合、マイナスにして赤色で表示する。
					$minusBar = "";
					if ($val < 0) {
						$barWidth = $barWidth * - 1;
						$minusBar = " minus_bar";
					}
					$result .= "<td class=\"{$key}_bar\"><div class=\"bar{$minusBar}\" style=\"width: {$barWidth}px;\"></div></td>";
				}
			}
			$result .= "</tr>";
		}

		return $result;
	}
	/**
	 * 組み合わせリストを取得します。
	 */
	public static function getKumiawaseListInner($zentai, $nukitorisu) {
		$arrs = array ();
		$zentaisu = count ( $zentai );
		if ($zentaisu < $nukitorisu) {
			return;
		} else if ($nukitorisu == 1) {
			for($i = 0; $i < $zentaisu; $i ++) {
				$arrs [$i] = array (
						$zentai [$i]
				);
			}
		} else if ($nukitorisu > 1) {
			$j = 0;
			for($i = 0; $i < $zentaisu - $nukitorisu + 1; $i ++) {
				$ts = ComnUtil::getKumiawaseListInner ( array_slice ( $zentai, $i + 1 ), $nukitorisu - 1 );
				foreach ( $ts as $t ) {
					array_unshift ( $t, $zentai [$i] );
					$arrs [$j] = $t;
					$j ++;
				}
			}
		}

		return $arrs;
	}
	/**
	 * 組み合わせリストを取得します。
	 */
	public static function getKumiawaseList($list) {
		$resultList = array ();
		$listSize = count ( $list );

		for($i = 1; $i <= $listSize; $i ++) {
			$tmpList = ComnUtil::getKumiawaseListInner ( $list, $i );
			foreach ( $tmpList as $tmp ) {
				array_push ( $resultList, $tmp );
			}
		}

		return $resultList;
	}
	public static function getLinkTagBunsekiRuiji($shoken_code, $juni, $torihikine, $zenjitsuhi_ritsu, $uehigeritsu, $gyoshu) {
		$tag = "";
		$tag .= "<a class=\"button mini\" href=\"./bunseki_ruiji.php?juni={$juni}&shoken_code={$shoken_code}&torihikine={$torihikine}&zenjitsuhi_ritsu={$zenjitsuhi_ritsu}&uehigeritsu={$uehigeritsu}&gyoshu={$gyoshu}\">分析</a>";
		return $tag;
	}

	/**
	 * リストから特定の値を起点に指定の数だけさかのぼり、リストを抽出して返します。
	 *
	 * @param unknown $torihiki_date_all_list
	 * @param unknown $torihiki_date
	 * @param unknown $count
	 * @return multitype:
	 */
	public static function getListTargetValueWithNum($torihiki_date_all_list, $torihiki_date, $count) {
		$resultList = array ();
		$size = count ( $torihiki_date_all_list );
		$target_index = NULL;
		for($i = 0; $i < $size; $i ++) {
			$tmp = $torihiki_date_all_list [$i];
			if ($tmp == $torihiki_date) {
				$target_index = $i - ($count - 1);
				break;
			}
		}
		if ($target_index != NULL) {
			for(; $target_index <= $i; $target_index ++) {
				array_push ( $resultList, $torihiki_date_all_list [$target_index] );
			}
		}
		return $resultList;
	}

	/**
	 * リストから特定の値を検索して、次の値を返します。
	 */
	public static function getNextValueByList($list, $val) {
		$result = NULL;
		$size = count($list);
		for ($i = 0; $i < $size; $i++) {
			if ($val == $list[$i] && $i != $size - 1) {
				$result = $list[$i + 1];
				break;
			}
		}
		return $result;
	}

	/**
	 * リストの値をORで繋いだSQLの条件文用の文字列を返します。
	 *
	 * @param unknown $joken
	 * @param unknown $valueList
	 * @return string
	 */
	public static function createSqlOrList($joken, $valueList) {
		$sql = "";
		$size = count($valueList);
		for ($i = 0; $i < $size; $i++) {
			if ($i != 0) {
				$sql .= " or ";
			}
			$sql .= "{$joken} = '{$valueList[$i]}'";
		}
		return $sql;
	}
}
