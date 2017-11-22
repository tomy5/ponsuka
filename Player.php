<?php
class Player {
	public $name; // プレイヤー名
	public $image; // プレイヤーの画像
	public $finger_image; // 指の画像
	public $finger; // プレイヤーの指の数
	public $finger_value; // 出した指の数
	
	function __construct($name, $image) {
		$this->name = $name;
		$this->image = $image;
		$this->finger = 2; // 指の初期値は2
		$this->finger_image = "yubi/3.png";
	}
	
	public function defaultFing() {
		if ($this->finger == 2) {
			$this->finger_image = "yubi/3.png";
		} else if ($this->finger == 1) {
			$this->finger_image = "yubi/0.png";
		}
	}
	
	public function randFing() {
		if ($this->finger == 2) {
			$this->finger_image = "yubi/" . rand(2, 4) . ".png";
		} else if ($this->finger == 1) {
			$this->finger_image = "yubi/" . rand(0, 1) . ".png";
		}
	}
	
	public function getValue() {
		$value;
		switch($this->finger_image) {
			case "yubi/0.png": $value = 0;
				break;
			case "yubi/1.png": $value = 1;
				break;
			case "yubi/2.png": $value = 1;
				break;
			case "yubi/3.png": $value = 0;
				break;
			case "yubi/4.png": $value = 2;
				break;
			default: ;
		}
		return $value;
	}
	
	// 勝ったらデクリメント
	public function decFing() {
		$this->finger--;
	}
	
	public function setFingImg($num) {
		if ($this->finger == 2) {
			switch($num) {
				case 0: $this->finger_image = "yubi/3.png";
					break;
				case 1: $this->finger_image = "yubi/2.png";
					break;
				case 2: $this->finger_image = "yubi/4.png";
					break;
			}
		}
		if ($this->finger == 1) {
			switch($num) {
				case 0: $this->finger_image = "yubi/0.png";
					break;
				case 1: $this->finger_image = "yubi/1.png";
					break;
			}
		}
	}
	
	/**
	 * ぽんすか関数
	 */
	public function ponsuka() {
		echo "<font size='8'><span style='background-color:#FFFFFF;'>ぽんすか ...</span></font>";
	}
	
	/**
	 * プレイヤーのパラメータを表示
	 */
	public function showPlayer() {
		echo "<p>" . $this->name . "</p>";
		echo "<img src='". $this->image ."' />";
		echo "<br>";
		echo "<img src='". $this->finger_image ."' />";
	}
}
?>
