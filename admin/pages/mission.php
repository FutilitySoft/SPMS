<?php
if(isset($_GET["op"]) && $_GET["op"] == "archive")
{
	//echo "Show archive mission";
// Get all missions where archive = 0
$sql = "SELECT missionid, missiontitle, missiondescription FROM ".$prefix."_missions WHERE missionid=".$_GET["id"].";";
$missionResult = mysql_query($sql) or die ("Mission Error: ".mysql_error());
$mission = mysql_fetch_assoc($missionResult);
?>
<div align='center'>
<h3 align="center">Past Mission <?php echo stripslashes($mission["missiontitle"]); ?></h3>
<p>
<br />
<table width='90%'>
<?php
if (isset($mission["img"]))
{ ?>
<tr>
	<td colspan=2><img src='images/missions/".$mission["img"]."' /></td>
</tr>
<?php
}
?>
<tr>
	<td colspan="2" align="center"><b>Mission Description</b></td>
</tr>
<tr>
	<td colspan="2"><?php echo stripslashes($mission["missiondescription"]); ?></td>
</tr>
</table>
<br /><br />
	<i>Current Mission</i>
	<br />
	<?php
	// Get Current Active Mission
	// Get all missions where archive=1
	$sql = "SELECT missionid, missiontitle FROM ".$prefix."_missions WHERE archive=0;";
	$missionResult = mysql_query($sql) or die ("Mission Archive Error: ".mysql_error());
	
	if (!mysql_num_rows($missionResult))
	{
		echo "<b>No current mission</b>";
	}
	else
	{
		while ($mission = mysql_fetch_assoc($missionResult))
		{
			echo "
			<a href='main.php?pageref=mission&id=".$mission["missionid"]."'>".stripslashes($mission["missiontitle"])."</a><br />
			";
		}
	}
	?>
	<br />
	<i>Past Missions</i>
	<br /><?php
	// Get all missions where archive=1
	$sql = "SELECT missionid, missiontitle FROM ".$prefix."_missions WHERE archive=1;";
	$missionResult = mysql_query($sql) or die ("Mission Archive Error: ".mysql_error());
	
	if (!mysql_num_rows($missionResult))
	{
		echo "<b>No archived missions</b>";
	}
	else
	{
		while ($mission = mysql_fetch_assoc($missionResult))
		{
			echo "
			<a href='main.php?pageref=mission&op=archive&id=".$mission["missionid"]."'>".stripslashes($mission["missiontitle"])."</a><br />
			";
		}
	}

}
else
{
// Get all missions where archive = 0
$sql = "SELECT missionid, missiontitle, missiondescription FROM ".$prefix."_missions WHERE archive=0;";
$missionResult = mysql_query($sql) or die ("Mission Error: ".mysql_error());
if(mysql_num_rows($missionResult))
{
	$mission = mysql_fetch_assoc($missionResult);
	?>
	<div align='center'>
	<h3 align="center">Current Mission <?php echo stripslashes($mission["missiontitle"]); ?></h3>
	<p>
	<br />
	<table width='90%'>
	<?php
	if (isset($mission["img"]))
	{ ?>
	<tr>
		<td colspan=2><img src='images/missions/".$mission["img"]."' /></td>
	</tr>
	<?php
	}
	?>
	<tr>
		<td colspan="2" align="center"><b>Mission Description</b></td>
	</tr>
	<tr>
		<td colspan="2"><?php echo stripslashes($mission["missiondescription"]); ?></td>
	</tr>
	</table>
<?php
}
else
{
	echo "<h2 align=\"center\">No current mission</h2>";
}
?>
<br />
<i>Past Missions</i>
<br />
<?php
// Get all missions where archive=1
$sql = "SELECT missionid, missiontitle FROM ".$prefix."_missions WHERE archive=1;";
$missionResult = mysql_query($sql) or die ("Mission Archive Error: ".mysql_error());

if (!mysql_num_rows($missionResult))
{
	echo "<b>No archived missions</b>";
}
else
{
while ($mission = mysql_fetch_assoc($missionResult))
{
	echo "
	<a href='main.php?pageref=mission&op=archive&id=".$mission["missionid"]."'>".stripslashes($mission["missiontitle"])."</a><br />
	";
}
}

?>
</div>
<?php
}
?>