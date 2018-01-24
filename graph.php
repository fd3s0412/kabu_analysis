<!DOCTYPE html>
<html lang="ja">
<?php
include (dirname ( __FILE__ ) . '/php_class/ChromePhp.php');
include (dirname ( __FILE__ ) . '/php_class/ComnUtil.php');
include (dirname ( __FILE__ ) . '/php_class/CsvUtil.php');
require_once (dirname ( __FILE__ ) . '/php_class/dao/DailyChartDao.php');

// パラメタ
$shokenCd = $_GET ['shokenCd'];

// グラフ表示用データ取得
$dao = new DailyChartDao ();
ChromePhp::log ( $shokenCd );
$datas = $dao->findByShokenCd ( $shokenCd );
ChromePhp::log ( count ( $datas ) );
?>

<head>
<link rel="stylesheet" type="text/css" href="./css/base.css">
<link rel="stylesheet" type="text/css" href="/js/libs/SgrChart/SgrChart.css">
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script src="/js/libs/SgrChart/SgrChart.js"></script>
<script>
$(function() {
	var datas = <?php echo json_encode($datas); ?>;
	var windowHeight = $(window).innerHeight();
	var headerHeight = $('.header').first().outerHeight();
	var contentsPadding =
			parseInt($('.contents').first().css('padding-top')) +
			parseInt($('.contents').first().css('padding-bottom'));
	var graphHeight = windowHeight - headerHeight - contentsPadding;
	$('#graph').sgrChart(datas, {maxHeight: graphHeight + 'px'});
})
</script>
<title>チャート</title>
</head>
<body>
	<?php include 'header.php'; ?>
	<div class="contents">
		<div id="graph"></div>
	</div>
</body>
</html>