<?php
$_need = array (
  'kid' => 'need',
  'pid' => 'coms',
  'title' => '意向需求',
  'enable' => '1',
  'etab' => '0',
  'deep' => '1',
  'cfgs' => 'showdef=1
login=1
ap_cvip=500
allpub=100
ippub=5
iprep=60',
  'f' => 
  array (
    'lpid' => 
    array (
      'kid' => 'lpid',
      'title' => '关联模型',
      'etab' => '0',
      'type' => 'input',
      'dbtype' => 'varchar',
      'dblen' => '96',
      'dbdef' => '0',
      'vreg' => 'nul:',
      'vtip' => '',
      'vmax' => '96',
      'fmsize' => 'house.1',
      'fmline' => '1',
      'fmtitle' => '0',
      'fmextra' => 'pick',
      'fmexstr' => '',
      'cfgs' => '',
    ),
    'ntype' => 
    array (
      'kid' => 'ntype',
      'title' => '类别',
      'etab' => '0',
      'type' => 'cbox',
      'dbtype' => 'varchar',
      'dblen' => '12',
      'dbdef' => '',
      'vreg' => 'nul:',
      'vtip' => '',
      'vmax' => '12',
      'fmsize' => '',
      'fmline' => '1',
      'fmtitle' => '0',
      'fmextra' => '',
      'fmexstr' => '',
      'cfgs' => 'a1=价格变动
a2=开盘预告
a3=楼盘动态
a4=看房团
b1=想看房
b2=想租房
b3=想买房
c1=想咨询
c2=想了解
c3=想报错
c4=想投诉',
    ),
    'mname' => 
    array (
      'kid' => 'mname',
      'title' => '会员名称',
      'etab' => '0',
      'type' => 'input',
      'dbtype' => 'varchar',
      'dblen' => '24',
      'dbdef' => '',
      'vreg' => 'str:2-24',
      'vtip' => '2-24字符',
      'vmax' => '24',
      'fmsize' => '',
      'fmline' => '1',
      'fmtitle' => '1',
      'fmextra' => '',
      'fmexstr' => '',
      'cfgs' => '',
    ),
    'mtel' => 
    array (
      'kid' => 'mtel',
      'title' => '电话',
      'etab' => '0',
      'type' => 'input',
      'dbtype' => 'varchar',
      'dblen' => '24',
      'dbdef' => '',
      'vreg' => 'nul:fix:tel',
      'vtip' => '2-24字符',
      'vmax' => '24',
      'fmsize' => '',
      'fmline' => '1',
      'fmtitle' => '0',
      'fmextra' => '',
      'fmexstr' => '',
      'cfgs' => '',
    ),
    'detail' => 
    array (
      'kid' => 'detail',
      'title' => '内容',
      'etab' => '0',
      'type' => 'text',
      'dbtype' => 'text',
      'dblen' => '0',
      'dbdef' => '',
      'vreg' => '',
      'vtip' => '内容10字符以上',
      'vmax' => '255',
      'fmsize' => '360x5',
      'fmline' => '1',
      'fmtitle' => '1',
      'fmextra' => '',
      'fmexstr' => '',
      'cfgs' => '',
    ),
  ),
);
?>