<!DOCTYPE html>
<html lang="ja">
<?php
include (dirname ( __FILE__ ) . '/php_class/ChromePhp.php');
include (dirname ( __FILE__ ) . '/php_class/ComnUtil.php');
include (dirname ( __FILE__ ) . '/php_class/CsvUtil.php');
?>

<head>
<?php include 'fragment/head.php'; ?>
<title>取引ルール登録</title>
</head>
<body>
	<?php include 'header.php'; ?>
	<div class="contents">
		<!-- ------------------------------------------------------------ -->
		<!-- 期間 -->
		<!-- ------------------------------------------------------------ -->
		<h2>期間</h2>
		<dl>
			<dt>期間</dt>
			<dd>
				<input type="number" />
				～
				<input type="number" />
			</dd>
		</dl>
		<!-- ------------------------------------------------------------ -->
		<!-- 買い -->
		<!-- ------------------------------------------------------------ -->
		<h2>買条件</h2>
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
		<!-- ------------------------------------------------------------ -->
		<!-- 売り -->
		<!-- ------------------------------------------------------------ -->
		<h2>売条件</h2>
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
		<!-- ------------------------------------------------------------ -->
		<!-- ボタンエリア -->
		<!-- ------------------------------------------------------------ -->
		<div class="btn_area">
			<a href="#" class="btn_base">検 索</a>
		</div>
	</div>
</body>
</html>