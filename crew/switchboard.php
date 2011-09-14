<?php
session_start();
session_name("spms_crew");
ob_start(); // Start Output Buffering
// Set Pagename
$pagename = "Crew Panel";
// get header
include ("../include/conf.php");
include ("../include/header.php");
include ("../functions.inc.php");
include ("../include/plainMail.php");

if(!isset($_GET["pageref"]))
{
	if(!isset($_SESSION["loggedin"]))
	{
		$pageref='login';
	}
	else
	{	
		$pageref='main';
	}
}
else
{
	$pageref=$_GET["pageref"];
}



if (session_is_registered("loggedin"))
{
	echo "
	<table align=\"center\" border=\"0\" cellpadding=\"2\" border=\"#333333\">
	<tr>
		<td><a href=\"switchboard.php\">Home</a> | <!--<a href=\"switchboard.php?pageref=logs\">Logs</a> | --> <a href=\"switchboard.php?pageref=personal\">Personal</a>  |  <a href=\"switchboard.php?pageref=bio\">Bio</a> | <a href=\"switchboard.php?pageref=logout\">Logout</a></td>
	</tr>
	</table>
	<table width=\"100%\">
	<tr>	
		<td align=\"left\">Welcome ".$_SESSION["realname"].";</td>
		<td align=\"right\">Current Date / Time: ".date("F j, Y, g:i a")."</td>
	</tr>
	</table>
	<br /><br />
	";
}

// Include the page
include("pages/".$pageref.".php");
// Display anything in the buffer
ob_end_flush();
?>
</body>

</html>
<?php mysql_close(); ?>
