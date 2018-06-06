<?php
include("cfg.php");

if (!is_file("$datadir/$filename")) {
    die ("<script>alert(\"找不到您要删除的文章！\");history.back();</script>");
    }

if ($action=="del") {
    if ($adminpsd==$password) {
        unlink("$datadir/$filename");
        echo "<meta http-equiv='Refresh' content='2; URL=javascript:self.close()'><p align=\"center\">已成功删除了！";
        }
    else {
        die ("<script>alert(\"密码错误！\");history.back();</script>");
        }
    }
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<title><?php echo "$name--删除文章"; ?></title>
<link href="style.css" rel=stylesheet>
</head>
<body background="images/bg.jpg">
<center>
  <p align="center">&nbsp;</p>
<form action="del.php?action=del&filename=<?php echo "$filename"; ?>" method="post">
<div style="font-size:9pt">请输入管理密码: </div><br>
<input name="password" size="20" type="password" style="border: 1 dashed #405282"><br>
<input type="submit" value="删 除"> <input type="reset" value="取 消" onclick="javascript:history.back();">
</form>
<div align="center">Copyright 2002-20012 by 哥舒 版权所有</div>
</center>
</body>
</html>



