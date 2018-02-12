<!DOCTYPE html>
<html lang="ja">
<?php
require_once ($_SERVER['DOCUMENT_ROOT'] . '/kabu_analysis/php_class/controller/Chart5mController.php');
?>

<head>
<?php include 'fragment/head.php'; ?>
<title>5分足</title>
<script src="./js/chart5m.js"></script>
</head>
<body>
	<?php include 'header.php'; ?>
	<div class="contents">
		<!-- ------------------------------------------------------------ -->
		<!-- 入力欄 -->
		<!-- ------------------------------------------------------------ -->
		<form method="get" action="chart5m.php">
			<dl>
				<dt>
					証券コード
					<i id="shoken_info_close" class="fa fa-caret-square-o-up fa-2"
						aria-hidden="true"></i>
					<i id="shoken_info_open" class="fa fa-caret-square-o-down fa-2"
						aria-hidden="true"></i>
				</dt>
				<dd>
					<input type="text" name="shoken_code"
						value="<?php echo $shoken_code; ?>" />
				</dd>
			</dl>
			<div id="shoken_info" class="accordion_wrapper">
				<dl>
					<dt>銘柄名</dt>
					<dd><?php echo $meigara['meigaramei']; ?></dd>
				</dl>
				<dl>
					<dt>市場・商品区分</dt>
					<dd><?php echo $meigara['shijo_shohin_kubun']; ?></dd>
				</dl>
				<dl>
					<dt>33業種区分</dt>
					<dd><?php echo $meigara['gyoshu_kubun_a']; ?></dd>
				</dl>
				<dl>
					<dt>17業種区分</dt>
					<dd><?php echo $meigara['gyoshu_kubun_b']; ?></dd>
				</dl>
				<dl>
					<dt>規模区分</dt>
					<dd><?php echo $meigara['kibo_kubun']; ?></dd>
				</dl>
			</div>
		</form>
		<!-- ------------------------------------------------------------ -->
		<!-- 5分足 -->
		<!-- ------------------------------------------------------------ -->
		<div class="scroll_wrapper">
			<table>
				<thead>
					<tr>
						<th>日付</th>
						<th>時刻</th>
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
					</tr>
				</thead>
				<tbody>
					<?php
					$html = '';
					foreach ( $datas as $data ) {
						$line = '<tr>';
						$line .= '<td>' . $data ['torihiki_date'] . '</td>';
						$line .= '<td>' . $data ['torihiki_time'] . '</td>';
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
						$html .= $line . '</tr>';
					}
					echo $html;
					?>
				</tbody>
			</table>
		</div>
	</div>
</body>
</html>