<?php
if(!defined("IN_ADMIN"))
{
	die("Direct access is not allowed!");
}
if ($_POST["editrank"])
{
	$sql = "UPDATE ".$prefix."_rank 
			SET ".$prefix."_rank.rankdesc='".$_POST["rankdesc"]."',
				".$prefix."_rank.image='".$_POST["image"]."',
				".$prefix."_rank.color='".$_POST["color"]."'
			WHERE ".$prefix."_rank.rankid=".$_POST["rankid"];
	//echo $sql;
	
	$result = mysql_query($sql) or die ("Could not query database: ".mysql_error());
	
	echo "<p align=\"center\">Rank Updated!<br /><a href=\"switchboard.php?pageref=ranks\">Continue</a></p>";
}
else
{
$sql = "SELECT ".$prefix."_rank.rankid, ".$prefix."_rank.rankdesc,
				".$prefix."_rank.image, ".$prefix."_rank.color
		FROM ".$prefix."_rank
		WHERE ".$prefix."_rank.rankid=".$_GET["id"];
$rankResult = mysql_query($sql) or die ("Could not query database: ".mysql_error());
$rank = mysql_fetch_assoc($rankResult);
?>
<p align="center">Edit Rank</p>
<p align="center"><a href="switchboard.php?pageref=ranks">Return</a></p>
<form action="switchboard.php?pageref=editrank" method="post">
<table align="center">
<tr>
	  <td colspan="3">Are you sure you want to edit this rank??</td>
</tr>
<tr>
	<td><input type="text" name="rankdesc" value="<?php echo $rank["rankdesc"]; ?>" /></td>
	<td><input type="text" name="image" value="<?php echo $rank["image"]; ?>" /></td>
	<td><input type="text" name="color" value="<?php echo $rank["color"]; ?>" /></td>
</tr>
<tr>
	<td colspan="3" align="center"><input type="submit" name="editrank" value="Submit Changes" /></td>
</table>
<input type="hidden" name="rankid" value="<?php echo $rank["rankid"]; ?>" />
</form>
<p align="center"><a href="switchboard.php?pageref=ranks">Return</a></p>
<p align="center">* Image path relative to <?php echo $domain; ?>/images/</p>
<?php 
}
?>
