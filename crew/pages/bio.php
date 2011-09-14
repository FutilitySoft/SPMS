<?php
if ($_POST["updateDetails"])
{
	$sql = "UPDATE ".$prefix."_crew 
			SET ".$prefix."_crew.psd='".htmlentities($_POST["psd"])."', ".$prefix."_crew.bio='".htmlentities($_POST["bio"])."'
			WHERE ".$prefix."_crew.crewid=".$_SESSION["crewid"];

	$result = mysql_query($sql) or die("Could not update crew details: ".mysql_error());
	
	echo "<p align=\"center\" class=\"normal\">Your Personal Description and Biography have been updated. <a href=\"switchboard.php?pageref=bio\">Continue</a></p>";
}
else
{
?>
<h2 align="center">Switchboard - Bio</h2>
<?php
$sql = "SELECT ".$prefix."_crew.psd, ".$prefix."_crew.bio 
		FROM ".$prefix."_crew 
		WHERE ".$prefix."_crew.crewid=".$_SESSION["crewid"];
$currentResult = mysql_query($sql) or die ("Could no get current information: ".mysql_error());
$currentInfo = mysql_fetch_array($currentResult);
?>
<p align="center" class="normal">Here you can update your Personal Description and Biography, do not use any html tags here, they will be removed from your bio.</p>
<form action="switchboard.php?pageref=bio" method="POST">
<table align="center">
<tr>
	<th colspan="2">Personal Description</th>
</tr>
<tr>
	<td colspan="2"><textarea name="psd" cols="60" rows="10"><?php echo reverse_htmlentities($currentInfo["psd"]); ?></textarea></td>
</tr>
<tr>
	<th colspan="2">Biography</th>
</tr>
<tr>
	<td colspan="2"><textarea name="bio" cols="60" rows="10"><?php echo reverse_htmlentities($currentInfo["bio"]); ?></textarea></td>
</tr>
<tr>
	<td colspan="2" align="center"><input type="submit" name="updateDetails" value="Update Details" /></td>
</tr>
</table>
</form>
<?php 
	mysql_free_result($currentResult); 
}
?>
