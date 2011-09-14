<?php
if(!defined("IN_ADMIN"))
{
	die("Direct access is not allowed!");
}
if ($_POST["addrank"])
{
	$sql = "INSERT INTO ".$prefix."_rank 
			VALUES ('','".$_POST["rankdesc"]."','".$_POST["image"]."','".$_POST["color"]."');";
	//echo $sql;
	
	$result = mysql_query($sql) or die ("Could not query database: ".mysql_error());
	
	echo "<p align=\"center\">New Rank Added<br /><a href=\"switchboard.php?pageref=ranks\">Continue</a></p>";
}
else
{
?>
<p align="center">Add New Rank</p>
<p align="center"><a href="switchboard.php?pageref=ranks">Return</a></p>
<form action="switchboard.php?pageref=addrank" method="post">
<table width="500px" align="center">
<tr>
	<th>Rank</th>
	<th>Image</th>
	<th>Color</th>
</tr>
<tr>
	<td><input type="text" name="rankdesc" /></td>
	<td><input type="text" name="image" />*</td>
	<td><input type="text" name="color" /></td>
</tr>
<tr>
	<td colspan="3" align="center"><input type="submit" name="addrank" value="Add Rank" /></td>
</table>
</form>
<p align="center"><a href="switchboard.php?pageref=ranks">Return</a></p>
<p align="center">* Image path relative to <?php echo $domain; ?>/images/</p>
<?php 
}
?>
