<?php

// 搜索列表-公共代码
// $_himp = 1;
include __DIR__.'/_ainit.php';

$tpname = $this->key=='xq' ? '小区' : '楼盘';
$ilist = tex('texHouse')->ilist();
$area = $ilist['area'];
$apid = $ilist['pid'];
$stype = req('stype');
$keywd = req('keywd');
$arname = empty($locals[$apid]['title']) ? '' : $locals[$apid]['title'];
$whr = $ilist['whr'];

echo "<title>".($arname ? "[$arname]" : '')."$tpname - $sys_name</title>\n";
//echo "<meta name='keywords' content='exkey' />\n";
//echo "<meta name='description' content='exdes' />\n";

eimp('initJs','jspop,jquery;bootstrap;comm;/base/assets/cssjs/sordbar');
eimp('initCss','bootstrap,stpub;comm');
