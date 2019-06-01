

### 模板指引


#### 模板目录

* /views/      - 项目模板:总目录
* /views/adm/  - 后台管理模板
* /views/base/ - 基础工具模板，如:map,动态js/css,工具等
* /views/comm/ - 前端默认模板（默认/中文）
* /views/mob/  - 手机版模板（预留）
* /views/umc/  - 会员中心模板（预留）
* /views/rest/ - rest API（预留）

模板目录详情，以`前端默认模板`为例，其他类似

* /views/comm/\_config/ - 模板配置
* /views/comm/\_ctrls/  - 控制器方法扩展代码
* /views/comm/assets/   - 资源目录，如css,js,images
* /views/comm/about/    - 公司介绍模块模板
* /views/comm/house/    - 楼盘模块模板
* /views/comm/suite/    - 房源（出租，出售）模板
* /views/comm/home/     - 前端首页模板
* /views/comm/info/     - 留言/导航等杂项模板
* /views/comm/news/     - 资讯模块模板
* /views/comm/faqs/     - 问答模板
* /views/comm/topic/    - 专题模板
* /views/comm/u-inc/    - 公共区块，如头尾等
* /views/comm/u-inc/ahead.htm - 公共头文件
* /views/comm/u-inc/afoot.htm - 公共尾文件
* /views/comm/u-inc/amenu.htm - 公共菜单文件

导航首页相关文件目录

* /views/base/home/              - 导航首页相关 总目录
* /views/base/home/en.htm        - 首页模板(英文版，预留)
* /views/base/home/cn.htm        - 首页模板(中文版，预留)
* /views/base/home/_layout.htm   - 首页布局
* 首页需自定义跳转或更多DIY，修改控制器文件 `/views/base/_ctrls/homeCtrl.php` 内的 `homeAct()` 方法
