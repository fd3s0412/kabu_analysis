<?php
class BunsekiService {

	/**
	 * 分析結果表示用テーブルのヘッダータグを返します。
	 *
	 * @return string
	 */
	public static function getBunsekiHeader() {
		$result = "";
		$cols = array (
				"From",
				"To",
				"全体",
				"勝",
				"負",
				"(勝)",
				"(負)",
				"pips",
				"勝率",
				"pips指数",
				"pips指数ゲージ"
		);
		foreach ( $cols as $col ) {
			$result .= "<th>{$col}</th>";
		}
		return $result;
	}

	/**
	 * 分析結果を返します。
	 *
	 * @param unknown $conn
	 * @param unknown $kizamichi
	 * @param unknown $colName
	 * @return multitype:
	 */
	public static function bunseki($conn, $kizamichi, $minNum, $maxNum, $colName) {
		$resultList = array ();
		$sqlList = BunsekiService::createSqlList ( $kizamichi, $minNum, $maxNum, $colName );
		foreach ( $sqlList as $sql ) {
			$stmt = $conn->prepare ( $sql );
			$stmt->execute ();

			while ( $row = $stmt->fetch () ) {
				// データ数が一定以下の場合は飛ばす。
				if ($row ['count'] == 0)
					continue;
				$result = array (
						// 'joken' => '取引値',
						'torihikine_from' => $row ["{$colName}_from"],
						'torihikine_to' => $row ["{$colName}_to"],
						'count' => $row ['count'],
						'count_win' => $row ['count_win'],
						'count_lose' => $row ['count_lose'],
						'count_sub_win' => $row ['count_sub_win'],
						'count_sub_lose' => $row ['count_sub_lose'],
						'pips' => $row ['pips'],
						'shoritsu' => ($row ['count_win'] + $row ['count_sub_win']) / $row ['count'],
						'pips_shisu' => $row ['p_k'] / $row ['count']
				);
				array_push ( $resultList, $result );
			}
		}

		return $resultList;
	}

	/**
	 * 分析用のSQLリストを返します。
	 *
	 * @param unknown $kizamichi
	 * @param unknown $minNum
	 * @param unknown $maxNum
	 * @param unknown $colName
	 * @return multitype:
	 */
	private static function createSqlList($kizamichi, $minNum, $maxNum, $colName) {
		$sqlList = array ();
		for($i = $minNum; $i <= $maxNum; $i = ($i * 1000 + $kizamichi * 1000) / 1000) {
			$fromNum = $i;
			$toNum = $i + $kizamichi;
			$sql = "select
						'{$fromNum} <=' as {$colName}_from
						, '< {$toNum}' as {$colName}_to
						, count(judge) as count
						, count(judge = '勝' or null) as count_win
						, count(judge = '負' or null) as count_lose
						, count(judge = '(勝)' or null) as count_sub_win
						, count(judge = '(負)' or null) as count_sub_lose
						, sum(pips) as pips
    					, sum(p_k) as p_k
					from
						kabuka
					where
						1 = 1
						and {$fromNum} <= {$colName}
						and {$colName} < {$toNum}
					";
			array_push ( $sqlList, $sql );
		}

		return $sqlList;
	}

	/**
	 * 翌営業日による分析結果を返します。
	 *
	 * @param unknown $conn
	 * @return multitype:
	 */
	public static function bunsekiYokueigyobi($conn) {
		$resultList = array ();
		$sql = "
				select
					yoku_eigyobi
					, count(judge) as count
					, count(judge = '勝' or null) as count_win
					, count(judge = '負' or null) as count_lose
					, count(judge = '(勝)' or null) as count_sub_win
					, count(judge = '(負)' or null) as count_sub_lose
					, sum(pips) as pips
    				, sum(p_k) as p_k
				from
					kabuka
				group by
					yoku_eigyobi
				order by
					yoku_eigyobi desc
				";

		$stmt = $conn->prepare ( $sql );
		$stmt->execute ();

		while ( $row = $stmt->fetch () ) {
			// データ数が0件の場合は飛ばす。
			if ($row ['count'] == 0)
				continue;
			$result = array (
					'yoku_eigyobi' => $row ['yoku_eigyobi'],
					'count' => $row ['count'],
					'count_win' => $row ['count_win'],
					'count_lose' => $row ['count_lose'],
					'count_sub_win' => $row ['count_sub_win'],
					'count_sub_lose' => $row ['count_sub_lose'],
					'pips' => $row ['pips'],
					'shoritsu' => ($row ['count_win'] + $row ['count_sub_win']) / $row ['count'],
					'pips_shisu' => $row ['p_k'] / $row ['count']
			);
			array_push ( $resultList, $result );
		}

		return $resultList;
	}

