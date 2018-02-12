<!DOCTYPE html>
<html lang="ja">
<?php
include ($_SERVER['DOCUMENT_ROOT'] . '/kabu_analysis/php_class/ComnUtil.php');
include ($_SERVER['DOCUMENT_ROOT'] . '/kabu_analysis/php_class/BunsekiService.php');
include ($_SERVER['DOCUMENT_ROOT'] . '/kabu_analysis/php_class/ChromePhp.php');

// データベースに接続
$dsn = "sqlite:kabu.sqlite";
$conn = new PDO ( $dsn );

// 数値列
$numColList = array (
		"count",
		"count_win",
		"count_lose",
		"count_sub_win",
		"count_sub_lose",
		"pips",
		"shoritsu",
		"pips_shisu"
);

// パーセント列
$percentColList = array (
		"shoritsu"
);
// 小数
$decimalColList = array(
		"pips_shisu"
);
?>
<head>
<link rel="stylesheet" type="text/css" href="./css/base.css">
<title>分析</title>
</head>
<body>
	<?php include 'header.php'; ?>
	<div class="contents">
		<table class="mini">
			<thead>
				<tr>
					<th>項目名</th>
					<th>刻み値</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<th>取引値</th>
					<td>
						<input type="number" value="1000" />
					</td>
				</tr>
				<tr>
					<th>前日比</th>
					<td>
						<input type="number" value="0.01" />
					</td>
				</tr>
				<tr>
					<th>上ひげ率</th>
					<td>
						<input type="number" value="0.05" />
					</td>
				</tr>
				<tr>
					<th>寄付乖離率</th>
					<td>
						<input type="number" value="0.01" />
					</td>
				</tr>
			</tbody>
		</table>
		<a class="button" href="#">検索</a>
	</div>
	<!--
	//------------------------------------------------------------
	// 営業日
	//------------------------------------------------------------
	//-->
	<div class="contents">
		<h2>営業日</h2>
		<table class="mini">
			<thead>
				<tr>
					<th>翌営業日</th>
					<th>全体</th>
					<th>勝</th>
					<th>負</th>
					<th>(勝)</th>
					<th>(負)</th>
					<th>pips</th>
					<th>勝率</th>
					<th>pips指数</th>
					<th>pips指数ゲージ</th>
				</tr>
			</thead>
			<tbody>
<?php
// 翌営業日による分析結果の取得
$resultList = BunsekiService::bunsekiYokueigyobi ( $conn );
echo ComnUtil::createTagTrByMapList ( $resultList, $numColList, $percentColList, $decimalColList );
?>
			</tbody>
		</table>
	</div>
	<!--
	//------------------------------------------------------------
	// 順位
	//------------------------------------------------------------
	//-->
	<div class="contents">
		<h2>順位</h2>
		<table class="mini">
			<thead>
				<tr>
					<?php echo BunsekiService::getBunsekiHeader()?>
				</tr>
			</thead>
			<tbody>
<?php
$resultList = BunsekiService::bunseki ( $conn, 5, 0, 50, 'juni' );
echo ComnUtil::createTagTrByMapList ( $resultList, $numColList, $percentColList, $decimalColList );
?>
			</tbody>
		</table>
	</div>
	<!--
	//------------------------------------------------------------
	// 取引値
	//------------------------------------------------------------
	//-->
	<div class="contents">
		<h2>取引値</h2>
		<table class="mini">
			<thead>
				<tr>
					<?php echo BunsekiService::getBunsekiHeader()?>
				</tr>
			</thead>
			<tbody>
<?php
$resultList = BunsekiService::bunseki ( $conn, 1000, 0, 35000, 'torihikine' );
echo ComnUtil::createTagTrByMapList ( $resultList, $numColList, $percentColList, $decimalColList );
?>
			</tbody>
		</table>
	</div>
	<!--
	//------------------------------------------------------------
	// 前日比（率）
	//------------------------------------------------------------
	//-->
	<div class="contents">
		<h2>前日比（率）</h2>
		<table class="mini">
			<thead>
				<tr>
					<?php echo BunsekiService::getBunsekiHeader()?>
				</tr>
			</thead>
			<tbody>
<?php
$resultList = BunsekiService::bunseki ( $conn, 0.01, 0, 30, 'zenjitsuhi_ritsu' );
echo ComnUtil::createTagTrByMapList ( $resultList, $numColList, $percentColList, $decimalColList );
?>
			</tbody>
		</table>
	</div>
	<!--
	//------------------------------------------------------------
	// 上ひげ率
	//------------------------------------------------------------
	//-->
	<div class="contents">
		<h2>上ひげ率</h2>
		<table class="mini">
			<thead>
				<tr>
					<?php echo BunsekiService::getBunsekiHeader()?>
				</tr>
			</thead>
			<tbody>
<?php
$resultList = BunsekiService::bunseki ( $conn, 0.03, 0, 101, 'uehigeritsu' );
echo ComnUtil::createTagTrByMapList ( $resultList, $numColList, $percentColList, $decimalColList );
?>
			</tbody>
		</table>
	</div>
	<!--
	//------------------------------------------------------------
	// 寄付乖離率
	//------------------------------------------------------------
	//-->
	<div class="contents">
		<h2>寄付乖離率</h2>
		<table class="mini">
			<thead>
				<tr>
					<?php echo BunsekiService::getBunsekiHeader()?>
				</tr>
			</thead>
			<tbody>
<?php
$resultList = BunsekiService::bunseki ( $conn, 0.01, - 0.1, 0.1, 'yoritsuki_kairiritsu' );
echo ComnUtil::createTagTrByMapList ( $resultList, $numColList, $percentColList, $decimalColList );
?>
			</tbody>
		</table>
	</div>
	<!--
	//------------------------------------------------------------
	// 業種
	//------------------------------------------------------------
	//-->
	<div class="contents">
		<h2>業種</h2>
		<table class="mini">
			<thead>
				<tr>
					<th>業種</th>
					<th>全体</th>
					<th>勝</th>
					<th>負</th>
					<th>(勝)</th>
					<th>(負)</th>
					<th>pips</th>
					<th>勝率</th>
					<th>pips指数</th>
					<th>pips指数ゲージ</th>
				</tr>
			</thead>
			<tbody>
<?php
$resultList = BunsekiService::bunsekiGyoshu ( $conn );
echo ComnUtil::createTagTrByMapList ( $resultList, $numColList, $percentColList, $decimalColList );
?>
			</tbody>
		</table>
	</div>
</body>
</html>