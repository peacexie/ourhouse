<?php

// A4-公共代码
include dirname(__DIR__).'/house/_ainit.php';

echo "<title>[$tpsu1] $title - $sys_name</title>\n";
//echo "<meta name='keywords' content='$exkey' />\n";
//echo "<meta name='description' content='$exdes' />\n";

eimp('initJs','jquery;comm');
eimp('initCss','bootstrap,stpub;comm');

$urlqr = surl("sale.$did.a4",'',1); 
