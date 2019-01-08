<html>
<head>
<body>
<?php
	// http://localhost/sql_test2.php?socketId=00:00:00:00:00:00&attribute=public&applianceTagID=C0:1C:4D:45:C1:35&startTime=00-00-00%2000:00:00&size=3&humanTagID[]=C0:1C:4D:44:9F:12&inRoomTime[]=10&bluetoothId[]=C0:1C:4D:44:B1:13&inRoomTime[]=20&bluetoothId[]=C0:1C:4D:45:77:92&inRoomTime[]=30
	
	$outletID = $_GET['socketId'];
	$start = $_GET['startTime'];
	$attribute = $_GET['attribute'];
	$applianceTagID = $_GET['applianceTagID'];
	$size = $_GET['size'];
	$InTagID = array();
	$InRoom = array();
	$usedPower = array();
	$InTagID = $_GET['humanTagID'];
	$InRoom = $_GET['inRoomTime'];
	
	$link = mysql_connect('localhost','testuser','password');
	$db_selected = mysql_select_db('sample2',$link);
	$query = sprintf("SELECT * FROM Info WHERE outletID ='%s' AND start = '%s'",mysql_real_escape_string($outletID),mysql_real_escape_string($start));
	$result = mysql_query($query);
	$row = mysql_fetch_assoc($result);
	$No = $row['No'];
	$tagID = $row['tagID'];
	$total = $row['total'];
	$close_flag = mysql_close($link);
	
	if($attribute=="public"){
		$InRoomTotal = 0;
		for($i=0;$i<$size;$i++) $InRoomTotal = $InRoomTotal + $InRoom[$i];
		for($i=0;$i<$size;$i++) $usedPower[$i] = $total * $InRoom[$i] / $InRoomTotal;
	}
	else if($attribute=="pp1"||$attribute=="pp2"){
		for($i=0;$i<$size;$i++){
			if($InTagID[$i]==$tagID) $usedPower[$i] = $total;
			else $usedPower[$i] = 0;
		}
	}
	else if($attribute=="personal"){
		for($i=0;$i<$size;$i++){
			$usedPower[$i] = 0;
		}
		
		$mysqli = new mysqli('localhost', 'testuser', 'password', 'sample2');
		if($mysqli->connect_error) {
			print("DB接続失敗：".$mysqli->connect_error);
			exit();
		}
		$mysqli->query("INSERT INTO `Info2` (`No`, `applianceTagID`, `InTagID`, `InRoom`, `usedPower`) VALUES ('$No', '$applianceTagID', '$applianceTagID', '0', '$total')");
		if (!$mysqli->commit()) {
			print("Transaction commit failed");
			exit();
		}
		$mysqli->close();
	}
	
	$mysqli = new mysqli('localhost', 'testuser', 'password', 'sample2');
	if($mysqli->connect_error) {
		print("DB接続失敗：".$mysqli->connect_error);
		exit();
	}
	for($i=0;$i<$size;$i++){
		//$mysqli->query("INSERT INTO `Info2` (`No`, 'applianceTagID', `InTagID`, `InRoom`, `usedPower`) VALUES ('$No', '$applianceTagID', '$InTagID[$i]', '$InRoom[$i]', '$usedPower[$i]')");
		$mysqli->query("INSERT INTO `Info2` (`No`, `applianceTagID`, `InTagID`, `InRoom`, `usedPower`) VALUES ('$No', '$applianceTagID', '$InTagID[$i]', '$InRoom[$i]', '$usedPower[$i]')");
		if (!$mysqli->commit()) {
			print("Transaction commit failed");
			exit();
		}
	}
	$mysqli->close();
	echo "<br><br><br>";
	echo "No : ".$No."<br>";
	echo "attribute : ".$attribute."<br>";
	echo "applianceTagID : ".$applianceTagID."<br>";
	echo "InTagID : ".$InTagID[2]."<br>";
	echo "InRoom : ".$InRoom[2]."<br>";
	echo "usedPower : ".$usedPower[2]."<br>";
	print("DB登録完了");
	
	
	
	
// 	/*--------------1201実験用その１-----------------*/
// 	$link = mysql_connect('localhost','testuser','password');
// 	$db_selected = mysql_select_db('Evaluation1201',$link);
// 	$query = sprintf("SELECT * FROM Info WHERE outletID ='%s' AND start = '%s'",mysql_real_escape_string($outletID),mysql_real_escape_string($start));
// 	$result = mysql_query($query);
// 	$row = mysql_fetch_assoc($result);
// 	$No = $row['No'];
// 	$tagID = $row['tagID'];
// 	$total = $row['total'];
// 	$close_flag = mysql_close($link);
// 	
// 	if($attribute=="public"){
// 		$InRoomTotal = 0;
// 		for($i=0;$i<$size;$i++) $InRoomTotal = $InRoomTotal + $InRoom[$i];
// 		for($i=0;$i<$size;$i++) $usedPower[$i] = $total * $InRoom[$i] / $InRoomTotal;
// 	}
// 	else if($attribute=="pp1"||$attribute=="pp2"){
// 		for($i=0;$i<$size;$i++){
// 			if($InTagID[$i]==$tagID) $usedPower[$i] = $total;
// 			else $usedPower[$i] = 0;
// 		}
// 	}
// 	else if($attribute=="personal"){
// 		for($i=0;$i<$size;$i++){
// 			$usedPower[$i] = 0;
// 		}
// 		
// 		$mysqli = new mysqli('localhost', 'testuser', 'password', 'Evaluation1201');
// 		if($mysqli->connect_error) {
// 			print("DB接続失敗：".$mysqli->connect_error);
// 			exit();
// 		}
// 		$mysqli->query("INSERT INTO `Info2` (`No`, `applianceTagID`, `InTagID`, `InRoom`, `usedPower`, `attribute`) VALUES ('$No', '$applianceTagID', '$applianceTagID', '0', '$total', '$attribute')");
// 		if (!$mysqli->commit()) {
// 			print("Transaction commit failed");
// 			exit();
// 		}
// 		$mysqli->close();
// 	}
// 	
// 	$mysqli = new mysqli('localhost', 'testuser', 'password', 'Evaluation1201');
// 	if($mysqli->connect_error) {
// 		print("DB接続失敗：".$mysqli->connect_error);
// 		exit();
// 	}
// 	for($i=0;$i<$size;$i++){
// 		//$mysqli->query("INSERT INTO `Info2` (`No`, 'applianceTagID', `InTagID`, `InRoom`, `usedPower`) VALUES ('$No', '$applianceTagID', '$InTagID[$i]', '$InRoom[$i]', '$usedPower[$i]')");
// 		$mysqli->query("INSERT INTO `Info2` (`No`, `applianceTagID`, `InTagID`, `InRoom`, `usedPower`, `attribute`) VALUES ('$No', '$applianceTagID', '$InTagID[$i]', '$InRoom[$i]', '$usedPower[$i]', '$attribute')");
// 		if (!$mysqli->commit()) {
// 			print("Transaction commit failed");
// 			exit();
// 		}
// 	}
// 	$mysqli->close();
// 	echo $size;
?>
<body>
</head>
</html>