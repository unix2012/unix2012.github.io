<?php
#设置部分
$adminpsd="5175891";#管理员密码
$number="24";#每页文章数
$name="阅读时间";#文章管理系统的名称
$book="词句失去作用的地方，才是生活开始的地方。";#文章副标题
$datadir="./data/";#存放资料的文件夹的位置
#设置结束，请不要改动以下的部分，除非您知道您在干什么：）
header("content-Type: text/html; charset=gb2312");
if (!is_dir("$datadir")) { mkdir("$datadir",0777); }
$php_self_url="http://".$HTTP_SERVER_VARS["SERVER_NAME"].$PHP_SELF;
global $php_self_url;
include("checkpostandget.php");
?>

