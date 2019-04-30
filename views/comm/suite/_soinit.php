<?php

// 搜索列表-公共代码
include dirname(__DIR__).'/house/_ainit.php';

$ilist = tex('texFy')->ilist($this->mod);
$area = $ilist['area'];
$apid = $ilist['pid'];
$arname = empty($locals[$apid]['title']) ? '' : $locals[$apid]['title'];
$whr = $ilist['whr'];

$stype = req('stype');
$keywd = req('keywd');

echo "<title>".($arname ? "[$arname]" : '')."$tpsu2 - $sys_name</title>\n";
//echo "<meta name='keywords' content='exkey' />\n";
//echo "<meta name='description' content='exdes' />\n";

eimp('initJs','jspop,jquery;bootstrap;comm;/base/assets/cssjs/sordbar');
eimp('initCss','bootstrap,stpub;comm');
