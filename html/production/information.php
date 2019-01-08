<html>
<title>使用電力量</title>
<body>
<?php
	session_start();
	require_once "definition.php";
	
	//tagID,tagNameを取得…１
	$tagID = array();
	$tagName = array();
	$total = array();
	$userID = $_SESSION[USER_ID];
	
	$link = mysql_connect('localhost','testuser','password');
	$db_selected = mysql_select_db('sample2',$link);
	$query = sprintf("SELECT * FROM Tag WHERE userID ='%s'",mysql_real_escape_string($userID));
	$result = mysql_query($query);
	$j = 0;
	for($i=0;;$i++){
		$row = mysql_fetch_assoc($result);
		if(!$row) break;
		if($row['userID']==$userID){
			$tagID[$j] = $row['tagID'];
			$tagName[$j] = $row['tagName'];
			$total[$j] = 0;
			$j++;
		}
	}
	$close_flag = mysql_close($link);
	
	//Info2からtagID[]の電力総量を計算
	$link = mysql_connect('localhost','testuser','password');
	$db_selected = mysql_select_db('sample2',$link);
	$result = mysql_query('SELECT * FROM Info2');
	for($i=0;;$i++){
		$row = mysql_fetch_assoc($result);
		if(!$row) break;
		for($k=0;$k<$j;$k++){
			$InTagID = $row['InTagID'];
			//echo $tagID[$k]." : ".$InTagID.":::".strcasecmp($IntagID,$tagID[$k])."<br>";
			//echo "Length Output : ".strlen($IntagID)." : " .strlen($tagID[$k])."<br>";
			//if(strcasecmp($InTagID,$tagID[$k])==0){
			if($InTagID==$tagID[$k]){
				//echo $row['usedPower']."<br>";
				$total[$k] = $total[$k] + $row['usedPower'];
				break;
			}
			else{
				//echo " : else judge"."<br>";
			}
		}
	}
	$close_flag = mysql_close($link);
	
	//それぞれ表示
	if($j==0) echo "電力使用状況はありません。<br>";
	else{
		echo "<table border=1><tr><td>タグ名</td><td>使用電力量合計(W)</td></tr>";
		for($i=0;$i<$j;$i++){
			echo "<tr>";
			echo "<td>".$tagName[$i]."</td>";
			echo "<td>".$total[$i]."</td>";
			echo "</tr>";
		}
		echo "</table>";
		echo "<a href=\"./detail.php\">詳細</a>";
	}
	print("<br/><br/>");
	echo "<a href=\"./menu.php\">戻る</a>";
?>
</body>
</html>