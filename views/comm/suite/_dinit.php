<?php
namespace imcat;

// 常用代码初始化
// $_himp = 1;
include dirname(__DIR__).'/house/_ainit.php';

// 房源详情-公共代码

if(!empty($lp['areas'])){
    $apid = !empty($locals[$lp['areas']]['pid']) ? $locals[$lp['areas']]['pid'] : $lp['areas'];
    $arname = empty($locals[$apid]['title']) ? '' : $locals[$apid]['title'];
}else{
    $apid = 0;
    $arname = '';   
}
$exaddr = empty($lp['addr']) ? '' : "位于:{$lp['addr']};";

$_expr = $this->mod=='sale' ? $pall : $price;
$_expu = $this->mod=='sale' ? '万' : '元/月';
$exprice = strip_tags(tex('texHouse')->vprcie($_expr,$_expu));

$exkey = "$sotags, $title";
$exdes = ($arname ? "[$arname]" : '')."{$title}; $exaddr $exprice";

echo "<title>[$tpsu1] $title - $sys_name</title>\n";
echo "<meta name='keywords' content='$exkey' />\n";
echo "<meta name='description' content='$exdes' />\n";

eimp('initJs','jquery;bootstrap;comm');
eimp('initCss','bootstrap,stpub;comm');
eimp('/~base/jslib/picPlay.js');
