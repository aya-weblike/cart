<?php session_start();?>
<?php ob_start();?>

<?php require('dbconnect.php'); ?>

<?php
    if (!empty($_POST)) { //入力されていたら

    if ($_POST['cname'] == '') {
    $error['cname'] = 'blank';
    }

    if ($_POST['email'] == '') {
    $error['email'] = 'blank';
    }

    if (strlen($_POST['postal']) < 7) {
    $error['postal'] = 'length';
    }
    if ($_POST['postal'] == '') {
    $error['postal'] = 'blank';
    }


    if ($_POST['address'] == '') {
    $error['address'] = 'blank';
    }

    if ($_POST['tel'] == '') {
    $error['tel'] = 'blank';
    }


    if (empty($error)) {
    $_SESSION['cinfo'] = $_POST;
    header('Location:check.php');
    exit();
    }
    }

    // 修正
    if (isset($_REQUEST['action']) && $_REQUEST['action'] == 'rewrite') {
    $_POST = $_SESSION['cinfo'];
    }
?>

<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>お客様情報入力</title>
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
            
            <main id="input-info-page">
                <div class="inner">
                    <section class="about">
                        <h2 class="section-title">お客様情報入力</h2>
                        <p>以下の項目をご入力ください。</p>
                    </section>

                    <form action="" method="POST">
                        <table>
                            <tr>
                                <th>お名前</th>
                                <td>
                                    <input type="text" name="cname" value="<?php if (isset($_POST['cname'])) {print h($_POST['cname']);} ?>">
                                    <?php if (isset($error['cname']) && $error['cname'] == 'blank') : ?>
                                        <p class="error">*正しくご入力ください</p>
                                    <?php endif; ?>
                                </td>
                            </tr>

                            <tr>
                                <th>メールアドレス</th>
                                <td>
                                    <input type="email" name="email" value="<?php if (isset($_POST['email'])) {print h($_POST['email']);} ?>">
                                    <?php if (isset($error['email'])) : ?>
                                        <?php if (empty($_POST['email']) || preg_match("^[A-Za-z0-9]+[A-Za-z0-9_.-]*@[A-Za-z0-9_.-]+.[A-Za-z0-9]+$", $_POST['email'])) : ?>
                                            <p class="error">*正しくご入力ください</p>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                </td>
                            </tr>

                            <tr>
                                <th>郵便番号</th>
                                <td>
                                    <input type="text" name="postal" maxlength="7" value="<?php if (isset($_POST['postal'])) {print h($_POST['postal']);} ?>">
                                    <?php if (isset($error['postal']) && $error['postal'] == 'blank') : ?>
                                        <p class="error">*半角数字のみ7桁で入力してください</p>
                                    <?php endif; ?>
                                    <?php if (isset($error['postal']) && $error['postal'] == 'length') : ?>
                                        <p class="error">*半角数字のみ7桁で入力してください</p>
                                    <?php endif; ?>
                                </td>
                            </tr>

                            <tr>
                                <th>住所</th>
                                <td>
                                    <input type="text" name="address" value="<?php if (isset($_POST['address'])) {print h($_POST['address']);} ?>">
                                    <?php if (isset($error['address']) && $error['address'] == 'blank') : ?>
                                        <p class="error">*正しくご入力ください</p>
                                    <?php endif; ?>
                                </td>
                            </tr>
                            
                            <tr>
                                <th>電話番号</th>
                                <td>
                                <input type="text" name="tel" value="<?php if (isset($_POST['tel'])) {print h($_POST['tel']);} ?>">
                                    <?php if (isset($error['tel'])) : ?>
                                        <?php if (empty($_POST['tel']) || preg_match("/[^0-9]/", $_POST['tel'])) : ?>
                                        <p class="error">*正しくご入力ください</p>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                </td>
                            </tr>

                            <tr>
                                <th>備考</th>
                                <td>
                                    <textarea name="note" value="<?php if (isset($_POST['note'])) {print h($_POST['note']);} ?>"></textarea>
                                </td>
                            </tr>
                        </table>

                        <div class="link">
                            <a class="btn" href="cart.php">戻る</a>
                            <input class="btn" type="submit" value="確認画面">
                        </div>
                    </form>
                </div>
            </main>

            <!-- フッター -->
            <footer class="inner">
                <p><small>&copy;Ayaka</small></p>
            </footer>
        </div>
    </body>
</html>