<?php
namespace imcat;
require(dirname(dirname(__DIR__)).'/root/run/_init.php');

// configs
$cfgsu = [
    'Hft' => [
        'xf' => 'https://yongzhou.haofang.net/xinfang/p{n}.html',
        'cs' => 'https://yongzhou.haofang.net/ershoufang/p{n}.html',
        'cz' => 'https://yongzhou.haofang.net/zufang/p{n}.html',
    ],
];
$cwait = 23;
$cmax = 10; // 0

$type = req('type');
$mod = req('mod'); // 
$page = req('page'); // 
$psub = req('psub',1);
$act = (empty($type) && empty($mod)) ? 'set' : 'do';

$res = $list = $data = []; 
$nextUrl = $cls = '';
$ins = $upd = 0;
if($act=='do' && $mod=='00'){
    $cls = "\\imcat\\cai{$type}$mod"; 
    $obj = new $cls();
    $act = req('act');
    $ext = req('ext');
    $res = $obj->{'fix'.$act}($ext);
    if($page>1) $nextUrl = "?type=$type&mod=$mod&act=$act&ext=$ext&page=".($page-1);
}elseif($act=='do'){ 
    $cls = "\\imcat\\cai{$type}$mod"; 
    $obj = new $cls();
    $url = str_replace('{n}',$page,$cfgsu[$type][$mod]);
    $list = $obj->getList($url);
    if(!$cmax){
        $ia = 0; $ib = count($list);
    }else{
        $iflg = '';
        $ia = ($psub-1)*$cmax; $ib = $psub*$cmax;
        if($ib>=count($list)){
            $ib = count($list);
            $iflg = 'next';
        }
    }
    for($i=$ia;$i<$ib;$i++){ //echo "$i,<br>\n";
        $row = $list[$i];
        $data = $obj->getRow($row['url']); 
        $tmp = $obj->dataRow($row,$data,$i);
        $res[] = $tmp;
        if($tmp['actf']=='ins') $ins++;
        else $upd++;
    }
    if(!$cmax){
        if($page>1) $nextUrl = "?type=$type&mod=$mod&page=".($page-1);
    }else{
        $np = $iflg ? 'page='.($page-1).'' : 'page='.$page.'&psub='.($psub+1);
        $nextUrl = "?type=$type&mod=$mod&$np";
        if($page==1 && !$iflg) { $nextUrl = ''; }
    }
}

?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1.0">
<title>采集中心</title>
<style type="text/css">
.out{ width:480px; margin:20px auto; }
.addsec{ display:inline-block; float:right; padding:5px; border:1px solid #CCC; }
.r{ float:right; }
</style>
</head>

<body>
<div class="out">

<?php if($act=='set'){ ?>

<form act='?' method='get'>
<p>
    <b>采集设置：</b> <br>
    Type: <input type='text' name='type' value='Hft'> (Hft,Lj) <br>
    Mod: <input type='text' name='mod' value='xf'> (xf,cz,cs,00) <br>
    Page: <input type='text' name='page' value='3'> (5,4,...) <hr>
    Act: <input type='text' name='act' value='Album'> <br>(mod=00使用/House,Fy,Huxing,Album) <br>
    Ext: <input type='text' name='ext' value='sale'> <br>(act=Fy使用/sale,rent) <br>
    <input type='submit' value='Sumbit'>
</p>
</form>

<?php }else{ ?>

<p>
    <a href="?" class="r">返回</a>
    <b>采集结果：</b> <br>
    add:<?=$ins?> / upd:<?=$upd?> <br>
</p>

<hr>

<p>
    <b>批次循环：</b>
    <?php if(empty($nextUrl)){ ?>
    	全部执行完毕！不用循环了...
    <?php }else{ ?>
    	<b class="addsec" onClick="setJsec()">+500</b>
        在<span id="jsec"><?=$cwait?></span>秒后重新跳转采集...<br>
    	<?=$nextUrl?>
    <?php } ?>
</p>

<?php } ?>

<hr>
<p>
    <b>调试信息：</b><br>
	Class:[<?=$cls?>] / page=[<?=$page?>]<br>
</p>
<textarea style="width:100%;height:560px;">
<?php
dump($res); echo "\n<hr>\n";
dump($list); echo "\n<hr>\n";
dump($data); echo "\n<hr>\n";
?>

</textarea>

</div>

</body>
</html>

<script>   
var idSec = document.getElementById('jsec');  
function jumpPage(){    
	var nSec = idSec.innerHTML;
	if(nSec>0) { idSec.innerHTML = nSec-1; }
	if(nSec<=0) { location.href='<?=$nextUrl?>'; }       
	else { setTimeout("jumpPage()",1000); }      
}
function setJsec(){ 
	var nSec = idSec.innerHTML;
	idSec.innerHTML = parseInt(nSec)+5000;
}
<?php if(!empty($nextUrl)){ ?>
setTimeout("jumpPage()",1000);   
<?php } ?>
</script>

