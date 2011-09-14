<?php
/*
 * Change Log
 *
 * 27th August 2005 - taylord1 - updated SQL to add other IM details to DB
 * 25th August 2005 - taylord1 - updated the format of the application email
 */
 
require("include/conf.php");
$postok = 1;
	
if(isset($_POST['iQapTcha']) && empty($_POST['iQapTcha']) && isset($_SESSION['iQaptcha']) && 
$_SESSION['iQaptcha'])
{

	if ($_POST["position"] == $secoff)

	{

		$position = $secoff;

	}

	else

	{

		$position = 0;

	}

	$sql = "INSERT INTO ".$prefix."_crew VALUES(NULL,'" . addslashes($_POST["realname"]) . "' , '" . addslashes($_POST["email"]) . "', '" . crypt($_POST["password"]) . "' , '" . addslashes($_POST["charlastname"]) . "' , '".addslashes($_POST["charfirstname"]) . "', '" . addslashes($_POST["charmiddlename"]) . "' , '" . addslashes($_POST["race"]) . "' , '" . addslashes($_POST["birthplace"]) . "', '" . addslashes($_POST["birthdate"]) . "','" . addslashes($_POST["age"]) . "', ".addslashes($_POST["gender"]) . ",1,'" . addslashes($shipname) ."', '" .$position. "','" . addslashes($_POST["appearance"]) . "','" . addslashes($_POST["history"]) . "','" . addslashes($_POST["aol"]) . "', 0, '" . addslashes($_POST["msn"]) . "', '" . addslashes($_POST["yahoo"]) . "', '" . addslashes($_POST["icq"]) . "');";

	$result = mysql_query($sql) or die("Insert Error: $sql : ".mysql_error());

	$insertid = mysql_insert_id();

	$sql = "INSERT INTO ".$prefix."_inactive VALUES ('".$insertid."', '".$_POST["position"]."', 0);";

	$updateResult = mysql_query($sql) or die("Update Error: ".mysql_error());

	$qry2 = "Select data FROM ".$prefix."_position where posid='".$_POST["position"]."'";

	$posresult = mysql_query($qry2) or die("Select Error: ".mysql_error());

	$posA = mysql_fetch_row($posresult);

	$mailbody = "An application has arrived from ".$_POST["realname"]." <".$_POST["email"]."> for the position of ".$posA[0]."\n\n";
	
	$mailbody .= "===Player IM Details===\n\n";
	$mailbody .= "AIM: ".$_POST["aol"]."\n";
	$mailbody .= "MSN: ".$_POST["msn"]."\n";
	$mailbody .= "Y!: ".$_POST["yahoo"]."\n";
	$mailbody .= "ICQ: ".$_POST["icq"]."\n\n";
	$mailbody .= "===End Player IM Details===\n\n";
	
	$mailbody = $mailbody . "===Experiance===\n\n ".$_POST["rpgexperience"]."\n\n===End Experiance===\n\n";
	
	$mailbody .= "===Character Details Details===\n\n";

	$mailbody = $mailbody . "Character Name: ".$_POST["charfirstname"]." ".$_POST["charmiddlename"]." ".$_POST["charlastname"]."\n";

	$mailbody = $mailbody . "Position Requested: $posA[0]\n";

	$mailbody = $mailbody . "Race: ".$_POST["race"]."\n";
	$mailbody = $mailbody . "Birthplace: ".$_POST["birthplace"]."\n";

	$mailbody = $mailbody . "Age: ".$_POST["age"]."\n";
	$mailbody = $mailbody . "Birthdate: ".$_POST["birthdate"]."\n";
	$qry = "SELECT * FROM ".$prefix."_gender";
	$genderResult = mysql_query($qry,$link);
	while($gender = mysql_fetch_assoc($genderResult))
	{
		if($_POST["gender"] == $gender["num"])
		{
			$mailbody = $mailbody . "Gender: ".$gender["data"]."\n\n";
		}
	}

	$mailbody .= "=== End Character Details===\n\n";

	$mailbody = $mailbody . "===Appearance===\n\n".$_POST["appearance"]."\n\n===End Appearance===\n\n";

	$mailbody = $mailbody . "===History===\n\n ".$_POST["history"]."\n\n===End History==\n\n";

	$mailbody = $mailbody . "===Sample Post===\n\n".$_POST["post"]." \n\n===End Sample Post===\n\n";
	
	$mailbody = $mailbody . "\nYou should hear from us within 48 hours. If more than 5 days pass then you should email $COemail and wait for a response.";

	$mailbody = $mailbody . "\n Thank You for your interest in the $shipname.\n\n";

	$mailbody = $mailbody . "$COname";
	
	$Headers = "From: ".$_POST["email"];

	$mailerto = "$COemail, $XOemail, $OTHERemail, ".$_POST["email"];

	$mailersubject= "Application for the $shipname has arrived!";

	if(mail ($mailerto, $mailersubject, $mailbody,$Headers))
	{		
		echo "<H2>Your application has been submitted to the CO and XO for review.  You will hear from them within 48 hours.</H2>";

		echo "If you do not receive an email containing your application within 24";

		echo "hours that means the address you provided was invalid.";

		echo "Please re-submit and double check your email address.";
		
	}
	else
	{
		echo "An error occured sending the mail";
	}


	?><font face="Tahoma" size="2"><a href="./main.php"><b> HOME</a></font></b><?

	}

else	{

	echo "<br><br><b>At least one error was encountered in the character submission.  Please click below and fix the errors.<br>";

	echo '<CENTER><a href="javascript:document.history.go(-1)">GO BACK AND TRY AGAIN</a></CENTER>';

	}

	

mysql_close();

?>

