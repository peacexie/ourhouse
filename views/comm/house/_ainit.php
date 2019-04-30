<?php
namespace imcat;

// 房产-公共代码

/*
if(req('_test')){
   $_cbase['sys_name'] = '贴心猫-爱窝房产'; // 永州智*h尚地产
   $_cbase['sys']['ver'] = '2.1'; 
}*/
if($this->mod=='suite'){
    glbError::show("Error {$this->mod}");
}

# ----------------------------

$nul0 = '';
$nul1 = "<span class='cCCC'>--</span>";
$nul2 = "<span class='cCCC'>未知</span>";
$nunit = "元/㎡";

$locals = read('local.i');
$sys_name = $_cbase['sys_name'];

if(in_array($this->mod,['sale','rent'])){
    $tpsu1 = $this->mod=='sale'?'售':'租';
    $tpsu2 = $this->mod=='sale'?'二手房':'出租房';
    if(!empty($lpid)){
        $lp = exaHouse::getLprow($lpid);
    }
} // suite用

$_hua = $this->ucfg['ua']; $_hup = empty($_hua['page']) ? 1 : $_hua['page'];
$_hext = count($_hua)>5 || $_hup>5;
glbHtml::page('init',$_hext);

# ----------------------------

/*
if(!empty($_himp)){
    eimp('initJs','jquery;bootstrap;comm');
    eimp('initCss','bootstrap,stpub;comm');
}
*/
/*
glbHtml::page('init',$ext);
if($title) echo "<title>".basStr::filTitle($title)."</title>\n";
if($keywd) echo "<meta name='keywords' content='".basStr::filTitle($keywd)."' />\n";
if($desc) echo "<meta name='description' content='".basStr::filTitle($desc)."' />\n";
*/

# ----------------------------
