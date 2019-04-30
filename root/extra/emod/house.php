<?php
namespace imcat;
(!defined('RUN_INIT')) && die('No Init'); 

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
                exaHouse::delRels($mod,$id); // del-rel,del-pic
                $cnt += $dop->opDelete($id);
                $msgop = lang('flow.dops_del');
            }elseif($fs_do=='updrels'){ 
                exaHouse::getRCnts($id, '0', 'house'); 
                $msgop = '更新关联';
            }
        }
        $msg = "$cnt ".lang('flow.dops_okn',$msgop);

        #require dopFunc::modAct('list_do',$mod,$dop->type);
    } 

    $dop->sobar($dop->msgBar($msg)); 
    glbHtml::fmt_head('fmlist',"$aurl[1]",'tblist');
    echo "<th>选</th><th>标题</th><th>栏目</th><th>显示</th>
        <th>关联 # 状态/装修/物业</th>
        <th>添加账号</th><th>添加/修改</th>
        <th>修改</th></tr>";
    $idfirst = ''; $idend = '';
    if($rs=$dop->getRecs()){ 
        foreach($rs as $r){ 
          $did = $idend = $r['did'];
          if(empty($idfirst)) $idfirst = $did;
          $rc = exaHouse::getRCnts($r, '1', 'house'); 
          echo "<tr>\n";
          echo $cv->Select($did);
          $areas = $cv->TKeys($r,0,'areas',12,"<i class='cCCC'>区域</i>");
          $addr = $cv->Field($r['addr'],0,18);
          echo $cv->Title($r,1,'title','',32,"<br><span class='c666'>$areas / $addr</span>");
          echo $cv->Types($r['catid']);
          echo $cv->Show($r['show']);
          $sale = $cv->TKeys($r,0,'sales',12,"<i class='cCCC'>状态未知</i>");
          $zxtype = $cv->TKeys($r,0,'zxtype',12,"<i class='cCCC'>装修未知</i>");
          $wytype = $cv->TKeys($r,0,'wytype',12,"<i class='cCCC'>物业未知</i>");
          echo "<td class='tl'>
          <a href='?dops-a&mod=huxing&lpid={$r['did']}'>户型($rc[cnthx])</a> -
          <a href='?dops-a&mod=album&lpid={$r['did']}'>相册($rc[cntpic])</a> -
          <a href='?dops-a&mod=hnews&lpid={$r['did']}'>动态($rc[cntnews])</a> #
          <a href='?dops-a&mod=sale&lpid={$r['did']}'>出售($rc[cntcs])</a> -
          <a href='?dops-a&mod=rent&lpid={$r['did']}'>出租($rc[cntcz])</a> <br>
          $sale / $zxtype / $wytype
          </td>\n";
          echo $cv->Field($r['auser']);
          $atime = $cv->Time($r['atime'],0);
          $etime = $cv->Time($r['etime'],0);
          echo "<td class='tc'>$atime<br>$etime</td>\n";
          echo $cv->Url(lang('flow.dops_edit'),1,"$aurl[1]&view=form&did=$r[did]&recbk=ref","");
          echo "</tr>"; 
        }
        //$dop->pgbar($idfirst,$idend);
        $pg = $dop->pg->show($idfirst,$idend);
        $op = "".basElm::setOption(basLang::show('flow.op_op3')."\nupdrels|更新关联",'',basLang::show('flow.op0_bacth'));
        dopFunc::pageBar($pg,$op);
    }else{
        echo "\n<tr><td class='tc' colspan='15'>".lang('flow.dops_nodata')."</td></tr>\n";
    }
    glbHtml::fmt_end(array("mod|$mod"));

    //require dopFunc::modAct('list_show',$mod,$dop->type);

}elseif($view=='form'){
    if(!empty($bsend)){

        $dop->svPrep();
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
        exaHouse::getRCnts($did, '0', 'house'); 
        basMsg::show("$actm".lang('flow.dops_ok'),'Redir');

        #require dopFunc::modAct('form_do',$mod,$dop->type);
    }else{
        require dopFunc::modAct('form_show',$mod,$dop->type);
    }
}elseif($view=='set'){
    ;//utf-8编码
}
