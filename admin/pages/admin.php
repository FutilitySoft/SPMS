<?php
if(!defined("IN_ADMIN"))
{
	die("Direct access is not allowed!");
}
/*
 * File Name: editcharacter.php
 *
 * Purpose: To Edit a Character already in the system
 *
 * Author: Dan Taylor
 *
 * Date Created: 24/07/04
 *
 */
 
//include_once("../include/functions.php");
if(isset($_GET["confirm"]))
{
	// Get Current Admin Status
	$sql = "SELECT ".$prefix."_crew.admin FROM ".$prefix."_crew WHERE ".$prefix."_crew.crewid=".$_GET["id"];
	
	$result = mysql_query($sql) or die ("Could not query user list: ".mysql_error());
	
	if (mysql_num_rows($result))
	{
	 // We&apsve found a match continue
	 $user = mysql_fetch_assoc($result);
	 
	 if ($user["admin"])
	 {
	 // Already and Admin, make a user
	 $sql = "UPDATE ".$prefix."_crew SET ".$prefix."_crew.admin=0 WHERE ".$prefix."_crew.crewid=".$_GET["id"];
	 } 
	 else
	 {
	 // A user, make admin
	 $sql = "UPDATE ".$prefix."_crew SET ".$prefix."_crew.admin=1 WHERE ".$prefix."_crew.crewid=".$_GET["id"];
	 }
	 
	 // Do the update
	 $result = mysql_query($sql) or die("Could not update crew details: ".mysql_error());
	 
	 header("Location: switchboard.php?pageref=crew");
	}
	else
	{
	 // Could not find a user with that ID.
	 echo "Error: Could not find user with userid: ".$_GET["id"];
	 echo "<br /><a href=&apsmain.php?pageref=crew&aps>Return</a>";
	}
}
else
{
?>
<p align="center">Are you sure you wish to modify this users admin / user status?<p>
<p align="center"><a href="switchboard.php?pageref=admin&id=<?php echo $_GET["id"]; ?>&confirm=1">Yes</a> / <a href="switchboard.php?pageref=crew">No</a></p>
<?php
}
?>
