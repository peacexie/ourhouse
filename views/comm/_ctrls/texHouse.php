<?php
namespace imcat\comm;

use imcat\basLang;
use imcat\comTypes;
use imcat\extMkdown;
use imcat\vopCell;

/*
单个模板扩展函数
*/ 
class texHouse{
    
    #protected $prop1 = array();
    static $nulC = "<span class='cCCC'>未知</span>";
    static $nul9 = "<p class='c999'>暂无资料</p>";

    static function vmd($text, $null=''){ 
        if(empty($null)) $null = self::$nul9;
        if(empty($text)){ return $null; }
        $text = str_replace(["\r\n","\n","\n\n\n\n","\n\n\n"], ["\n","\n\n","\n\n","\n\n"], $text);
        return extMkdown::pdext($text,0);
    }

    // ext: 建设,产权
    static function vnian2($nian, $null='', $ext=''){ 
        if(empty($null)) $null = self::$nulC;
        if(empty($nian)){
            return $null.$ext;
        }else{ // $nunit = "元/㎡";
            $ex0 = strpos($nian,'年') ? '' : '年';
            return $nian.$ex0.$ext;
        }
    }

    static function vprcie($price, $punit, $null=''){ 
        if(empty($null)) $null = self::$nulC;
        if(empty($price)){
            return $null;
        }else{ // $nunit = "元/㎡";
            $price = "<i class='cCCC'>&yen;</i><b>{$price}</b>";
            $unit = vopCell::cOpt($punit,'house.punit',0,"元/㎡");
            return $price.$unit;
        }
    }

    static function vtags($tags, $sytle='default'){ 
        $tags = str_replace(array(' ','/',"，","|"), array(',',',',",",","), $tags);
        $tga = explode(',', $tags); $tgstr = '';
        foreach($tga as $tag){
            $tgstr .= "<span class='label label-$sytle'>$tag</span>\n";
        }
        return $tgstr;
    }

    static function ilist($flag=0){ 
        $tmp = texBase::whrAids(); 
        extract($tmp); //dump($tmp);
        $priceA = req('price');
        if(strstr($priceA,'~')){ //$area && 
            $arr = explode('~',$priceA);
            $arr[0] && $whr .= (empty($whr) ? '' : ' AND ')."price>='".($arr[0]*10000)."'";
            $arr[1] && $whr .= (empty($whr) ? '' : ' AND ')."price<='".($arr[1]*10000)."'";
        }
        /*$stype = req('stype');
        if($stype){
            $whr .= (empty($whr) ? '' : ' AND ')."catid='$stype'";
        }*/
        $wy = req('wy');
        if($wy){
            $whr .= (empty($whr) ? '' : ' AND ')."wytype='$wy'";
        }
        $sa = req('sa');
        if($sa){
            $whr .= (empty($whr) ? '' : ' AND ')."sales='$sa'";
        }
        $zx = req('zx');
        if($zx){
            $whr .= (empty($whr) ? '' : ' AND ')."zxtype='$zx'";
        }
        $hxroom = req('hxroom');
        if($hxroom){
            $wh2 = $hxroom > 10 ? "hxroom>'5'" : "hxroom='$hxroom'";
            $field = "DISTINCT(lpid) AS lpid";
            $lst2 = db()->table('docs_huxing')->field($field)->where($wh2)->select();
            $tb2 = [];
            if(!empty($lst2)){
                foreach($lst2 as $v2) { $tb2[] = $v2['lpid']; }
                $inids = "'".implode("','",$tb2)."'";
                $whr .= (empty($whr) ? '' : ' AND ')."did IN($inids)";
            }
        }
        $keywd = req('keywd');
        if($keywd){
            $whr .= (empty($whr) ? '' : ' AND ')."title LIKE '%$keywd%'";
        }
        return ['area'=>$area, 'pid'=>$pid, 'whr'=>$whr];
    }

}
