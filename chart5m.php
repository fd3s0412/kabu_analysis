<!DOCTYPE html>
<html lang="ja">
<?php
require_once (dirname ( __FILE__ ) . '/php_class/ChromePhp.php');
require_once (dirname ( __FILE__ ) . '/php_class/dao/Chart5mDao.php');
require_once (dirname ( __FILE__ ) . '/php_class/dao/MasterMeigaraDao.php');

// パラメタ
$shoken_code = $_GET ['shoken_code'];

// グラフ表示用データ取得
$dao = new Chart5mDao ();
$datas = $dao->findByShokenCd ( $shoken_code );
ChromePhp::log ( count ( $datas ) );

// 銘柄データ取得
$masterMeigaraDao = new MasterMeigaraDao ();
$meigara = $masterMeigaraDao->findByShokenCd ( $shoken_code );
ChromePhp::log ( $meigara );
?>

<head>
<?php include 'fragment/head.php'; ?>
<title>5分足</title>
<script src="./js/libs/ResizeInner/ResizeInner.js"></script>
<script src="./js/libs/AccordionWrapper/AccordionWrapper.js"></script>
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
					<i id="btnAccordionClose" class="fa fa-caret-square-o-up fa-2" aria-hidden="true"></i>
					<i id="btnAccordionOpen" class="fa fa-caret-square-o-down fa-2" aria-hidden="true"></i>
				</dt>
				<dd>
					<input type="text" name="shoken_code"
						value="<?php echo $shoken_code; ?>" />
				</dd>
			</dl>
			<div class="accordion_wrapper">
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
						<th>移動平均短期</th>
						<th>移動平均中期</th>
						<th>移動平均長期</th>
						<th>MACD</th>
						<th>シグナル</th>
						<th>OSCI</th>
						<th>RSI</th>
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
						$line .= '<td class="align_right">' . $data ['volume'] . '</td>';
						$line .= '<td class="align_right">' . $data ['ma_short'] . '</td>';
						$line .= '<td class="align_right">' . $data ['ma_middle'] . '</td>';
						$line .= '<td class="align_right">' . $data ['ma_long'] . '</td>';
						$line .= '<td class="align_right">' . $data ['macd'] . '</td>';
						$line .= '<td class="align_right">' . $data ['signal'] . '</td>';
						$line .= '<td class="align_right">' . $data ['osci'] . '</td>';
						$line .= '<td class="align_right">' . $data ['rsi'] . '</td>';
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