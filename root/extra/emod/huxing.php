<?php
namespace imcat;
(!defined('RUN_INIT')) && die('No Init'); 

$lpid = req('lpid');

$msg = ''; $tabext = '';
if($view=='list'){
    if(!empty($bsend)){

        $fs_do = req('fs_do');
        $fs = basReq::arr('fs');
        if(empty($fs_do)) $msg = lang('flow.dops_setop');
        if(empty($fs)) $msg = lang('flow.dops_setitem');
        $cnt = 0; $msgop = '';
        foreach($fs as $id=>$v){ 
            if(in_array($fs_do,array('show','hidden'))){ 
                $cnt += $dop->opShow($id,$fs_do);
                $msgop = $fs_do=='show' ? lang('flow.dops_checked') : lang('flow.dops_hide');
            }elseif($fs_do=='del'){ 
                #exaHouse::delRels($mod,$id); // del-rel,del-pic
                $cnt += $dop->opDelete($id);
                $msgop = lang('flow.dops_del');
            }elseif($fs_do=='(xxx)'){ 
                $msgop = '';
            }
        }
        $msg = "$cnt ".lang('flow.dops_okn',$msgop);

        #require dopFunc::modAct('list_do',$mod,$dop->type);
    } 

    if($lpid){
        $dop->so->whrstr .= " AND `lpid`='$lpid'";
        $lp = exaHouse::getLprow($lpid, 'house');
        $msg = ($msg ? "<span class='cF00'>$msg</span><br>" : '')."楼盘:$lp[lplink]";
    }

    $sobar = $dop->msgBar($msg);
    $sostr = "?dops-a&mod=$mod";
    $sobar = str_replace("$sostr", "$sostr&lpid=$lpid", $sobar);
    $dop->sobar($sobar); 
    
    glbHtml::fmt_head('fmlist',"$aurl[1]",'tblist');
    echo "<th>选</th><th>标题</th><th>栏目</th><th>显示</th>
        <th>户型</th><th>面积/㎡</th><th>总价/万</th><th>状态</th>
        <th>添加时间</th><th>添加账号</th><th>修改时间</th>
        <th>修改</th></tr>";
    $idfirst = ''; $idend = '';
    if($rs=$dop->getRecs()){ 
        foreach($rs as $r){ 
          $did = $idend = $r['did'];
          if(empty($idfirst)) $idfirst = $did;
          echo "<tr>\n";
          echo $cv->Select($did);
          echo $cv->Title($r,1,'title',surl("comm:house.{$r['lpid']}.hu#".basename($r['mpic']),'',1),32);
          echo $cv->Types($r['catid']);
          echo $cv->Show($r['show']);
          echo $cv->Field($r['hxs'],1,24);
          echo $cv->Field($r['mjout'],1,24);
          echo $cv->Field($r['pall']);
          echo $cv->TKeys($r,1,'sales'); // ($r,$td=1,$key,$len=12,$null='',$color=1)
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

    //require dopFunc::modAct('list_show',$mod,$dop->type);

}elseif($view=='form'){
    if(!empty($bsend)){

        $dop->svPrep();
        $dop->fmv['hxroom'] = intval($dop->fmv['hxs']);
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
        if(!empty($fm['lpid'])){
            exaHouse::getRCnts($fm['lpid'], '0', 'house'); 
        }
        basMsg::show("$actm".lang('flow.dops_ok'),'Redir');

        #require dopFunc::modAct('form_do',$mod,$dop->type);
    }else{

        if(!empty($did)){
            $fmo = $db->table($dop->tbid)->where("did='$did'")->find();
            $fme = $dop->tbext ? $db->table($dop->tbext)->where("did='$did'")->find() : [];
            $fme && $fmo = $fmo + $fme;
            $isadd = 0;
        }else{
            $fmo = array();
            $fmo['lpid'] = $lpid;
            $isadd = 1;
        }
        $dop->fmo = $fmo;
        glbHtml::fmt_head('fmlist',"$aurl[1]",'tbdata');
        $dop->fmCatid();
        fldView::lists($mod,$fmo);
        $dop->fmProp();
        glbHtml::fmae_send('bsend',lang('flow.dops_send'));
        glbHtml::fmt_end(array("mod|$mod","isadd|$isadd"));

        #require dopFunc::modAct('form_show',$mod,$dop->type);
    }
}elseif($view=='set'){
    ;//utf-8编码
}
