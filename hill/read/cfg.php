<?php
#���ò���
$adminpsd="5175891";#����Ա����
$number="24";#ÿҳ������
$name="�Ķ�ʱ��";#���¹���ϵͳ������
$book="�ʾ�ʧȥ���õĵط����������ʼ�ĵط���";#���¸�����
$datadir="./data/";#������ϵ��ļ��е�λ��
#���ý������벻Ҫ�Ķ����µĲ��֣�������֪�����ڸ�ʲô����
header("content-Type: text/html; charset=gb2312");
if (!is_dir("$datadir")) { mkdir("$datadir",0777); }
$php_self_url="http://".$HTTP_SERVER_VARS["SERVER_NAME"].$PHP_SELF;
global $php_self_url;
include("checkpostandget.php");
?>

