<?php
require_once ($_SERVER ['DOCUMENT_ROOT'] . '/kabu_analysis/php_class/ChromePhp.php');
require_once ($_SERVER ['DOCUMENT_ROOT'] . '/kabu_analysis/php_class/entity/Chart5m.php');
require_once ($_SERVER ['DOCUMENT_ROOT'] . '/kabu_analysis/php_class/dao/Chart5mDao.php');
require_once ($_SERVER ['DOCUMENT_ROOT'] . '/kabu_analysis/php_class/dao/ChartDailyDao.php');
require_once ($_SERVER ['DOCUMENT_ROOT'] . '/kabu_analysis/php_class/dao/MasterMeigaraDao.php');
class Kanri {
	/**
	 * 日足取込実施.
	 */
	public function inserDalilyCharttByCsv() {
		// ファイルパスリストを取得
		$csvPathList = $this->getCsvPathListForChart5m ();
		foreach ( $csvPathList as $csvPath ) {
			ChromePhp::log ( $csvPath );
			// 証券コードごとにわかれているCSVを登録する
			$this->insertUpdateChart5mByCsv ( $csvPath );
		}
	}

	/**
	 * 日足CSVファイルパスリストを取得する.
	 *
	 * @return array
	 */
	private function getCsvPathListForChart5m() {
		$fileList = array ();
		// 日足取込処理
		foreach ( glob ( $_SERVER ['DOCUMENT_ROOT'] . '/kabu_analysis/csv/5m/*', GLOB_BRACE ) as $file ) {
			if (is_file ( $file )) {
				array_push ( $fileList, htmlspecialchars ( $file ) );
			}
		}
		return $fileList;
	}

	/**
	 * CSVファイルを基に5分足データを登録する.
	 *
	 * @param unknown $csvPath
	 */
	public function insertUpdateChart5mByCsv($csvPath) {
		if (($fp = fopen ( $csvPath, "r" )) === false) {
			ChromePhp::log ( "file open error: {$csvPath}" );
			// エラー処理
			return;
		}
		// CSVの中身がダブルクオーテーションで囲われていない場合に一文字目が化けるのを回避
		setlocale ( LC_ALL, 'ja_JP' );

		$shoken_code = preg_replace ( '/(^.*\/|\.csv$)/im', '', $csvPath );

		$chart5mDao = new Chart5mDao ();
		$i = 0;
		while ( ($lineDatas = fgetcsv ( $fp )) !== FALSE ) {
			mb_convert_variables ( 'UTF-8', 'sjis-win', $lineDatas );
			// 3行目からデータ行
			if ($i >= 3) {
				$entity = new Chart5m ();
				$entity->shoken_code = $shoken_code;
				$entity->torihiki_date = str_replace ( '-', '', $lineDatas [0] );
				$entity->torihiki_time = preg_replace ( '/(:00$|:)/m', '', $lineDatas [1] );
				$entity->hajimene = $lineDatas [2];
				$entity->takane = $lineDatas [3];
				$entity->yasune = $lineDatas [4];
				$entity->owarine = $lineDatas [5];
				$entity->dekidaka = $lineDatas [6];
				$entity->macd = $lineDatas [8];
				$entity->signal = $lineDatas [9];
				$entity->osci = $lineDatas [10];
				$entity->rsi = $lineDatas [11];
				$entity->ema_kairiritsu_12 = $lineDatas [12];
				$entity->ema_kairiritsu_26 = $lineDatas [13];
				$entity->ema_12 = $lineDatas [14];
				$entity->ema_26 = $lineDatas [15];
				$chart5mDao->update ( $entity );
				$chart5mDao->insert ( $entity );
			}
			$i ++;
		}
		fclose ( $fp );
	}
}

if (isset ( $_POST ['inserDalilyCharttByCsv'] )) {
	$kanri = new Kanri ();
	$kanri->inserDalilyCharttByCsv ();
}