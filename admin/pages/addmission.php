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
if (isset($_POST["addMission"]))
{
	//print_r($_POST);
	$sql = "INSERT INTO ".$prefix."_missions (missiontitle, missiondescription, missionoutcome, img, archive)
			VALUES ('".$_POST["title"]."', '".$_POST["description"]."', '', '".$_POST["banner"]."', 1);";
	$result = mysql_query($sql) or die(mysql_error());
	echo "<p align=\"center\">Mission Added<br /><a href=\"switchboard.php?pageref=missions\">Continue</a></p>";
}
else
{
?>
<form action="switchboard.php?pageref=addmission" method="post">
<table border="1" align="center">
<tr>
	<td width="20px">Mission Title</td>
	<td align="left"><input type="text" name="title" /></td>
</tr>
<tr>
	<td colspan="2" style="font-size: xx-small;" width="20px"><b>Note:</b> the title of your mission.</td>
</tr>
<tr>
	<td colspan="2" width="20px">Mission Description</td>
</tr>
<tr>
	<td colspan="2"><textarea name="description" cols="60" rows="20"></textarea></td>
</tr>
<tr>
	<td colspan="2" style="font-size: xx-small;"><b>Note:</b> A textual description of your mission.</td>
</tr>
<tr>
	<td>Mission Banner</td>
	<td><input type="text" name="banner" /></td>
</tr>
<tr>
	<td colspan="2" style="font-size: xx-small;"><b>Note:</b> the mission banner is a filename,<br />please ensure you have uploaded your file to the images/missions/ directory.</td>
</tr>
<tr>
	<td colspan="2"><input type="submit" name="addMission" value="Add Mission" /></td>
</tr>
</table>
</form>
<?php

}

?>