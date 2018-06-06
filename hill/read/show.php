<?php
include("cfg.php");

function wdbconvert ($post,$allow=array('pic'=>1,'flash'=>1,'fontsize'=>1)) {

    $post=str_replace("<p>","<br><br>",$post);
    $post=str_replace("<br>"," <br>",$post);
    $post=str_replace("[u]","<u>",$post);
    $post=str_replace("[/u]","</u>",$post);
    $post=str_replace("[b]","<b>",$post);
    $post=str_replace("[/b]","</b>",$post);
    $post=str_replace("[i]","<i>",$post);
    $post=str_replace("[/i]","</i>",$post);
    $post=str_replace("[br]","<br>",$post);
    $post=str_replace("[list]","<ul>",$post);
    $post=str_replace("[/list]","</ul>",$post);
    $post=str_replace("[olist]","<ol>",$post);
    $post=str_replace("[/olist]","</ol>",$post);
    $post=str_replace("[*]","<li>",$post);
    $post=str_replace("[hr]","<hr width=40% align=left>",$post);
    $post=str_replace("[sup]","<sup>",$post);
    $post=str_replace("[/sup]","</sup>",$post);
    $post=str_replace('[url=&quot;','[url="',$post);
    $post=str_replace('&quot;]','"]',$post);

    $pattern=array(
        "/\[font=([^\[]*)\](.+?)\[\/font\]/is",
        "/\[color=([#0-9a-z]{1,10})\](.+?)\[\/color\]/is",
        "/\[email=([^\[]*)\](.+?)\[\/email\]/is",
        "/\[email\]([^\[]*)\[\/email\]/is",
        "/\[url=([^\[]*)\](.+?)\[\/url\]/is",
        "/\[url\]www\.([^\[]*)\[\/url\]/is",
        "/\[url\]([^\[]*)\[\/url\]/is",
        "/\[quote\]\s*(.*?)\s*\[\/quote\]/is",
        "/(\[fly\])(.+?)(\[\/fly\])/is",
        "/(\[move\])(.+?)(\[\/move\])/is",
        "/(\[align=)(left|center|right)(\])(.+?)(\[\/align\])/is",
        "/(\[shadow=)(\S+?)(\,)(.+?)(\,)(.+?)(\])(.+?)(\[\/shadow\])/is",
        "/(\[glow=)(\S+?)(\,)(.+?)(\,)(.+?)(\])(.+?)(\[\/glow\])/is",
        "/\[code\](.+?)\[\/code\]/is"
        );

    $replacement=array(
        "<font face=\"\\1\">\\2</font>",
        "<font color=\"\\1\">\\2</font>",
        "<a href=\"mailto:\\1\">\\2</a>",
        "<a href=\"mailto:\\1\">\\1</a>",
        "<a href=\"\\1\" target=_blank>\\2</a>",
        "<a href=\"http://www.\\1\" target=_blank>\\1</a>",
        "<a href=\"\\1\" target=_blank>\\1</a>",
        "<table cellpadding=0 cellspacing=0 border=0 WIDTH=94% bgcolor=#000000 align=center><tr><td><table width=100% cellpadding=5 cellspacing=1 border=0><TR><TD BGCOLOR=#405028>\\1</table></table>",
        "<marquee width=90% behavior=alternate scrollamount=3>\\2</marquee>",
        "<MARQUEE scrollamount=3>\\2</MARQUEE>",
        "<DIV Align=\\2>\\4</DIV>",
        "<table width=\\2 style=\"filter:shadow(color=\\4, direction=\\6 ,strength=2)\">\\8</table>",
        "<table width=\\2 style=\"filter:glow(color=\\4, strength=\\6)\">\\8</table>",
        "<table border=0 width=95% align=center cellpadding=2 bgcolor=DDDDDF><tr><td><pre><font face='Courier New'>\\1</font></pre></td></tr></table>",
        );

    $post=preg_replace($pattern,$replacement,$post);

    if ($allow['pic']) {
        $post=preg_replace("/\[img\]\s*(\S+?)\s*\[\/img\]/is","<img src=\\1 border=0>",$post);
        }
    if ($allow['flash']) {
        $post=preg_replace("/(\[swf\])\s*(\S+?\.swf)\s*(\[\/swf\])/is","<PARAM NAME=PLAY VALUE=TRUE><PARAM NAME=LOOP VALUE=TRUE><PARAM NAME=QUALITY VALUE=HIGH><embed src=\"\\2\" quality=high pluginspage=\"http://www.macromedia.com/shockwave/download/index.cgi?P1_Prod_Version=ShockwaveFlash\" type=\"application/x-shockwave-flash\"></embed>",$post);
        $post=preg_replace("/(\[FLASH=)(\S+?)(\,)(\S+?)(\])(\S+?)(\[\/FLASH\])/is","<OBJECT CLASSID=\"clsid:D27CDB6E-AE6D-11cf-96B8-444553540000\" WIDTH=\\2 HEIGHT=\\4><PARAM NAME=MOVIE VALUE=\\6><PARAM NAME=PLAY VALUE=TRUE><PARAM NAME=LOOP VALUE=TRUE><PARAM NAME=QUALITY VALUE=HIGH><EMBED SRC=\\6 WIDTH=\\2 HEIGHT=\\4 PLAY=TRUE LOOP=TRUE QUALITY=HIGH></EMBED></OBJECT>",$post);
        }
    if ($allow['fontsize']) {
        $post=eregi_replace("\\[size=([^\\[]*)\\]","<font size=\\1>",$post);
        $post=str_replace("[/size]","</font>",$post);
        }

    return $post;
    }

