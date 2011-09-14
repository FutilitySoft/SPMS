<?php
if(!defined("IN_ADMIN"))
{
	die("Direct access is not allowed!");
}

if (isset($_POST["submit_pos"]))
{
	/*print_r($_POST);
	print "<br />";*/
	// Update crewposition
	$sql = "UPDATE ".$prefix."_crewposition SET 
							  colorid=".$_POST["section"]." WHERE posid=".$_POST["posid"].";";
	$updateResult = mysql_query($sql) or die("Error: ".mysql_error());
	// Update Crew
	$sql = "UPDATE ".$prefix."_position SET 
							  data='".$_POST["data"]."',
							  description='".$_POST["description"]."' WHERE posid=".$_POST["posid"].";";
	// Test Hack
	// print $sql;
	$updateResult = mysql_query($sql) or die("Update Error: ".mysql_error());

	// print out completion message
	echo "<p align='center'><b>Position has been updated!</b></p>
	<p align='center'><a href='switchboard.php?pageref=positions'>Return to Position Switchboard</a> | <a href='switchboard.php?pageref=main'>Return to main switchboard</a>";
	exit;
}

if(!isset($_GET["posid"]))
{
	// No get, return to switchboard
	header("Location: switchboard.php?pageref=positions");
	break;
}

// Get Position Data
$sql = "SELECT pos.data, pos.description, cpos.colorid FROM ".$prefix."_crewposition as cpos, ".$prefix."_position as pos WHERE cpos.posid=".$_GET["posid"]." AND cpos.posid=pos.posid;";
$posResult = mysql_query($sql) or die ("Position Error: ".mysql_error());
$position = mysql_fetch_assoc($posResult);

$sql = "SELECT id, clrtext FROM ".$prefix."_colors";
$colorResult = mysql_query($sql) or die ("Position Error: ".mysql_error());

?>
<form action='switchboard.php?pageref=editposition' method='post'>
<table align='center' width='300px'>
<tr>
	<td>Position Name <?php echo stripslashes($position["data"]); ?></td>
	<td><input type="text" name="data" value="<?php echo stripslashes($position["data"]); ?>"/></td>
</tr>
<tr>
	<td>Position Description</td>
	<td><textarea name="description"><?php echo stripslashes($position["description"]); ?></textarea></td>
</tr>
<tr>
	<td>Section</td>
	<td><select name="section">
		<?php
		while ($color = mysql_fetch_assoc($colorResult))
		{
			if ($position["colorid"] == $color["id"])
			{
				echo "<option value='".$color["id"]."' selected>".stripslashes($color["clrtext"])."</option>";
			}
			else
			{
				echo "<option value='".$color["id"]."'>".stripslashes($color["clrtext"])."</option>";
			}
		}
		?>
		</select>
		</td>
</tr>
<tr>	
	<td colspan='2' align='center'><input type='hidden' name='posid' value="<?php echo $_GET["posid"]; ?>" />
	<input type='submit' name='submit_pos' value='Edit Position' /></td>
</tr>
</table>
</form>
