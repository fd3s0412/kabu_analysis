<!DOCTYPE html>
<html lang="ja">
<?php
require_once ($_SERVER ['DOCUMENT_ROOT'] . '/kabu_analysis/php_class/controller/KanriController.php');
?>

<head>
<?php include 'fragment/head.php'; ?>
<title>管理</title>
<script src="./js/kanri.js"></script>
</head>
<body>
	<?php include 'header.php'; ?>
	<div class="contents">
		<form id="kanri" method="post" action="./kanri.php">
			<!-- ------------------------------------------------------------ -->
			<!-- ボタンエリア -->
			<!-- ------------------------------------------------------------ -->
			<div class="btn_area">
				<a href="#" id="insertDailyChartByCsv" class="btn_base">日足取込</a>
			</div>
		</form>
	</div>
</body>
</html>