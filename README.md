# deluge-php - Simple php wrapper for the deluge-web json api
The deluge documentation is a little scattered. This should help people get up and running with the json api. Includes the core methods, webui methods, and also the webapi plugin (see url below)
Most functions are not tested, as they are automatically parsed from the following places:
* https://web.archive.org/web/20150423162855/http://deluge-torrent.org:80/docs/master/core/rpc.html
* https://web.archive.org/web/20150423143401/http://deluge-torrent.org:80/docs/master/modules/ui/web/json_api.html#module-deluge.ui.web.json_api
* https://github.com/idlesign/deluge-webapi
## autoremove.php 小硬盘，种子数据自动删除（根据平均上传速度）(简单好用)
1. 安装php
2. 修改 autoremove.php里的host、passwd、max_space参数
3. crontab 添加任务 * * * * * cd your_path/deluge-autoremove && php autoremove.php


## License
GPL v3.0: See LICENSE.md


