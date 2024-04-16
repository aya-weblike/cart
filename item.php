<?php require('dbconnect.php'); ?>

<?php
    $items = $db->prepare('SELECT * FROM products WHERE id=?');
    $items->execute(array($_REQUEST['id']));  //パラメータで送られてきたidを配列に入れて実行する
    $item = $items->fetch();
?>

<!DOCTYPE html>
<html lang="ja">
    <head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>アイテムページ</title>
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

            <main class="item-page">
                <div class="inner">
                    <form action="cart.php" method="post" enctype="multipart/form-data">
                        <div class="pdc-pic">
                            <!-- 写真の画像 -->
                            <img src="image/<?php print h($item['picture']); ?>" alt="<?php print h($item['name']); ?>">
                        </div>
                        <input type="hidden" name="item_picture" value="<?php print($item['picture']); ?>">
                        
                        <div class="content">
                            <!-- 商品番号 -->
                            <p>商品番号：<?php print h($item['id']); ?></p>
                            <input type="hidden" name="item_id" value="<?php print($item['id']); ?>">

                            <!-- 商品名 -->
                            <p>商品名：<?php print h($item['name']); ?></p>
                            <input type="hidden" name="item_name" value="<?php print($item['name']); ?>">

                            <!-- 金額 -->
                            <p>金額：<?php print number_format($item['price']) . "円"; ?></p>
                            <input type="hidden" name="item_price" value="<?php print($item['price']); ?>">

                            <!-- 個数 -->
                            <div class="select-box">
                                <p>個数：</p>
                                <select name="item_num">
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                </select>
                            </div>

                            <!-- カートボタン -->
                            <button class="btn" type="submit">カートに入れる</button>
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