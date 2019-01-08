<html>
<head><title>メニュー</title></head>
<body>
<?php
	session_start();
	//header('Expires:-1');
	//header('Cache-Control:');
	//header('Pragma:');
	require_once "definition.php";
	
	$flag = 1;
	$logout = "ログイン画面に戻る";
	
	if($_SERVER['HTTP_REFERER']=="http://172.16.31.110/production/login.php"){
		$bConfirm = array(USER_ID=>TRUE, PASSWORD=>TRUE);
		$nextPage = TRUE;
		
		$bConfirm[USER_ID] = containsChar( $_POST[USER_ID] );// 下の方に自分で定義した関数 文字がはいっているか return "true" or "false"
		$bConfirm[PASSWORD] = containsChar( $_POST[PASSWORD] );
		
		foreach($bConfirm as $value){
			if(!$value){  
				$nextPage = FALSE;
			}
		}
		if(!$nextPage){
			echo "<br><font color=\"red\">入力の足りない箇所があります。</font><br><br>";
			echo "ユーザ名 : ";
			if(!$bConfirm[USER_ID]) echo "<font color=\"red\">ユーザ名の入力がありません</font><br>";
			else {
				echo $_POST[USER_ID]."<br>";

			}
			echo "パスワード: ";
			if(!$bConfirm[PASSWORD]) echo "<font color=\"red\">パスワードの入力がありません</font><br>";
			else {
				echo "【非表示】<br>";
			}
			$flag = 0;
		}
		$userID = htmlspecialchars($_POST[USER_ID], ENT_QUOTES);
		$password = htmlspecialchars($_POST[PASSWORD], ENT_QUOTES);
	}
	else{
		$userID = $_SESSION[USER_ID];
		$password = $_SESSION[PASSWORD];
	}
	
	if($flag==1){
		$link = mysql_connect('localhost','testuser','password');
		$db_selected = mysql_select_db('sample2',$link);
		$query = sprintf("SELECT * FROM User WHERE userID ='%s'",mysql_real_escape_string($userID));
		$result = mysql_query($query);
		$row = mysql_fetch_assoc($result);
		if(!$row){
			print("ユーザが登録されていません。");
			$logout = "ログイン画面に戻る";
		}
		else{
			if($row['password']!=$password){
				echo "ユーザまたはパスワードが違います。";
			}
			else{
				$userName = $row['userName'];
				print($userName."さん");
				print("<br/>");
				echo "<br><a href=\"information.php\">使用電力量</a>";
				echo "<br><a href=\"tagsignup.php\">タグ登録</a>";
				echo "<br><a href=\"appliancesignup.php\">家電登録</a>";
				$logout = "ログアウト";
			}
		}
		$close_flag = mysql_close($link);
	}
	
	if($_SERVER['HTTP_REFERER']=="http://172.16.31.110/production/login.php"){
		$_SESSION[PASSWORD] = $_POST[PASSWORD];
		$_SESSION[USER_ID] = $userID;
		$_SESSION[USER_NAME] = $userName;
	}
	
	function containsChar( $sPost ){
		$bConfirm = TRUE;
		if(!(isset($sPost)) || $sPost == "") {
			$bConfirm = FALSE;
		}
		return $bConfirm;
	}
	echo "<br><br><a href=\"login.php\">$logout</a>";
?>
</body>
</html>