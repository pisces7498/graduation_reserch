<?php
  session_start();
?>
<html>
<head><title>regist.php</title></head>
<body>
<?php
  $syouhin = $_POST['syouhin'];
  $_SESSION['syouhin'] = $_POST['syouhin'];
  print("次の商品を登録しました<br />");
  print("商品：$syouhin<br />");
?>
<a href=regist_check.php>商品の確認</a>
</body>
</html>