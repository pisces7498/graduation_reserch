<html>
<head><title>タグ登録</title></head>
<body>
<form method = "post" action = "tagsignupok.php">
<?php
	session_start();
	require_once "definition.php";
	
	$tagName_txt = "";
	$tagID_txt = "";
	$password_txt = "";
	
	if(isset($_SESSION[TAG_NAME])) $tagName_txt = $_SESSION[TAG_NAME];
	if(isset($_SESSION[TAG_ID])) $tagID_txt = $_SESSION[TAG_ID];
	if(isset($_SESSION[PASSWORD])) $password_txt = $_SESSION[PASSWORD];
	
	echo "タグ名<br><input type = \"text\" name = \"my_tagName\" value=\"$tagName_txt\"><br>";
	echo "タグID<br><input type = \"text\" name = \"my_tagID\" value=\"$tagID_txt\"><br>";
	echo "パスワード<br><input type = \"password\" name = \"my_password\" value=\"$password_txt\"><br>";
	echo "<input type =\"submit\" value=\"登録\"><br>";
	
	echo "<a href=\"./menu.php\">戻る</a>";
?>
</form>
</html>