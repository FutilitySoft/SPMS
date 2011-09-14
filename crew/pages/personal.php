<?php
if (isset($_POST["changeIM"]))
{
	$sql = "UPDATE ".$prefix."_crew SET ".$prefix."_crew.aol='{$_POST["aol"]}',
									".$prefix."_crew.msn='{$_POST["msn"]}',
									".$prefix."_crew.yahoo='{$_POST["yahoo"]}',
									".$prefix."_crew.icq='{$_POST["icq"]}'
									WHERE ".$prefix."_crew.crewid=".$_SESSION["crewid"];
	// Update Database
	$result = mysql_query($sql) or die ("Could not update crew information: ".mysql_query());

	header("Location: switchboard.php?pageref=personal");
}
elseif (isset($_POST["changeEmail"]))
{
	$mailer = new plainMail();
	
	$mailer->to = $_POST["email"];
	$mailer->from = $COemail;
	$mailer->cc = "";
	$mailer->bcc = "";
	$mailer->subject = "Your email address on $shipname has been changed";
	$mailer->body = "
	Your $shipname email address has been changed to ".$_POST["email"]."
	
	If this has been an error please contact the ship's CO to rectify this.
		
	$shipname Command Staff
	";
	
	$mailer->send();
	//print $mailer->errorMsg();
	$_SESSION["username"] = $_POST["email"]; // Update session variables to reflect the change.
	
	echo "<p align=\"center\" class=\"normal\">Your email address has been changed and a confirmation email sent out. <a href=\"switchboard.php?pageref=personal\">Continue</a></p>";
}
elseif (isset($_POST["changePassword"]))
{

	// Check old Password Matches
	$sql = "SELECT ".$prefix."_crew.password FROM ".$prefix."_crew WHERE ".$prefix."_crew.crewid=".$_SESSION["crewid"];
	$result = mysql_query($sql) or die ("Could not get current password: ".mysql_error());

	$pwd = mysql_fetch_assoc($result);

	if (crypt($_POST["currentpassword"],$pwd["password"]) == $pwd["password"])
	{
		if ($_POST["newpassword"] == $_POST["confnewpassword"])
		{
			$sql = "UPDATE ".$prefix."_crew SET ".$prefix."_crew.password=\"".crypt($_POST["newpassword"])."\" WHERE ".$prefix."_crew.crewid=".$_SESSION["crewid"];

			// Update Database
			$result = mysql_query($sql) or die ("Could not update crew information: ".mysql_query());
			
			echo "<p align=\"center\" class=\"normal\">Your password has been changed! <a href=\"switchboard.php?pageref=personal\">Continue</a></p>";
		}
		else
		{
			echo "<p align=\"center\" class=\"normal\">Sorry your new passwords didn\"t match. <a href=\"javascript:history.go(-1)\">Go Back</a></p>";
		}
	}
	else
	{
		echo "<p align=\"center\" class=\"normal\">Sorry your current password was incorrect. <a href=\"javascript:history.go(-1)\">Go Back</a></p>";
	}

	//header("Location: switchboard.php?pageref=personal");

}else
{
?>

<h2 align="center">Switchboard - Personal Information</h2>
<p align="center" class="normal">Please use the forms below to update your personal information held on file here</p>
<?php
$sql = "SELECT ".$prefix."_crew.aol, ".$prefix."_crew.msn, ".$prefix."_crew.yahoo, ".$prefix."_crew.icq FROM ".$prefix."_crew WHERE ".$prefix."_crew.crewid=".$_SESSION["crewid"];
$infoResult = mysql_query($sql) or die ("Could not query database: ".mysql_error());
$info = mysql_fetch_assoc($infoResult);
?>
<p align="center" class="normal">Your Name: <?php echo $_SESSION["realname"]; ?></p>
<form action="switchboard.php?pageref=personal" method="post">
<table align="center">
<tr>
	<th colspan="2">IM Information</th>
<tr>
	<td>AOL</td>
	<td><input type="text" name="aol" value="<?php echo $info["aol"]; ?>" /></td>
</tr>
<tr>
	<td>MSN</td>
	<td><input type="text" name="msn" value="<?php echo $info["msn"]; ?>" /></td>
</tr>
<tr>
	<td>!Y</td>
	<td><input type="text" name="yahoo" value="<?php echo $info["yahoo"]; ?>" /></td>
</tr>
<tr>
	<td>ICQ</td>
	<td><input type="text" name="icq" value="<?php echo $info["icq"]; ?>" /></td>
</tr>
<tr>
	<td colspan="2" align="center"><input type="submit" name="changeIM" value="Update Your IM Details" />
</table>
</form>
<form action="switchboard.php?pageref=personal" method="post">
<table align="center">
<tr>
	<th colspan="2">Email Address</th>
</tr>
<tr>
	<td><p align="center" class="normal">Current Email Address</p></td>
	<td><?php echo $_SESSION["username"]; ?></td>
</tr>
<tr>
	<td><p align="center" class="normal">New Email Address</p></td>
	<td><input type="text" name="email" value="<?php echo $_SESSION["username"]; ?>" /></td>
</tr>
<tr>
	<td colspan="2" align="center"><input type="submit" name="changeEmail" value="Update Email Address" />
</table>
</form>
<form action="switchboard.php?pageref=personal" method="post">
<table align="center">
<tr>
	<th colspan="2">Password</th>
</tr>
<tr>
	<td><p align="center" class="normal">Current Password</p></td>
	<td><input type="password" name="currentpassword" /></td>
</tr>
<tr>
	<td><p align="center" class="normal">New Password</p></td>
	<td><input type="password" name="newpassword" />
</tr>
<tr>
	<td><p align="center" class="normal">Confirm New Password</p></td>
	<td><input type="password" name="confnewpassword" />
</tr>
<tr>
	<td colspan="2" align="center"><input type="submit" name="changePassword" value="Change Password" />
</table>
</form>
<?php
	mysql_free_result($infoResult);
}
?>
