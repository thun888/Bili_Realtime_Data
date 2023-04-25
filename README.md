# Bilibili Up主数据实时统计系统
[![demo.jpg](https://github.com/CzJam/Bili_Realtime_Data/blob/main/demo2.jpg)](https://github.com/CzJam/Bili_Realtime_Data/blob/main/demo2.jpg)
### 本项目通过B站官方api实时统计Up主的视频与粉丝数据

### 主要功能
- 实时粉丝数
- 每日（月）实时涨粉数
- 实时视频数据（最多展示前30期）
	- 播放量 
	- 在线观看人数
	- 三连数、三连率
	- 是否上了热门

----

### 系统特点
- 无需登录B站帐号
- 可自定义数据更新间隔
- 支持添加多个Up主数据，可为多个Up主分别设定视频展示数与数据更新间隔
- 支持在本地服务器部署，无需公网IP
- 适配手机布局、可选亮色与暗色主题

------------



### 运行环境

**为降低新手部署难度，教程基于Linux系统宝塔面板环境。**
> 本项目涉及Linux与Web开发相关的知识，若您没有经验请善用搜索引擎，其中99%的问题都能得到解决。如“怎么安装Linux”“怎么安装宝塔面板”等。

- 完整LNMP或LAMP环境（PHP版本>=7.3。宝塔面板支持一键安装。）
- PhpMyAdmin（数据库管理工具。宝塔面板支持一键安装）

------------



### 搭建步骤

1. 新建站点，将项目里除sql外所有文件上传到站点目录下
2. 新建数据库，导入项目里的sql文件
3. 通过PhpMyadmin登录数据库，插入一行数据并按要求更改其内容：
	 - uid：在up主的个人空间右侧找到，也显示在浏览器链接里
	 - nick：up主标识，随便填写英文即可。可通过不同标识查看不同Up主的数据
	 - dailyFans：每日00:00自动统计的粉丝数。随便填个数就行，晚上12点会自动更新
	 - monthlyFans：每月1日00:00自动统计的粉丝数。如果统计自己的月涨粉可在B站的数据中心导出Excel，看上月最后一天的粉丝数
4. 复制数据库名、用户名、密码，填写到站点目录中的database.php文件中
5. 浏览器访问 http://站点地址/?usr=nick 其中nick为刚刚在数据库中填写的up主标识
6. 在宝塔面板左侧新建计划任务，用于统计涨粉：
	- 每日00:00执行访问url：http://站点地址/updatefans.php?update=daily 
	- 每月00:00执行访问url：http://站点地址/updatefans.php?update=monthly 
6. 至此搭建完成！您可在controller.php中修改显示的视频数量与自动刷新时间，在index.php中可修改主题风格
------------



### 注意事项
由于B站限制单IP访问频率，频繁刷新会导致IP暂时被封锁，获取不到数据。如果您要一次全部展示30期视频，请将自动刷新时间设置为一分钟以上（60000毫秒），若展示的视频数量较少则可减少自动刷新时间。
