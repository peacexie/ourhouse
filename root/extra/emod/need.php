<?php
namespace imcat;
(!defined('RUN_INIT')) && die('No Init'); 

$lpid = req('lpid');
$part = req('part');
$pmod = $part ? $part : 'house';
$pcfgs = ['sale'=>'出售', 'rent'=>'出租', 'house'=>'楼盘'];
$pname = isset($pcfgs[$part]) ? $pcfgs[$part] : '楼盘';
$msg = ''; $tabext = '';

/*
if($view=='clear'){
    $msg = lang('flow.dops_clearok');
    if($mod=='coitem'){
        $pids = glbDBExt::getKids('corder','title','1=1'); 
        $db->table($dop->tbid)->where("ordid NOT IN($pids)")->delete(); 
    }else{
        $db->table($dop->tbid)->where("atime<'".($_cbase['run']['stamp']-3*86400)."'")->delete(); 
    }
    $view = 'list';
}*/
 
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
    //basLang::inc('aflow', 'docs_list');
    glbHtml::fmt_head('fmlist',"$aurl[1]",'tblist');
    echo "<th>选</th><th>标题</th><th>模型</th>
        <th>名称</th><th>电话</th><th>需求项目</th>
        <th>显示</th>
        <th>添加时间</th>
        <th>修改</th></tr>";
    $idfirst = ''; $idend = '';
    if($rs=$dop->getRecs()){ 
        foreach($rs as $r){ 
          $cid = $idend = $r['cid'];
          $ilpid = $r['lpid']; $ipart = $r['part'];
          if(empty($idfirst)) $idfirst = $cid;
          echo "<tr>\n";
          echo $cv->Select($cid); 
          echo "<td><a href='".surl("comm:$ipart.$ilpid")."'>$r[title]</a></td>\n";
          $ipname = isset($pcfgs[$ipart]) ? $pcfgs[$ipart] : '楼盘';
          echo "<td class='tc'>$ipname</td>\n";
          echo "<td class='tc'>$r[mname]</td>\n";
          echo "<td class='tc'>$r[mtel]</td>\n";
          $ntype = $cv->TKeys($r,0,'ntype',12,"<i class='cCCC'>选项</i>");
          echo "<td class='tc'>$ntype</td>\n";
          echo $cv->Show($r['show']);
          echo $cv->Time($r['atime']);
          //echo $cv->Field($r['auser']);
          //echo $cv->Time($r['etime'],'y');
          echo $cv->Url(lang('flow.dops_edit'),1,"$aurl[1]&view=form&cid=$r[cid]&recbk=ref","");
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
        $dop->fmv['title'] = req('fm_lpid_refname');
        if(!empty($isadd)){ // basReq::in() 
            $dop->svAKey(); $cid = $dop->fmu['cid'] = $dop->fmv['cid'];
            $db->table($dop->tbid)->data($dop->fmv)->insert(); 
            $actm = lang('flow.dops_add');
        }else{ 
            $cid = $dop->svEKey();
            $db->table($dop->tbid)->data($dop->fmv)->where("cid='$cid'")->update();
            $dop->fmu['cid'] = $cid;
            $actm = lang('flow.dops_edit');
        }
        $dop->svEnd($cid); //静态情况等
        if(!empty($fm['lpid']) && !empty($dop->fmv['part'])){
            exaHouse::getRCnts($fm['lpid'], '0', $dop->fmv['part']); 
        }
        basMsg::show("$actm".lang('flow.dops_ok'),'Redir');

    }else{

        if(!empty($cid)){
            $fmo = $db->table($dop->tbid)->where("cid='$cid'")->find();
            $isadd = 0;
        }else{
            $fmo = ['part'=>$part];
            $fmo['lpid'] = $lpid;
            $isadd = 1;
        }
        $dop->fmo = $fmo;
        glbHtml::fmt_head('fmlist',"$aurl[1]",'tbdata');
        # ----------- 
        function ipick($pmod='house',$val=''){
            $pmod || $pmod = 'house'; $k = 'lpid'; $item = '';
            $title = dopFunc::vgetTitle($pmod,$val); 
            $item = "<input id='fm[{$k}]' type='hidden' name='fm[{$k}]' value='$val'>\n<input id='fm_{$k}_refname' name='fm_{$k}_refname' value='$title'>\n";
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
        $js = "\$('#fm[title]').parent().hide(); function smod(e){\$('#fm_lpid_modpicks').val(\$(e).val())}";
        echo basJscss::jscode($js);

    }
}elseif($view=='xset'){
    ;//
}
