<?php
if(!defined("IN_ADMIN"))
{
	die("Direct access is not allowed!");
}
/*
 * File Name: deletecharacter.php
 *
 * Purpose: To delete a character from the SPMS system
 *
 * Author: Dan Taylor
 *
 * Date Created: 25/07/04
 *
 */
 
if (isset($_GET["sure"]) && $_GET["sure"] == 1)
{
	$sql = "DELETE FROM ".$prefix."_crew WHERE crewid=".$_GET["id"];
	$result = mysql_query($sql) or die ("Could not remove Crew Information: ".mysql_error());
	$sql = "DELETE FROM ".$prefix."_inactive WHERE crewid=".$_GET["id"];
	$result = mysql_query($sql) or die ("Could not remove Crew Information: ".mysql_error());
	$sql = "UPDATE ".$prefix."_crewposition SET crewid=0, type=0 WHERE crewid=".$_GET["id"];
	$result = mysql_query($sql) or die ("Could not remove Crew Information: ".mysql_error());
	//header("Location: switchboard.php?pageref=crew");
	
	echo "<p align=\"center\">Character Account Deleted<br /><a href=\"switchboard.php?pageref=crew\">Continue</a></p>";
}
else
{
	$sql = "SELECT firstname, lastname FROM ".$prefix."_crew WHERE crewid=".$_GET["id"];
	$result = mysql_query($sql) or die ("Could not query user: ".mysql_error());

	if (mysql_num_rows($result))
	{
		$character = mysql_fetch_assoc($result);
		$name = stripslashes($character["firstname"]." ".$character["lastname"]);
		echo "<p align=\"center\">Are you sure you want to delete the Character ".$name."?<br />";
		echo "<a href='switchboard.php?pageref=deletecharacter&op=del&id=".$_GET["id"]."&sure=1'>Yes</a> / <a href='switchboard.php?pageref=crew'>No</a></p>";
	}
	else
	{
		echo "Error: No character with that ID!";
	}	
}
?>
