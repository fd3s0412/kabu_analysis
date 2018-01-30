<!DOCTYPE html>
<html lang="ja">
<?php
include (dirname ( __FILE__ ) . '/php_class/ComnUtil.php');
include (dirname ( __FILE__ ) . '/php_class/BunsekiService.php');
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
<title>類似</title>
</head>
<body>
	<?php include 'header.php'; ?>
	<div class="contents">
		<table class="mini">
			<thead>
				<tr>
					<th>項目名</th>
					<th>値</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<th>証券コード</th>
					<td><input type="number" value="<?php echo $shoken_code ?>" /></td>
				</tr>
				<tr>
					<th>順位</th>
					<td><input type="number" value="<?php echo $juni ?>" /></td>
				</tr>
				<tr>
					<th>取引値</th>
					<td><input type="number" value="<?php echo $torihikine ?>" /></td>
				</tr>
			</tbody>
		</table>
		<table class="mini">
			<thead>
				<tr>
					<th>項目名</th>
					<th>値</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<th>前日比</th>
					<td><input type="number" value="<?php echo $zenjitsuhi_ritsu ?>" />
					</td>
				</tr>
				<tr>
					<th>上ひげ率</th>
					<td><input type="number" value="<?php echo $uehigeritsu ?>" /></td>
				</tr>
				<tr>
					<th>業種</th>
					<td><input type="text" value="<?php echo $gyoshu ?>" /></td>
				</tr>
			</tbody>
		</table>
		<a class="button" href="#">検索</a>
	</div>
	<!--
	//------------------------------------------------------------
	// 取引値・前日比（率）・上ひげ率・業種
	//------------------------------------------------------------
	//-->
	<div class="contents">
		<h2>分析結果</h2>
		<table class="mini">
			<thead>
				<tr>
					<th>条件</th>
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
$resultList = BunsekiService::bunsekiRuiji ( $conn, $shoken_code, $juni, $torihikine, $zenjitsuhi_ritsu, $uehigeritsu, $gyoshu );
echo ComnUtil::createTagTrByMapList ( $resultList, $numColList, $percentColList, $decimalColList );
?>
			</tbody>
		</table>
	</div>
</body>
</html>