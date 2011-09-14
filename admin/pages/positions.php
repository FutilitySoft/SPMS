<?php
/* Fixes
 * 25/08/2005 - taylord1 - fixed loop issue that dropped every fifth position (Thanks Watson)
 * 25/08/2005 - taylord1 - Re-formatted page, new table layout.
 */

if(!defined("IN_ADMIN"))
{
	die("Direct access is not allowed!");
}
?>
 
<div align='center'><a href='switchboard.php?pageref=addposition'>Create new position</a></div>
<p>Please note when setting the display order, using 0 will hide that position. This is useful for temporarily removing certain positions from your manifest</p>
<br />
<!-- div align='center'>
<p>Go to section: -->
<?php

// Loop through sections
$sql = "SELECT id, clrtext, class FROM ".$prefix."_colors ORDER BY viewid";
// Do Query
$colorResult = mysql_query($sql) or die("Color Query: ".mysql_error());

while($color = mysql_fetch_assoc($colorResult))
{
	echo "<form action=\"switchboard.php?pageref=position_order\" method=\"post\">\n";
	echo "<table width=\"380px\" align=\"center\" border=\"1\">\n";
	echo "<tr>\n";
	echo "\t<th class=\"".$color["class"]."\">".$color["clrtext"]."</th>\n";
	echo "</tr>\n";
	echo "<tr>\n";
	echo "\t<td>\n";
	// position table
	echo "\t\t<table width=\"100%\">\n";
	echo "\t\t<tr>\n";
		echo "\t\t\t<th>Position</th>\n";
		echo "\t\t\t<th>Operations</th>\n";
		echo "\t\t\t<th>Display Order</th>\n";
	echo "\t\t</tr>\n";
	// grab positions for this color
	$sql = "SELECT pos.posid, pos.data, pos.viewid AS display, cpos.colorid FROM ".$prefix."_position as pos
	LEFT JOIN ".$prefix."_crewposition as cpos ON cpos.posid=pos.posid
	WHERE cpos.colorid=".$color["id"]." ORDER BY cpos.colorid ASC;";
	$posResult = mysql_query($sql) or die("Position Error: ".mysql_error());
	// loop through positions
	while($position = mysql_fetch_assoc($posResult))
	{
		echo "\t\t<tr>\n";
		echo "\t\t\t<td align=\"left\" width=\"50%\">".$position["data"]."</td>\n";
		echo "\t\t\t<td align=\"right\">\n";
		echo "\t\t\t\t<table align=\"center\" border=\"0\">\n";
		echo "\t\t\t\t<tr>\n";
		echo "\t\t\t\t\t<td align=\"center\"><a href=\"switchboard.php?pageref=editposition&posid=".$position["posid"]."\">Edit Position</a></td>\n";
		echo "\t\t\t\t\t<td align=\"center\"><a href=\"switchboard.php?pageref=deleteposition&posid=".$position["posid"]."\">Delete Position</a></td>\n";
		echo "\t\t\t\t</tr>\n";
		echo "\t\t\t\t</table>\n";
		echo "\t\t\t</td>";
		echo "\t\t\t<td><input type=\"text\" name=\"display[]\" value=\"".$position["display"]."\" size=\"3\" />";
		echo "<input type=\"hidden\" name=\"posid[]\" value=\"".$position["posid"]."\" /></td>";
		echo "\t\t\t</tr>\n";
	}
	echo "\t\t</table>\n";
	echo "\t</td>\n";
	echo "</tr>\n";
	echo "<tr>\n";
	echo "<td align=\"center\"><input type=\"submit\" name=\"dispid\" value=\"Save Display Order\" /></td>";
	echo "</tr>\n";
	echo "</table>\n";
	echo "</form>";
	echo "<br /><br />\n";
}
/*
// Print Single Click Menu //

$sql = "SELECT id, clrtext FROM ".$prefix."_colors ORDER BY viewid";
// Do Query
$colorResult = mysql_query($sql) or die("Color Query: ".mysql_error());

// Counter set to 0
$i = 0;

// Loop through results
while($color = mysql_fetch_assoc($colorResult))
{
	
	while ($i != 25 && $color != NULL)
	{
		echo "<a href='#".$color["clrtext"]."'>".$color["clrtext"]."</a> ";
		$i ++;
		$color = mysql_fetch_assoc($colorResult);
	}
	echo "<br />";
	// Reset $i
	$i = 0;
}
?></p></div>
<br />
<?php
	
$cols = 4;


// Get Color information a second time
// $sql = "SELECT id, clrtext FROM ".$prefix."_colors";
// Do Query again - should be pulled from the cache
$colorResult = mysql_query($sql) or die("Color Query: ".mysql_error());

//Loop for each color
while ($color = mysql_fetch_assoc($colorResult))
{
	// Print Color Text
	echo "<div bgcolor=<a name='".$color["clrtext"]."'><h2 align='center'>".$color["clrtext"]."</h2></a>";

	// Get positions for this color
	$sql = "SELECT pos.posid, pos.data, cpos.colorid FROM ".$prefix."_position as pos
	LEFT JOIN ".$prefix."_crewposition as cpos ON cpos.posid=pos.posid
	WHERE cpos.colorid=".$color["id"]." ORDER BY cpos.colorid ASC;";

	$posResult = mysql_query($sql) or die("Position Error: ".mysql_error());
	$position = mysql_fetch_assoc($posResult);
	// print table
	echo "<table width='100%' border=0>";
	while($position)
	{
	echo "<tr>";
	$i = 0;
	while (($i != $cols) && $position != NULL)
	{
		echo "
		<td>	
		<table align='center' width='220px'>
		<tr>
			<th>".$position["data"]."</th>
		</tr>
		<tr>
			<td align='center'><a href='switchboard.php?pageref=editposition&posid=".$position["posid"]."'>Edit Position</a> | <a href='switchboard.php?pageref=deleteposition&posid=".$position["posid"]."'>Delete Position</a></td>
		</tr>
		</table>
		</td>
		";
		$i++;
		$position = mysql_fetch_assoc($posResult);
	}
		print "</tr>";
	}
	echo "</table>
	<div align='center'><a href='#top'>Return to top</a></div>";

	// Hack to be removed laters
	echo "<br /> <br />";
}*/

/*

// Get all positions
print $sql = "SELECT pos.posid, pos.data, cpos.colorid FROM ".$prefix."_position as pos
	LEFT JOIN ".$prefix."_crewposition as cpos ON cpos.posid=pos.posid
	ORDER BY cpos.colorid ASC;";

$posResult = mysql_query($sql) or die("Position Error: ".mysql_error());
echo mysql_num_rows($posResult);
echo "<table width='100%' border=1>";
while($position = mysql_fetch_assoc($posResult))
{
	echo "<tr>
			";
	$i = 0;
	while ($i != $cols)
	{
		echo "
		<td>	
		<table align='center' width='220px'>
		<tr>
			<th>".$position["data"]."</th>
		</tr>
		<tr>
			<td align='center'><a href='switchboard.php?pageref=editposition&posid=".$position["posid"]."'>Edit Position</a> | <a href='switchboard.php?pageref=deleteposition&posid=".$position["posid"]."'>Delete Position</a></td>
		</tr>
		</table>
		</td>
		";
		$i++;
		$position = mysql_fetch_assoc($posResult);
	}
	print "</tr>";
}
echo "</table>";
*/
?>
