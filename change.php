<?php session_start();?>
<?php ob_start();?>
<?php require('dbconnect.php');?>

<?php
	$max = $_POST['max']; //送られてきた商品数
	$pic = $_SESSION['pic'];
	$id = $_SESSION['id'];
	$name = $_SESSION['name'];
	$price = $_SESSION['price'];
	$num = $_SESSION['num'];
?>

<!-- 削除か数量変更かの確認 -->
<?php
	$flag = false;
?>

<?php
	// 削除処理＝削除にチェックが入っているとき
	for ($i = 0; $i < $max; $i++) {
		if (isset($_POST["delete" . $i])) {
			$flag = true;
		}
	}
?>

<?php
	if ($flag == true) {
		for ($i = $max - 1; 0 <= $i; $i--) {
			if (isset($_POST["delete" . $i])) {
				array_splice($pic, $i, 1);
				array_splice($id, $i, 1);
				array_splice($name, $i, 1);
				array_splice($price, $i, 1);
				array_splice($num, $i, 1);
			}
			$_SESSION['pic'] = $pic;
			$_SESSION['id'] = $id;
			$_SESSION['name'] = $name;
			$_SESSION['price'] = $price;
			$_SESSION['num'] = $num;
			header('Location:cart.php');
			exit();
		}
	} else {
		// 数量変更
		for ($i = 0; $i < $max; $i++) {
			if (isset($_POST["num" . $i])) {
				if ($_POST["num" . $i] < 1 || 5 < $_POST["num" . $i]) {							
					echo '<p>数量は1個以上、5個までです。</p>'; 
					echo '<p>カート画面へ戻り、修正してください。</p>'; 
					echo '<P><a href="cart.php">カートへ戻る</a></p>'; 											
					exit();
				}
				$num[$i] = $_POST["num" . $i];
			}
		}
		$_SESSION['num'] = $num;
		header('Location:cart.php');
		exit();
	}
?>
