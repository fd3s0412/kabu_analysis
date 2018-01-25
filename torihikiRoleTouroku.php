<!DOCTYPE html>
<html lang="ja">
<?php
include (dirname ( __FILE__ ) . '/php_class/ChromePhp.php');
include (dirname ( __FILE__ ) . '/php_class/ComnUtil.php');
include (dirname ( __FILE__ ) . '/php_class/CsvUtil.php');
?>

<head>
<link rel="stylesheet" type="text/css" href="./css/base.css">
<link rel="stylesheet" type="text/css"
	href="/js/libs/SgrChart/SgrChart.css">
<script
	src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script src="/js/libs/SgrChart/SgrChart.js"></script>
<title>チャート</title>
</head>
<body>
	<?php include 'header.php'; ?>
	<div class="contents">
		<div class="one_block">
			<dl>
				<dt>期間</dt>
				<dd>
					<input type="number" />
					～
					<input type="number" />
				</dd>
			</dl>
		</div>
		<div class="two_block">
			<dl>
				<dt>始値</dt>
				<dd><input type="number" /></dd>
			</dl>
			<dl>
				<dt>高値</dt>
				<dd><input type="number" /></dd>
			</dl>
			<dl>
				<dt>安値</dt>
				<dd><input type="number" /></dd>
			</dl>
			<dl>
				<dt>終値</dt>
				<dd><input type="number" /></dd>
			</dl>
			<dl>
				<dt>移動平均短期乖離率</dt>
				<dd><input type="number" /></dd>
			</dl>
			<dl>
				<dt>移動平均中期乖離率</dt>
				<dd><input type="number" /></dd>
			</dl>
			<dl>
				<dt>移動平均長期乖離率</dt>
				<dd><input type="number" /></dd>
			</dl>
			<dl>
				<dt>RSI</dt>
				<dd><input type="number" /></dd>
			</dl>
			<dl>
				<dt>MACD</dt>
				<dd><input type="number" /></dd>
			</dl>
			<dl>
				<dt>シグナル</dt>
				<dd><input type="number" /></dd>
			</dl>
		</div>
		<div class="two_block">
			<dl>
				<dt>始値</dt>
				<dd><input type="number" /></dd>
			</dl>
			<dl>
				<dt>高値</dt>
				<dd><input type="number" /></dd>
			</dl>
			<dl>
				<dt>安値</dt>
				<dd><input type="number" /></dd>
			</dl>
			<dl>
				<dt>終値</dt>
				<dd><input type="number" /></dd>
			</dl>
			<dl>
				<dt>移動平均短期乖離率</dt>
				<dd><input type="number" /></dd>
			</dl>
			<dl>
				<dt>移動平均中期乖離率</dt>
				<dd><input type="number" /></dd>
			</dl>
			<dl>
				<dt>移動平均長期乖離率</dt>
				<dd><input type="number" /></dd>
			</dl>
			<dl>
				<dt>RSI</dt>
				<dd><input type="number" /></dd>
			</dl>
			<dl>
				<dt>MACD</dt>
				<dd><input type="number" /></dd>
			</dl>
			<dl>
				<dt>シグナル</dt>
				<dd><input type="number" /></dd>
			</dl>
		</div>
		<div class="btn_area">
			<a href="#" class="btn_base">検 索</a>
		</div>
	</div>
</body>
</html>