	/**
	 * 業種による分析結果を返します。
	 *
	 * @param unknown $conn
	 * @return multitype:
	 */
	public static function bunsekiGyoshu($conn) {
		$resultList = array ();
		$sql = "
				select
					gyoshu
					, count(judge) as count
					, count(judge = '勝' or null) as count_win
					, count(judge = '負' or null) as count_lose
					, count(judge = '(勝)' or null) as count_sub_win
					, count(judge = '(負)' or null) as count_sub_lose
					, sum(pips) as pips
    				, sum(p_k) as p_k
				from
					kabuka
				group by
					gyoshu
				order by
					count desc
				";

		$stmt = $conn->prepare ( $sql );
		$stmt->execute ();

		while ( $row = $stmt->fetch () ) {
			// データ数が0件の場合は飛ばす。
			if ($row ['count'] == 0)
				continue;
			$result = array (
					'gyoshu' => $row ['gyoshu'],
					'count' => $row ['count'],
					'count_win' => $row ['count_win'],
					'count_lose' => $row ['count_lose'],
					'count_sub_win' => $row ['count_sub_win'],
					'count_sub_lose' => $row ['count_sub_lose'],
					'pips' => $row ['pips'],
					'shoritsu' => ($row ['count_win'] + $row ['count_sub_win']) / $row ['count'],
					'pips_shisu' => $row ['p_k'] / $row ['count']
			);
			array_push ( $resultList, $result );
		}

		return $resultList;
	}

	/**
	 * 分析結果を返します。
	 *
	 * @param unknown $conn
	 * @param unknown $kizamichi
	 * @param unknown $colName
	 * @return multitype:
	 */
	public static function bunsekiRuiji($conn, $shoken_code, $juni, $torihikine, $zenjitsuhi_ritsu, $uehigeritsu, $gyoshu) {
		$resultList = array ();
		ChromePhp::log ( "bunsekiRuiji" );
		$sqlList = BunsekiService::createSqlListBunsekiRuiji ( $shoken_code, $juni, $torihikine, $zenjitsuhi_ritsu, $uehigeritsu, $gyoshu );
		foreach ( $sqlList as $sql ) {
			// ChromePhp::log($sql);
			$stmt = $conn->prepare ( $sql );
			$stmt->execute ();

			while ( $row = $stmt->fetch () ) {
				$result = array (
						'joken' => $row ['joken'],
						'count' => $row ['count'],
						'count_win' => $row ['count_win'],
						'count_lose' => $row ['count_lose'],
						'count_sub_win' => $row ['count_sub_win'],
						'count_sub_lose' => $row ['count_sub_lose'],
						'pips' => $row ['pips'],
						'shoritsu' => ($row ['count_win'] + $row ['count_sub_win']) / $row ['count'],
						'pips_shisu' => $row ['p_k'] / $row ['count']
				);
				array_push ( $resultList, $result );
			}
		}

		usort ( $resultList, function ($a, $b) {
			return $a ['count'] > $b ['count'] ? - 1 : 1;
		} );
		return $resultList;
	}

