<?php
if(!defined("IN_ADMIN"))
{
	die("Direct access is not allowed!");
}
/*
 * File Name: editcharacter.php
 *
 * Purpose: To Edit a Character already in the system
 *
 * Author: Dan Taylor
 *
 * Date Created: 24/07/04
 *
 */

if (isset($_POST["editcharacter"]))
{
	//print_r($_POST);
	
	// Update Query
	
	$sql = "UPDATE ".$prefix."_crew SET ".$prefix."_crew.firstname=\"".htmlentities($_POST["forename"])."\", 
										".$prefix."_crew.middlename=\"".htmlentities($_POST["middlename"])."\", 
										".$prefix."_crew.lastname=\"".htmlentities($_POST["surname"])."\", 
										".$prefix."_crew.realname=\"".htmlentities($_POST["realname"])."\", 
										".$prefix."_crew.email=\"".$_POST["email"]."\", 
										".$prefix."_crew.aol=\"".$_POST["aol"]."\", 
										".$prefix."_crew.msn=\"".$_POST["msn"]."\", 
										".$prefix."_crew.yahoo=\"".$_POST["yahoo"]."\", 
										".$prefix."_crew.icq=\"".$_POST["icq"]."\", 
										".$prefix."_crew.race=\"".$_POST["race"]."\", 
										".$prefix."_crew.birthplace=\"".addslashes($_POST["pob"])."\",
										".$prefix."_crew.birthdate=\"".addslashes($_POST["birthdate"])."\",
										".$prefix."_crew.age=\"".$_POST["age"]."\", 
										".$prefix."_crew.psd=\"".htmlentities($_POST["psd"])."\", 
										".$prefix."_crew.bio=\"".htmlentities($_POST["bio"])."\", 
										".$prefix."_crew.rank=\"".$_POST["rank"]."\"
										WHERE ".$prefix."_crew.crewid=".$_POST["crewid"];
	$result = mysql_query($sql) or die ("Could not update crew table: ".mysql_error());
	
	// Clear Old Position
	$sql = "UPDATE ".$prefix."_crewposition SET ".$prefix."_crewposition.crewid=0, ".$prefix."_crewposition.type=0 WHERE ".$prefix."_crewposition.crewid=".$_POST["crewid"];
	$result = mysql_query($sql) or die ("Could not remove old position: ".mysql_error());
	
	// Clear any inactive users with char id
	$sql = "DELETE FROM ".$prefix."_inactive WHERE ".$prefix."_inactive.crewid=".$_POST["crewid"];
	$result = mysql_query($sql) or die ("Could not remove inactive position: ".mysql_error());
		
	if ($_POST["type"] == 0)
	{
		// Set User Inactive
		$sql = "INSERT INTO ".$prefix."_inactive VALUES (\"".$_POST["crewid"]."\",\"".$_POST["position"]."\",\"0\");";
		
		$result = mysql_query($sql) or die ("Could not set inactive user: ".mysql_error());
	}
	else
	{
	
		// Set New Position
		$sql = "UPDATE ".$prefix."_crewposition SET ".$prefix."_crewposition.crewid=\"".$_POST["crewid"]."\",  
												".$prefix."_crewposition.type=\"".$_POST["type"]."\"
												WHERE ".$prefix."_crewposition.posid=\"".$_POST["position"]."\";";
		//die ($sql);
		$result = mysql_query($sql) or die ("Could not update crewposition table: ".mysql_error());
	}
	
	/*
	if ($_POST["password"])
	{
		// Generate New Password
		$password = generatePassword();
		// Update Database
		$sql = "UPDATE ".$prefix."_crew SET ".$prefix."_crew.password=\"".crypt($password)."\" WHERE ".$prefix."_crew.crewid=".$_POST["crewid"];
		$result = mysql_query($sql) or die ("Could not update password: ".mysql_error());
		
		// Mail User
		$mailer = new plainMail();
	
		$mailer->to = $_POST["email"];
		//$mailer->to = "dan@taylord1.co.uk";
		$mailer->from = $COemail;
		$mailer->cc = "";
		$mailer->bcc = "";
		$mailer->subject = "Your password has been reset on the $shipname";
		$mailer->body = "
		Your $shipname password has been reset to $password
		
		You can change this password by logining to the Crew Control Panel at the following location ".$domain."/crewcp/
		
		$shipname Command Staff
		";
		$mailer->to;
		if (!$mailer->send())
		{	
			echo $mailer->errorMsg();
		}
		
	}
	*/
	//header("Location: switchboard.php?pageref=crew");
	
	echo "<p align=\"center\">Character Account Details Updated<br /><a href=\"switchboard.php?pageref=crew\">Continue</a></p>";
}
else
{
	// Get Current Information
	$sql = "SELECT ".$prefix."_crew.crewid, ".$prefix."_crew.firstname, ".$prefix."_crew.middlename, 
			".$prefix."_crew.lastname, ".$prefix."_crew.realname, ".$prefix."_crew.email, 
			".$prefix."_crewposition.type, ".$prefix."_crew.aol, ".$prefix."_crew.msn, ".$prefix."_crew.yahoo, 
			".$prefix."_crew.icq, ".$prefix."_crewposition.posid, ".$prefix."_crew.race, ".$prefix."_crew.birthplace,
			".$prefix."_crew.birthdate, ".$prefix."_crew.age, ".$prefix."_crew.psd, ".$prefix."_crew.bio, ".$prefix."_crew.rank
			FROM ".$prefix."_crew
			LEFT JOIN ".$prefix."_crewposition ON ".$prefix."_crewposition.crewid=".$prefix."_crew.crewid
			LEFT JOIN ".$prefix."_rank ON ".$prefix."_rank.rankid=".$prefix."_crew.rank
			WHERE ".$prefix."_crew.crewid=".$_GET["id"];
			
	$currentResult = mysql_query($sql) or die ("Error, could not query current character information. MySQL Error: ".mysql_error());
	
	$currentInfo = mysql_fetch_assoc($currentResult);
	
	// Get all positions
	$sql = "SELECT ".$prefix."_position.posid, ".$prefix."_position.data FROM ".$prefix."_crewposition, ".$prefix."_position
			WHERE ".$prefix."_crewposition.posid=".$prefix."_position.posid ORDER BY ".$prefix."_crewposition.colorid ASC";

	$posResult = mysql_query($sql) or die("Position Error: ".mysql_error());
	
	if ($debug)
	{
		print "Number of open positions: ".mysql_num_rows($posResult);
	}
	
    // Rank Query
	$sql = "SELECT ".$prefix."_rank.rankid, ".$prefix."_rank.rankdesc, ".$prefix."_rank.color FROM ".$prefix."_rank;";
	
	$rankResult = mysql_query($sql) or die("Rank Error: ".mysql_error());
	
	if ($debug)
	{
		print "Number of ranks: ".mysql_num_rows($rankResult);
	}
	
	// Get inactive details
	$sql = "SELECT * FROM ".$prefix."_inactive
			WHERE ".$prefix."_inactive.crewid=".$_GET["id"];
	
	$inactiveResult = mysql_query($sql) or die ("Could not query inactive users");
	
	if (mysql_num_rows($inactiveResult))
	{
		$inactive = mysql_fetch_assoc($inactiveResult);
		// print_r($inactive);
	}
?>
<form action="switchboard.php?pageref=editcharacter" method="POST" name="theForm">
<input type="hidden" name="crewid" value="<?php echo $currentInfo["crewid"]; ?>" />
Player Information
<table>
<tr>
	<td>Full Name</td>
	<td><input type="text" name="realname" value="<?php if(isset($currentInfo["crewid"])) {echo $currentInfo["realname"];} ?>" /></td>
</tr>
<tr>
	<td>Email Address</td>
	<td><input type="text" name="email" value="<?php if(isset($currentInfo["email"])) {echo $currentInfo["email"];} ?>" /></td>
</tr>
<!-- tr>
	<td>Password:</td>
	<td>
		Reset Password?
		<table>
		<tr>
			<td>Yes</td>
			<td><input type="radio" name="password" value="1" /></td>
		</tr>
		<tr>
			<td>No</td>
			<td><input type="radio" name="password" value="0" checked="checked" /></td>
		</tr>
		</table>
	</td>
</tr -->
<tr>
	<td>AOL</td>
	<td><input type="text" name="aol" value="<?php if(isset($currentInfo["aol"])) {echo $currentInfo["aol"];} ?>" /></td>
</tr>
<tr>
	<td>MSN</td>
	<td><input type="text" name="msn" value="<?php if(isset($currentInfo["msn"])) {echo $currentInfo["msn"];} ?>" /></td>
</tr>
<tr>
	<td>ICQ</td>
	<td><input type="text" name="icq" value="<?php if(isset($currentInfo["icq"])) {echo $currentInfo["icq"];} ?>" /></td>
</tr>
<tr>
	<td>Y!</td>
	<td><input type="text" name="yahoo" value="<?php if(isset($currentInfo["yahoo"])) {echo $currentInfo["yahoo"];} ?>" /></td>
</tr>
</table>
<br />
Character Information
<table>
<tr>
	<td>Character Type:</td>
	<td><select name="type">
	<?php 
	
	if ($currentInfo["type"] == 0)
	{
		echo "<option value=\"0\" selected=\"selected\">Inactive</option>";
	}
	else
	{
		echo "<option value=\"0\">Inactive</option>";
	}
	
	if ($currentInfo["type"] == 1)
	{
		echo "<option value=\"1\" selected=\"selected\">Player</option>";
	}
	else
	{
		echo "<option value=\"1\">Player</option>";
	}
	
	if ($currentInfo["type"] == 2)
	{
		echo "<option value=\"2\" selected=\"selected\">PCC</option>";
	}
	else
	{
		echo "<option value=\"2\">PCC</option>";
	}
	
	if ($currentInfo["type"] == 3)
	{
		echo "<option value=\"3\" selected=\"selected\">NPC</option>";
	}
	else
	{
		echo "<option value=\"3\">NPC</option>";
	}
	
	if ($currentInfo["type"] == 4)
	{
		echo "<option value=\"4\" selected=\"selected\">LOA</option>";
	}
	else
	{
		echo "<option value=\"4\">LOA</option>";
	}
	?>
	</select>
	</td>
</tr>
<tr>
	<td>Position</td>
	<td>
	<select name="position" size="1">
	<?php
	while ($position = mysql_fetch_assoc($posResult))
	{
		if ($currentInfo["posid"] == $position["posid"] || $position["posid"] == $inactive["posid"])
		{
			echo "<option value=\"".$position["posid"]."\" selected=\"selected\">".$position["data"]."</option>";
		}
		else
		{
			echo "<option value=\"".$position["posid"]."\">".$position["data"]."</option>";
		}
	}
	mysql_free_result($posResult);
	?>
	</select>
	</td>
</tr>
<tr>
	<td>Rank:</td>
	<td>
		<select name="rank" size="1">
		<?php
		while($rank = mysql_fetch_assoc($rankResult))
		{
			if ($currentInfo["rank"] == $rank["rankid"])
			{
				echo "<option value=\"".$rank["rankid"]."\" selected=\"selected\">".$rank["rankdesc"]." [".$rank["color"]."]</option>";
			}
			else
			{
				echo "<option value=\"".$rank["rankid"]."\">".$rank["rankdesc"]." [".$rank["color"]."]</option>";
			}
		}
		?>
		</select>	
	</td>
</tr>
<tr>
	<td valign="top">Character Name:</td>
	<td>Forename: <input type="text" name="forename" value="<?php echo stripslashes($currentInfo["firstname"]); ?>" /><br />
	Middle Name: <input type="text" name="middlename" value="<?php echo stripslashes($currentInfo["middlename"]); ?>" /><br />
	Surname: <input type="text" name="surname" value="<?php echo stripslashes($currentInfo["lastname"]); ?>" /></td>
</tr>
<tr>
	<td>Character Race:</td>
	<td><input type="text" name="race" value="<?php echo stripslashes($currentInfo["race"]); ?>" /></td>
</tr>
<tr>
	<td>Character Gender:</td>
	<td><select name="gender">
	<option value="1">Male</option>
	<option value="2">Female</option>
	</select></td>
</tr>
<?php /* Explode Date Variable */ 
$dates = explode("/", $currentInfo["birthdate"]);
?>
<tr>
	<td>Birth Date</td>
	<td width="400"><INPUT TYPE="hidden" NAME="birthdate" size="20">
	<INPUT TYPE="text" disabled NAME="displayBD" size="20">
        </td>
</tr>
<tr>
	<td>Age:</td>
	<td><INPUT TYPE="text" NAME="age" size="10" onblur="CalculateBD()"  value="<?php if(isset($currentInfo["age"])) {echo $currentInfo["age"];} ?>" ></td>
</tr>
<tr>
	<td>Birth Month:</td>
	<td><INPUT TYPE="text" NAME="birthmonth" size="2" onblur="CalculateBD()" value="<?php if(isset($dates[0])) {echo $dates[0];} ?>"></td> 
</tr>
<tr>
	<td>Birth Day: </td>
	<td><INPUT TYPE="text" NAME="birthday" size="2" onblur="CalculateBD()" value="<?php if(isset($dates[1])) {echo $dates[1];} ?>"></td>
</tr>
<script language="javascript">
CalculateBD();
</script>
<tr>
	<td>Place of Birth:</td>
	<td><input type="text" name="pob" value="<?php echo stripslashes($currentInfo["birthplace"]); ?>" /></td>
</tr>
<tr>
	<td colspan="2">Personal Description</td>
</tr>
<tr>
<td colspan="2"><textarea name="psd" cols="60" rows="10"><?php if(isset($currentInfo["psd"])) {echo reverse_htmlentities($currentInfo["psd"]);} ?></textarea></td>
</tr>
<tr>
	<td colspan="2">Biography</td>
</tr>
<tr>
<td colspan="2"><textarea name="bio" cols="60" rows="10"><?php if(isset($currentInfo["bio"])) {echo reverse_htmlentities($currentInfo["bio"]);} ?></textarea></td>
</tr>
</table>
<input type="submit" name="editcharacter" value="Edit Character">
</form>
<?php
}
?>
