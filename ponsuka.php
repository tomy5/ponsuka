<html>
<head lang="ja">
<meta http-equiv="Content-Type" content="text/html"; charset=utf8">
<title>ぽんすか</title>
</head>
<body bgcolor="#00DDDD">
<?php

include "Player.php";

session_start();

/*
 * プレイヤー数を設定する
 */
if (isset($_GET["num"])) {
	$num = $_GET["num"];
}

if (!isset($_GET["players"])) {
	$players = new ArrayObject();
	for ($i = 1; $i <= $num; $i++) {
		$name = "player" . $i;
		$n = rand(1,11);
		$img = "img/index".$n.".png";
		$player = new Player($name, $img);
		// プレイヤーを追加
		$players->append($player);
	}
	// 最後に自分を追加する
	$name = "You";
	$img = "img/you.jpg";
	$player = new Player($name, $img);
	$players->append($player);
	// セッションにプレイヤーを追加
	$_SESSION["players"] = serialize($players);
} else {
	$players = unserialize($_SESSION["players"]);
}

/*
 * ぽんすかで使う最大数を設定する
 * プレイヤー数 * 2 + 自分の数
 */
if (!isset($_GET["MAX_FING"])) {
	$MAX_FING = ($num * 2) + 2;
	$_SESSION["MAX_FING"] = $MAX_FING;
} else {
	$MAX_FING = $_SESSION["MAX_FING"];
}

/*
 * ぽんすかフラグの最大値
 */
if (!isset($_GET["MAX_FLAG"])) {
	$MAX_FLAG = $num; // 最初は人数分
	$_SESSION["MAX_FLAG"] = $MAX_FLAG;
} else {
	$MAX_FLAG = $_SESSION["MAX_FLAG"];
}

/*
 * ぽんすかフラグ
 */
if (!isset($_GET["FLAG"])) {
	$FLAG = 0; // 最初は0
	$_SESSION["FLAG"] = $FLAG;
} else {
	$FLAG = $_SESSION["FLAG"];
}

/*
 * プレイヤーを表示する
 */
foreach ($players as $i => $value) {
	$value->defaultFing();
	$value->showPlayer();
	if ($FLAG == $i && $FLAG != $MAX_FLAG) {
		$value->ponsuka();
	}
}

echo '<form action="result.php" method="GET">';

if ($FLAG != $MAX_FLAG) {
	echo '自分が出す手<input type="number" name="you" min="0" max="' . $players[$MAX_FLAG]->finger . '" value="0">';
} else {
	echo 'ぽんすか...<input type="number" name="pon" min="0" max="' . $MAX_FING . '" value="0"><br>';
	echo '自分が出す手<input type="number" name="you" min="0" max="' . $players[$MAX_FLAG]->finger . '" value="0">';
}
?>

<input type="submit" value="決定">
</form>
</body>
</html>
