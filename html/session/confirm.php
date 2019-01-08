<html>
<body>

<?php
	
	//confirm.php

	session_start();//defineとの関係

	require_once "definition.php";

	//これにFALSEが入力されたら、アウト
	$bConfirm = array(TITLE=>TRUE, URL=>TRUE, MAIL=>TRUE);
	$nextPage = TRUE;//FALSE
	
	$bConfirm[TITLE] = containsChar( $_POST[TITLE] );// 下の方に自分で定義した関数 文字がはいっているか return "true" or "false"
	$bConfirm[URL] = containsChar( $_POST[URL] );
	$bConfirm[MAIL] = containsChar( $_POST[MAIL] );
	
	//フォームすべてに文字がはいっているか確認
	foreach($bConfirm as $value){
		if(!$value){  
			$nextPage = FALSE;
		}
	}

	//入っていたら
	if($nextPage){
		echo "以下の内容でよろしいでしょうか?<br><br>";
		echo "タイトル ： ".htmlspecialchars($_POST[TITLE], ENT_QUOTES)."<br>";
		echo "URL : ".htmlspecialchars($_POST[URL], ENT_QUOTES)."<br>";
		echo "アドレス ： ".htmlspecialchars($_POST[MAIL], ENT_QUOTES)."<br>";
		echo "<br><b><a href=\"regist.php\">確認した上で登録<a></b>";
	}
	
	//入っていなかったら
	else{
		echo "<br><font color=\"red\">入力の足りない箇所があります。</font><br><br>";
		
		echo "タイトル : ";
		if(!$bConfirm[TITLE]) echo "<font color=\"red\">タイトルの入力がありません</font><br>";
		else {
			echo $_POST[TITLE]."<br>";			
		}
		
		
		echo "URL : ";
		if(!$bConfirm[URL]) echo "<font color=\"red\">URLの入力がありません</font><br>";
		else {
			echo $_POST[URL]."<br>";
		}
		
		
		echo "メール : ";
		if(!$bConfirm[MAIL]) echo "<font color=\"red\">メールの入力がありません</font><br>";
		else {
			echo $_POST[MAIL]."<br>";
		}
		//sessoin情報を使う

		echo "<br><a href=\"input.php\">戻る</a>";
	}

	
	//最後に入っていなくても入っていてもセッションに入れる…1
	$_SESSION[URL] = $_POST[URL];
	$_SESSION[TITLE] = $_POST[TITLE];
	$_SESSION[MAIL] = $_POST[MAIL];


	//文字が変数に入っているか判定する関数
	function containsChar( $sPost ){
		$bConfirm = TRUE;
		//$choppedChars = chop($sPost);
		if(!(isset($sPost)) || $sPost == "") {
			$bConfirm = FALSE; //スペース等を抜くchop関数
		}
		return $bConfirm;
	}

?>

</body>
</html>
