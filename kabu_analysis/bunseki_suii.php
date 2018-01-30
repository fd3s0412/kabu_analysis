<!DOCTYPE html>
<html lang="ja">
<?php
include (dirname ( __FILE__ ) . '/php_class/ComnUtil.php');
include (dirname ( __FILE__ ) . '/php_class/BunsekiSuiiService.php');
include (dirname ( __FILE__ ) . '/php_class/ChromePhp.php');

// パラメータ取得
$shoken_code = htmlspecialchars ( $_GET ['shoken_code'] );
$juni = htmlspecialchars ( $_GET ['juni'] );
$torihikine = htmlspecialchars ( $_GET ['torihikine'] );
$zenjitsuhi_ritsu = htmlspecialchars ( $_GET ['zenjitsuhi_ritsu'] );
$uehigeritsu = htmlspecialchars ( $_GET ['uehigeritsu'] );
$gyoshu = htmlspecialchars ( $_GET ['gyoshu'] );

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
$decimalColList = array (
		"pips_shisu"
);
?>
<head>
<link rel="stylesheet" type="text/css" href="./css/base.css">
<title>推移</title>
</head>
<body>
	<?php include 'header.php'; ?>
	<!--
	//------------------------------------------------------------
	// 各翌営業日
	//------------------------------------------------------------
	//-->
	<div class="contents">
		<h2>各営業日結果</h2>
		<table class="mini">
			<thead>
				<tr>
					<?php echo BunsekiSuiiService::getBunsekiHeader()?>
				</tr>
			</thead>
		<tbody>
<?php
$resultList = BunsekiSuiiService::bunsekiSuiiEach ( $conn );
echo ComnUtil::createTagTrByMapList ( $resultList, $numColList, $percentColList, $decimalColList );
?>
			</tbody>
		</table>
	</div>
	<!--
	//------------------------------------------------------------
	// 累積（日付を重ねるごとにどうなっていくか）
	//------------------------------------------------------------
	//-->
	<div class="contents">
		<h2>累積</h2>
		<table class="mini">
			<thead>
				<tr>
					<?php echo BunsekiSuiiService::getBunsekiHeader()?>
				</tr>
			</thead>
			<tbody>
<?php
$resultList = BunsekiSuiiService::bunsekiSuiiRuiseki ( $resultList );
echo ComnUtil::createTagTrByMapList ( $resultList, $numColList, $percentColList, $decimalColList );
?>
			</tbody>
		</table>
	</div>
	</body>
</html>