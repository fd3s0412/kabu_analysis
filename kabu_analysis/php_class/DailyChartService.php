<?php
class DailyChartService {
	/**
	 * 日足テーブルの最大取引日付を返します。
	 *
	 * @return Ambigous <string, mixed>
	 */
	public static function getMaxTorihikiDate() {
		$conn = new PDO ( "sqlite:kabu.sqlite" );
		$sql = "
				select
					max(torihiki_date) as max_torihiki_date
				from
					daily_chart
				";

		$stmt = $conn->prepare ( $sql );
		$stmt->execute ();

		$result = "";
		while ( $row = $stmt->fetch () ) {
			$result = $row ['max_torihiki_date'];
			break;
		}

		return $result;
	}

	/**
	 * 日足テーブルの取引日付リストを返します。
	 *
	 * @return multitype:
	 */
	public static function getTorihikiDateList() {
		$conn = new PDO ( "sqlite:kabu.sqlite" );

		$sql = "
				select
					torihiki_date
				from
					daily_chart
				group by
					torihiki_date
				order by
					torihiki_date
				";

		$stmt = $conn->prepare ( $sql );
		$stmt->execute ();

		$resultList = array ();
		while ( $row = $stmt->fetch () ) {
			array_push ( $resultList, $row ['torihiki_date'] );
		}

		return $resultList;
	}

