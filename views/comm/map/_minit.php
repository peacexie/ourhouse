<?php
namespace imcat;

// 常用代码初始化
// $_himp = 1;
include dirname(__DIR__).'/house/_ainit.php';

// map-公共代码
$mapkey = $_cbase['3aks']['baidumap'];
$cityname = $_cbase['ucfg']['city'];
$_cbase['tpl']['tplpend'] = '(null)';

// 1200,900; 400,350,300
$w0 = req('w',1200); $h0 = req('h',400); 
$w1 = $w0-300; $h1 = $h0-50; $h2 = $h0-100; 

// row
$did = req('did');
$row = exaHouse::getLprow($did);
if(empty($row['map']) || !strpos($row['map'],',')){
    die("Empty Map-Point!");
}
$areas = $row['areas'];
$apid = !empty($locals[$areas]['pid']) ? $locals[$areas]['pid'] : $areas;
$apname = !empty($locals[$apid]['title']) ? $locals[$apid]['title'] : '';
$pnts = explode(',', $row['map']);
$pnta = ['lng'=>$pnts[0], 'lat'=>$pnts[1]];
$thumb = comStore::revSaveDir($row['mpic']);

// 

// head
echo "<title>{$row['title']} - $sys_name</title>\n";
eimp('initJs','jquery;comm');

