<html>
<head><title></title></head>
<body>
<?php
	session_start();
	require_once "definition.php";
	
	//これにFALSEが入力されたら、アウト
	$bConfirm = array(TAG_NAME=>TRUE, TAG_ID=>TRUE, PASSWORD=>TRUE);
	$nextPage = TRUE;//FALSE
	
	$bConfirm[TAG_NAME] = containsChar( $_POST[TAG_NAME] );
	$bConfirm[TAG_ID] = containsChar( $_POST[TAG_ID] );
	$bConfirm[PASSWORD] = containsChar( $_POST[PASSWORD] );
	
	$tagName = $_POST[TAG_NAME];
	$tagID = $_POST[TAG_ID];
	$password = $_POST[PASSWORD];
	
	//フォームすべてに文字入っているか確認（記入漏れ防止）…１
	foreach($bConfirm as $value){
		if(!$value){
			  $nextPage = FALSE;
		}
	}
	if(!$nextPage){
		echo "<br><font color=\"red\">入力の足りない箇所があります。</font><br><br>";
		echo "タグID : ";
		if(!$bConfirm[TAG_NAME]) echo "<font color=\"red\">タグ名の入力がありません</font><br>";
		else {
			echo $_POST[TAG_NAME]."<br>";
		}
		echo "タグID : ";
		if(!$bConfirm[TAG_ID]) echo "<font color=\"red\">タグIDの入力がありません</font><br>";
		else {
			echo $_POST[TAG_ID]."<br>";
		}
		echo "パスワード : ";
		if(!$bConfirm[PASSWORD]) echo "<font color=\"red\">パスワードの入力がありません</font><br>";
		else {
			echo "【非表示】<br>";
		}
	}
	else{
		//パスワードの一致…２
		if($password!=$_SESSION[PASSWORD]) echo "パスワードが間違っています。";
		else{
			//既にタグが登録済みか…３
			$flag = 0;
			$link = mysql_connect('localhost','testuser','password');
			$db_selected = mysql_select_db('sample2',$link);
			$result = mysql_query('SELECT * FROM Tag');
			for($i=0;;$i++){
				$row = mysql_fetch_assoc($result);
				if(!$row) break;
				if($row['tagID']==$tagID){
					echo "既に登録されているタグIDです。";
					$flag = 1;
					break;
				}
			}
			$close_flag = mysql_close($link);
			
			if($flag==0){
				//タグの登録
				$userID = $_SESSION[USER_ID];
				$mysqli = new mysqli('localhost','testuser','password','sample2');
				if($mysqli->connect_error) {
					print("DB接続失敗：".$mysqli->connect_error);
					exit();
				}
				$mysqli->query("INSERT INTO `Tag` ( `tagID`, `tagName`, `userID`) VALUES ('$tagID', '$tagName', '$userID')");
				if(!$mysqli->commit()) {
					print("Transaction commit failed");
					exit();
				}
				$mysqli->close();
				
				echo "<br><font color=\"red\">登録が完了しました。</font><br><br>";
				echo "名前 : ".$tagID."<br>";
				echo "タグ名 : ".$tagName."<br>";
				echo "ユーザID : ".$userID."<br>";
			}
		}
	}
	
	function containsChar($sPost){
		$bConfirm = TRUE;
		if(!(isset($sPost)) || $sPost == ""){
			$bConfirm = FALSE;
		}
		return $bConfirm;
	}
	echo "<br><a href=\"tagsignup.php\">登録画面に戻る</a>";
?>
</html>