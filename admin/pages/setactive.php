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
// Set all missions to archive
$sql = "UPDATE ".$prefix."_missions SET archive=1;";
$res = mysql_query($sql) or die(mysql_error()." | ".$sql);
// Set mission ID to current
$sql = "UPDATE ".$prefix."_missions SET archive=0 WHERE missionid=".$_GET["id"].";";
$res = mysql_query($sql) or die(mysql_error()." | ".$sql);

header("location: switchboard.php?pageref=missions");
?>