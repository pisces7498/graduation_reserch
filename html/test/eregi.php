<html>
<head><title></title></head>
<body>
<?php
  $moji = "test script";
  if(ereg("[a-z]{6}", $moji, $result)){
    print_r($result);
  }
?>
</body>
</html>