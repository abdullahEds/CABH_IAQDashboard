<?php
$myfile = fopen("/home/uxjb3x180e71/public_html/cabh_iaq_dashboard/cron/log1.txt", "a") or die("Unable to open file!");
$txt = "new line ". date('Y-m-d H:i:s') ."\n";
fwrite($myfile, $txt);

fclose($myfile);
?>