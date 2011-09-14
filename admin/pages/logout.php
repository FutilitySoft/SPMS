<?php
if(!defined("IN_ADMIN"))
{
	die("Direct access is not allowed!");
}

session_destroy();
header("Location: switchboard.php");
?>
