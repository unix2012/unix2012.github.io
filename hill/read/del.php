<?php
include("cfg.php");

if (!is_file("$datadir/$filename")) {
    die ("<script>alert(\"�Ҳ�����Ҫɾ�������£�\");history.back();</script>");
    }

if ($action=="del") {
    if ($adminpsd==$password) {
        unlink("$datadir/$filename");
        echo "<meta http-equiv='Refresh' content='2; URL=javascript:self.close()'><p align=\"center\">�ѳɹ�ɾ���ˣ�";
        }
    else {
        die ("<script>alert(\"�������\");history.back();</script>");
        }
    }
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<title><?php echo "$name--ɾ������"; ?></title>
<link href="style.css" rel=stylesheet>
</head>
<body background="images/bg.jpg">
<center>
  <p align="center">&nbsp;</p>
<form action="del.php?action=del&filename=<?php echo "$filename"; ?>" method="post">
<div style="font-size:9pt">�������������: </div><br>
<input name="password" size="20" type="password" style="border: 1 dashed #405282"><br>
<input type="submit" value="ɾ ��"> <input type="reset" value="ȡ ��" onclick="javascript:history.back();">
</form>
<div align="center">Copyright 2002-20012 by ���� ��Ȩ����</div>
</center>
</body>
</html>



