<?php

  // http://localhost/sql_test.php?humanTagID=00:00:00:00:00:00&socketId=00:00:00:00:00:00&startTime=00-00-00%2000:00:00&endTime=00-00-00%2000:00:00&consumption=100

  //$bluetoothId = "00:00:00:00:00:00";
  //$socketId = "00:00:00:00:00:00";
  //$startTime = "2018-11-08 00:00:00";
  //$endTime = "2018-11-08 00:00:00";
  //$consumption = 0.0;

	$bluetoothId = $_GET["humanTagID"];
	$socketId = $_GET["socketId"];
	$startTime = $_GET["startTime"];
	$endTime = $_GET["endTime"];
	$consumption = $_GET["consumption"];
	
	print("$bluetoothId<br> $socketId<br> $startTime<br> $endTime<br> $consumption<br>");
	
	$mysqli = new mysqli('localhost', 'testuser', 'password', 'sample2');
	if($mysqli->connect_error) {
		print("DB接続失敗：".$mysqli->connect_error);
		exit();
	}
	$mysqli->query("INSERT INTO `Info` (`tagID`, `outletID`, `start`, `stop`, `total`) VALUES ('$bluetoothId', '$socketId', '$startTime', '$endTime', '$consumption')");
	if (!$mysqli->commit()) {
		print("Transaction commit failed");
		exit();
	}
	$mysqli->close(); 
	print("DB登録完了");
	
	
// 	/*--------------1201実験用その１-----------------*/
// 	$mysqli = new mysqli('localhost', 'testuser', 'password', 'Evaluation1201');
// 	if($mysqli->connect_error) {
// 		print("DB接続失敗：".$mysqli->connect_error);
// 		exit();
// 	}
// 	$mysqli->query("INSERT INTO `Info` (`tagID`, `outletID`, `start`, `stop`, `total`) VALUES ('$bluetoothId', '$socketId', '$startTime', '$endTime', '$consumption')");
// 	if (!$mysqli->commit()) {
// 		print("Transaction commit failed");
// 		exit();
// 	}
// 	$mysqli->close(); 
	
?>
