<?php
if(!defined("IN_ADMIN"))
{
	die("Direct access is not allowed!");
}
if (!isset($_GET["posid"])) // If we've got here through underhanded means
{
	header("location: switchboard.php?pageref=sections"); // Go the the switchboard
}

if (isset($_GET["conf"]))
{
	// Delete from Positions Table
	$sql = "DELETE FROM ".$prefix."_position WHERE posid=".$_GET["posid"];
	$delResult = mysql_query($sql) or die("Error: ".mysql_error());
	
	// Delete from crew position table
	$sql = "DELETE FROM ".$prefix."_crewposition WHERE posid=".$_GET["posid"];
	$delResult = mysql_query($sql) or die("Error: ".mysql_error());

	echo "<h2 align='center'>Position Deleted!</h2>
	<p align='center'><a href='switchboard.php?pageref=positions'>Return to Positions Switchboard</a> | <a href='switchboard.php?pageref=main'>Return to main switchboard</a>";
	exit;
}

$sql = "SELECT data FROM ".$prefix."_position WHERE posid=".$_GET["posid"];

$posRes = mysql_query($sql) or die("Error: ".mysql_error());

$position = mysql_fetch_assoc($posRes);
?>

<h2 align="center">Delete Position!</h2>
<p align="center">Are you sure you wish to delete the following Position?</p>

<table align="center">
<tr>
	<td><b>Position Name</b></td>
	<td><?php echo $position["data"]; ?></td>
</tr>
<tr>	
	<td colspan="2" align="center">Delete Position?<br /> <a href="switchboard.php?pageref=deleteposition&posid=<?php echo $_GET["posid"]; ?>&conf=1">Yes</a> | <a href="switchboard.php?pageref=positions">No</a></td>
</tr>
</table>
