<html>
<body>
登録が完了しました。<br><br>
<?php
session_start();

require_once "definition.php";

echo "<b>〇登録内容</b><br>";
echo "タイトル : ".htmlspecialchars($_SESSION[TITLE], ENT_QUOTES)."<br>";
echo "URL : ".htmlspecialchars($_SESSION[URL], ENT_QUOTES)."<br>";
echo "メール : ".htmlspecialchars($_SESSION[MAIL], ENT_QUOTES)."<br>";

echo "<br>ご登録ありがとうございました。<br><br>";
echo "<a href=\"./input.php\">入力フォームに戻る</a>";

$sTitle = addslashes($_SESSION[TITLE]);
$sUrl = addslashes($_SESSION[URL]);
$sMail = addslashes($_SESSION[MAIL]);

//DBへの操作
mysql_connect("127.0.0.1", "ユーザ名", "パスワード");
mysql_select_db("test");
$result = mysql_query("insert into テーブル名 values( '$sTitle', '$sUrl', '$sMail' )");

session_destroy();
?>
</body>
</html>
