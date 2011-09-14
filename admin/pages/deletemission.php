<?php
if(!defined("IN_ADMIN"))
{
	die("Direct access is not allowed!");
}
/*
 * File Name: addmission.php
 *
 * Purpose: Add's a mission to the database
 *
 * Author: Dan Taylor
 *
 * Date Created: 29th August 2005
 *
 */
if (isset($_POST["deleteMission"]))
{
	//print_r($_POST);
	$sql = "DELETE FROM ".$prefix."_missions WHERE missionid=".$_POST["id"].";";
			
	$result = mysql_query($sql) or die(mysql_error());
	
	//echo $result;
	echo "<p align=\"center\">Mission Deleted<br /><a href=\"switchboard.php?pageref=missions\">Continue</a></p>";
	
}
else
{
$sql = "SELECT * FROM ".$prefix."_missions WHERE missionid=".$_GET["id"].";";
$result = mysql_query($sql) or die(mysql_error());
$mission = mysql_fetch_assoc($result);
?>
<p align="center">Are you sure you wish to delete this mission?</p>
<form action="switchboard.php?pageref=deletemission" method="post">
<table border="1" align="center">
<tr>
	<td width="20px">Mission Title</td>
	<td align="left"><input type="text" name="title" value="<?php echo stripslashes($mission["missiontitle"]); ?>" disabled="disabled" /></td>
</tr>
<tr>
	<td colspan="2" width="20px">Mission Description</td>
</tr>
<tr>
	<td colspan="2"><textarea name="description" cols="60" rows="20" disabled="disabled"><?php echo stripslashes($mission["missiondescription"]); ?></textarea></td>
</tr>
<tr>
	<td>Mission Banner</td>
	<td><input type="text" name="banner" value="<?php echo stripslashes($mission["img"]); ?>" disabled="disabled" /></td>
</tr>
<tr>
	<td colspan="2" align="center"><input type="submit" name="deleteMission" value="Delete Mission" /></td>
</tr>
</table>
<input type="hidden" name="id" value="<?php echo $mission["missionid"]; ?>" />
</form>
<p align="center"><a href="javascript:history.go(-1)">Go Back</a></p>
<?php

}

?>