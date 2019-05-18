<?php 
namespace imcat;
# vote-topic : for:topic

require __DIR__.'/_cfgall.php'; 

glbHtml::head('json'); 
//$fm = basReq::arr('fm'); 

safComm::urlStamp();

// 验证码
$re2 = safComm::formCAll('fmneed','',3600,0);
if(!empty($re2[0])){ 
    $data['error'] = 1;
    $data['msg'] = lang('plus.coms_errvcode');
    die(out($data,'json'));
}

// dop
$_cfg = read('need');
$cfgs = basElm::text2arr($_cfg['cfgs']); //dump($cfgs);
$dop = new dopComs($_cfg,[]);
$dop->svPrep(); 
$dop->svAKey();
$dop->svPKey('add'); 
$data = $dop->fmv; //dump($data);
// insert(); 

// cookie
$gpnum = empty(intval($cfgs['ippub'])) ? 1 : intval($cfgs['ippub']);
$ckey = "need_{$fm['part']}_{$fm['lpid']}";
$stamp = $_SERVER["REQUEST_TIME"];
$glife = intval($gpnum)*60;
$ck = comCookie::mget('needs',$ckey); // cookie;
if(empty($ck) || ($stamp-intval($ck))>$glife){
    //cookie-set
}else{
    $data['error'] = 1;
    $data['msg'] = basLang::show('flow.ck_rep',$glife);
    die(out($data,'json'));
}

// data
$msg = '';
if(empty($data['ntype'])){
    $msg = '需求意向:不能为空';
}elseif(empty($data['mname'])){    
    $msg = '称呼:不能为空';
}elseif(preg_match("/^\d{3,4}([\d|-|#]{5,10})\d{2,4}$/",$data['mtel'])){
    $msg = $data['mtel'] ? '电话:格式不对' : '电话:不能为空';
}else{
    // insert
}
if($msg){
    $data['error'] = 1;
    $data['msg'] = $msg;
    die(out($data,'json'));    
}


// mtel重复
$whr = "part='$fm[part]' AND lpid='$fm[lpid]' AND mtel='$fm[mtel]'";
$whr .= " AND atime>'".($_SERVER["REQUEST_TIME"]-86400)."'";
$ord = "ORDER BY cid DESC";
$rp = $db->table('coms_need')->where($whr)->find();
if(empty($rp)){
    comCookie::mset('needs',$glife,$ckey,$stamp,20);
    $dop->fmv['title'] = $dop->fme['title'];
    $db->table($dop->tbid)->data($dop->fmv)->insert();
    comCookie::mset('vcodes',0,'fmneed','null');
    $data['error'] = 0;
    $data['msg'] = '提交成功，我们会及时联系你的!';
}else{
    $data['error'] = 1;
    $data['msg'] = '提交太频繁!'; 
}
die(out($data,'json')); 

/*

*/