if (!is_file("$datadir/$filename")) {
    die ("<script>alert(\"找不到您要阅读的文章！\");history.back();</script>");
    }

$file=explode("|hyenpkjvlg|",join("",file("$datadir/$filename")));

$count=str_replace("$file[0]|hyenpkjvlg|$file[1]|hyenpkjvlg|$file[2]|hyenpkjvlg|$file[3]","$file[0]|hyenpkjvlg|$file[1]|hyenpkjvlg|$file[2]|hyenpkjvlg|".($file[3]+1),join("",file("$datadir/$filename")));
$countfp=fopen("$datadir/$filename","w");
fwrite($countfp,$count);
fclose($countfp);
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<title><?php echo "$file[0]"; ?></title>
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
<body style="background-attachment:fixed" background="images/bg.jpg">
<center>
<table border=0 borderColorDark=#ffffff borderColorLight=#405028 cellSpacing=0 width=1024>
<tr><td align=center>
<div align=left class=name>『<a href="index.php"><?php echo "$name"; ?></a>』</div>
<table align=center border=0 cellspacing=6 cellpadding=0 width=100%>
<tr height=35><td class=timu align=middle>
<b><?php echo "$file[0]"; ?></b></td></tr>
<tr><td>
<div align=center>作者：<font color="red"><?php echo "$file[1]"; ?></font></div>
<table align=center border=0 cellspacing=0 cellpadding=6 width=100%>
<tr><td  style="border-top:1px solid #ff0000;border-bottom:1px solid #ff0000" class=text>
<?php echo wdbconvert("$file[4]"); ?>
</td></tr></table>
</td></tr></table>
<a href="javascript:window.external.AddFavorite('<?php echo "$php_self_url?filename=$filename"; ?>','<?php echo "$file[0]"; ?>')">收藏此文章</a>　　　　　<a href="javascript:window.print()">打印此文章</a>　　　　　<a href="post.php?filename=<?php echo "$filename"; ?>">编辑此文章</a>　　　　　<a href="del.php?filename=<?php echo "$filename"; ?>">删除此文章</a>
</td></tr></table><br>
<div align="center"><a href="javascript:self.close();">『关闭窗口』</a></div><br>
</center>
<div align="center">Copyright 2002-20012 by 哥舒 版权所有</div>
</body>
</html>




