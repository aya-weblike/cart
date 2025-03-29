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

<!DOCTYPE html>
<html lang="ja">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Aya Accessories Sample</title>
		<link rel="icon" href="image/favicon.ico">
		<meta name="description" content="ハンドメイドアクセサリーを販売しているサイト">
		
		<!-- reset css -->
		<link rel="stylesheet" href="https://unpkg.com/destyle.css@1.0.5/destyle.css">
		
		<!-- css -->
		<link href="css/style.min.css" rel="stylesheet">
	</head>

	<body>
		<div class="wrap">
			<!-- ヘッダー -->
			<header class="header">
				<h1 class="logo"><a href="index.php">Aya Accessories Sample</a></h1>
			</header>

			<main id=change-page>
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
									print '<div id="alert-page">';
									print "<section>";
									print "<h2 class='section-title'>数量は1個以上、5個までです。</h2>";							
									print '<p>カート画面へ戻り、修正してください。</p>'; 
									print '<a class="btn" href="cart.php">カートへ戻る</a>'; 	
									print "</section>";
									print '</div>';										
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
			</main>
			<!-- フッター -->
			<footer class="inner">
				<p><small>&copy;Ayaka</small></p>
            </footer>
		</div>
	</body>
</html>