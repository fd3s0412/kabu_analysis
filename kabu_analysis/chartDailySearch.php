<!DOCTYPE html>
<html lang="ja">
<?php
require_once ($_SERVER ['DOCUMENT_ROOT'] . '/kabu_analysis/php_class/controller/ChartDailySearchController.php');
?>

<head>
<?php include 'fragment/head.php'; ?>
<title>取引シミュレーション（日足）</title>
<script>
$(function() {
	<?php if (isset ($datas)) { ?>
	window.DATAS = <?php echo json_encode($datas); ?>;
	<?php } ?>
});
</script>
<script src="./js/chartDailySearch.js"></script>
</head>
<body>
	<?php include 'header.php'; ?>
	<div class="contents">
		<form id="chartDailySearch" method="get" action="./chartDailySearch.php">
			<?php include 'fragment/searchArea.php'; ?>
			<!-- ------------------------------------------------------------ -->
			<!-- ボタンエリア -->
			<!-- ------------------------------------------------------------ -->
			<div class="btn_area">
				<a href="#" class="btn_base btn_search">検 索</a>
				<a id="btnRiekiKeisan" href="#" class="btn_base">利益計算</a>
				<input type="hidden" name="execute" value="true" />
			</div>
		</form>
		<!-- ------------------------------------------------------------ -->
		<!-- 5分足 -->
		<!-- ------------------------------------------------------------ -->
		<div class="scroll_wrapper">
			<table id="torihiki_table">
				<thead>
					<tr>
						<th>日付</th>
						<th>始値</th>
						<th>高値</th>
						<th>安値</th>
						<th>終値</th>
						<th>出来高</th>
						<th>MACD</th>
						<th>シグナル</th>
						<th>OSCI</th>
						<th>RSI</th>
						<th>EMA(12)乖離率</th>
						<th>EMA(26)乖離率</th>
						<th>EMA(12)</th>
						<th>EMA(26)</th>
						<th>粗利益</th>
						<th>累計</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$html = '';
					if (isset ( $datas )) {
						foreach ( $datas as $data ) {
							$line = '<tr class="' . ($data ['buy_flg'] ? ' buy_row' : '') . ($data ['sell_flg'] ? ' sell_row' : '') . '">';
							$line .= '<td>' . $data ['torihiki_date'] . '</td>';
							$line .= '<td class="align_right">' . $data ['hajimene'] . '</td>';
							$line .= '<td class="align_right">' . $data ['takane'] . '</td>';
							$line .= '<td class="align_right">' . $data ['yasune'] . '</td>';
							$line .= '<td class="align_right">' . $data ['owarine'] . '</td>';
							$line .= '<td class="align_right">' . $data ['dekidaka'] . '</td>';
							$line .= '<td class="align_right">' . $data ['macd'] . '</td>';
							$line .= '<td class="align_right">' . $data ['signal'] . '</td>';
							$line .= '<td class="align_right">' . $data ['osci'] . '</td>';
							$line .= '<td class="align_right">' . $data ['rsi'] . '</td>';
							$line .= '<td class="align_right">' . $data ['ema_kairiritsu_12'] . '</td>';
							$line .= '<td class="align_right">' . $data ['ema_kairiritsu_26'] . '</td>';
							$line .= '<td class="align_right">' . $data ['ema_12'] . '</td>';
							$line .= '<td class="align_right">' . $data ['ema_26'] . '</td>';
							$line .= '<td></td>';
							$line .= '<td></td>';
							$html .= $line . '</tr>';
						}
					}
					echo $html;
					?>
				</tbody>
			</table>
		</div>
	</div>
</body>
</html>