<?php
class BunsekiSuiiService {

	/**
	 * 分析結果表示用テーブルのヘッダータグを返します。
	 *
	 * @return string
	 */
	public static function getBunsekiHeader() {
		$result = "";
		$cols = array (
				"翌営業日",
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
	 * 各翌営業日ごとの結果を返します。
	 *
	 * @param unknown $conn
	 * @return unknown
	 */
	public static function bunsekiSuiiEach ($conn ) {
		$resultList = array();
		$sqlList = array();

		$sql = "select
				yoku_eigyobi as yoku_eigyobi
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
				and 0.06 <= zenjitsuhi_ritsu
				and zenjitsuhi_ritsu < 0.08
			group by yoku_eigyobi
			order by yoku_eigyobi desc
			";
		array_push($sqlList, $sql);

		foreach ( $sqlList as $sql ) {
			$stmt = $conn->prepare ( $sql );
			$stmt->execute ();

			while ( $row = $stmt->fetch () ) {
				$result = array (
						'yoku_eigyobi' => $row ["yoku_eigyobi"],
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

	public static function bunsekiSuiiRuiseki( $list ) {
		$sum = 0;
		$reversed = array_reverse($list);
		foreach ($reversed as &$obj) {
			$sum = $sum + $obj['pips'];
			$obj['pips'] = $sum;
		}
		$list = array_reverse($reversed);
		return $list;
	}
}