	/**
	 * 日足分析結果テーブルを更新します。（初日のみ）
	 *
	 * @param unknown $torihiki_date
	 * @param unknown $shoken_code
	 */
	public static function updateDailyChartAnalysis($kikan_col_name, $days) {
		ChromePhp::log("updateDailyChartAnalysis");
		$conn = new PDO ( "sqlite:kabu.sqlite" );

		$sql = "select
				  shoken_code
				from
				  daily_chart
				group by
				  shoken_code
				order by
				  shoken_code
				";

		$stmt = $conn->prepare ( $sql );
		$stmt->execute ();

		$shoken_code_list = array ();
		while ( $row = $stmt->fetch () ) {
			array_push ( $shoken_code_list, $row ['shoken_code'] );
		}

		$debug = 0;
		foreach ( $shoken_code_list as $shoken_code ) {
			// 指定日数日の終値を取得。
			$sql = "select id, owarine
					from daily_chart
					where shoken_code = {$shoken_code}
					order by torihiki_date
					limit {$days}
					";

			// 証券コードを元に終値リストを取得。
			$stmt = $conn->prepare ( $sql );
			$stmt->execute ();

			$sum = 0;
			$id = NULL;
			$owarine = NULL;
			$count = 0;
			$ketasu_chosei = 1000;
			while ( $row = $stmt->fetch () ) {
				$sum = $sum + $row ['owarine'] * $ketasu_chosei;
				$id = $row ['id'];
				$owarine = $row ['owarine'];
				$count ++;
			}

			$ido_heikinsen = floor(($sum) / $count) / $ketasu_chosei;

			// 指定日数分の終値が取得できている場合、分析テーブル更新。
			if ($id != NULL && $count == $days) {
				$ketasu_chosei = 100000;
				$ido_heikin_kairiritsu = floor(($owarine * $ketasu_chosei) / ($ido_heikinsen * $ketasu_chosei) * $ketasu_chosei) / $ketasu_chosei;
				$sonzai_flg = DailyChartService::getSonzaiFlg($conn, $id);
				if (!$sonzai_flg) {
					$sql = "insert into daily_chart_analysis (
								id,
								ido_heikinsen_{$kikan_col_name},
								ido_heikin_kairiritsu_{$kikan_col_name}
							) values (
								{$id},
								{$ido_heikinsen},
								{$ido_heikin_kairiritsu}
							);";
				} else {
					$sql = "update daily_chart_analysis
							set
								ido_heikinsen_{$kikan_col_name} = {$ido_heikinsen},
								ido_heikin_kairiritsu_{$kikan_col_name} = {$ido_heikin_kairiritsu}
							where
								id = {$id};";
				}
				$conn->query ( $sql );
			}

			$debug ++;
			if ($debug >= 100 and FALSE) break;
		}
	}

	/**
	 * 分析結果テーブルの指定IDレコードが存在しているかを確認します。
	 *
	 * @param unknown $conn
	 * @param unknown $id
	 */
	public static function getSonzaiFlg ($conn, $id) {
		$result = false;
		$sql = "select count(id) as count from daily_chart_analysis where id = {$id};";
		$stmt = $conn->prepare ($sql);
		$stmt->execute();
		while ($row = $stmt->fetch()) {
			if ($row['count'] > 0) {
				$result = TRUE;
			}
		}
		return $result;
	}

	/**
	 * 日足分析テーブルを更新します。（初日以外）
	 *
	 * @param unknown $kikan_col_name
	 * @param unknown $days
	 */
	public static function updateDailyChartAnalysisMain($kikan_col_name, $days) {
		ChromePhp::log("updateDailyChartAnalysisMain");
		set_time_limit(300);
		$conn = new PDO ( "sqlite:kabu.sqlite" );

		// 証券コードをすべて取得
		$datas = DailyChartService::getShokenCodeListIsNotNullEMA($conn, $kikan_col_name);
		$size = count($datas);

		// 全銘柄ループ
		for ($i = 0; $i < $size; $i++) {
			$data = $datas[$i];
			$pre_ema = $data['ema'];
			// 銘柄の全日程株価取得
			$kabuka_list = DailyChartService::getKabukaList($conn, $data['shoken_code'], $data['torihiki_date']);
			$kabuka_list_size = count($kabuka_list);
			for ($j = 0; $j < $kabuka_list_size; $j++) {
				$k_data = $kabuka_list[$j];
				$owarine = $k_data['owarine'];
				// ID
				$id = $k_data['id'];
				// EMA
				$ketasu_chosei = 1000;
				$ema = ($pre_ema * $ketasu_chosei + floor(2 / ($days + 1) * $ketasu_chosei) * ($owarine - $pre_ema)) / $ketasu_chosei;
				// EMA乖離率
				$ketasu_chosei = 100000;
				$ema_kairiritsu = floor(($owarine * $ketasu_chosei) / ($ema * $ketasu_chosei) * $ketasu_chosei) / $ketasu_chosei;

				// DB更新
				$sonzai_flg = DailyChartService::getSonzaiFlg($conn, $id);
				if (!$sonzai_flg) {
					$sql = "insert into daily_chart_analysis (
					id,
					ido_heikinsen_{$kikan_col_name},
					ido_heikin_kairiritsu_{$kikan_col_name}
					) values (
					{$id},
					{$ema},
					{$ema_kairiritsu}
					);";
				} else {
					$sql = "update daily_chart_analysis
					set
					ido_heikinsen_{$kikan_col_name} = {$ema},
					ido_heikin_kairiritsu_{$kikan_col_name} = {$ema_kairiritsu}
					where
					id = {$id};";
				}
				$conn->query ( $sql );

				// 前回のEMA更新
				$pre_ema = $ema;
			}
		}

	}
	/**
	 * 各証券コードの移動平均線が算出できる最小の日付を返します。
	 *
	 * @param unknown $conn
	 * @return multitype:
	 */
	public static function getShokenCodeListIsNotNullEMA($conn, $kikan_col_name) {
		$result_list = array();
		$sql = "select
					dc.id,
					dc.shoken_code,
					dc.torihiki_date,
					dca.ido_heikinsen_{$kikan_col_name} as ema
				from daily_chart dc
				inner join (
					select
						t1.shoken_code,
						min(t1.torihiki_date) as torihiki_date
					from daily_chart t1
					inner join daily_chart_analysis t2
						on t1.id = t2.id
					where 1=1
					and t2.ido_heikinsen_{$kikan_col_name} is not null
					group by t1.shoken_code
				) sub
					on dc.shoken_code = sub.shoken_code
					and dc.torihiki_date = sub.torihiki_date
				inner join daily_chart_analysis dca
					on dc.id = dca.id
				order by dc.torihiki_date desc
				";
		$stmt = $conn->prepare ($sql);
		$stmt->execute();
		while ($row = $stmt->fetch()) {
			$result = array(
					'id' => $row['id'],
					'shoken_code' => $row['shoken_code'],
					'torihiki_date' => $row['torihiki_date'],
					'ema' => $row['ema']
			);
			array_push($result_list, $result);
		}
		return $result_list;
	}

	/**
	 * 証券コードの日足を返します。（取引日付で指定したより未来のすべての日足）
	 * @param unknown $shoken_code
	 * @param unknown $torihiki_date
	 * @return multitype:
	 */
	public static function getKabukaList($conn, $shoken_code, $torihiki_date) {
		$result_list = array();
		$sql = "select id, owarine
				from daily_chart
				where 1=1
					and shoken_code = {$shoken_code}
					and torihiki_date > '{$torihiki_date}'
				order by torihiki_date
				";
		$stmt = $conn->prepare ($sql);
		$stmt->execute();
		while ($row = $stmt->fetch()) {
			$result = array(
					'id' => $row['id'],
					'owarine' => $row['owarine']
			);
			array_push($result_list, $result);
		}
		return $result_list;
	}
}
