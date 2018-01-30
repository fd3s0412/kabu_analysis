<?php
class CsvUtil {

	/**
	 * CSVファイルの読み込みを行います。
	 *
	 * @param string $filepath
	 * @return string|array
	 */
	public function readCsv($filepath) {
		if (($fp = fopen ( $filepath, "r" )) === false) {
			ChromePhp::log("file open error: {$filepath}");
			// エラー処理
			return array();
		}

		// CSVの中身がダブルクオーテーションで囲われていない場合に一文字目が化けるのを回避
		setlocale ( LC_ALL, 'ja_JP' );

		$i = 0;
		while ( ($line = fgetcsv ( $fp )) !== FALSE ) {
			mb_convert_variables ( 'UTF-8', 'sjis-win', $line );
			if ($i == 0) {
				// タイトル行
				$header = $line;
				$i ++;
				continue;
			}

			$data [] = $line;

			$i ++;
		}

		fclose ( $fp );

		return $data; // よみこんだやつ
	}
	/**
	 * 日足を取り込みます。
	 *
	 * @param array $target_date_list
	 */
	public function insertDailyChart($target_date_list) {
		set_time_limit(300);
		$conn = new PDO ( "sqlite:kabu.sqlite" );

		ChromePhp::log($target_date_list);
		// 指定日付分ループ
		foreach ( $target_date_list as $target_date ) {

			$filepath = $_SERVER ['DOCUMENT_ROOT'] . "/csv/daily/stocks_{$target_date}.csv";
			//ChromePhp::log ( $filepath );

			// 対象日付のCSV読込
			$csv_records = $this->readCsv ( $filepath );

			// 東証1部の銘柄をすべて登録
			foreach ( $csv_records as $datas ) {

				// 東証1部判定
				if ($datas [2] == "東証1部") {
					try {
						// 空白の場合はnullにする。
						$size = count($datas);
						for ($i = 0; $i < $size; $i++) {
							if ($datas[$i] == "") {
								$datas[$i] = "null";
							}
						}
						$shoken_code = preg_replace("/-.$/", "", $datas[0]);
						// DB登録
						$sql = "insert into daily_chart (torihiki_date, shoken_code, kaishamei, shijo, hajimene, takane, yasune, owarine, dekidaka, baibai_daikin) values (
								'{$target_date}',
								{$shoken_code},
								'{$datas[1]}',
								'{$datas[2]}',
								{$datas[3]},
								{$datas[4]},
								{$datas[5]},
								{$datas[6]},
								{$datas[7]},
								{$datas[8]}
								)";
						$stmt = $conn->prepare ( $sql );
						$stmt->execute ();
					} catch (Throwable  $t) {
						ChromePhp::log("Insert Error: {$datas[0]}, sql => {$sql}");
					}
				}
			}
		}
	}
}
