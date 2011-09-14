<?php
if(!defined("IN_ADMIN"))
{
	die("Direct access is not allowed!");
}
?>
<p>Rank Switchboard</p>

<table align="center">
<tr>
	<td><a href='switchboard.php?pageref=addrank'>Add Rank</td>
</tr>
</table>
<?php
$sql = "SELECT ".$prefix."_rank.rankid, ".$prefix."_rank.rankdesc, ".$prefix."_rank.image, ".$prefix."_rank.color 
		FROM ".$prefix."_rank";
		
$rankResult = mysql_query($sql) or die ("Could not query database for ranks: ".mysql_error());
?>
<table width="780px" align="center">
<tr>
	<th>Rank</th>
	<th>Image</th>
	<th>Color</th>
	<th>Edit</th>
	<th>Delete</th>
</tr>
<?php
while ($rank = mysql_fetch_assoc($rankResult))
{
	echo "<tr>
		<td>".$rank["rankdesc"]."</td>
		<td><img src=\"$domain/images/".$rank["image"]."\" /></td>
		<td>".$rank["color"]."</td>
		<td><a href=\"switchboard.php?pageref=editrank&id=".$rank["rankid"]."\">Edit</a></td>
		<td><a href=\"switchboard.php?pageref=deleterank&id=".$rank["rankid"]."\">Delete</a></td>
	</tr>";
}

?>
</table>
