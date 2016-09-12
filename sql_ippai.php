<?php
$dbh = new PDO("mysql:dbname=task", "root");
// SELECT文、こんかいは使わない
// foreach($dbh->query('SELECT * from tmp_article_contents') as $row) {
//     print_r($row);
// }

$momopan = "MOMOKO NO PANTS";

echo $momopan . "(初期化)<br>";
$sql = 'DELETE FROM tmp_article_contents';
$stmt = $dbh->prepare($sql);
$flag = $stmt->execute();
if (!$flag) {
    die('DELETEクエリーが失敗しました。'.mysql_error());
}

// 親テーブル初期化
// echo $momopan . "(初期化その2)<br>";
// $sql = 'DELETE FROM tmp_articles';
// $stmt = $dbh->prepare($sql);
// $flag = $stmt->execute();
// if (!$flag) {
//   die('DELETEクエリーが失敗しました。'.mysql_error());
// }

$oya_ikutsu = 20000;
echo $momopan . "(親TBL $oya_ikutsu 件つくる・・・)<br>";
for ($i = 1; $i <= $oya_ikutsu; $i++) {
  $now = date('Y/m/d H:i:s');
  $sql = 'INSERT INTO tmp_articles (id, create_date, update_date) VALUES (?,?,?)';
  $stmt = $dbh->prepare($sql);
  $flag = $stmt->execute(array($i, $now, $now));
}
echo $momopan . "(親TBLつくった)<br>";

echo $momopan . "(子TBL $oya_ikutsu ✖︎ 10件つくる・・・)<br>";
for ($article_id = 1; $article_id <= $oya_ikutsu; $article_id++) {
  for ($topic_id = 1; $topic_id <= 10; $topic_id++) {
    $id = ($oya_ikutsu * ($article_id-1) + $topic_id);
    $topic_val = "topic" . ($topic_id - 1);
    $now = date('Y/m/d H:i:s');
    $sql = 'INSERT INTO tmp_article_contents (id, article_id, topic_id, topic_val, create_date, update_date) VALUES (?,?,?,?,?,?)';
    $stmt = $dbh->prepare($sql);
    $flag = $stmt->execute(array($id, $article_id, $topic_id, $topic_val, $now, $now));
  }
}
echo $momopan . "(子TBLつくった)<br>";

$dbh = null;
?>
