<?php
require_once ($_SERVER ['DOCUMENT_ROOT'] . '/kabu_analysis/php_class/ChromePhp.php');
require_once ($_SERVER ['DOCUMENT_ROOT'] . '/kabu_analysis/php_class/dao/Chart5mDao.php');
require_once ($_SERVER ['DOCUMENT_ROOT'] . '/kabu_analysis/php_class/dao/MasterMeigaraDao.php');
require_once ($_SERVER ['DOCUMENT_ROOT'] . '/kabu_analysis/php_class/form/ChartSearchForm.php');

$form = new ChartSearchForm ();

// 検索処理実施
if (isset ( $_GET ['execute'] )) {

	// 銘柄データ取得
	$masterMeigaraDao = new MasterMeigaraDao ();
	$meigara = $masterMeigaraDao->findByShokenCd ( $form->shoken_code );
	ChromePhp::log ( $meigara );

	// グラフ表示用データ取得
	$dao = new Chart5mDao ();
	$datas = $dao->findByConditions ( $form );
	ChromePhp::log ( count ( $datas ) );
} else {
	// 初期値設定
	$form->shoken_code = '3656';
	$form->buy_osci_to = '-0.01';
	$form->sell_osci_from = '0.01';
	$form->songiriritsu = '2';
}
