<?php
require_once("./lib/util.php");
// 接続用ファイルの読み込み
require_once('DBConnect.php');

//GETデータ取得
$id = filter_input(INPUT_GET,"id");

//該当コメント情報取得
$sql = "SELECT * FROM XXX WHERE id = $id ";
$stm = $pdo->prepare($sql);
$stm->execute();
$result = $stm->fetchAll(PDO::FETCH_ASSOC);
//1件しかないので
$row = $result[0];
?>

<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
</head>
<body>
<form method="POST" action="index.php">
<input type="text" name="name" placeholder="名前編集" value="<?php echo es($row['name']); ?>"><br>
<textarea name="comment" cols='20' rows='5' placeholder="コメント編集"><?php echo es($row['comment']); ?></textarea>
<br>
<input type="hidden" name="edi" value="<?php echo $row['id']; ?>">
<input type="submit" name="" value="編集">
</form>

<style>
*{background-color: #eaf5fc}

input     {font-size: 14px;
           background-color: #fff;
           border: 0.5px solid #cce6f9;
           margin-top: 14px;
           margin-left: 20px;
           padding-left: 10px;
           padding-top: 5.5px;
           padding-bottom: 5.5px;}

textarea  {font-size: 14px;
           background-color: #fff;
           border: 0.5px solid #cce6f9;
           margin-top: 10px;
           margin-left: 20px;
           padding-left: 10px;
           padding-top: 5.5px;
           padding-bottom: 5.5px;
           }

</style>

</body>
</html>
