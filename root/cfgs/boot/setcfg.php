<?php
(!defined('RUN_INIT')) && die('No Init');
// supml -> setup-multi-language

// ### 演示数据 ------------------------

$_demo_tabs = array(
    'dext_house', 'docs_house', 
    'dext_sale', 'docs_sale', 
    'dext_rent', 'dext_rent', 
    // 
    'dext_album', 'dext_hnews', 
    'dext_huxing', //'dext_xxx', 
    // 
    'dext_demo', 'docs_demo', 
    'dext_news', 'docs_news', 
);

// ### 文件替换 ------------------------

$_files = array();

// ### db-table替换 ------------------------

$_dbtabs = array();

$_updmods = array(); // 'about','info'

// 综合结果 ------------------------
$_scfgs['demo_tabs'] = $_demo_tabs;
$_scfgs['files'] = $_files;
$_scfgs['dbtabs'] = $_dbtabs; 
$_scfgs['updmods'] = $_updmods; 
