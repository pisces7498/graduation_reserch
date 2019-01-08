<html>
<head><title></title></head>
<body>
<?php
	session_start();
	require_once "definition.php";
	
	//これにFALSEが入力されたら、アウト
	$bConfirm = array(APPLIANCE_NAME=>TRUE, TAG_ID=>TRUE, ATTRIBUTE=>TRUE, PASSWORD=>TRUE);
	$nextPage = TRUE;//FALSE
	
	$bConfirm[APPLIANCE_NAME] = containsChar( $_POST[APPLIANCE_NAME] );
	$bConfirm[TAG_ID] = containsChar( $_POST[TAG_ID] );
	$bConfirm[ATTRIBUTE] = containsChar( $_POST[ATTRIBUTE] );
	$bConfirm[PASSWORD] = containsChar( $_POST[PASSWORD] );
	
	$applianceName = $_POST[APPLIANCE_NAME];
	$tagID = $_POST[TAG_ID];
	$attribute = $_POST[ATTRIBUTE];
	$password = $_POST[PASSWORD];
	
	//echo $attribute;
	
	//フォームすべてに文字入っているか確認（記入漏れ防止）…１
	foreach($bConfirm as $value){
		if(!$value){
			  $nextPage = FALSE;
		}
	}
	if(!$nextPage){
		echo "<br><font color=\"red\">入力の足りない箇所があります。</font><br><br>";
		echo "家電名 : ";
		if(!$bConfirm[APPLIANCE_NAME]) echo "<font color=\"red\">家電名の入力がありません</font><br>";
		else {
			echo $_POST[APPLIANCE_NAME]."<br>";
		}
		echo "タグID : ";
		if(!$bConfirm[TAG_ID]) echo "<font color=\"red\">タグIDの入力がありません</font><br>";
		else {
			echo $_POST[TAG_ID]."<br>";
		}
		echo "家電属性 : ";
		if(!$bConfirm[ATTRIBUTE]) echo "<font color=\"red\">家電属性の選択がありません</font><br>";
		else {
			echo $_POST[ATTRIBUTE]."<br>";
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
				//家電の登録
				$userID = $_SESSION[USER_ID];
				$mysqli = new mysqli('localhost','testuser','password','sample2');
				if($mysqli->connect_error) {
					print("DB接続失敗：".$mysqli->connect_error);
					exit();
				}
				$mysqli->query("INSERT INTO `Appliance` (`Name`, `attribute`) VALUES ('$applianceName', '$attribute')");
				if(!$mysqli->commit()) {
					print("Transaction commit failed");
					exit();
				}
				$mysqli->close();
				//タグの登録
				$link = mysql_connect('localhost','testuser','password');
				$db_selected = mysql_select_db('sample2',$link);
				$query = sprintf("SELECT * FROM Appliance WHERE name ='%s' AND attribute='%s'",mysql_real_escape_string($applianceName),mysql_real_escape_string($attribute));
				$result = mysql_query($query);
				$row = mysql_fetch_assoc($result);
				$applianceID = $row['applianceID'];
				$tagName = $row['name'];
				
				$mysqli = new mysqli('localhost','testuser','password','sample2');
				if($mysqli->connect_error) {
					print("DB接続失敗：".$mysqli->connect_error);
					exit();
				}
				if($attribute=="public"||$attribute=="pp1"||$attribute=="pp2") $userID = NULL;
				$mysqli->query("INSERT INTO `Tag` ( `tagID`, `tagName`, `userID`, `applianceID`) VALUES ('$tagID', '$tagName', '$userID', '$applianceID')");
				if(!$mysqli->commit()) {
					print("Transaction commit failed");
					exit();
				}
				$mysqli->close();
				echo "<br><font color=\"red\">登録が完了しました。</font><br><br>";
				echo "名前 : ".$tagID."<br>";
				echo "家電名 : ".$applianceName."<br>";
				echo "家電属性：".$attribute."<br>";
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
	echo "<br><a href=\"appliancesignup.php\">登録画面に戻る</a>";
?>
</html>