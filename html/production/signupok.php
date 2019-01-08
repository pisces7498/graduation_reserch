<html>
<head><title>確認画面</title></head>
<body>
<?php
	require_once "definition.php"; 
	
	$bConfirm = array(USER_NAME=>TRUE, USER_ID=>TRUE, PASSWORD=>TRUE, PASSWORD2=>TRUE);
	$nextPage = TRUE;
	
	$bConfirm[USER_NAME] = containsChar( $_POST[USER_NAME] );
	$bConfirm[USER_ID] = containsChar( $_POST[USER_ID] );
	$bConfirm[PASSWORD] = containsChar( $_POST[PASSWORD] );
	$bConfirm[PASSWORD2] = containsChar( $_POST[PASSWORD2] );
	
	$userName = $_POST[USER_NAME];
	$userID = $_POST[USER_ID];
	$password = $_POST[PASSWORD];
	$password2 = $_POST[PASSWORD2];
	
	echo "$userName";
	
	$signuped = 0;
	
	foreach($bConfirm as $value){
		if(!$value){  
			$nextPage = FALSE;
		}
	}
	if(!$nextPage){
		echo "<br><font color=\"red\">入力の足りない箇所があります。</font><br><br>";
		echo "名前 : ";
		if(!$bConfirm[USER_NAME]) echo "<font color=\"red\">名前の入力がありません</font><br>";
		else {
			echo $_POST[USER_NAME]."<br>";
		}
		echo "ユーザID : ";
		if(!$bConfirm[USER_ID]) echo "<font color=\"red\">ユーザIDの入力がありません</font><br>";
		else {
			echo $_POST[USER_ID]."<br>";
		}
		echo "パスワード: ";
		if(!$bConfirm[PASSWORD]) echo "<font color=\"red\">パスワードの入力がありません</font><br>";
		else {
			echo "【非表示】<br>";
		}
		echo "パスワード（確認用）: ";
		if(!$bConfirm[PASSWORD2]) echo "<font color=\"red\">パスワード（確認用）の入力がありません</font><br>";
		else {
			echo "【非表示】<br>";
		}
	}
	else{
		if($password!=$password2) echo "パスワードが一致していません";
		else{
			$link = mysql_connect('localhost','testuser','password');
			$db_selected = mysql_select_db('sample2',$link);
			$query = sprintf("SELECT * FROM User WHERE userID ='%s'",mysql_real_escape_string($userID));
			$result = mysql_query($query);
			$row = mysql_fetch_assoc($result);
			if($row){
				$signuped = 1;
				echo "このユーザIDは既に登録済みです。";
			}
			else if(!$row)
			{
				$mysqli = new mysqli('localhost', 'testuser', 'password', 'sample2');
				if($mysqli->connect_error) {
					print("DB接続失敗：".$mysqli->connect_error);
					exit();
				}
				$mysqli->query("INSERT INTO `User` ( `userID`, `userName`, `password`) VALUES ( '$userID', '$userName', '$password')");
				if (!$mysqli->commit()) {
					print("Transaction commit failed");
					exit();
				}
				$mysqli->close();
				echo "<br><font color=\"red\">登録が完了しました。</font><br><br>";
				echo "名前 : ".$userName."<br>";
				echo "ユーザ名 : ".$userID."<br>";
			}
			
		}
	}
	
	function containsChar( $sPost ){
		$bConfirm = TRUE;
		if(!(isset($sPost)) || $sPost == "") {
			$bConfirm = FALSE;
		}
		return $bConfirm;
	}
	echo "<br><a href=\"signup.html\">登録画面に戻る</a>";
?>
</body>
</html>