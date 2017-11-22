<html>
<head lang="ja">
<meta http-equiv="Content-Type" content="text/html"; charset=utf8">
<title>ぽんすか TOP</title>
</head>
<body bgcolor="#00DDDD">
<form action="ponsuka.php" method="get">
<font size="6"><center><h3>ぽんすか</h3></center></font>
<?php
$a = rand(1, 11);
// ランダムでキャラクターを決める
echo '<center><IMG src="img/index' . $a . '.png"/></center>';
?>
<center>
<br>
地域によって名前が違うゲーム(いっせーのせ、ぽんすか)など...
<br>
<br>
+----------------------------------------------------------------------------------------------------------------+
<br>
ルール
<br>
<br>
ぽんすか $NUMBER の $NUMBER のタイミングで同時に親指を上に上げる<br>その場に出た親指の数と $NUMBER の数が一致すれば指を一つ減らせる
<br>
2回成功すれば勝ち
<br><br>
+----------------------------------------------------------------------------------------------------------------+
<p>対戦人数を選んでね</p>
<br>
<p>対戦人数</p>
<input type="number" name="num" min="1" max="4" value="4">
<input type="submit" value="決定">
</center>
</form>
</body>
</html>

