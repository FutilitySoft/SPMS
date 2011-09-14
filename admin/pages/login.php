<?php
if(!defined("IN_ADMIN"))
{
	die("Direct access is not allowed!");
}


if (isset($_POST["submit"]))
{
	$query = "SELECT ".$prefix."_crew.crewid, ".$prefix."_crew.realname, ".$prefix."_crew.password,  ".$prefix."_crew.admin, ".$prefix."_crewposition.type as active FROM ".$prefix."_crew 
			  LEFT JOIN ".$prefix."_crewposition ON ".$prefix."_crewposition.crewid=".$prefix."_crew.crewid
			  WHERE ".$prefix."_crew.email='".$_POST["email"]."';";

	/*
		0 = Real Name
		1 = password
	*/

	$crewResult = mysql_query($query) or die ("Error: ".mysql_error());
	$numrows = mysql_num_rows($crewResult);
	if ($numrows > 0)
	{
		$crewArray = mysql_fetch_array($crewResult);

		if ($crewArray["active"] == 0)
		{
			print "<h2 align='center'>Error! You've specified an inactive account</h2>";
			exit;
		}
		if ($crewArray["admin"] == 0)
		{
			print "<h2 align='center'>Error! You don't have access to the admin panel.</h2>";
			exit;
		}

		if(crypt($_POST["password"], $crewArray["password"]) == $crewArray["password"])
		{
			// Login Success!
			// Set Session Variables
			$_SESSION["loggedin"] = 1;
			$_SESSION["username"] = $_POST["email"];
			$_SESSION["crewid"] = $crewArray["crewid"];
			$_SESSION["realname"] = $crewArray["realname"];
			$_SESSION["admin"] = 1;
			// Redirect
			header("Location: switchboard.php?pageref=main");
		}
		else
		{
			print "<h1 align='center'>Invalid Password!</h1>";
		}
	}
	else
	{
		print "<h1 align='center'>Account does not exist!</h1>";
	}
}
else
{
?>

<form action='switchboard.php?pageref=login' method='post'>
<table align='center'>
<tr>
	<th colspan='2'>Unauthorised access prohibited!</th>
</tr>
<tr>
	<td align='right'><b>Username:</b></td>
	<td><input type='text' name='email' /></td>
</tr>
<tr>
	<td align='right'><b>Password:</b></td>
	<td><input type='password' name='password' /></td>
</tr>
<tr>
	<td colspan='2' align='center'><input type='submit' name='submit' value='Login' /></td>
</tr>
</table>
</form>
<?php
}
?>
