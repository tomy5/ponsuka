<html>
<head lang="ja">
<meta http-equiv="Content-Type" content="text/html"; charset=utf8">
<title>結果</title>
</head>
<body bgcolor="#00DDDD">
<?php

include "Player.php";

session_start();


if (isset($_SESSION["players"])) {
	$players = unserialize($_SESSION["players"]);
}

if (isset($_SESSION["MAX_FLAG"])) {
	$MAX_FLAG = $_SESSION["MAX_FLAG"];
}
if (isset($_SESSION["MAX_FING"])) {
	$MAX_FING = $_SESSION["MAX_FING"];
}
if (isset($_SESSION["FLAG"])) {
	$FLAG = $_SESSION["FLAG"];
}

/*
 * 自分が出す値をGETする
 */
if (isset($_GET["you"])) {
	$players[$MAX_FLAG]->setFingImg($_GET["you"]);
}

$total = 0; // 指の合計数
foreach ($players as $i => $value) {
	if ($i != $MAX_FLAG) {
		// 自分以外はランダムで決める
		$value->randFing();
	}
	$value->showPlayer();
	$total += $value->getValue();
	if ($FLAG == $i && $FLAG != $MAX_FLAG) {
		// 自分以外は乱数で決める
		$num = rand(0, $MAX_FING);
		echo "<font size='8'><span style='background-color:#FFFFFF;'> " . $num . " !</span></font>";
	} else if ($FLAG == $MAX_FLAG && $i == $MAX_FLAG) {
		// 自分のターン
		$num = $_GET["pon"];
		echo "<font size='8'><span style='background-color:#FFFFFF;'> " . $num . " !</span></font>";
	}
}
echo "<br><h2>TOTAL: " . $total . "</h2>";

// もしnumとtotalの値が同じなら指の数を減らす
if ($num == $total) {
	$players[$FLAG]->decFing();
	$MAX_FING--;
}

// 指の数が0になったら抜ける(勝ち)
$win = 0; // 勝ちフラグ
$lose = 0; // 負けフラグ
if ($players[$FLAG]->finger == 0) {
	$players->offsetUnset($FLAG);
	if ($FLAG == $MAX_FLAG) {
		$win = 1;
	}
	$MAX_FLAG--;
	// 残りプレイヤーが自分のみになったら負け
	if ($MAX_FLAG == 0) {
		$lose = 1;
	}
}

if ($FLAG < $MAX_FLAG) {
	$FLAG++;
} else {
	$FLAG = 0;
}

// セッションにデータを保存する
$_SESSION["players"] = serialize($players);
$_SESSION["FLAG"] = $FLAG;
$_SESSION["MAX_FLAG"] = $MAX_FLAG;
$_SESSION["MAX_FING"] = $MAX_FING;


?>
<?php
if($win == 1)
	echo '<form action="win.php" method="GET">';
else if($lose == 1)
	echo '<form action="lose.php" method="GET">';
else
	echo '<form action="ponsuka.php" method="GET">';
?>
<input type="hidden" value=1 name="players">
<input type="hidden" value=1 name="FLAG">
<input type="hidden" value=1 name="MAX_FLAG">
<input type="hidden" value=1 name="MAX_FING">
<input type="submit" value="次へ進む">
</form>
</body>
</html>
