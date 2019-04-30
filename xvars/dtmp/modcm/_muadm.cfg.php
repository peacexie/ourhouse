<?php
$_muadm = array (
  'kid' => 'muadm',
  'pid' => 'menus',
  'title' => '后台菜单',
  'enable' => '1',
  'etab' => '1',
  'deep' => '3',
  'i' => 
  array (
    'm1main' => 
    array (
      'kid' => 'm1main',
      'pid' => '0',
      'title' => '主营',
      'icon' => 'heart',
      'deep' => '1',
      'cfgs' => '',
    ),
    'm2pro' => 
    array (
      'kid' => 'm2pro',
      'pid' => 'm1main',
      'title' => '楼盘房源',
      'icon' => '',
      'deep' => '2',
      'cfgs' => '',
    ),
    'm3sale' => 
    array (
      'kid' => 'm3sale',
      'pid' => 'm2pro',
      'title' => '出售管理',
      'icon' => '',
      'deep' => '3',
      'cfgs' => '出售管理(!)?dops-a&mod=sale
增加(!)sale(!)jsadd',
    ),
    'm3rent' => 
    array (
      'kid' => 'm3rent',
      'pid' => 'm2pro',
      'title' => '出租管理',
      'icon' => '',
      'deep' => '3',
      'cfgs' => '出租管理(!)?dops-a&mod=rent
增加(!)rent(!)jsadd',
    ),
    'm3house' => 
    array (
      'kid' => 'm3house',
      'pid' => 'm2pro',
      'title' => '楼盘管理',
      'icon' => '',
      'deep' => '3',
      'cfgs' => '楼盘管理(!)?dops-a&mod=house
增加(!)house(!)jsadd',
    ),
    'm3hxdt' => 
    array (
      'kid' => 'm3hxdt',
      'pid' => 'm2pro',
      'title' => '户型动态',
      'icon' => '',
      'deep' => '3',
      'cfgs' => '户型管理(!)?dops-a&mod=huxing(!)
动态(!)?dops-a&mod=hnews',
    ),
    'm3upx' => 
    array (
      'kid' => 'm3upx',
      'pid' => 'm2pro',
      'title' => '相册管理',
      'icon' => '',
      'deep' => '3',
      'cfgs' => '<a href="?dops-a&mod=album&part=house" title="楼盘相册">相册</a> 
- 
<a href="?dops-a&mod=album&part=sale" title="出售相册">售</a>
- 
<a href="?dops-a&mod=album&part=rent" title="出租相册">租</a>',
    ),
    'm2res' => 
    array (
      'kid' => 'm2res',
      'pid' => 'm1main',
      'title' => '房产设置',
      'icon' => '',
      'deep' => '2',
      'cfgs' => '',
    ),
    'm3fang' => 
    array (
      'kid' => 'm3fang',
      'pid' => 'm2res',
      'title' => '属性参数',
      'icon' => '',
      'deep' => '3',
      'cfgs' => '参数属性(!)?admin-types&mod=fang(!)frame
设置(!)?admin-parex',
    ),
    'm3keres' => 
    array (
      'kid' => 'm3keres',
      'pid' => 'm2res',
      'title' => '意向需求',
      'icon' => '',
      'deep' => '3',
      'cfgs' => '楼盘意向(!)?dops-a&mod=need&part=house(!)
所有(!)?dops-a&mod=need',
    ),
    'm2user' => 
    array (
      'kid' => 'm2user',
      'pid' => 'm1main',
      'title' => '会员管理',
      'icon' => '',
      'deep' => '2',
      'cfgs' => '',
    ),
    'm3inmem' => 
    array (
      'kid' => 'm3inmem',
      'pid' => 'm2user',
      'title' => '经纪人',
      'icon' => '',
      'deep' => '3',
      'cfgs' => '经纪人(!)?dops-a&mod=inmem
等级(!)?admin-grade&mod=inmem',
    ),
    'm3prson' => 
    array (
      'kid' => 'm3prson',
      'pid' => 'm2user',
      'title' => '个人会员',
      'icon' => '',
      'deep' => '3',
      'cfgs' => '个人会员(!)?dops-a&mod=person
添加(!)person(!)jsadd',
    ),
    'm3060' => 
    array (
      'kid' => 'm3060',
      'pid' => 'm2user',
      'title' => '企业会员',
      'icon' => '',
      'deep' => '3',
      'cfgs' => '企业会员(!)?dops-a&mod=company
添加(!)company(!)jsadd',
    ),
    'm1info' => 
    array (
      'kid' => 'm1info',
      'pid' => '0',
      'title' => '资讯',
      'icon' => 'bullhorn',
      'deep' => '1',
      'cfgs' => '',
    ),
    'm2info' => 
    array (
      'kid' => 'm2info',
      'pid' => 'm1info',
      'title' => '新闻介绍',
      'icon' => '',
      'deep' => '2',
      'cfgs' => '',
    ),
    'm3news' => 
    array (
      'kid' => 'm3news',
      'pid' => 'm2info',
      'title' => '新闻动态',
      'icon' => '',
      'deep' => '3',
      'cfgs' => '新闻动态(!)?dops-a&mod=news
增加(!)news(!)jsadd',
    ),
    'm3nrem' => 
    array (
      'kid' => 'm3nrem',
      'pid' => 'm2info',
      'title' => '新闻评论',
      'icon' => '',
      'deep' => '3',
      'cfgs' => '新闻评论(!)?dops-a&mod=nrem(!)
栏目(!)?admin-catalog&mod=news(!)frame',
    ),
    'm3about' => 
    array (
      'kid' => 'm3about',
      'pid' => 'm2info',
      'title' => '站点介绍',
      'icon' => '',
      'deep' => '3',
      'cfgs' => '站点介绍(!)?dops-a&mod=about
增加(!)about(!)jsadd',
    ),
    'm2topic' => 
    array (
      'kid' => 'm2topic',
      'pid' => 'm1info',
      'title' => '专题新闻',
      'icon' => '',
      'deep' => '2',
      'cfgs' => '',
    ),
    'm3topic' => 
    array (
      'kid' => 'm3topic',
      'pid' => 'm2topic',
      'title' => '专题新闻',
      'icon' => '',
      'deep' => '3',
      'cfgs' => '专题新闻(!)?dops-a&mod=topic
增加(!)topic(!)jsadd',
    ),
    'm3torem' => 
    array (
      'kid' => 'm3torem',
      'pid' => 'm2topic',
      'title' => '评论栏目',
      'icon' => '',
      'deep' => '3',
      'cfgs' => '新闻评论(!)?dops-a&mod=trem(!)
栏目(!)?admin-catalog&mod=topic(!)frame',
    ),
    'm1coms' => 
    array (
      'kid' => 'm1coms',
      'pid' => '0',
      'title' => '互动',
      'icon' => 'commenting-o',
      'deep' => '1',
      'cfgs' => '',
    ),
    'm2faqs' => 
    array (
      'kid' => 'm2faqs',
      'pid' => 'm1coms',
      'title' => '问答系统',
      'icon' => '',
      'deep' => '2',
      'cfgs' => '',
    ),
    'm3qadmin' => 
    array (
      'kid' => 'm3qadmin',
      'pid' => 'm2faqs',
      'title' => '管理发布',
      'icon' => '',
      'deep' => '3',
      'cfgs' => '问答管理(!)?dops-a&mod=faqs
发布(!)faqs(!)jsadd',
    ),
    'm3qrtag' => 
    array (
      'kid' => 'm3qrtag',
      'pid' => 'm2faqs',
      'title' => '回复标签',
      'icon' => '',
      'deep' => '3',
      'cfgs' => '<a href="?dops-a&mod=qarep">问答回复</a> 
- <a href="?dops-a&mod=qatag">标签</a>
',
    ),
    'm3qaset' => 
    array (
      'kid' => 'm3qaset',
      'pid' => 'm2faqs',
      'title' => '统计更新',
      'icon' => '',
      'deep' => '3',
      'cfgs' => '<a href="?apis-exp_qaset">问答统计</a> 
- <a href="?apis-exp_qaset&view=uset">更新</a>',
    ),
    'm2else' => 
    array (
      'kid' => 'm2else',
      'pid' => 'm1coms',
      'title' => '其他互动',
      'icon' => '',
      'deep' => '2',
      'cfgs' => '',
    ),
    'm3gbook' => 
    array (
      'kid' => 'm3gbook',
      'pid' => 'm2else',
      'title' => '网站留言管理',
      'icon' => '',
      'deep' => '3',
      'cfgs' => '?dops-a&mod=gbook',
    ),
    'm3notea' => 
    array (
      'kid' => 'm3notea',
      'pid' => 'm2else',
      'title' => '站务笔记管理',
      'icon' => '',
      'deep' => '3',
      'cfgs' => '笔记管理(!)?dops-a&mod=notea
发布(!)notea(!)jsadd',
    ),
    'm1adv' => 
    array (
      'kid' => 'm1adv',
      'pid' => '0',
      'title' => '广告',
      'icon' => 'link',
      'deep' => '1',
      'cfgs' => '',
    ),
    'm1tool' => 
    array (
      'kid' => 'm1tool',
      'pid' => '0',
      'title' => '工具',
      'icon' => 'gavel',
      'deep' => '1',
      'cfgs' => '',
    ),
    'm2sys' => 
    array (
      'kid' => 'm2sys',
      'pid' => 'm1tool',
      'title' => '系统工具',
      'icon' => '',
      'deep' => '2',
      'cfgs' => '',
    ),
    'm3catch' => 
    array (
      'kid' => 'm3catch',
      'pid' => 'm2sys',
      'title' => '缓存静态',
      'icon' => '',
      'deep' => '3',
      'cfgs' => '系统缓存(!)?admin-update
静态(!)?admin-static',
    ),
    'm3self' => 
    array (
      'kid' => 'm3self',
      'pid' => 'm2sys',
      'title' => '个人资料',
      'icon' => '',
      'deep' => '3',
      'cfgs' => '个人资料(!)?admin-uinfo
密码(!)?admin-uinfo&view=passwd',
    ),
    'm3env' => 
    array (
      'kid' => 'm3env',
      'pid' => 'm2sys',
      'title' => '环境检测',
      'icon' => '',
      'deep' => '3',
      'cfgs' => '<a href="?admin-ediy&part=binfo">基础环境</a> 
- <a href="?admin-ediy&part=check">检测</a>',
    ),
    'm3ediy' => 
    array (
      'kid' => 'm3ediy',
      'pid' => 'm2sys',
      'title' => '配置搜索',
      'icon' => '',
      'deep' => '3',
      'cfgs' => '<a href="?admin-ediy&part=exdiy">DIY配置</a> 
- <a href="?admin-ediy&part=search">搜索</a>',
    ),
    'm2data' => 
    array (
      'kid' => 'm2data',
      'pid' => 'm1tool',
      'title' => '数据工具',
      'icon' => '',
      'deep' => '2',
      'cfgs' => '',
    ),
    'm3plan' => 
    array (
      'kid' => 'm3plan',
      'pid' => 'm2data',
      'title' => '计划任务',
      'icon' => '',
      'deep' => '3',
      'cfgs' => '计划任务(!)?apis-cron_plan
积分(!)?apis-jifen_plan',
    ),
    'm3share' => 
    array (
      'kid' => 'm3share',
      'pid' => 'm2data',
      'title' => '数据分享',
      'icon' => '',
      'deep' => '3',
      'cfgs' => '数据分享(!)?apis-exd_share
设置(!)?apis-exd_share&view=set',
    ),
    'm3data' => 
    array (
      'kid' => 'm3data',
      'pid' => 'm2data',
      'title' => '数据采集',
      'icon' => '',
      'deep' => '3',
      'cfgs' => '数据采集(!)?apis-exd_crawl
增加(!)?apis-exd_crawl&view=form',
    ),
    'm3seo' => 
    array (
      'kid' => 'm3seo',
      'pid' => 'm2data',
      'title' => '优化推送',
      'icon' => '',
      'deep' => '3',
      'cfgs' => 'SEO优化(!)?apis-seo_push
推送(!)?apis-seo_push&pid=seo_pset',
    ),
    'm2fav' => 
    array (
      'kid' => 'm2fav',
      'pid' => 'm1tool',
      'title' => '我的收藏',
      'icon' => '',
      'deep' => '2',
      'cfgs' => '',
    ),
    'm3favor' => 
    array (
      'kid' => 'm3favor',
      'pid' => 'm2fav',
      'title' => '收藏帮助',
      'icon' => '',
      'deep' => '3',
      'cfgs' => '网址收藏(!)?dops-a&mod=adfavor&view=vself
帮助(!)http://txmao.txjia.com/dev.php(!)blank',
    ),
    'm1adm' => 
    array (
      'kid' => 'm1adm',
      'pid' => '0',
      'title' => '架设',
      'icon' => 'cogs',
      'deep' => '1',
      'cfgs' => '',
    ),
    'm2stru' => 
    array (
      'kid' => 'm2stru',
      'pid' => 'm1adm',
      'title' => '超管架构',
      'icon' => 'gear',
      'deep' => '2',
      'cfgs' => '',
    ),
    'm3model' => 
    array (
      'kid' => 'm3model',
      'pid' => 'm2stru',
      'title' => '模块架设',
      'icon' => '',
      'deep' => '3',
      'cfgs' => '模块架设(!)?admin-groups
扩展(!)?admin-upgrade&mod=extend',
    ),
    'm3auser' => 
    array (
      'kid' => 'm3auser',
      'pid' => 'm2stru',
      'title' => '管理员:设置/添加',
      'icon' => '',
      'deep' => '3',
      'cfgs' => '管理员(!)?dops-a&mod=adminer
添加(!)adminer(!)jsadd',
    ),
    'm3catalog' => 
    array (
      'kid' => 'm3catalog',
      'pid' => 'm2stru',
      'title' => '栏目管理:文档/广告',
      'icon' => '',
      'deep' => '3',
      'cfgs' => '<a href="?admin-catalog" title="文档栏目">栏目管理</a> 
- 
<a href="?admin-catalog&mod=adpic" title="广告栏目">广告</a>',
    ),
    'm3relat' => 
    array (
      'kid' => 'm3relat',
      'pid' => 'm2stru',
      'title' => '类别:管理/关联',
      'icon' => '',
      'deep' => '3',
      'cfgs' => '类别管理(!)?admin-types
关联(!)?admin-relat',
    ),
    'm3amenu' => 
    array (
      'kid' => 'm3amenu',
      'pid' => 'm2stru',
      'title' => '菜单导航配置',
      'icon' => '',
      'deep' => '3',
      'cfgs' => '?admin-menus',
    ),
    'm3grade' => 
    array (
      'kid' => 'm3grade',
      'pid' => 'm2stru',
      'title' => '等级权限设置',
      'icon' => '',
      'deep' => '3',
      'cfgs' => '?admin-grade',
    ),
    'm2api' => 
    array (
      'kid' => 'm2api',
      'pid' => 'm1adm',
      'title' => '插件/接口',
      'icon' => 'code-fork',
      'deep' => '2',
      'cfgs' => '',
    ),
    'm3apisms' => 
    array (
      'kid' => 'm3apisms',
      'pid' => 'm2api',
      'title' => '短信接口',
      'icon' => '',
      'deep' => '3',
      'cfgs' => '短信发送(!)?apis-sms_send
记录(!)?apis-sms_logs',
    ),
    'm3apipay' => 
    array (
      'kid' => 'm3apipay',
      'pid' => 'm2api',
      'title' => '支付记录',
      'icon' => '',
      'deep' => '3',
      'cfgs' => '支付记录(!)?apis-pay_logs
接口(!)?apis-pay_logs&view=vcfgs',
    ),
    'm3apimail' => 
    array (
      'kid' => 'm3apimail',
      'pid' => 'm2api',
      'title' => '邮件接口',
      'icon' => '',
      'deep' => '3',
      'cfgs' => '邮件记录(!)?apis-mail_logs
接口(!)?apis-mail_logs&view=vcfgs',
    ),
    'm3apiwexin' => 
    array (
      'kid' => 'm3apiwexin',
      'pid' => 'm2api',
      'title' => '微信接口',
      'icon' => '',
      'deep' => '3',
      'cfgs' => '<a href="?awex-wex_apps">微信接口</a> 
- 
<a href="../a3rd/weixin_pay/wedemo.php">演示</a>',
    ),
    'm2adt' => 
    array (
      'kid' => 'm2adt',
      'pid' => 'm1adm',
      'title' => '超管工具',
      'icon' => 'gavel',
      'deep' => '2',
      'cfgs' => '',
    ),
    'm3paras' => 
    array (
      'kid' => 'm3paras',
      'pid' => 'm2adt',
      'title' => '参数设置',
      'icon' => '',
      'deep' => '3',
      'cfgs' => '核心参数(!)?admin-paras
扩展(!)?admin-parex',
    ),
    'm3dbs' => 
    array (
      'kid' => 'm3dbs',
      'pid' => 'm2adt',
      'title' => '数据库管理',
      'icon' => '',
      'deep' => '3',
      'cfgs' => '数据库(!){root}/root/tools/adbug/dbadm.php(!)blank
管理(!)?admin-db_act',
    ),
    'm3safes' => 
    array (
      'kid' => 'm3safes',
      'pid' => 'm2adt',
      'title' => '安全日志',
      'icon' => '',
      'deep' => '3',
      'cfgs' => '安全参数(!)?admin-paras&mod=prsafe
日志(!)?admin-rlogs&mod=syact',
    ),
    'm3upver' => 
    array (
      'kid' => 'm3upver',
      'pid' => 'm2adt',
      'title' => '更新升级',
      'icon' => '',
      'deep' => '3',
      'cfgs' => '系统升级(!)?admin-upgrade
导入(!)?admin-upgrade&mod=import',
    ),
  ),
);
?>