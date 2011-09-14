<?php
if (isset($_POST["submit"]))
{
	$query = "SELECT realname, password, crewid FROM ".$prefix."_crew WHERE email='".$_POST["email"]."';";

	/*
		0 = Real Name
		1 = password
		2 = crewid
	*/

	$crewResult = mysql_query($query) or die ("Error: ".mysql_error());
	$numrows = mysql_num_rows($crewResult);
	if ($numrows > 0)
	{
		$crewArray = mysql_fetch_array($crewResult);

		if(crypt($_POST["password"], $crewArray["password"]) == $crewArray["password"])
		{
			// Login Success!
			// Set Session Variables
			$_SESSION["loggedin"] = 1;
			$_SESSION["username"] = $_POST["email"];
			$_SESSION["realname"] = $crewArray["realname"];
			$_SESSION["crewid"] = $crewArray["crewid"];
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
