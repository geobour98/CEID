<?php


$mydata = $_POST["dedomena"];

$arxeio = fopen("mydata.har", "w");


fwrite($arxeio, $mydata);

fclose($arxeio);





?>