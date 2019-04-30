<?php
/*
 * 文档通用模板配置
/*/
$_vc_sale = array(

    //config配置
    'c' => array(
        'vmode' => 'dynamic', //dynamic,static,close
        'stexp' => '2h', //hour(s)
    ),
    
    //mod.home模块首页
    'm' => array(
        '0' => 'suite/sale-mtype', //首页,news/mtype
        'list' => 'suite/sale-mtype', //搜索,news/mtype
    ), 
    
    //详情页
    'd' => [
        '0' => 'suite/sale-detail',
        'a4' => 'suite/sale-a4',
        'tu' => 'suite/sale-tu',
    ],
    //类别页
    't' => 'suite/sale-mtype',
    
);
