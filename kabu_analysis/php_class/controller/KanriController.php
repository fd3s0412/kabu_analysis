<?php
require_once ($_SERVER ['DOCUMENT_ROOT'] . '/kabu_analysis/php_class/ChromePhp.php');
require_once ($_SERVER ['DOCUMENT_ROOT'] . '/kabu_analysis/php_class/dao/Chart5mDao.php');
require_once ($_SERVER ['DOCUMENT_ROOT'] . '/kabu_analysis/php_class/dao/ChartDailyDao.php');
require_once ($_SERVER ['DOCUMENT_ROOT'] . '/kabu_analysis/php_class/dao/MasterMeigaraDao.php');

class Kanri {
	/**
	 * 日足取込実施.
	 */
	public function inserDalilyCharttByCsv() {
		// ファイルパスリストを取得
		$fileList = $this->getDailyChartCsvFileNameList();

		// 証券コードごとにファイルになっているため、登録

	}

	/**
	 * 日足CSVファイルパスリストを取得する.
	 *
	 * @return array
	 */
	private function getDailyChartCsvFileNameList() {
		$fileList = array();
		// 日足取込処理
		if (isset ( $_POST ['inserDalilyCharttByCsv'] )) {
			foreach(glob($_SERVER ['DOCUMENT_ROOT'] . '/kabu_analysis/csv/daily/*',GLOB_BRACE) as $file){
				if(is_file($file)){
					array_push($fileList, htmlspecialchars($file));
				}
			}
		}
		return $fileList;
	}

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
}

$kanri = new Kanri();
$kanri->inserDalilyCharttByCsv();
