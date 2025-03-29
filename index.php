<?php require('dbconnect.php'); ?>

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
		
			<main id="home">
				<!-- メインビジュアル -->
				<div class="mv">
					<img src="image/top.jpg" alt="店舗イメージ画像です">
				</div>

				<div class="inner">
					<ul class="product-list">
						<!-- データベースより商品情報を抜き出して表示させる -->
						<?php $products = $db->query('SELECT * FROM products'); ?>
						<?php while ($product = $products->fetch()) : ?>
							<li>
								<a href="item.php?id=<?php print h($product['id']); ?>">
									<img src="image/<?php print h($product['picture']); ?>">
									<p class="pdc-name"><?php print h($product['name']); ?></p>
									<p><?php print number_format($product['price']) . "円"; ?></p>							
								</a>
							</li>
						<?php endwhile; ?>
					</ul>
				</div>
			</main>
			
			<!-- フッター -->
			<footer class="inner">
				<p><small>&copy;Ayaka</small></p>
			</footer>
		</div>
	</body>
</html>