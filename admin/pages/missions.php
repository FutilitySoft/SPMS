<?php
if(!defined("IN_ADMIN"))
{
	die("Direct access is not allowed!");
}
/*
 * File Name: missions.php
 *
 * Purpose: To facilitate mission archive management
 *
 * Author: Dan Taylor
 *
 * Date Created: 29th August 2005
 *
 */
 
// Check if item is current
function isCurrent($id)
{
	if(!$id)
	{
		// We are the current mission
		return "Active Mission";
	}
	else
	{
		// Not listed as the current mission
		return "<a href=\"switchboard.php?pageref=setactive&id=$id\">Set Active</a>";
	}
}
?>
<p align="center"><a href="switchboard.php?pageref=addmission">Add New Mission</a></p>
<table align="center">
<tr>
	<th>Mission</th>
	<th>Set Current</th>
	<th>Edit</th>
	<th>Delete</th>
</tr>
<?php
$sql = "SELECT * FROM ".$prefix."_missions";
$res = mysql_query($sql) or die(mysql_error()." | ".$sql);
if(mysql_num_rows($res))
{
	while($mission = mysql_fetch_assoc($res))
	{
		//print_r($mission);
		echo "<tr>\n";
		echo "<td>".$mission["missiontitle"]."</td>\n";
		echo "<td>".isCurrent($mission["archive"])."</td>\n";
		echo "<td><a href=\"switchboard.php?pageref=editmission&id=".$mission["missionid"]."\">Edit Mission</a></td>\n";
		echo "<td><a href=\"switchboard.php?pageref=deletemission&id=".$mission["missionid"]."\">Delete Mission</a></td>\n";
		echo "</tr>\n";
	}
}
else
{
	echo "<tr><th colspan=\"4\">No Missions</th></tr>\n";
}?>
</table>
