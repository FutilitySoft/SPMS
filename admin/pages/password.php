<?php
if(!defined("IN_ADMIN"))
{
	die("Direct access is not allowed!");
}

if(isset($_POST["resetPassword"]))
{
	//print_r($_POST);
	$sql = "UPDATE ".$prefix."_crew
		SET password='".crypt($_POST["password"])."'
		WHERE crewid=".$_POST["id"].";";
	mysql_query($sql) or die(mysql_error());
	echo "<h1 align=\"center\">Password Reset</h1>";
	echo "<p align=\"center\">The password has been reset to ".$_POST["password"].". <a href=\"switchboard.php?pageref=crew\">Continue</a></p>";
}
else
{
?>
<form action="switchboard.php?pageref=password" method="post">
<table align="center">
<tr>
	<td>New Password</td>
	<td><input type="text" name="password" /></td>
</tr>
<tr>
	<td align="center" colspan=\"2\"><input type="submit" name="resetPassword" value="Reset Password" /></td>
</tr>
</table>
<input type="hidden" name="id" value="<?php echo $_GET["id"]; ?>" />
</form>
<?php
}
?>
