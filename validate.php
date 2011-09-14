<?	
	$classtype = "commandStaffTitle";
       // include("setup/conf.php");	
	
	
	$result=0;
	$qry = "select email,password,psd,bio from crew where crewid='" . $crewid . "'";
	$result = mysql_query($qry,$link) or die ("Invalid Query");
	
	$num_of_rows = mysql_num_rows ($result);

	if ($num_of_rows > 0) {
	
		$ud = mysql_fetch_row($result);
		$uname = $ud[0];
		$passwd = $ud[1];

		if ($uname == $username) {
			if ($passwd == $password) {

/* THIS IS THE EDITOR PART */

	$qry = "SELECT * FROM crew WHERE crewid=" . $crewid;
	$result = mysql_query($qry,$link);
	$data = mysql_fetch_row($result);
	/* Array for crew
		0 = ID
		1 = Real Name
		2 = E-mail Address
		3 = Password
		4 = Last Name
		5 = First Name
		6 = Middle Name
		7 = Race
		8 = Birthplace
		9 = Date of Birth
		10 = Age
		11 = GenderID (see table gender)
		12 = RankID (see table rank)
		13 = Current Assignment (Defaults to $shipname)
		14 = PositionID (See table position)
		15 = Personal Appearance Description (!! May be HTML fomatted!)
		16 = Biography (!! May be HTML fomatted!)
		17 = AOL
	*/
?>

<h1 align='center'>Editing <?	
	if ($data[5] != "") {
		echo $data[5] . " ";
	}
	if ($data[6] != "")
	{
		echo $data[6]." ";
	}
	echo $data[4]."'s Biography";
?></h1>

<center>
<form action="main.php?pageref=update_bio&crewid=<? echo $crewid ?>" method="post" align="center">
<table width="640" cellspacing="0" cellpadding="0" border="0">
	<tr>
		<td width="40" class="<? echo $classtype ?>"><? echo "&nbsp" ?></td>
		<td width="600" colspan="2" align="left" class="<? echo $classtype ?>"><b>Editable Fields</b></td>
	</tr>
	<tr>
		<td width="40" class="<? echo $classtype ?>"><? echo "&nbsp" ?></td>
		<td width="600" colspan="2" align="left"><br>Character Description:<br>
		<TEXTAREA NAME="desc" ROWS="10" COLS="70" WRAP="PHYSICAL"><? echo $data[15] ?></TEXTAREA><br></td>
	</tr>
	<tr>
		<td width="40" class="<? echo $classtype ?>"><? echo "&nbsp" ?></td>
		<td width="600" colspan="2" align="left"><br>Biographical Data:<br>
		<TEXTAREA NAME="bio" ROWS="10" COLS="70" WRAP="PHYSICAL"><? echo $data[16] ?></TEXTAREA><br></td>
	</tr>
	<tr>
		<td width="40" class="<? echo $classtype ?>"><? echo "&nbsp" ?></td>
		<td width="600" colspan="2" align="left"><br><INPUT TYPE="SUBMIT" VALUE="Update"></td>
	</tr>
</table>
</form>
</center>
<?
/* END OF THE EDITOR PART */
			}
			else {
				//header("Location: main.php?pageref=bio_template.php&crewid=" . $crewid);
				// password incorrect
				echo "Password Incorrect";
			}
		}
		else {
			//header("Location: main.php?pageref=bio_template.php&crewid=" . $crewid);
			// username incorrect
			echo "Password Incorrect";
		}
	
	}
	else {
		//header("Location: main.php?pageref=bio_template.php&crewid=" . $crewid);

		// Username doesn't exist
		echo "Unknown Error!";
	}
?>
