<?php
if(!defined("IN_ADMIN"))
{
	die("Direct access is not allowed!");
}

if(isset($_POST["dispid"]))
{
	//print_r($_POST);
	$i = 0;
	while(isset($_POST["posid"][$i]))
	{
		$sql = "UPDATE ".$prefix."_position
			SET viewid=".$_POST["display"][$i]."
			WHERE posid=".$_POST["posid"][$i].";";
		//echo $sql."<br />";
		mysql_query($sql) or die(mysql_error());
		$i++;
	}
	// Return us to the positions page
	header("Location: switchboard.php?pageref=positions");
}
?>
