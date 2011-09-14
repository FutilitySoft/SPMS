<?php
if(!defined("IN_ADMIN"))
{
	die("Direct access is not allowed!");
}
if (isset($_POST["add_position"]))
{
	// Insert Position in to Position Table
	$sql = "INSERT INTO ".$prefix."_position VALUES ('','".$_POST["posname"]."','".$_POST["posdesc"]."','');";
	// print $sql."<br />";
	// Query DB
	$insertResult = mysql_query($sql) or die("Error: ".mysql_error());
	//print $insertResult;	
	// Get Insert Id
	$insertid = mysql_insert_id();
	// Hack
	//$insertid = 1;
	
	// Insert Position in to Crew Position Table
	$sql = "INSERT INTO ".$prefix."_crewposition VALUES (0,".$insertid.",".$_POST["section"].",0);";
	//print $sql."<br />";
	$insertResult = mysql_query($sql) or die("Error: ".mysql_error());
	//print $insertResult;

	echo "
	<div align='center'><h2>Position Added</h2>
	<p>A new position has been added to the vessel! It is position number ".$insertid.".</p>
	<p><a href='switchboard.php?pageref=addposition'>Add another position</a></p>
	</div>
	";
	
	echo "
	<br />
	<div align='center'>
	<a href='switchboard.php?pageref=positions'>Return to Positions Switchboard</a> | <a href='switchboard.php'>Return to main switchboard</a>
	</div>";
}
else
{
// get positions from DB
$sql = "SELECT * FROM ".$prefix."_colors;";
$sectionRes = mysql_query($sql) or die ("Section Error: ".mysql_error());
?>
<form method='post' action='switchboard.php?pageref=addposition'>
<table align='center'>
<tr>
	<td>Position Name</td>
	<td><input type='text' name='posname' /></td>
</tr>
<tr>
	<td>Position Description</td>
	<td><textarea name='posdesc'></textarea></td>
</tr>
<tr>
	<td>Section</td>
	<td><select name='section'>
		<?php
		while($section = mysql_fetch_assoc($sectionRes))
		{
			echo "<option value='".$section["id"]."'>".stripslashes($section["clrtext"])."</option>";
		}
		?>
		</select></td>
</tr>
<tr>
	<td colspan='2' align='center'><input type='submit' name='add_position' value='Add Position' /></td>
</tr>
</table>
</form>
<?php
}
?>
