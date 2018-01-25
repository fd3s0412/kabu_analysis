<!DOCTYPE html>
<html lang="ja">
<?php
require_once (dirname ( __FILE__ ) . '/php_class/ChromePhp.php');
require_once (dirname ( __FILE__ ) . '/php_class/dao/Chart5mDao.php');

// パラメタ
$shoken_code = $_GET ['shoken_code'];

// グラフ表示用データ取得
$dao = new Chart5mDao ();
$datas = $dao->findByShokenCd ( $shoken_code );
ChromePhp::log ( count ( $datas ) );
?>

<head>
<?php include 'fragment/head.php'; ?>
<title>5分足</title>
</head>
<body>
	<?php include 'header.php'; ?>
	<div class="contents">
		<form method="get" action="chart5m.php">
			<dl>
				<dt>証券コード</dt>
				<dd>
					<input type="text" name="shoken_code"
						value="<?php echo $shoken_code; ?>" />
				</dd>
			</dl>
		</form>
		<!-- ------------------------------------------------------------ -->
		<!-- 5分足 -->
		<!-- ------------------------------------------------------------ -->
		<table>
			<thead>
				<tr>
					<th>証券コード</th>
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
					$line .= '<td>' . $data ['shoken_code'] . '</td>';
					$line .= '<td>' . $data ['torihiki_date'] . '</td>';
					$line .= '<td>' . $data ['torihiki_time'] . '</td>';
					$line .= '<td>' . $data ['hajimene'] . '</td>';
					$line .= '<td>' . $data ['takane'] . '</td>';
					$line .= '<td>' . $data ['yasune'] . '</td>';
					$line .= '<td>' . $data ['owarine'] . '</td>';
					$line .= '<td>' . $data ['volume'] . '</td>';
					$line .= '<td>' . $data ['ma_short'] . '</td>';
					$line .= '<td>' . $data ['ma_middle'] . '</td>';
					$line .= '<td>' . $data ['ma_long'] . '</td>';
					$line .= '<td>' . $data ['macd'] . '</td>';
					$line .= '<td>' . $data ['signal'] . '</td>';
					$line .= '<td>' . $data ['osci'] . '</td>';
					$line .= '<td>' . $data ['rsi'] . '</td>';
					$html .= $line . '</tr>';
				}
				echo $html;
				?>
			</tbody>
		</table>
	</div>
</body>
</html>