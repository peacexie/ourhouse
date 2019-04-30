<?php
namespace imcat;
(!defined('RUN_INIT')) && die('No Init'); 

$lpid = req('lpid');
$part = req('part');
$pmod = $part ? $part : 'house';
$pcfgs = ['sale'=>'出售', 'rent'=>'出租', 'house'=>'楼盘'];
$pname = isset($pcfgs[$part]) ? $pcfgs[$part] : '楼盘';
$msg = ''; $tabext = '';

//*
if($view=='clear'){
    $msg = lang('flow.dops_clearok');
    foreach($pcfgs as $key=>$val) {
        $sqlin = "AND lpid NOT IN(SELECT did FROM {$db->pre}docs_{$key}_{$db->ext})";
        $sql = "DELETE FROM {$db->pre}docs_album_{$db->ext} WHERE part='{$key}'";
        $db->qurey("$sql $sqlin");
    }
    $view = 'list';
}//*/
 
if($view=='list'){

    if(!empty($bsend)){
        require dopFunc::modAct('list_do',$mod,$dop->type);
    } //$dop->whrstr = " AND "; $_mpid,

    if($lpid){
        $dop->so->whrstr .= " AND `lpid`='$lpid'";
        $lp = exaHouse::getLprow($lpid, $pmod);
        $msg = ($msg ? "<span class='cF00'>$msg</span><br>" : '')."$pname:$lp[lplink]";
    }
    if($part){
        $dop->so->whrstr .= " AND `part`='$part'";
    }

    $sobar = $dop->msgBar($msg);
    $sostr = "?dops-a&mod=$mod";
    $sobar = str_replace("$sostr", "$sostr&lpid=$lpid&part=$part", $sobar);
    $dop->sobar($sobar); 

    glbHtml::fmt_head('fmlist',"$aurl[1]",'tblist');
    basLang::inc('aflow', 'docs_list');
    $idfirst = ''; $idend = '';
    if($rs=$dop->getRecs()){ 
        foreach($rs as $r){ 
          $did = $idend = $r['did'];
          if(empty($idfirst)) $idfirst = $did;
          echo "<tr>\n";
          echo $cv->Select($did);
          echo $cv->Title($r,1,'title',$r['mpic'],32);
          echo $cv->Types($r['catid']);
          echo $cv->Show($r['show']);
          echo $cv->Time($r['atime']);
          echo $cv->Field($r['auser']);
          echo $cv->Time($r['etime'],'y');
          echo $cv->Url(lang('flow.dops_edit'),1,"$aurl[1]&view=form&did=$r[did]&recbk=ref","");
          echo "</tr>"; 
        }
        $dop->pgbar($idfirst,$idend);
    }else{
        echo "\n<tr><td class='tc' colspan='15'>".lang('flow.dops_nodata')."</td></tr>\n";
    }
    glbHtml::fmt_end(array("mod|$mod"));

    #require dopFunc::modAct('list_show',$mod,$dop->type);

}elseif($view=='form'){
    if(!empty($bsend)){

        $dop->svPrep();
        $dop->fmv['part'] = req('fm_lpid_modpicks');
        if(!empty($isadd)){ // basReq::in() 
            $dop->svAKey(); $did = $dop->fmu['did'] = $dop->fmv['did'];
            $db->table($dop->tbid)->data($dop->fmv)->insert(); 
            $dop->tbext && $db->table($dop->tbext)->data($dop->fmu)->insert(0); 
            $actm = lang('flow.dops_add');
        }else{ 
            $did = $dop->svEKey();
            $db->table($dop->tbid)->data($dop->fmv)->where("did='$did'")->update();
            $dop->fmu['did'] = $did;
            if($dop->tbext){
                if($db->table($dop->tbext)->where("did='$did'")->find()){
                    $db->table($dop->tbext)->data($dop->fmu)->where("did='$did'")->update(0);
                }else{
                    $db->table($dop->tbext)->data($dop->fmu)->insert(0);
                }
            }
            $actm = lang('flow.dops_edit');
        }
        $dop->svEnd($did); //静态情况等
        if(!empty($fm['lpid']) && !empty($dop->fmv['part'])){
            exaHouse::getRCnts($fm['lpid'], '0', $dop->fmv['part']); 
        }
        basMsg::show("$actm".lang('flow.dops_ok'),'Redir');

    }else{

        if(!empty($did)){
            $fmo = $db->table($dop->tbid)->where("did='$did'")->find();
            $fme = $dop->tbext ? $db->table($dop->tbext)->where("did='$did'")->find() : [];
            $fme && $fmo = $fmo + $fme;
            $isadd = 0;
        }else{
            $fmo = ['part'=>$part];
            $fmo['lpid'] = $lpid;
            $isadd = 1;
        }
        $dop->fmo = $fmo;
        glbHtml::fmt_head('fmlist',"$aurl[1]",'tbdata');
        $dop->fmCatid();
        # ----------- 
        function ipick($pmod='house',$val=''){
            $pmod || $pmod = 'house'; $k = 'lpid'; $item = '';
            $title = dopFunc::vgetTitle($pmod,$val); 
            $item = "<input id='fm[{$k}]' type='hidden' name='fm[{$k}]' value='$val'>\n<input id='fm_{$k}_refname' value='$title'>\n";
            $sels = "<select id='sel_pmod' type='text' style='width:60px;' onchange='smod(this)'>";
            $sels .= basElm::setOption(['house'=>'楼盘','sale'=>'出售','rent'=>'出租'],$pmod)."</select>"; 
            $item .= "$sels<input name='fm_{$k}_modpicks' id='fm_{$k}_modpicks' type='hidden' value='$pmod'>";
            $item .= "<input type='button' value='".basLang::show('admin.fv_pick')."' onclick=\"pickOpen('fm_{$k}_modpicks','','fm[{$k}]','fm_{$k}_refname',1)\" class='btn'>";
            $item .= "<input type='button' value='".basLang::show('admin.fv_clear')."' onclick=\"pickOnc('fm[{$k}]','fm_{$k}_refname')\" class='btn'>";
            return $item;
        }
        $item = ipick($fmo['part'],$fmo['lpid']);
        glbHtml::fmae_row('关联资料',$item);
        # ----------- 
        fldView::lists($mod,$fmo,'',[],['lpid']);
        $dop->fmProp();
        glbHtml::fmae_send('bsend',lang('flow.dops_send'));
        glbHtml::fmt_end(array("mod|$mod","isadd|$isadd"));
        $js = "function smod(e){\$('#fm_lpid_modpicks').val(\$(e).val())}";
        echo basJscss::jscode($js);

    }
}elseif($view=='xset'){
    ;//
}
