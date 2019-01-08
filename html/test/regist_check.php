<?php
  session_start();
?>
<html>
<head><title>regist_check.php</title></head>
<body>
<?php
  print ("登録済み:<br />");
  print ($_SESSION['syouhin']."<br />");
?>
<a href=session.html>追加登録</a>
</body>
</html>