<?php
if(!defined("IN_ADMIN"))
{
	die("Direct access is not allowed!");
}
/*
 * File Name: addcharacter.php
 *
 * Purpose: to allow the addition of new character without using the join form.
 *
 * Author: Dan Taylor
 *
 * Date Created: 24/07/04
 *
 */
if (isset($_POST["addcharacter"]))
{
	// Generate Password
	$password = generatePassword();
	
	// SQL for Inserting in to the crew table
	$sql = "INSERT INTO ".$prefix."_crew VALUES (NULL,'" . addslashes($_POST["realname"]) . "' , '" . addslashes($_POST["email"]) . "', '" . crypt($password) . "' , '" . addslashes($_POST["surname"]) . "' , '".addslashes($_POST["forename"]) . "', '" . addslashes($_POST["middlename"]) . "' , '" . addslashes($_POST["race"]) . "' , '" . addslashes($_POST["pob"]) . "', '" . addslashes($_POST["dob"]) . "','" . addslashes($_POST["age"]) . "', ".addslashes($_POST["gender"]) . ",".$_POST["rank"].",'" . addslashes($shipname) ."', '0','" . htmlentities($_POST["psd"]) . "','" . htmlentities($_POST["bio"]) . "','" . addslashes($_POST["aol"]) . "', 0, '".addslashes($_POST["msn"])."' , '".addslashes($_POST["icq"])."', '".addslashes($_POST["yahoo"])."' );";

	$result = mysql_query($sql) or die ("Could not add new crewmember to the database.<br /> Error: ".mysql_error());
	
	// SQL for updating the crew_position table
	$sql = "UPDATE ".$prefix."_crewposition SET crewid=".mysql_insert_id().", 
			type=".$_POST["type"]." WHERE posid=".$_POST["position"].";";

	$result = mysql_query($sql) or die ("Could not up date position list.<br /> Error: ".mysql_error());
	
	mysql_free_result();
	
		// Mail User
		
		// include("../include/plainMail.php");
	
		$mailer = new plainMail();
	
		$mailer->to = $_POST["email"];
		$mailer->from = $COemail;
		$mailer->cc = "";
		$mailer->bcc = "";
		$mailer->subject = "Your password has been reset on the $shipname";
		$mailer->body = "
		Your $shipname password has been reset to $password
		
		You can change this password by logining to the Crew Control Panel at the following location ".$domain."/crew/
		
		$shipname Command Staff
		";
	
		$mailer->send();
		print $mailer->errorMsg();
		
		header("Location: switchboard.php?pageref=crew");
}
else
{

// New Open Positions Query
	$sql = "SELECT ".$prefix."_position.posid, ".$prefix."_position.data FROM ".$prefix."_crewposition, ".$prefix."_position
			WHERE ".$prefix."_crewposition.posid=".$prefix."_position.posid AND ".$prefix."_crewposition.crewid=0 ORDER BY ".$prefix."_crewposition.colorid ASC";

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
?>
<form action="switchboard.php?pageref=addcharacter" method="POST" name="theForm">
Player Information
<table>
<tr>
	<td>Full Name</td>
	<td><input type="text" name="realname" /></td>
</tr>
<tr>
	<td>Email Address</td>
	<td><input type="text" name="email" /></td>
</tr>
<tr>
	<td>Password:</td>
	<td>The password will be automatically generated then emailed to the player</td>
</tr>
<tr>
	<td>AOL</td>
	<td><input type="text" name="aol" /></td>
</tr>
<tr>
	<td>MSN</td>
	<td><input type="text" name="msn" /></td>
</tr>
<tr>
	<td>ICQ</td>
	<td><input type="text" name="icq" /></td>
</tr>
<tr>
	<td>Y!</td>
	<td><input type="text" name="yahoo" /></td>
</tr>
</table>
<br />
Character Information
<table>
<tr>
	<td>Character Type:</td>
	<td><select name="type">
	<!-- Dont set inactive here <option value="0">Inactive</option> -->
	<option value="1">Player</option>
	<option value="2">PCC</option>
	<option value="3">NPC</option>
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
		print "<option value=\"".$position["posid"]."\">".$position["data"]."</option>";
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
			echo "<option value=\"".$rank["rankid"]."\">".$rank["rankdesc"]." [".$rank["color"]."]</option>";
		}
		?>
		</select>	
	</td>
</tr>
<tr>
	<td valign="top">Character Name:</td>
	<td>Forename: <input type="text" name="forename" /><br />
	Middle Name: <input type="text" name="middlename" /><br />
	Surname: <input type="text" name="surname" /></td>
</tr>
<tr>
	<td>Character Race:</td>
	<td><input type="text" name="race" /></td>
</tr>
<tr>
	<td>Character Gender:</td>
	<td><select name="gender">
	<option value="1">Male</option>
	<option value="2">Female</option>
	</select></td>
</tr>
<tr>
	<td>Birth Date</td>
	<td width="400"><INPUT TYPE="hidden" NAME="birthdate" size="20">
	<INPUT TYPE="text" disabled NAME="displayBD" size="20">
        </td>
</tr>
<tr>
	<td>Age:</td>
	<td><INPUT TYPE="text" NAME="age" size="10" onblur="CalculateBD()"  value="<?php if(isset($currentInfo["age"])) { echo $currentInfo["age"]; } ?>" ></td>
</tr>
<tr>
	<td>Birth Month:</td>
	<td><INPUT TYPE="text" NAME="birthmonth" size="2" onblur="CalculateBD()"></td>
</tr>
<tr>
	<td>Birth Day:</td>
	<td><INPUT TYPE="text" NAME="birthday" size="2" onblur="CalculateBD()"></td>
</tr>
<tr>
	<td>Place of Birth:</td>
	<td><input type="text" name="pob" /></td>
</tr>
<tr>
	<td colspan="2">Personal Description</td>
</tr>
<tr>
	<td colspan="2"><textarea name="psd" cols="60" rows="10"><?php if(isset($currentInfo["psd"])){ echo stripslashes($currentInfo["psd"]); } ?></textarea></td>
</tr>
<tr>
	<td colspan="2">Biography</td>
</tr>
<tr>
	<td colspan="2"><textarea name="bio" cols="60" rows="10"><?php if(isset($currentInfo["bio"])){ echo stripslashes($currentInfo["bio"]); } ?></textarea></td>
</tr>
</table>
<input type="submit" name="addcharacter" value="Add Character">
</form>
<?php
}
?>
