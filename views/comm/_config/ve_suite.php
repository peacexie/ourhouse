<?php
/*
 * 此文件作用：`?suite` 指向不存在的模板
/*/
$_ve_suite = array(

    //mod.home模块首页
    'm' => array(
        '0' => 'suite/mhome', //首页,news/mtype
        'list' => 'suite/mext', //搜索,news/mtype
    ), 
    
    //详情页
    'd' => 'suite/detail',

    'sale' => array(
        '0' => 'suite/detail', //首页,news/mtype
        'a4' => 'suite/a4', //搜索,news/mtype
    ), 

    //'sale' => 'suite/_null',
    //'rent' => 'suite/_null',

    //类别页
    't' => array(
        '0' => 'suite/detail', //首页,news/mtype
        'a4' => 'suite/a4', //搜索,news/mtype
    ), 

    't' => 'xxx/mtype',

);
