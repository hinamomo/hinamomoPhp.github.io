<table border="1">
<tr><th>id</th><th>title</th><th>body</th><th>created</th><th>modified</th></tr>
<?php
  $pdo = new PDO("mysql:dbname=testdb", "root");
  $st = $pdo->query("SELECT * FROM posts");
  while ($row = $st->fetch()) {
    $id = htmlspecialchars($row['id']);
    $title = htmlspecialchars($row['title']);
    $body = htmlspecialchars($row['body']);
    $created = htmlspecialchars($row['created']);
    $modified = htmlspecialchars($row['modified']);
    echo "<tr><td>$id</td><td>$title</td><td>$body</td><td>$created</td><td>$modified</td></tr>";
  }
?>
</table>