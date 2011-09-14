<?php
if(!defined("IN_ADMIN"))
{
	die("Direct access is not allowed!");
}
if (isset($_POST["submit"]))
{
	$sql = "UPDATE ".$prefix."_colors SET clrtext='".$_POST["sectionName"]."' ,
							  class='".$_POST["sectionStyle"]."' 
							  WHERE id=".$_POST["id"];

	// Test Hack
	// print $sql;
	$updateResult = mysql_query($sql) or die("Error: ".mysql_error());
	echo "<p align='center'><b>Section has been updated!</b></p>
	<p align='center'><a href='switchboard.php?pageref=sections'>Return to Section Switchboard</a> | <a href='switchboard.php?pageref=main'>Return to main switchboard</a>";
	exit;
}

if(!isset($_GET["id"]))
{
	// No get, return to switchboard
	header("Location: switchboard.php?pageref=sections");
	break;
}

$sql = "SELECT * FROM ".$prefix."_colors WHERE id=".$_GET["id"];

$editResult = mysql_query($sql) or die("Error: ".mysql_error());
$edit = mysql_fetch_array($editResult);

$sql = "SELECT stylename FROM ".$prefix."_crewstyles;";
$styleResult = mysql_query($sql) or die("Style Error: ".mysql_error());

// print_r($edit);
?>
<form action='switchboard.php?pageref=editsection' method='post'>
<table align='center' width='300px'>
<tr>
	<td>Section Name</td>
	<td><input type="text" name="sectionName" value="<?php echo stripslashes($edit["clrtext"]); ?>"/></td>
</tr>
<tr>
	<td>Section Style</td>
	<td><select name='sectionStyle'>
		<?php
		while ($style = mysql_fetch_assoc($styleResult))
		{
			if ($edit["class"] == $style["stylename"])
			{
				echo "<option value='".$style["stylename"]."' selected>".stripslashes($style["stylename"])."</option>";
			}
			else
			{
				echo "<option value='".$style["stylename"]."'>".stripslashes($style["stylename"])."</option>";
			}
		}
		?>
		</select>
		</td>
</tr>
<tr>	
	<td colspan='2' align='center'><input type='hidden' name='id' value='<?php echo $edit["id"]; ?>' />
	<input type='submit' name='submit' value='Edit Section' /></td>
</tr>
</table>
</form>
