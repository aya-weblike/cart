<!-- セッション管理 -->
<?php
    ini_set('session.auto_start',"1");
    ini_set('display_errors',"On");
?>

<!-- ロリポップ -->
<?php
    try {
        $db = new PDO('mysql:dbname=LAA1561319-accessories;host=mysql216.phy.lolipop.lan;charset=utf8','LAA1561319','root');
    } catch (PDOException $e) {
        print 'DB接続エラー：' . $e->getMessage();
    }
?>

<!-- ローカル -->

    <!-- try{
        $db=new PDO('mysql:dbname=accessories;host=127.0.0.1;charset=utf8' , 'root' , 'root');
    }catch (PDOException $e){
        print 'DB接続エラー:' . $e->getMessage();
    } -->


<!-- htmlspecialcharsのショートカット -->
<?php 
    function h($value){
    return htmlspecialchars($value , ENT_QUOTES);
    } 
?>
