<?php
include("cfg.php");

function myreaddir($dir) {
        $handle=opendir($dir);
        $i=0;
        while($file=readdir($handle)) {
                if (($file!=".")and($file!="..")) {
                        $list[$i]=$file;
                        $i=$i+1;
                        }
                }
        closedir($handle);
        return $list;
        }

$oldlist=myreaddir($datadir);
sort($oldlist);

if ($keyword=="") {
        $list=$oldlist;
        $posts=count($list);
        $firsttable="共有<font color=\"red\">$posts</font>篇文章&nbsp;&nbsp;&nbsp;<a href=\"post.php\" target=\"_blank\">发表</a>&nbsp;&nbsp;&nbsp;<a href=\"javascript:window.external.AddFavorite('$php_self_url','$name')\">收藏</a>&nbsp;&nbsp;&nbsp;";
        }
else {
        $keyword=htmlspecialchars("$keyword");
        $keyword=str_replace("\n","<br>","$keyword");
        $keyword=StripSlashes("$keyword");
        $ii=0;
        for ($i=0;$i<sizeof($oldlist);$i=$i+1) {
                $readfile=join("",file("$datadir/".$oldlist[$i]));
                $modifyfile=str_replace("$keyword",$keyword.$keyword,$readfile);
                if (strlen($readfile)!=strlen($modifyfile)) {
                        $list[$ii]=$oldlist[$i];
                        $ii=$ii+1;
                        }
                }
        $posts=count($list);
        $firsttable="找到<font color=\"red\">$posts</font>篇文章&nbsp;&nbsp;&nbsp;<a href=\"index.php\">返回首页</a>&nbsp;&nbsp;&nbsp;";
        }
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title><?php echo "$name"; ?></title>
<link href="style.css" rel=stylesheet>
<script language="JavaScript">
<!--
function MM_reloadPage(init) {  //reloads the window if Nav4 resized
  if (init==true) with (navigator) {if ((appName=="Netscape")&&(parseInt(appVersion)==4)) {
    document.MM_pgW=innerWidth; document.MM_pgH=innerHeight; onresize=MM_reloadPage; }}
  else if (innerWidth!=document.MM_pgW || innerHeight!=document.MM_pgH) location.reload();
}
MM_reloadPage(true);
// -->
</script>
</head>
<body style="background-attachment:fixed" background="images/bg.jpg"><br>
<div align=center><img src="images/top.jpg" width=526 height=116 border=0></div>
<br><br>
<div align=center style="font-size:12pt"><b><?php echo "$name"; ?></b></div>
<br>
<table align=center border=0 cellspacing=0 width=500>
<tr><td>
<div align="center" style="font-size:10.5pt"><?php echo "$book"; ?></div>
</td></tr></table>
<br>
<center>
<table border=0 cellspacing=0 width=1024 bordercolorlight=#405028 bordercolordark=#FFFFFF>
<tr>
<td width="53%" align="center" style="border-top:1px solid #ff0000;border-bottom:1px solid #ff0000">文章标题</td>
<td width="15%" align="center" style="border-top:1px solid #ff0000;border-bottom:1px solid #ff0000">作者</td>
<td width="25%" align="center" style="border-top:1px solid #ff0000;border-bottom:1px solid #ff0000">发表日期</td>
<td width="7%" align="center" style="border-top:1px solid #ff0000;border-bottom:1px solid #ff0000">人气</td>
</tr>
<?php
if (!isset($page)) { $page=1; }
for ($i=$posts-($number+1)*($page-1);$i>$posts-($number+1)*$page;$i=$i-1) {
 if ($list[$i]!="") {
  $file=explode("|hyenpkjvlg|",join("",file("$datadir/".$list[$i])));
echo "<tr>\n<td>&nbsp;※&nbsp;<a href=\"show.php?filename=$list[$i]\" target=\"_blank\">$file[0]</a></td>\n
  <td align=\"center\">$file[1]</td>\n
   <td align=\"center\">$file[2]</td>\n
  <td align=\"center\">$file[3]</td>\n</tr>\n";
  }
  }
?>
</table>
<table border=0 cellspacing=0 width=1024 bordercolorlight=#405028 bordercolordark=#FFFFFF>
<tr>
<td width=53% style="border-top:1px solid #ff0000">
<div align=center><?php for ($i=1;$i<=ceil($posts/$number);$i=$i+1) { echo "[<a href=\"?page=$i\">$i</a>]"; } ?></div>
</td>
<td width=47% align="center" style="border-top:1px solid #ff0000"><?php echo "$firsttable"; ?></td>
</tr></table>
<form action="index.php" method="post">
<table><tr><td><input type="text" name="keyword" style="border: 1 dashed #405028"></td>
<td><input type="image" src="images/search.gif"></td></tr></table>
</form>
<div align="center">Copyright 2002-20012 by 哥舒 版权所有</div>
</center>
</body>
</html>
