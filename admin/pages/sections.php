<?php
/*
 * Updates
 * 25/08/2005 - taylord1 - page reformatted - display order added
 */

if(!defined("IN_ADMIN"))
{
	die("Direct access is not allowed!");
}
?>

<p>Welcome to the sections switchboard, from here you are able to add new sections, edit exisiting sections and remove sections which are no longer needed.</p>
<p>Please note when setting the display order, using 0 will hide that section. This is useful for temporarily removing certain sections from your manifest</p>

<div align='center'><a href='switchboard.php?pageref=addsection'>Create New Section</a></div>
<br />
<!-- Get Section List -->
<?php
$sql = "SELECT id, clrtext, class, viewid AS display FROM ".$prefix."_colors;";
$colorResult = mysql_query($sql) or die ("Error: ".mysql_error());
$numrows = mysql_num_rows($colorResult);
?>
<form action="switchboard.php?pageref=section_order" method="post">
<table align="center">
<tr>
	<th>Section</th>
	<th>Operation</th>
	<th>Display Order</th>
</tr>
<?php
while($color = mysql_fetch_assoc($colorResult))
{
	echo "<tr class=\"".$color["class"]."\">";
	echo "<td class=\"".$color["class"]."\">".$color["clrtext"]."</td>";
	echo "<td>";
	echo "<table>";
	echo "<tr>";
	echo "<td class=\"".$color["class"]."\"><a href=\"switchboard.php?pageref=editsection&id=".$color["id"]."\">Edit Section</a></td>";
	echo "<td class=\"".$color["class"]."\"><a href=\"switchboard.php?pageref=deletesection&id=".$color["id"]."\">Delete Section</a></td>";
	echo "</tr>";
	echo "</table>";
	echo "</td>";
	echo "\t\t\t<td class=\"".$color["class"]."\" align=\"center\"><input type=\"text\" name=\"display[]\" value=\"".$color["display"]."\" size=\"3\" />";
	echo "<input type=\"hidden\" name=\"colorid[]\" value=\"".$color["id"]."\" /></td>";
	echo "</tr>";
}
?>
<tr>
	<td align="center" colspan="3"><input type="submit" name="dispid" value="Update Display Order" /></td>
</tr>
</table>
</form>
<?php
mysql_free_result($colorResult);
