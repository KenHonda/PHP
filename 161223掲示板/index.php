<?php
require_once("./lib/util.php");
// 接続用ファイルの読み込み
require_once('./DBConnect.php');

//POSTデータ取得
$otp = filter_input(INPUT_POST,"otp");
$name = filter_input(INPUT_POST,"name");
$comment = filter_input(INPUT_POST,"comment");
$del = filter_input(INPUT_POST,"del",FILTER_DEFAULT,["flags"=>FILTER_REQUIRE_ARRAY]);

//編集ページから戻って来たときのidが入ってくる。
$edi = filter_input(INPUT_POST,"edi");

//新規データ作成時
if(!is_null($otp)){
  $sql = "INSERT INTO XXX (name, comment, otp) VALUES (?,?,?)";
  $stm = $pdo->prepare($sql);
  $data=[$name,$comment,$otp];
  $stm->execute($data);
}

//削除時
if(is_array($del)){//POSTされたidキーを取り出す、結果、$dataには一つしかパラメータ入ってない。↓
  $data = array_keys($del);
  //$id_list=implode(",",array_fill(0,count($data),"?"));
  $sql = "DELETE FROM XXX WHERE id = $data[0]";
  //print $sql;
  //print_r($data);
  $stm = $pdo->prepare($sql);
  $stm->execute();
}

//編集時(編集ページから帰ってきた場合に利用)
if($edi){
  $sql = "UPDATE XXX SET name = '$name', comment = '$comment' WHERE id = $edi";
    //print $sql;
    //print_r($data);
  $stm = $pdo->prepare($sql);
  $stm->execute($data);
}

//データ一覧取得
$sql = "SELECT * FROM XXX";
$stm = $pdo->prepare($sql);
$stm->execute();
$result = $stm->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="Content-Style-Type" content="text/css">
  <title>Test</title>
  <link rel="stylesheet" type="text/css" href="css/style.css">
  <link rel="stylesheet" href="font-awesome-4.7.0/css/font-awesome.css">
</head>
<body>
  <!--ヘッダー-->
  <div class="header">

    <div class="aa1">
      <a href="index.php">&ensp;<i class="fa fa-home fa-lg" aria-hidden="true"></i>&thinsp;</a>
    </div>
    <div class="aba">
      <a href="index.php">ホーム&emsp;&thinsp;</a>
    </div>
    <div class="aa2">
      <a href="index.php">&ensp;<i class="fa fa-bell fa-lg" aria-hidden="true"></i>&nbsp;</a>
    </div>
    <div class="aba">
      <a href="index.php">通知&emsp;&nbsp;</a>
    </div>
    <div class="aa3">
      <a href="index.php">&ensp;<i class="fa fa-envelope fa-lg" aria-hidden="true"></i>&nbsp;</a>
    </div>
    <div class="aba">
      <a href="index.php">メッセージ&emsp;</a>
    </div>

    <div class="bird">
      <img src="images/bird.png" width="23.5px" height="23.5px">
    </div>

    <div class="bbb">

      <img class="egg" src="images/egg.png" width="30px" height="30px">

      <img class="wing" src="images/hane.png" width="100px" height="30px">

    </div>
  </div>

  <!--左側-->
  <div class="main">
    <div class="ddd">
      <div class="ooo">
        <br><br><br></div>
        <div class="yyy">
          <img src="images/egg.png" width="65px" height="65px">
        </div>
        <div class="lll"><strong>
          アカウント名</strong><br>
          <div class="ggg">@guest
          </div>
        </div>
        <br>
        <br>
      </div>

      <!--投稿一覧-->
      <div class="eee">
        <div class="iii">
          <form method="POST">
            <input class="name" type="text" name="name" placeholder="名前"><br>
            <textarea name="comment" cols='20' rows='5' placeholder="コメント"></textarea>
            <input type="hidden" name="otp" value="<?PHP print md5(microtime());?>">
            <input type="submit" value="投稿">
          </form>
        </div>
        <div class="ttt">


          <form method="POST">
            <?php
            foreach ($result as $row){
              echo "<div>";
              echo "名前:&thinsp;";
              echo es($row['name']);
              echo "<br>";
              echo "コメント:&thinsp;";
              echo es($row['comment']);
              echo "<br>";
              echo "<input type='submit' name='del[{$row['id']}]' value='削除'>";
              echo "<a href='edit.php?id={$row['id']}'>変更</a>";
              echo "</div>";
              echo "<br>";
            }
            ?>
          </form>
        </div>
      </div>
    </div>
  </body>
  </html>
