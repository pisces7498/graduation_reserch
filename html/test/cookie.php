<?php
  $time = $_COOKIE["firstphp"];
  if(!isset($time)){
    $time = 0;
  }else{
    $time++;
  }
  setcookie("firstphp", $time, time()+60*60);
?>

<html>
<head>
<title>cookie.php</title>
</head>
<body>
<?php
  if($time==0){
    print("はじめまして～");
  }else if($time == 1){
    print("2回目ですね！");
  }else{
    print("たくさん来てくれてありがとう～");
  }
?>
</body>
</html>