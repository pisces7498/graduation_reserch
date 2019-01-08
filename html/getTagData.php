<?php

	$mysqli = new mysqli('localhost', 'testuser', 'password', 'sample2');
	if($mysqli->connect_error) {
		print("DB接続失敗：".$mysqli->connect_error);
		exit();
	}

	//$result = $mysqli->query("SELECT `tagID`, `userName` FROM `Tag` INNER JOIN `User` ON `Tag`.`userID` = `User`.`userID`");
	$result = $mysqli->query("SELECT `tagID`, `userID` FROM `Tag` WHERE `applianceID` IS NULL");
	if($result) {
		while($row = $result->fetch_object()) {
			$tagId = $row->tagID;
			$userId = $row->userID;
			$attribute = "human";
			print("$tagId,$userId,$attribute ");
		}
	}
	$result = $mysqli->query("SELECT `tagID`, `userID` ,`attribute` FROM `Tag` INNER JOIN `Appliance` ON `Tag`.`applianceID` = `Appliance`.`applianceID`");
	if($result) {
		while($row = $result->fetch_object()) {
			$tagId = $row->tagID;
			$userId = $row->userID;
			if($userId == "") $userId = "public";
			$attribute = $row->attribute;
			print("$tagId,$userId,$attribute ");
		}
	}

?>
