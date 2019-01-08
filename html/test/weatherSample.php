<?php
$tmp_url = "http://weather.livedoor.com/forecast/webservice/json/v1?city=130010";
$json = file_get_contents($tmp_url,true) or die("Failed to get json");
$json = mb_convert_encoding($json, 'UTF8', 'ASCII,JIS,UTF-8,EUC-JP,SJIS-WIN');
$obj = json_decode($json);

$img_url = $obj->forecasts[0]->image->url;
$date = $obj->forecasts[0]->date;
$title = $obj->forecasts[0]->image->title;

$min = $obj->forecasts[1]->temperature->min->celsius;
$max = $obj->forecasts[1]->temperature->max->celsius;
$telop = $obj->forecasts[1]->telop;
$tomorrow = $obj->forecasts[1]->dateLabel;
$tomorrow_img = $obj->forecasts[1]->image->url;

?>
<h1>weather forecast</h1>
<div>
<p> TODAY:<?php echo $date;?></p>
<p> TODAY TITLE:<?php echo $title; ?></p>
<p> TODAY IMAGE:<?php echo "<img src='".$img_url."'>"; ?></p>
<p> TOMORROW TELOP:<?php echo $telop ?></p>
<p> TOMORROW:<?php echo $tomorrow; ?></p>
<p> TOMORROW MAX TEMPARATURE:<?php echo $max; ?></p>
<p> TOMORROW MIN TEMPARATURE:<?php echo $min; ?></p>
<p> TOMORROW IMAGE:<?php echo "<img src='".$tomorrow_img."'>"; ?></p>

</div>
