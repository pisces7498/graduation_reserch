<html>
<body>
<b>sessionを利用した登録</b>
	<br><br>
	<form method = "post" action = "confirm.php">
		<?php
		session_start();
		require_once "definition.php";
		
		$title_txt = "";
		$url_txt = "";
		$mail_txt = "";
		
		if(isset($_SESSION[TITLE])) $title_txt = $_SESSION[TITLE];
		if(isset($_SESSION[URL])) $url_txt = $_SESSION[URL];
		if(isset($_SESSION[MAIL])) $mail_txt = $_SESSION[MAIL];

		echo "タイトル<br><input type = \"text\" name = \"my_title\" value=\"$title_txt\"><br>";
		echo "URL<br><input type = \"text\" name = \"my_url\" value=\"$url_txt\"><br>";
		echo "メールアドレス<br><input type = \"text\" name = \"my_mail_address\" value=\"$mail_txt\"><br><br><br>";
		echo "<input type =\"submit\" value=\"登録\"><br>";
		?>
	</form>
</body>
</html>
