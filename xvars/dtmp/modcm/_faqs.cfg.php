<?php
$_faqs = array (
  'kid' => 'faqs',
  'pid' => 'docs',
  'title' => '问答',
  'enable' => '1',
  'etab' => '1',
  'deep' => '1',
  'cfgs' => 'showdef=0',
  'f' => 
  array (
    'title' => 
    array (
      'kid' => 'title',
      'title' => 'Title/标题',
      'etab' => '0',
      'type' => 'input',
      'dbtype' => 'varchar',
      'dblen' => '255',
      'dbdef' => '',
      'vreg' => 'tit:2-60',
      'vtip' => 'Title 2-60 characters<br>标题2-60字符',
      'vmax' => '60',
      'fmsize' => '360',
      'fmline' => '1',
      'fmtitle' => '1',
      'fmextra' => '',
      'fmexstr' => '',
      'cfgs' => '',
    ),
    'color' => 
    array (
      'kid' => 'color',
      'title' => '标题颜色',
      'etab' => '0',
      'type' => 'input',
      'dbtype' => 'varchar',
      'dblen' => '12',
      'dbdef' => '',
      'vreg' => 'nul:str:4-7',
      'vtip' => '如:#FF00FF',
      'vmax' => '8',
      'fmsize' => '',
      'fmline' => '0',
      'fmtitle' => '0',
      'fmextra' => 'color',
      'fmexstr' => 'title',
      'cfgs' => '',
    ),
    'ndb_repeat' => 
    array (
      'kid' => 'ndb_repeat',
      'title' => '检查重复',
      'etab' => '0',
      'type' => 'repeat',
      'dbtype' => 'nodb',
      'dblen' => '0',
      'dbdef' => '',
      'vreg' => '',
      'vtip' => '',
      'vmax' => '0',
      'fmsize' => '',
      'fmline' => '0',
      'fmtitle' => '0',
      'fmextra' => 'repeat',
      'fmexstr' => '',
      'cfgs' => 'news,title',
    ),
    'hinfo' => 
    array (
      'kid' => 'hinfo',
      'title' => '精华',
      'etab' => '0',
      'type' => 'radio',
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
      'cfgs' => '0=(无)
tip24=精华
tip36=推荐
tip48=有用
tip56=收藏',
    ),
    'detail' => 
    array (
      'kid' => 'detail',
      'title' => 'Detail/内容',
      'etab' => '1',
      'type' => 'text',
      'dbtype' => 'text',
      'dblen' => '0',
      'dbdef' => '',
      'vreg' => 'nul:str:10+',
      'vtip' => 'At least 10 characters, support makedown<br>内容10字符以上,支持makedown语法',
      'vmax' => '0',
      'fmsize' => '560x18',
      'fmline' => '1',
      'fmtitle' => '1',
      'fmextra' => '',
      'fmexstr' => '',
      'cfgs' => '',
    ),
    'tags' => 
    array (
      'kid' => 'tags',
      'title' => 'Tags/标签',
      'etab' => '0',
      'type' => 'input',
      'dbtype' => 'varchar',
      'dblen' => '24',
      'dbdef' => '',
      'vreg' => 'nul:',
      'vtip' => '',
      'vmax' => '24',
      'fmsize' => '480',
      'fmline' => '1',
      'fmtitle' => '0',
      'fmextra' => '',
      'fmexstr' => '',
      'cfgs' => '',
    ),
    'mpic' => 
    array (
      'kid' => 'mpic',
      'title' => '缩略图',
      'etab' => '0',
      'type' => 'file',
      'dbtype' => 'varchar',
      'dblen' => '255',
      'dbdef' => '',
      'vreg' => 'nul:fix:image',
      'vtip' => 'gif/jpg/jpeg/png格式.',
      'vmax' => '255',
      'fmsize' => '320',
      'fmline' => '1',
      'fmtitle' => '1',
      'fmextra' => '',
      'fmexstr' => '',
      'cfgs' => '',
    ),
    'jump' => 
    array (
      'kid' => 'jump',
      'title' => '跳转地址',
      'etab' => '0',
      'type' => 'input',
      'dbtype' => 'varchar',
      'dblen' => '255',
      'dbdef' => '',
      'vreg' => 'nul:fix:uri',
      'vtip' => 'http://开头',
      'vmax' => '255',
      'fmsize' => '480',
      'fmline' => '1',
      'fmtitle' => '1',
      'fmextra' => '',
      'fmexstr' => '',
      'cfgs' => '',
    ),
    'source' => 
    array (
      'kid' => 'source',
      'title' => 'From/来源',
      'etab' => '1',
      'type' => 'input',
      'dbtype' => 'varchar',
      'dblen' => '255',
      'dbdef' => '',
      'vreg' => '',
      'vtip' => '',
      'vmax' => '255',
      'fmsize' => '480',
      'fmline' => '1',
      'fmtitle' => '0',
      'fmextra' => '',
      'fmexstr' => '',
      'cfgs' => '',
    ),
    'click' => 
    array (
      'kid' => 'click',
      'title' => '点击次数',
      'etab' => '0',
      'type' => 'input',
      'dbtype' => 'int',
      'dblen' => '10',
      'dbdef' => '0',
      'vreg' => 'n+i',
      'vtip' => '如:888',
      'vmax' => '8',
      'fmsize' => '240',
      'fmline' => '1',
      'fmtitle' => '1',
      'fmextra' => '',
      'fmexstr' => '',
      'cfgs' => '',
    ),
    'author' => 
    array (
      'kid' => 'author',
      'title' => '作者',
      'etab' => '1',
      'type' => 'input',
      'dbtype' => 'varchar',
      'dblen' => '255',
      'dbdef' => '',
      'vreg' => 'nul:',
      'vtip' => '',
      'vmax' => '255',
      'fmsize' => '',
      'fmline' => '0',
      'fmtitle' => '1',
      'fmextra' => '',
      'fmexstr' => '',
      'cfgs' => '',
    ),
    'bugid' => 
    array (
      'kid' => 'bugid',
      'title' => 'bug编号',
      'etab' => '0',
      'type' => 'input',
      'dbtype' => 'varchar',
      'dblen' => '24',
      'dbdef' => '',
      'vreg' => 'nul:',
      'vtip' => '2016-0720:11234567',
      'vmax' => '24',
      'fmsize' => '150',
      'fmline' => '1',
      'fmtitle' => '1',
      'fmextra' => '',
      'fmexstr' => '',
      'cfgs' => '',
    ),
    'bugst' => 
    array (
      'kid' => 'bugst',
      'title' => '状态',
      'etab' => '0',
      'type' => 'select',
      'dbtype' => 'varchar',
      'dblen' => '12',
      'dbdef' => 'open',
      'vreg' => 'nul:',
      'vtip' => '',
      'vmax' => '12',
      'fmsize' => '',
      'fmline' => '0',
      'fmtitle' => '1',
      'fmextra' => '',
      'fmexstr' => '',
      'cfgs' => 'open=开放
noedit=关闭编辑
close=关闭回复',
    ),
    'mdshow' => 
    array (
      'kid' => 'mdshow',
      'title' => 'md显示',
      'etab' => '1',
      'type' => 'select',
      'dbtype' => 'varchar',
      'dblen' => '12',
      'dbdef' => '',
      'vreg' => '',
      'vtip' => '',
      'vmax' => '12',
      'fmsize' => '',
      'fmline' => '0',
      'fmtitle' => '1',
      'fmextra' => '',
      'fmexstr' => '',
      'cfgs' => 'text=Text(文本)
md=Makedown',
    ),
  ),
  'i' => 
  array (
    'qapub' => 
    array (
      'kid' => 'qapub',
      'pid' => '0',
      'title' => 'Fixed/修复',
      'deep' => '1',
      'frame' => '0',
      'char' => 'F',
      'cfgs' => '',
    ),
    'qabug' => 
    array (
      'kid' => 'qabug',
      'pid' => '0',
      'title' => 'Bug/反馈',
      'deep' => '1',
      'frame' => '0',
      'char' => 'B',
      'cfgs' => '',
    ),
    'qapro' => 
    array (
      'kid' => 'qapro',
      'pid' => '0',
      'title' => 'Improve/改进',
      'deep' => '1',
      'frame' => '0',
      'char' => 'I',
      'cfgs' => '',
    ),
    'qacom' => 
    array (
      'kid' => 'qacom',
      'pid' => '0',
      'title' => 'Share/交流',
      'deep' => '1',
      'frame' => '0',
      'char' => 'S',
      'cfgs' => '',
    ),
    'qatra' => 
    array (
      'kid' => 'qatra',
      'pid' => '0',
      'title' => 'Trans/翻译',
      'deep' => '1',
      'frame' => '0',
      'char' => 'T',
      'cfgs' => '',
    ),
    'qahlp' => 
    array (
      'kid' => 'qahlp',
      'pid' => '0',
      'title' => 'Help/捐助',
      'deep' => '1',
      'frame' => '0',
      'char' => 'H',
      'cfgs' => '',
    ),
    'qareg' => 
    array (
      'kid' => 'qareg',
      'pid' => '0',
      'title' => 'Speci/规范',
      'deep' => '1',
      'frame' => '0',
      'char' => 'S',
      'cfgs' => '',
    ),
  ),
);
?>