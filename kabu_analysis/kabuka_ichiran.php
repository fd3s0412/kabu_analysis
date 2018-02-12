<!DOCTYPE html>
<html lang="ja">
<?php
include ($_SERVER['DOCUMENT_ROOT'] . '/kabu_analysis/php_class/ChromePhp.php');
include ($_SERVER['DOCUMENT_ROOT'] . '/kabu_analysis/php_class/ComnUtil.php');
include ($_SERVER['DOCUMENT_ROOT'] . '/kabu_analysis/php_class/KabukaService.php');

// データベースに接続
$dsn = "sqlite:kabu.sqlite";
$conn = new PDO ( $dsn );
?>

<head>
<link rel="stylesheet" type="text/css" href="./css/base.css">
<title>株価一覧</title>
</head>
<body>
	<?php include 'header.php'; ?>
	<div class="contents">
		<div class="scroll_wrapper">
			<table>
				<thead>
					<tr>
						<th>&nbsp;</th>
						<th>順位</th>
						<th>コード</th>
						<th>名称</th>
						<th>市場</th>
						<th>取引日付</th>
						<th>取引値</th>
						<th>前日比（額）</th>
						<th>前日比（率）</th>
						<th>出来高</th>
						<th>高値</th>
						<th>安値</th>
						<th>上ひげ率</th>
						<th>業種</th>
						<th>翌営業日</th>
						<th>寄付</th>
						<th>高値</th>
						<th>安値</th>
						<th>勝可能性</th>
						<th>負可能性</th>
						<th>寄付乖離率</th>
						<th>判定</th>
						<th>pips</th>
						<th>p/k</th>
					</tr>
				</thead>
				<tbody>
<?php
// 数値列
$numColList = array (
		"torihikine",
		"zenjitsuhi_gaku",
		"dekidaka",
		"takane",
		"yasune",
		"yoku_yoritsuki",
		"yoku_takane",
		"yoku_yasune",
		"pips",
		"p/k",
		"zenjitsuhi_ritsu",
		"uehigeritsu",
		"yoritsuki_kairiritsu"
);
// パーセント列
$percentColList = array (
		"zenjitsuhi_ritsu",
		"uehigeritsu",
		"yoritsuki_kairiritsu"
);
// 小数
$decimalColList = array (
		"p/k"
);

$resultList = KabukaService::getKabukaList ( $conn );
echo ComnUtil::createTagTrByMapList ( $resultList, $numColList, $percentColList, $decimalColList );
?>
				</tbody>
			</table>
		</div>
	</div>
</body>
</html>