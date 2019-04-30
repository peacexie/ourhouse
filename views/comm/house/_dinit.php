<?php
namespace imcat;

// 常用代码初始化
// $_himp = 1;
include __DIR__.'/_ainit.php';

// 楼盘详情-公共代码

$tpname = $catid=='xq' ? '小区' : '楼盘';
$whrp = "lpid='$did'";
$apid = !empty($locals[$areas]['pid']) ? $locals[$areas]['pid'] : $areas;
$arname = empty($locals[$apid]['title']) ? '' : $locals[$apid]['title'];

$exprice = strip_tags(tex('texHouse')->vprcie($price,$punit));

$extit = "{$tpname}详情";
$exkey = "$title, $tpname, $sotags";
$exdes = ($arname ? "[$arname]" : '')."{$title}[$tpname]; 位于:$addr; 均价:$exprice";

if(empty($this->view) || $this->view=='more'){
    //
}elseif(in_array($this->view,['hu','news'])){
    $extit = $tpname.($this->view=='hu' ? '户型' : '动态');
}elseif(in_array($this->view,['cz','cs'])){
    $extit = $this->view=='cz' ? '出租房' : '二手房';
    $ilist = tex('texFy')->ilist($this->view=='cz'?'rent':'sale');
    $area = $ilist['area'];
    $apid = $ilist['pid'];
    $whri = $ilist['whr'] ? "{$ilist['whr']} AND $whrp" : $whrp;
}

// sql字句
$whr_c = "did!='$did'";
$whr_c .= $catid ? " AND catid='$catid'" : '';
// 同区域
$tmp = tex('texBase')->whrAids($apid);
$whr_a = $tmp['whr'] ? "$whr_c AND ".$tmp['whr'] : $whr_c;
// 同价位
$whr_p = $whr_c." AND price>'".($price-1000)."' AND price<'".($price+1000)."'";
//echo "$whr_a<br>$whr_p";

echo "<title>$title - $extit - $sys_name</title>\n";
echo "<meta name='keywords' content='$exkey' />\n";
echo "<meta name='description' content='$exdes' />\n";

eimp('initJs','jquery;bootstrap;comm');
eimp('initCss','bootstrap,stpub;comm');
eimp('/~base/jslib/picPlay.js');
