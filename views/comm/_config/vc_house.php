<?php
/*
 * 文档通用模板配置
/*/
$_vc_house = array(

    //config配置
    'c' => array(
        'vmode' => 'dynamic', //dynamic,static,close
        'stexp' => '2h', //hour(s)
    ),
    
    //mod.home模块首页
    'm' => array(
        '0' => 'house/mhome', //首页,news/mtype
        'list' => 'house/house-lp', //搜索,news/mtype
    ), 
    
    //详情页
    /*'d' => [
        '0' => 'house/detail',
        'hu' => 'house/detail-hu',
        'tu' => 'house/detail-tu',
        'news' => 'house/detail-news',
        'cs' => 'house/detail-cs',
        'cz' => 'house/detail-cz',
    ],*/
    //类别页
    't' => 'house/mtype',

    'lp' => 'house/house-lp',
    'xq' => 'house/house-lp',

);
