<?php session_start();?>
<?php ob_start();?>
<?php require('dbconnect.php');?>

<?php
	if (!isset($_SESSION['cinfo'])) {
		header('Location:index.php');
		exit();
	} 
?>

<?php
	if (isset($_SESSION['pic'])) {
		$pic = $_SESSION['pic'];
		$id = $_SESSION['id'];
		$name = $_SESSION['name'];
		$price = $_SESSION['price'];
		$num = $_SESSION['num'];
		$max = count($id);
	}
?>

<!-- データベースへの登録処理 -->

<!-- 顧客情報をデータベースへ登録する -->
<?php
	if (!empty($_POST)) { //データベースで顧客情報のテーブルに入れる
		$statement = $db->prepare('INSERT INTO cust_order SET name=? , email=? , postal=? , address=? , tel=? , note=? ');
		echo $ret = $statement->execute(
			array(
				$_SESSION['cinfo']['cname'],
				$_SESSION['cinfo']['email'],
				$_SESSION['cinfo']['postal'],
				$_SESSION['cinfo']['address'],
				$_SESSION['cinfo']['tel'],
				$_SESSION['cinfo']['note'],
			)
		);


		// データベースに入れた顧客情報のidを取得するSQLをここに書く
		$sql = 'SELECT COUNT(id) FROM cust_order';
		$stmt = $db->prepare($sql);
		$stmt->execute();
		$last_cust_id = $stmt->fetch(PDO::FETCH_COLUMN);

		for ($i = 0; $i < $max; $i++) {
			//下のSQLに取得した顧客idを一緒にいれるプログラムを書く
			$statement = $db->prepare('INSERT INTO sales SET id=? , products=? , num=? , created=NOW() ');
			echo $ret = $statement->execute(
				array(
					$last_cust_id,
					$_SESSION['id'][$i],
					$_SESSION['num'][$i],
				)
			);
		}
		unset($_SESSION['cinfo']);
		unset($_SESSION['pic']);
		unset($_SESSION['id']);
		unset($_SESSION['name']);
		unset($_SESSION['price']);
		unset($_SESSION['num']);

		header('Location:thanks.php');
		exit();
	} 
?>

<!DOCTYPE html>
<html lang="ja">
	<head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>注文内容確認</title>
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

			<main class="check-page">
				<div class="inner">
                    <section class="about">
                        <h2 class="section-title">入力された内容は以下の通りです</h2>
                    </section>

					<form action="" method="post">
						<input type="hidden" name="action" value="submit">
						<h3>お客様情報</h3>
							<table>
								<tr>
									<th>お名前</th>
									<td><?php print h($_SESSION['cinfo']['cname']); ?></td>
								</tr>

								<tr>
									<th>メールアドレス</th>
									<td><?php print h($_SESSION['cinfo']['email']); ?></td>
								</tr>

								<tr>
									<th>郵便番号</th>
									<td><?php print h($_SESSION['cinfo']['postal']); ?></td>
								</tr>

								<tr>
									<th>住所</th>
									<td><?php print h($_SESSION['cinfo']['address']); ?></td>
								</tr>

								<tr>
									<th>電話番号</th>
									<td><?php print h($_SESSION['cinfo']['tel']); ?></td>
								</tr>

								<tr>
									<th>備考</th>
									<td><?php print h($_SESSION['cinfo']['note']); ?></td>
								</tr>
							</table>

							<h3>ご注文内容</h3>
							<?php
								$sub = 0;
								$sum = 0;
								for ($i = 0; $i < $max; $i++) 
							{ ?>
								<table>
									<tr>
										<th>商品写真</th>
										<td><img class="cart-page-pic" src="image/<?php print h($pic[$i]); ?>"></td>
									</tr>

									<tr>
										<th>商品名</th>
										<td><?php print $name[$i]; ?></td>
									</tr>

									<tr>
										<th>個数</th>
										<td><?php print $num[$i]; ?></td>
									</tr>

									<tr>
										<th>小計</th>
										<?php
											$sub = $price[$i] * $num[$i];
											$sum += $sub;
										?>
										<td><?php print number_format($sub) . "円"; ?></td>
									</tr>
								</table>
							<?php } ?>
							

						<div class="sum">
							<p>合計：<?php print number_format($sum) . "円"; ?></p>
						</div>

						<div class="link">
							<a class="btn" href='inputinfo.php?action=rewrite'>修正</a>
							<input class="btn" type='submit' value='注文'>
						</div>
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