<?php session_start();?>
<?php require('dbconnect.php');?>

<?php
	if (isset($_POST['item_id'])) //カートに追加されたとき
	{
		$p_pic = $_POST['item_picture'];
		$p_id = $_POST['item_id'];
		$p_name = $_POST['item_name'];
		$p_price = $_POST['item_price'];
		$p_num = $_POST['item_num'];

		// 重複確認
		$flag1 = false; //重複していない場合


		//カートに商品が入っていた時
		if (isset($_SESSION['id']) == true) {
			$pic = $_SESSION['pic'];
			$id = $_SESSION['id'];
			$name = $_SESSION['name'];
			$price = $_SESSION['price'];
			$num = $_SESSION['num'];

			if (in_array($p_id, $id) == true) {
				echo '<script type="text/javascript">alert("その商品はすでにカートに入っています。");</script>';
				$flag1 = true; //重複している場合
			}
		}

		if ($flag1 == false) {
			//重複していない場合
			$pic[] = $p_pic;
			$id[] = $p_id;
			$name[] = $p_name;
			$price[] = $p_price;
			$num[] = $p_num;

			$_SESSION['pic'] = $pic;
			$_SESSION['id'] = $id;
			$_SESSION['name'] = $name;
			$_SESSION['price'] = $price;
			$_SESSION['num'] = $num;
		}
	} else { //数量変更や削除があったとき
		$pic = $_SESSION['pic'];
		$id = $_SESSION['id'];
		$name = $_SESSION['name'];
		$price = $_SESSION['price'];
		$num = $_SESSION['num'];
	}
?>

<!-- カートに商品が入っていないとき -->
<?php
	$max = count($id);
	if ($max == 0) {
		print "<p>カートに商品が入っていません</p>";
		print '<p><a href="index.php">トップページへ戻る</a></p>';
		exit();
	} 
?>

<!DOCTYPE html>
<html lang="ja">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>カート</title>
		<link rel="apple-touch-icon" sizes="180x180" href="image/apple-touch-icon.png">
		<link rel="icon" type="image/png" sizes="32x32" href="image/favicon-32x32.png">
		<link rel="icon" type="image/png" sizes="16x16" href="image/favicon-16x16.png">
		<link rel="manifest" href="image/site.webmanifest">
		<meta name="description" content="ハンドメイドアクセサリーを販売しているサイト">
		
		<!-- reset css -->
		<link rel="stylesheet" href="https://unpkg.com/destyle.css@1.0.5/destyle.css">
		
		<!-- css -->
		<link href="css/style.css" rel="stylesheet">
	</head>

	<body>
		<div class="wrap">
			<!-- ヘッダー -->
			<header class="header">
				<h1 class="logo"><a href="index.php">Aya Accessories Sample</a></h1>
			</header>

			<main class="cart-page">
				<div class="inner">
					<section class="about">
						<h2 class="section-title">カートに入っている商品一覧</h2>
						<p>【個数変更】数字を変更後、下部の「個数変更」ボタンを押してください。</p>
						<p>【商品削除】削除したい商品のチェックボックスにチェックを入れ、下部の「削除」ボタンを押してください。</p>
					</section>

					<form action="change.php" method="post">
							<?php
								$sum = 0;
								$sub = 0;
								for ($i = 0; $i < $max; $i++) { 
							?>
								<table>
									<tr>
										<th class="bg-pink">商品番号</th>
										<td class="bg-pink"><?php print h($id[$i]); ?></td>
									</tr>

									<tr>
										<th>商品写真</th>
										<td><img class="cart-page-pic" src="image/<?php print h($pic[$i]); ?>"></td>
									</tr>

									<tr>
										<th>商品名</th>
										<td><?php print h($name[$i]); ?></td>
									</tr>

									<tr>
										<th>個数</th>
										<td><input type="text" name="num<?php print $i; ?>" value="<?php print $num[$i]; ?>">個</td>
									</tr>

									<tr>
										<th>小計</th>
										<?php 
											$sub = $price[$i] * $num[$i];
											$sum += $sub;
										?>
										<td><?php print number_format($sub) . "円"; ?></td>
									</tr>

									<tr>
										<th>削除</th>
										<td><input type="checkbox" name="delete<?php print $i; ?>"></td>
									</tr>
								</table>
							<?php } ?>

							<!-- 合計金額 -->
							<div class="sum">
								<p>合計:<?php print number_format($sum) . "円"; ?></p>
							</div>
							
							<!-- 変更削除ボタン -->
							<div class="change">
								<button class="btn" type="submit" value="個数変更">個数変更</button>
								<button class="btn" type="submit" value="削除">削除</button>
							</div>

							<div class="link">
								<a class="btn" href="index.php">戻る</a>
								<a class="btn" href="inputinfo.php">購入手続き</a>
							</div>
						<!-- カートに入っている商品数を送る -->
						<input type="hidden" name="max" value="<?php print $max; ?>">
					</form>
				</div>
			</main>
			
			<!-- フッター -->
			<footer class="inner">
				<p><small>&copy;2024 Aya</small></p>
			</footer>
		</div>
	</body>
</html>