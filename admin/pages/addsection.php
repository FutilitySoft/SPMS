<?php
if(!defined("IN_ADMIN"))
{
	die("Direct access is not allowed!");
}
if ($_POST["submit"])
{
  $sql = "INSERT ".$prefix."_colors VALUES('','".$_POST["sectionName"]."','".$_POST["sectionStyle"]."','');";
  $insertResult = mysql_query($sql) or die("Error: ".mysql_error());
  $insertid = mysql_insert_id();

  echo "<div align='center'>
	<p>A new section has been added to the $shipname the sections ID is: $insertid</p>
		<p><a href='switchboard.php'>Add another section</a></p>
	<p><a href='switchboard.php?pageref=sections'>Return to Section Switchboard</a> | <a href='switchboard.php?pageref=main'>Return to main switchboard</a>
	</div>";
}
else
{

$sql = "SELECT stylename FROM ".$prefix."_crewstyles;";
$styleres = mysql_query($sql) or die("Style Error: ".mysql_error());

?>
<p>Add a new section to the <?php echo $shipname; ?> please enter the Section name and CSS Style Type.</p>
<form action='switchboard.php?pageref=addsection' method='post'>
<table align='center' width='300px'>
<tr>
	<td>Section Name</td>
	<td><input type='text' name='sectionName' /></td>
</tr>
<tr>
	<td>Section Style</td>
	<td><select name='sectionStyle'>
	<?php
	while($style = mysql_fetch_assoc($styleres))
	{
		echo "<option value='".$style["stylename"]."'>".$style["stylename"]."</option>";
	}
	?>
		</select></td>
</tr>
<tr>	
	<td colspan='2' align='center'><input type='submit' name='submit' value='Add New Section' /></td>
</tr>
</table>
</form>
<?php
}
?>
