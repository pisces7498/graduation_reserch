<html>
<head><title>家電登録</title></head>
<body>
<form method = "post" action = "appliancesignupok.php">
<?php
	session_start();
	require_once "definition.php";
	
	$applianceName = "";
	$tagID_txt = "";
	$password_txt = "";
	
	if(isset($_SESSION[APPLIANCE_NAME])) $applianceName_txt = $_SESSION[APPLIANCE_NAME];
	if(isset($_SESSION[TAG_ID])) $tagID_txt = $_SESSION[TAG_ID];
	if(isset($_SESSION[TAG_ID])) $tagID_txt = $_SESSION[ATTRIBUTE];
	if(isset($_SESSION[PASSWORD])) $password_txt = $_SESSION[PASSWORD];
	
	echo "家電名<br><input type = \"text\" name = \"my_applianceName\" value=\"$applianceName_txt\"><br>";
	echo "タグID<br><input type = \"text\" name = \"my_tagID\" value=\"$tagID_txt\"><br>";
	echo "家電属性<br>";
	echo "<input type=\"radio\" name=\"my_attribute\" value=public>public";
	echo "<input type=\"radio\" name=\"my_attribute\" value=pp1>pp1";
	echo "<input type=\"radio\" name=\"my_attribute\" value=pp2>pp2";
	echo "<input type=\"radio\" name=\"my_attribute\" value=personal>personal";
	echo "<br>";
	echo "パスワード<br><input type = \"password\" name = \"my_password\" value=\"$password_txt\"><br>";
	echo "<input type =\"submit\" value=\"登録\"><br>";
	
	echo "<a href=\"./menu.php\">戻る</a>";
?>
</form>
</body>
</html>