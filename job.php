<?php
	include("include/conf.php");
?>

<HTML>
<HEAD>
	<title><?=$shipname?> Job Description</title>
	<link type="text/css" rel=stylesheet href="include/main.css">
    <style fprolloverstyle>A:hover {color: #FF0000; font-family: Tahoma; font-size: 10pt; text-decoration: overline underline; font-weight: bold}
    </style>
</HEAD>

<BODY link=#FFFFFF vlink=#FFFFFF alink="#FFFFFF" text="#FFFFFF" bgcolor="#000000" >
        <?
	$qry = "SELECT data,description FROM ".$prefix."_position WHERE posid=" . $_GET["posid"];
	$positionqry = mysql_query($qry,$link) or die(mysql_error() . "<br><br>" . $qry);
	list($position_data, $position_desc) = mysql_fetch_row($positionqry);
	?>
<font face="Tahoma" size="2"><b><? echo $position_data ?></font></b>
<br>
<p><? echo $position_desc ?></p>
<b><font size="10pt">
<a href="javascript:top.self.close();">Close</a>
</font></b>
<body>

</html>
<? mysql_close($link); ?>
