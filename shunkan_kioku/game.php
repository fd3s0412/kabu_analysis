<!DOCTYPE html>
<html lang="ja">
<head>
<?php include './header.php'; ?>
<script src="./js/game.js"></script>
</head>
<body>
	<div class="title">瞬間記憶</div>
	<div class="view">
	</div>
	<div class="num_pad">
		<div class="input_view">&nbsp;</div>
		<table>
			<tr>
				<td data-num="7">7</td>
				<td data-num="8">8</td>
				<td data-num="9">9</td>
				<td id="btnClear" rowspan="2">Clear</td>
			</tr>
			<tr>
				<td data-num="4">4</td>
				<td data-num="5">5</td>
				<td data-num="6">6</td>
			</tr>
			<tr>
				<td data-num="1">1</td>
				<td data-num="2">2</td>
				<td data-num="3">3</td>
				<td id="btnOk" rowspan="2">OK</td>
			</tr>
			<tr>
				<td colspan="3" data-num="0">0</td>
			</tr>
		</table>
	</div>
</body>
</html>