<?php
$s1=""; $s2=""; $s3="";
$result = [];
preg_replace("/([0-9]{4})\/([0-9]{2})\/([0-9]{2})/i","$3/$2/$1",$result);
print_r($result);

