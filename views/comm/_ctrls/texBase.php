<?php
namespace imcat\comm;

use imcat\basJscss;
use imcat\comCookie;
use imcat\comTypes;
use imcat\usrPerm;

/*
公共模板扩展函数
*/ 
class texBase{
    
    //protected $xxx = array();

    static function time($stamp){
        $diff = time()-$stamp;
        if($diff<86400){
            return date('H:i',$stamp);
        }else{
            return date('m-d',$stamp);
        }
    }
    
    static function whrAids($area=0){
        $whr = '';
        $locals = read('local.i');
        $area = $area ? $area : req('local');
        $pid = !empty($locals[$area]['pid']) ? $locals[$area]['pid'] : $area;
        if($area){
            if($pid!=$area){
                $ks['_1'] = $area;
            }else{
                $ks['_1'] = $pid;
                $subs = comTypes::getSubs($locals, $pid, '2'); 
                $subs = array_keys($subs); 
                if(!empty($subs)) $ks = $subs+$ks;
            }
            $inids = "'".implode("','",$ks)."'";
            $whr .= (empty($whr) ? '' : ' AND ')."areas IN($inids)";
        }
        return ['area'=>$area, 'pid'=>$pid, 'whr'=>$whr];
    }

    static function init($obj){
        $ocar_items = comCookie::oget('ocar_items'); 
        if(strlen($ocar_items)==0){
            $db = db();
            $unqid = usrPerm::getUniqueid();
            $row = $db->table('coms_cocar')->where("ordid='$unqid'")->count(); 
            $row || $row = 0;
            comCookie::oset('ocar_items',$row);
        }
    }
    
    static function pend(){
        $tpl = cfg('tpl');
        $base = $tpl['tplpend'];
        $ext = $tpl['tplpext']; 
        $base || $base = 'jstag,menu';
        $js = "";
        $js .= "setTimeout(\"jcronRun()\",3700);\n";
        strstr($base,'jstag') && $js .= "jtagSend();\n";
        strstr($base,'menu') && $js .= "jsactMenu();\n";
        $ext && $js .= "$ext;\n";
        echo basJscss::jscode("\n$js")."\n";
    }
    

}
