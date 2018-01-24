<!DOCTYPE html>
<html lang="ja">
<head>
<?php include './header.php'; ?>
</head>
<body>
	<div class="title">瞬間記憶</div>
	<ul class="menu_list select_list">
		<li>難易度</li>
		<li><input id="chkEasy" name="rdoNanido" type="radio" value="5" /><label for="chkEasy">EASY</label></li>
		<li><input id="chkNormal" name="rdoNanido" type="radio" value="7" checked="checked" /><label for="chkNormal">NORMAL</label></li>
		<li><input id="chkHard" name="rdoNanido" type="radio" value="9" /><label for="chkHard">HARD</label></li>
		<li><input id="chkVeryHard" name="rdoNanido" type="radio" value="11" /><label for="chkVeryHard">VERY HARD</label></li>
		<li><input id="chkInferno" name="rdoNanido" type="radio" value="13" /><label for="chkInferno">INFERNO</label></li>
	</ul>
	<ul class="menu_list">
		<li><a href="./game.php">スタート</a></li>
	</ul>
</body>
</html>