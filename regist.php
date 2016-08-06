<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>登録</title>
</head>
<body>
<table border="1">
<tr><th>id</th><th>title</th><th>body</th><th>created</th><th>modified</th></tr>
<?php

$pdo = new PDO("mysql:dbname=testdb", "root");
if (!$pdo) {
  exit('データベースを選択できませんでした。');
}

$id   = $_REQUEST['id'];
$title = $_REQUEST['title'];
$body  = $_REQUEST['body'];

$st = $pdo->prepare("INSERT INTO `posts`(`id`, `title`, `body`) VALUES (?,?,?)");
$st->execute(array($id, $title, $body));
if (!$st) {
  exit('データを登録できませんでした。');
}
$stt = $pdo->query("SELECT * FROM posts");
  while ($row = $stt->fetch()) {
    $id = htmlspecialchars($row['id']);
    $title = htmlspecialchars($row['title']);
    $body = htmlspecialchars($row['body']);
    $created = htmlspecialchars($row['created']);
    $modified = htmlspecialchars($row['modified']);
    echo "<tr><td>$id</td><td>$title</td><td>$body</td><td>$created</td><td>$modified</td></tr>";
  }

?>

</table>

<p>登録が完了しました。<br /><a href="index.html">戻る</a></p>
</body>
</html>