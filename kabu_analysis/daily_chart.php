<!DOCTYPE html>
<html lang="ja">
<?php
include(dirname(__FILE__) . '/php_class/ChromePhp.php');
include(dirname(__FILE__) . '/php_class/ComnUtil.php');
include(dirname(__FILE__) . '/php_class/CsvUtil.php');
include(dirname(__FILE__) . '/php_class/DailyChartService.php');

if (htmlspecialchars ( $_GET ['action'] ) == "insertDailyChart") {
	ChromePhp::log($_GET['target_date_list']);
	$target_date_list = preg_split("/,/", $_GET['target_date_list']);
	ChromePhp::log($target_date_list);
	$csvUtil = new CsvUtil();
	$csvUtil->insertDailyChart($target_date_list);
} elseif ($_GET['action'] == "updateDailyChartAnalysis") {
	$csvUtil = new CsvUtil();
	DailyChartService::updateDailyChartAnalysis('tanki', 5);
	DailyChartService::updateDailyChartAnalysis('chuki', 12);
	DailyChartService::updateDailyChartAnalysis('choki', 26);
} elseif ($_GET['action'] == "updateDailyChartAnalysisMain") {
	$csvUtil = new CsvUtil();
	DailyChartService::updateDailyChartAnalysisMain('tanki', 5);
	DailyChartService::updateDailyChartAnalysisMain('chuki', 12);
	DailyChartService::updateDailyChartAnalysisMain('choki', 26);
}

?>

<head>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script>
function submit() {
	var url = "./daily_chart.php?action=insertDailyChart"
	var target_date_list = $('#target_date_list').val();
	url = url + "&target_date_list=" + target_date_list;
	location.href = url;
	return false;
}
</script>
<link rel="stylesheet" type="text/css" href="./css/base.css">
<title>日足</title>
</head>
<body>
	<?php include 'header.php'; ?>
	<div class="contents">
		<dl>
			<dt>最終取引日付</dt>
			<dd><?php echo DailyChartService::getMaxTorihikiDate() ?></dd>
		</dl>
		<dl>
			<dt>日足CSV読込対象日</dt>
			<dd><input id="target_date_list" type="text" value="2017-09-04,2017-09-05" /></dd>
		</dl>
		<dl>
			<dt>日足CSV読込</dt>
			<dd><a class="button mini" href="javascript:submit()">実行</a></dd>
		</dl>
		<dl>
			<dt>日足分析値更新（初日のみ）</dt>
			<dd><a class="button mini" href="./daily_chart.php?action=updateDailyChartAnalysis">実行</a></dd>
		</dl>
		<dl>
			<dt>日足分析値更新</dt>
			<dd><a class="button mini" href="./daily_chart.php?action=updateDailyChartAnalysisMain">実行</a></dd>
		</dl>
	</div>
</body>
</html>