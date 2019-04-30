<?php
namespace imcat\comm;

use imcat\basLang;
use imcat\comTypes;

/*
单个模板扩展函数
*/ 
class texFy{
    
    #protected $prop1 = array();
    
    static function ilist($mod){ 
        $tmp = texBase::whrAids(); 
        extract($tmp); //dump($tmp);
        if($whr){
            $lst2 = db()->table('docs_house')->field('did')->where($whr)->select();
            if(!empty($lst2)){
                $tb2 = [];
                foreach($lst2 as $v2) { $tb2[] = $v2['did']; }
                $inids = "'".implode("','",$tb2)."'";
                $whr = "lpid IN($inids)";
            }
        } //echo $whr; 
        $priceA = req('price');
        if(strstr($priceA,'~')){ //$area && 
            $arr = explode('~',$priceA);
            $field = $mod=='sale' ? 'pall' : 'price';
            $arr[0] && $whr .= (empty($whr) ? '' : ' AND ')."$field>='".$arr[0]."'";
            $arr[1] && $whr .= (empty($whr) ? '' : ' AND ')."$field<='".$arr[1]."'";
        }
        $mjoutA = req('mjout');
        if(strstr($mjoutA,'~')){
            $arr = explode('~',$mjoutA);
            $arr[0] && $whr .= (empty($whr) ? '' : ' AND ')."mjout>='".$arr[0]."'";
            $arr[1] && $whr .= (empty($whr) ? '' : ' AND ')."mjout<='".$arr[1]."'";
        }
        $catid = req('catid');
        if($catid){
            $whr .= (empty($whr) ? '' : ' AND ')."catid='$catid'";
        }
        $hxroom = req('hxroom');
        if($hxroom){
            $whr .= (empty($whr) ? '' : ' AND ')."hxroom".($hxroom > 5 ? ">'5'" : "='$hxroom'");
        }
        $keywd = req('keywd');
        if($keywd){
            $whr .= (empty($whr) ? '' : ' AND ')."title LIKE '%$keywd%'";
        } //echo $whr; 
        return ['area'=>$area, 'pid'=>$pid, 'whr'=>$whr];
    }

}
