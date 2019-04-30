<?php
/*
 * 文档通用模板配置
/*/
$_vc_rent = array(

    //config配置
    'c' => array(
        'vmode' => 'dynamic', //dynamic,static,close
        'stexp' => '2h', //hour(s)
    ),
    
    //mod.home模块首页
    'm' => array(
        '0' => 'suite/rent-mtype', //首页,news/mtype
        'list' => 'suite/rent-mtype', //搜索,news/mtype
    ), 
    
    //详情页
    'd' => [
        '0' => 'suite/rent-detail',
        'a4' => 'suite/rent-a4',
        'tu' => 'suite/rent-tu',
    ],
    //类别页
    't' => 'suite/rent-mtype',
    
);
