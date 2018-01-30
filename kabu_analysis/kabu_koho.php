<!DOCTYPE html>
<html lang="ja">
<?php
include (dirname ( __FILE__ ) . '/php_class/ComnUtil.php');
include (dirname ( __FILE__ ) . '/php_class/KabuKohoService.php');

// データベースに接続
$dsn = "sqlite:kabu.sqlite";
$conn = new PDO ( $dsn );
?>
<head>
<link rel="stylesheet" type="text/css" href="./css/base.css">
<title>候補一覧</title>
</head>
<body>
	<?php include 'header.php'; ?>
	<div class="contents">
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
					<th>前日比<br />（額）
					</th>
					<th>前日比<br />（率）
					</th>
					<th>出来高</th>
					<th>高値</th>
					<th>安値</th>
					<th>上ひげ率</th>
					<th>業種</th>
					<th>翌営業日</th>
				</tr>
			</thead>
			<tbody>
<?php
// 数値列
$numColList = array (
		"torihikine",
		"zenjitsuhi_gaku",
		"zenjitsuhi_ritsu",
		"dekidaka",
		"takane",
		"yasune",
		"uehigeritsu"
);
// パーセント列
$percentColList = array (
		"zenjitsuhi_ritsu",
		"uehigeritsu"
);
$resultList = KabuKohoService::getKabuKohoList ( $conn );
echo ComnUtil::createTagTrByMapList ( $resultList, $numColList, $percentColList, array() );
?>
			</tbody>
		</table>
	</div>
</body>
</html>