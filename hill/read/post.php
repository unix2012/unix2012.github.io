<?php
include("cfg.php");

function mygetdate() {
    $array_date=getdate();
    if ($array_date[mon]<10) { $array_date[mon]="0".$array_date[mon]; }
    if ($array_date[mday]<10) { $array_date[mday]="0".$array_date[mday]; }
    if ($array_date[hours]<10) { $array_date[hours]="0".$array_date[hours]; }
    if ($array_date[minutes]<10) { $array_date[minutes]="0".$array_date[minutes]; }
    if ($array_date[seconds]<10) { $array_date[seconds]="0".$array_date[seconds]; }
    $date[filename]=$array_date[year].$array_date[mon].$array_date[mday].$array_date[hours].$array_date[minutes].$array_date[seconds].".txt";
    $date[date]=$array_date[year]."-".$array_date[mon]."-".$array_date[mday].".".$array_date[hours].":".$array_date[minutes];
    return $date;
    }
if (!is_file("$datadir/$filename")) {
    $date=mygetdate();
    $filename=$date[filename];
    $file[0]="";
    $file[1]="<未知>";
    $file[2]="$date[date]";
    $file[3]="0";
    $file[4]="";
    $cancel="javascript:self.close()";
    $type="发表文章";
    }
else {
    $file=explode("|hyenpkjvlg|",str_replace("<br>","\n",str_replace("&nbsp;"," ",join("",file("$datadir/$filename")))));
    $cancel="javascript:history.back()";
    $type="编辑文章";
    }

if ($action=="post") {
    if ($title!="" and $writer!="" and $content!="" and $password==$adminpsd) {
        $fp=fopen("$datadir/$filename","w+");
        $newfile=$title."|hyenpkjvlg|".$writer."|hyenpkjvlg|".$otherinfo."|hyenpkjvlg|".$content;
        $newfile=htmlspecialchars("$newfile");
        $newfile=str_replace("\n","<br>","$newfile");
        $newfile=str_replace(" ","&nbsp;","$newfile");
        $newfile=StripSlashes("$newfile");
        fwrite($fp,"$newfile");
        fclose($fp);
        echo "<meta http-equiv='Refresh' content='0; URL=show.php?filename=$filename'>";
        }
    else {
        echo "<script>alert(\"标题、作者、内容不能为空或者密码错误！\");history.back();</script>";
        }
    }
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title><?php echo "$name--$type"; ?></title>
<link href="style.css" rel=stylesheet>
</head>
<body style="background-attachment : fixed" background="images/bg.jpg">
<center>
<p align="center">&nbsp;<p>
<table border=0 cellspacing=0 cellpadding=0 width=640 bordercolorlight="#405028" bordercolordark="#FFFFFF">
<tr height=30><td align=center><?php echo "$type"; ?></td></tr>
<tr><td align=center><br>
<form method="post" action="post.php?action=post&filename=<?php echo "$filename"; ?>&otherinfo=<?php echo $file[2]."|hyenpkjvlg|".$file[3]; ?>">
文章标题：<input type="text" name="title" size="60" style="border:1 dashed #496EB5" value="<?php echo "$file[0]"; ?>"><br>
文章作者：<input type="text" name="writer" size="20" style="border: 1 dashed #496EB5" value="<?php echo "$file[1]"; ?>">
　　　　主人密码：<input type="password" name="password" size="18" style="border: 1 dashed #496EB5">
<br>
文章内容（本程序支持<a href="images/wdbcode.htm" target="_blank">WDB</a>代码）：
<br>
<textarea rows="20" name="content" cols="68" style="border: 1 dashed #496EB5">
<?php echo "$file[4]"; ?></textarea><br><br>
<input type="submit" value="提 交" style="background-color:#FFFFFF; border:0">　　<input type="reset" value="复 原" style="background-color:#FFFFFF; border:0">　　<input type="reset" value="取 消" style="background-color:#FFFFFF; border:0" onclick="<?php echo "$cancel"; ?>">
</form>
</td></tr></table>
<br>Copyright 2002-20012 by 哥舒 版权所有</div>
</center>
</body>
</html>




