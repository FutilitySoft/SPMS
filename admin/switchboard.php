<?php
define("IN_ADMIN", 1);

session_start();

session_name("spms_crew");

ob_start(); // Start Output Buffering

// Set Pagename

$pagename = "Admin Panel";

// get header

include ("../include/conf.php"); // Get Config

include ("../include/header.php"); // Show Header

include ("../functions.inc.php"); // Get Common Functions

include ("../include/plainMail.php"); // Get Plain Email Class



if(!isset($_GET["pageref"]))

{

	if(!session_is_registered("loggedin") || !session_is_registered("admin"))

	{

		// If the pageref isn't set 

		// and we're not logged in redirect to login

		$pageref='login';

	}

	else

	{	

		// If we are logged in redirect to the main switchboard

		$pageref='main';

	}

}

else

{

	if (session_is_registered("loggedin") && session_is_registered("admin")) //Check for login & Admin clearance

	{

		$pageref=$_GET["pageref"];

	}

	else

	{	//Send to login page if we're not logged in or not an admin

		$pageref='login';

	}

}







if (session_is_registered("loggedin") && session_is_registered("admin"))

{

	echo "

	<table align='center' border='0' cellpadding='2' border='#333333'>

	<tr>

		<td><a href='switchboard.php'>Home</a> | <!-- <a href='switchboard.php?pageref=styles'>Styles</a> | --> <a href='switchboard.php?pageref=sections'>Sections</a> | <a href='switchboard.php?pageref=positions'>Postions</a> | <a href='switchboard.php?pageref=crew'>Crew</a> | <a href='switchboard.php?pageref=ranks'>Ranks</a> | <a href='switchboard.php?pageref=missions'>Missions</a> | <a href='switchboard.php?pageref=logout'>Logout</a></td>

	</tr>

	</table>

	<table width='100%'>

	<tr>	

		<td align='left' valign='top'>Welcome ".$_SESSION["realname"].";</td>

		<td align='right' valign='top'>Current Date / Time: ".date("F j, Y, g:i a")."</td>

	</tr>

	</table>

	<br /><br />

	";

}



// Include the page

include("pages/".$pageref.".php");

// Display anything in the buffer

ob_end_flush();

?>

</body>



</html>

<?php mysql_close(); ?>

