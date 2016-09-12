<html>
<head>
<title>make blog</title>
<meta http-equiv="Content-Type" content="text/html; charset=euc-jp">
</head>
<body>

<?php
if ($_POST{"honbun"}) {	// ※1 記事が記入されていればファイル生成開始
	$honbun = $_POST{"honbun"};

	// ※2 タグを除去する場合はコメントアウトを外す
	// $honbun = htmlspecialchars($honbun);
 
	// ※3 文字コードをEUCに変換
	$honbun = mb_convert_encoding($honbun, "EUC-JP","AUTO");

	// ※4 クオーテーションマークを変換
	if(get_magic_quotes_gpc()) { $honbun = stripslashes($honbun); } 

	// ※5 乱数を生成してファイル名に
	$filename = rand( 1000000, 9999999) . ".html";

	// ※6 ファイル生成＆書き込み
	$handle = fopen( $filename, 'w');
	fwrite( $handle, $honbun);
	fclose( $handle );

	// メッセージ表示
	echo $filename. "To generate, it was to write.";
} else {
	echo "Please send the contents of the article from the form.";
}
?>

</body>
</html>