	/**
	 * 分析用のSQLリストを返します。
	 *
	 * @param unknown $kizamichi
	 * @param unknown $minNum
	 * @param unknown $maxNum
	 * @param unknown $colName
	 * @return multitype:
	 */
	private static function createSqlListBunsekiRuiji($shoken_code, $juni, $torihikine, $zenjitsuhi_ritsu, $uehigeritsu, $gyoshu) {
		$sqlList = array ();
		ChromePhp::log ( "createSqlListBunsekiRuiji" );
		$torihikineFrom = floor ( $torihikine / 1000 ) * 1000;
		$torihikineTo = $torihikineFrom + 1000;
		$zenjitsuhi_ritsuFrom = floor ( $zenjitsuhi_ritsu * 100 ) / 100;
		$zenjitsuhi_ritsuTo = ($zenjitsuhi_ritsuFrom * 10000 + 0.01 * 10000) / 10000;
		$uehigeritsuFrom = floor ( $uehigeritsu * 100 ) / 100;
		$uehigeritsuTo = ($uehigeritsuFrom * 10000 + 0.01 * 10000) / 10000;
		$juniFrom = floor ( ($juni - 1) / 5 ) * 5 + 1;
		$juniTo = $juniFrom + 4;

		$jokenList = array (
				" and {$torihikineFrom} <= torihikine and torihikine < {$torihikineTo}",
				" and {$zenjitsuhi_ritsuFrom} <= zenjitsuhi_ritsu and zenjitsuhi_ritsu < {$zenjitsuhi_ritsuTo}",
				" and {$uehigeritsuFrom} <= uehigeritsu and uehigeritsu < {$uehigeritsuTo}",
				" and '{$gyoshu}' = gyoshu",
				" and {$juniFrom} <= juni and juni <= {$juniTo}"
		);
		$jokenKumiawaseList = ComnUtil::getKumiawaseList ( $jokenList );

		$jokenTextList = array (
				"{$torihikineFrom} <= 取引値 < {$torihikineTo}",
				"{$zenjitsuhi_ritsuFrom} <= 前日比（率） < {$zenjitsuhi_ritsuTo}",
				"{$uehigeritsuFrom} <= 上ひげ率 < {$uehigeritsuTo}",
				"業種 = {$gyoshu}",
				"{$juniFrom} <= 順位 <= {$juniTo}"
		);
		$jokenTextKumiawaseList = ComnUtil::getKumiawaseList ( $jokenTextList );

		$jokenKumiawaseListSize = count ( $jokenKumiawaseList );
		for($j = 0; $j < $jokenKumiawaseListSize; $j ++) {
			$jokenList = $jokenKumiawaseList [$j];
			$joken = "";
			$jokenText = "";
			$jokenListSize = count ( $jokenList );
			for($i = 0; $i < $jokenListSize; $i ++) {
				$joken .= $jokenList [$i];
				if ($i != 0) {
					$jokenText .= "<br />";
				}
				$jokenText .= $jokenTextKumiawaseList [$j] [$i];
			}

			$sql = "select
    					'{$jokenText}' as joken
    					, count(judge) as count
    					, count(judge = '勝' or null) as count_win
    					, count(judge = '負' or null) as count_lose
    					, count(judge = '(勝)' or null) as count_sub_win
    					, count(judge = '(負)' or null) as count_sub_lose
    					, sum(pips) as pips
    					, sum(p_k) as p_k
    				from
    					kabuka
    				where
    					1 = 1
    					{$joken}
    				";
			array_push ( $sqlList, $sql );
		}

		$sql = "select
    					'証券コード = {$shoken_code}' as joken
    					, count(judge) as count
    					, count(judge = '勝' or null) as count_win
    					, count(judge = '負' or null) as count_lose
    					, count(judge = '(勝)' or null) as count_sub_win
    					, count(judge = '(負)' or null) as count_sub_lose
    					, sum(pips) as pips
    					, sum(p_k) as p_k
    				from
    					kabuka
    				where
    					1 = 1
    					and shoken_code = {$shoken_code}
    				";
		array_push ( $sqlList, $sql );
		return $sqlList;
	}
}
