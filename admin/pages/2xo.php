<?php
if(!defined("IN_ADMIN"))
{
	die("Direct access is not allowed!");
}
/*
 * Change 2XO Flag
 *
 */
if ($_GET["op"] == "add")
{
	// remove current 2XO
	$sql = "UPDATE ".$prefix."_crew
		SET ".$prefix."_crew.secondofficer=0;";

	mysql_query($sql) or die ("Could not remove 2XO: ".mysql_error());

	// Set new 2XO	
	$sql = "UPDATE ".$prefix."_crew
			SET ".$prefix."_crew.secondofficer=1
			WHERE ".$prefix."_crew.crewid=".$_GET["id"].";";
		
	mysql_query($sql) or die ("Could not set new 2XO: ".mysql_error());
}
elseif ($_GET["op"] == "del")
{
	// Remove Current 2XO
	// remove current 2XO
	$sql = "UPDATE ".$prefix."_crew
		SET ".$prefix."_crew.secondofficer=0
		WHERE ".$prefix."_crew.crewid=".$_GET["id"].";";

	mysql_query($sql) or die ("Could not remove 2XO: ".mysql_error());
}
header("Location: switchboard.php?pageref=crew");
?>
