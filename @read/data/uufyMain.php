<?php
namespace imcat;
require(dirname(dirname(__DIR__)).'/root/run/_init.php');

$hftc = read('haoft','ex');
$apic = $hftc['linzhi']; //dump($apic);
$api = new cifUuhfy($apic);

$mod = req('mod'); // 
$date = req('date'); // 
$act = (empty($mod)) ? 'set' : 'do';

$res = $sum = $list = [];
if($act=='do'){ 
    $type = $mod=='Rent' ? 'Lease' : $mod;
    $url = $api->apiUrl($type, $date);
    $ptmp = $api->pageData($url); //echo $url;
    $sum = $ptmp['sum'];
    $list = $ptmp['list'];
    //dump($ptmp); echo "$mod, $date";
}

$res = []; 
$nextUrl = $cls = '';
$ins = $upd = 0;
if($act=='do' && in_array($mod,['Comp','Dept','User'])){ 
    $nextUrl = "";
}elseif($mod=='fixFy'){
    $ext = req('ext','sale');
    $res = $api->fixFy($ext); //dump($res);
}elseif($act=='do'){ // 
    if(!empty($list)){ foreach($list as $ki => $row) {
        $method = strtolower($mod).'Row';
        $tmp = $api->$method($row, $ki);
        $res[] = $tmp;
        if($tmp['actf']=='ins') $ins++;
        else $upd++;
    } }
    $typ2 = strtoupper($type);
    if(!empty($sum['ERRMSG'])){
        $nextUrl = "";
    }elseif($sum["LAST_TIME_$typ2"]!==$sum["NEXT_TIME_$typ2"]){
        $nextUrl = "?mod=$mod&date=".$sum["NEXT_TIME_$typ2"];
    }else{
        $nextUrl = "";
    }

}

?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1.0">
<title>优优好房-管理中心</title>
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
    Mod: <input type='text' name='mod' value='Sale'> <br>(Sale, Rent, fixFy, Comp, User, Dept) <br>
    Date: <input type='text' name='date' value=''> (2015-01-01) <hr>
    Ext: <input type='text' name='ext' value='sale'> <br>(mod=fixFy使用/sale,rent) <br>
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
        在<span id="jsec">180</span>秒后重新跳转采集...<br>
    	<?=$nextUrl?>
    <?php } ?>
</p>

<?php } ?>

<hr>
<p>
    <b>调试信息：</b><br>
	Model:[<?=$mod?>] / date=[<?=$date?>]<br>
</p>
<textarea style="width:100%;height:560px;">
<?php
dump($sum); echo "\n<hr>\n";
dump($list); echo "\n<hr>\n";
dump($res); echo "\n<hr>\n";
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

