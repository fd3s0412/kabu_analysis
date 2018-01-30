<!DOCTYPE html>
<html lang="ja">
<?php
include (dirname ( __FILE__ ) . '/php_class/ChromePhp.php');
include (dirname ( __FILE__ ) . '/php_class/ComnUtil.php');
include (dirname ( __FILE__ ) . '/php_class/CsvUtil.php');
?>

<head>
<?php include 'fragment/head.php'; ?>
<title>取引シミュレーション</title>
<script src="./js/chart5mSearch.js"></script>
</head>
<body>
	<?php include 'header.php'; ?>
	<div class="contents">
		<form method="get" action="chart5m.php">
			<!-- ------------------------------------------------------------ -->
			<!-- 基本情報 -->
			<!-- ------------------------------------------------------------ -->
			<dl>
				<dt>
					証券コード
					<i id="search_field_close" class="fa fa-caret-square-o-up fa-2"
						aria-hidden="true"></i>
					<i id="search_field_open" class="fa fa-caret-square-o-down fa-2"
						aria-hidden="true"></i>
				</dt>
				<dd>
					<input type="text" name="shoken_code" value="3656" />
				</dd>
			</dl>
			<div id="search_field">
				<!-- ------------------------------------------------------------ -->
				<!-- 期間 -->
				<!-- ------------------------------------------------------------ -->
				<h2>期間</h2>
				<dl>
					<dt>日付</dt>
					<dd>
						<input type="number" />
						～
						<input type="number" />
					</dd>
				</dl>
				<dl>
					<dt>時刻</dt>
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
					<dd>
						<input type="number" />
					</dd>
				</dl>
				<dl>
					<dt>高値</dt>
					<dd>
						<input type="number" />
					</dd>
				</dl>
				<dl>
					<dt>安値</dt>
					<dd>
						<input type="number" />
					</dd>
				</dl>
				<dl>
					<dt>終値</dt>
					<dd>
						<input type="number" />
					</dd>
				</dl>
				<dl>
					<dt>移動平均短期乖離率</dt>
					<dd>
						<input type="number" />
					</dd>
				</dl>
				<dl>
					<dt>移動平均中期乖離率</dt>
					<dd>
						<input type="number" />
					</dd>
				</dl>
				<dl>
					<dt>移動平均長期乖離率</dt>
					<dd>
						<input type="number" />
					</dd>
				</dl>
				<dl>
					<dt>RSI</dt>
					<dd>
						<input type="number" />
					</dd>
				</dl>
				<dl>
					<dt>MACD</dt>
					<dd>
						<input type="number" />
					</dd>
				</dl>
				<dl>
					<dt>シグナル</dt>
					<dd>
						<input type="number" />
					</dd>
				</dl>
				<!-- ------------------------------------------------------------ -->
				<!-- 売り -->
				<!-- ------------------------------------------------------------ -->
				<h2>売条件</h2>
				<dl>
					<dt>始値</dt>
					<dd>
						<input type="number" />
					</dd>
				</dl>
				<dl>
					<dt>高値</dt>
					<dd>
						<input type="number" />
					</dd>
				</dl>
				<dl>
					<dt>安値</dt>
					<dd>
						<input type="number" />
					</dd>
				</dl>
				<dl>
					<dt>終値</dt>
					<dd>
						<input type="number" />
					</dd>
				</dl>
				<dl>
					<dt>移動平均短期乖離率</dt>
					<dd>
						<input type="number" />
					</dd>
				</dl>
				<dl>
					<dt>移動平均中期乖離率</dt>
					<dd>
						<input type="number" />
					</dd>
				</dl>
				<dl>
					<dt>移動平均長期乖離率</dt>
					<dd>
						<input type="number" />
					</dd>
				</dl>
				<dl>
					<dt>RSI</dt>
					<dd>
						<input type="number" />
					</dd>
				</dl>
				<dl>
					<dt>MACD</dt>
					<dd>
						<input type="number" />
					</dd>
				</dl>
				<dl>
					<dt>シグナル</dt>
					<dd>
						<input type="number" />
					</dd>
				</dl>
			</div>
			<!-- ------------------------------------------------------------ -->
			<!-- ボタンエリア -->
			<!-- ------------------------------------------------------------ -->
			<div class="btn_area">
				<a href="#" id="btnSearch" class="btn_base">検 索</a>
			</div>
		</form>
	</div>
</body>
</html>