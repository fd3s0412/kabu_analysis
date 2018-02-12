<?php
require_once ($_SERVER['DOCUMENT_ROOT'] . '/kabu_analysis/php_class/ChromePhp.php');
require_once ($_SERVER['DOCUMENT_ROOT'] . '/kabu_analysis/php_class/dao/Chart5mDao.php');
require_once ($_SERVER['DOCUMENT_ROOT'] . '/kabu_analysis/php_class/dao/MasterMeigaraDao.php');

// パラメタ
$shoken_code = $_GET ['shoken_code'];

// グラフ表示用データ取得
$dao = new Chart5mDao ();
$datas = $dao->findByShokenCd ( $shoken_code );
ChromePhp::log ( count ( $datas ) );

// 銘柄データ取得
$masterMeigaraDao = new MasterMeigaraDao ();
$meigara = $masterMeigaraDao->findByShokenCd ( $shoken_code );
ChromePhp::log ( $meigara );
