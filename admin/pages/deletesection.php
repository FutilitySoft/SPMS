<?php
if(!defined("IN_ADMIN"))
{
	die("Direct access is not allowed!");
}

if (!isset($_GET["id"])) // If we've got here through underhanded means
{
	header("location: switchboard.php?pageref=sections"); // Go the the switchboard
}

if (isset($_GET["conf"]))
{
	$sql = "DELETE FROM ".$prefix."_colors WHERE id=".$_GET["id"];

	$delResult = mysql_query($sql) or die("Error: ".mysql_error());
	

	echo "<h2 align='center'>Section Deleted!</h2>
	<p align='center'><a href='switchboard.php?pageref=sections'>Return to Section Switchboard</a> | <a href='switchboard.php?pageref=main'>Return to main switchboard</a>";
	exit;
}

$sql = "SELECT * FROM ".$prefix."_colors WHERE id=".$_GET["id"];

$colorRes = mysql_query($sql) or die("Error: ".mysql_error());

$color = mysql_fetch_array($colorRes);
?>

<h2 align='center'>Delete Section!</h2>
<p align='center'>Are you sure you wish to delete the following Section?</p>

<table align='center'>
<tr>
	<td><b>Section Name</b></td>
	<td><?php echo $color["clrtext"]; ?></td>
</tr>
<tr>
	<td><b>Section Style</b></td>
	<td><?php echo $color["class"]; ?></td>
</tr>
<tr>	
	<td colspan='2' align='center'>Delete Section?<br /> <a href='switchboard.php?pageref=deletesection&id=<?php echo $color["id"]; ?>&conf=1'>Yes</a> | <a href='switchboard.php?pageref=sections'>No</a></td>
</tr>
</table>
