<?php
if(!defined("IN_ADMIN"))
{
	die("Direct access is not allowed!");
}

if(isset($_POST["dispid"]))
{
	//print_r($_POST);
	$i = 0;
	while(isset($_POST["colorid"][$i]))
	{
		$sql = "UPDATE ".$prefix."_colors
			SET viewid=".$_POST["display"][$i]."
			WHERE id=".$_POST["colorid"][$i].";";
		echo $sql."<br />";
		mysql_query($sql) or die(mysql_error());
		$i++;
	}
	// Return us to the positions page
	header("Location: switchboard.php?pageref=sections");
}
?>
