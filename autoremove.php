<?php
include("deluge.class.php");
//connect to deluge-webui and login
// host:string, host of webui server daemon, e.g. "http://1.1.1.1:8112"
// passwd:string
// return:deluge instance
function init($host, $passwd){
    $deluge = new deluge($host, $passwd);
    return $deluge;
}
function sort_by_average_upspeed($a, $b){
    return ($a->total_uploaded/$a->active_time < $b->total_uploaded/$b->active_time)  ? -1 : 1;
}

$host = "";
$passwd = "";
$max_space = 1024*1024*1024*180;     // 180GB
$maxUploadSpeed = 20;      // 20MB/s, then crontab task interval can be set to $maxSpace*0.05/20/60 min  
$deluge = init($host, $passwd);
$free_space = $deluge->getFreeSpace("");
$torrents = $deluge->getTorrents(null,['active_time', 'hash', 'is_finished', 'is_seed', 'name', 'num_peers', 'num_seeds', 'paused', 'progress',  'ratio', 'seeding_time', 'total_done', 'total_peers', 'total_seeds', 'total_size', 'total_uploaded']);
usort($torrents,"sort_by_average_upspeed");
echo $free_space/1024/1024/1024;
while($free_space < $max_space * 0.05){
   
    
    $torrent_to_del = array_shift($torrents);
    if($torrent_to_del->active_time > 10*60){

    $deluge->removeTorrent($torrent_to_del->hash,ture);
    $free_space = $free_space + $torrent_to_del->total_done; 

    }
    
}
$deluge->close();


?>
