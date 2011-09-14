<?php
// Get Positions
$sql = "SELECT ".$prefix."_position.posid, ".$prefix."_position.data FROM ".$prefix."_crewposition, ".$prefix."_position
		WHERE ".$prefix."_crewposition.posid=".$prefix."_position.posid AND ".$prefix."_crewposition.crewid=0 
				AND ".$prefix."_crewposition.posid != $secoff
				AND ".$prefix."_position.viewid>0
		ORDER BY ".$prefix."_crewposition.colorid ASC";

$positionResult = mysql_query($sql,$link) or die("Position Error: ".mysql_error());
	
	
// Get Genders
$qry = "SELECT * FROM ".$prefix."_gender";
$genderResult = mysql_query($qry,$link);

?>
	<script type="text/javascript">
             $(document).ready(function(){
	       // Simple call
       		$('#QapTcha').QapTcha(
		{PHPfile:'<?=$domain;?>/js/Qaptcha.jquery.php'}
	);
	    });
	</script>

<a name="top"></a>
<table width="85%" align="center">
<tr>
	<td><h1 align="center">Application to serve on <?php echo $shipname; ?><hr /></td>
</tr>
<tr>
	<td>
	<!-- Start Rules -->
	  <p><b>SIMM RATING:</b> Due to mature and sometimes graphically descriptive (i.e violent, FE-verse tied) content being posted and
		referred to, this simulation is rated 18+. Mature audiences only. This simm is not for folks with a weak stomach.<p>		 
<b>Instructions:</b> This is the official application form to apply for 
        service aboard the USS Horizon. Please keep in mind the following guidelines 
        for members:</p>
	<ol>
		<li>The USS Horizon is more than a run-and-shoot-and-oooh-look-I-saved-the-galaxy-again simm. 
          The USS Horizon is about character development and dialogue that develops 
          among the simmers. This is not to say however that the Intrepid class 
          Horizon has no action. We do, plenty of it, just not in the usual constant 'shoot 'em up' way that some simms tend to do. 
          With the crew we have aboard, there's plenty of action available for anyone without facing any enemies outside of the ship. ;) </li>
<br>
		<li>Please take your time on the application. You getting the position you're applying for depends in part on the quality of character that you design. It will also partially depend on your ability to proofread what you have written. </li>
<br>
		<li>At all times as a crewmember of the USS Horizon, you are required to maintain the dignity of the position and to act according to the rules governing the simulation. More plainly: flaming, trolling and profane-filled tirades will not be tolerated by any member of the simulation. More of the Horizon's simm rules are located over in the <a href="http://www.usshorizon.org/forum/showthread.php?t=83"> Announcements</a> area of the forums. </li> 
<br>
		<li>Please attempt to do some Star Trek research regarding the position you are taking. 
        For example, do not apply for the Chief Engineer if you have no idea about the basic fundamentals of 
		the technology of the Star Trek universe. In addition, do not apply for the Chief Engineer position if you are interested in 
		'blowing shit up' constantly. If you are looking for a good place to start, try security or helm or medical. 
		If a position you have in mind isn't listed here, contact the CO by e-mail, and something might be arranged. 
		All positions are subject to the review of the ship's Commanding Officer and senior staff/Game Masters.</li> 
<br>		
	<li>The USS Horizon expects ALL players to make an attempt to post once 
          per week regardless of rank/rate or position. It doesn't need to be long or spectacular. It should, if possible, be about your character in the current storyline/plot. If that is not possible then you should post a personal log. More content in a post is always preferable, but not required! However, do remember that one post of quality can be worth more than 6 short posts that never really developed into anything. Joint posts are heavily encouraged on the Horizon as a way to further develop characters. With higher ranking positions comes greater responsibility. All senior staff should 
          post more frequently than the required minimum. Failure for any player 
          to meet this minimum will first result in a warning to post more frequently 
          and then result in dismissal from this simm.</li>
		</ol>
		<p>By submitting this form, you acknowledge you have read and agreed with the above.</p>

		<p>If you have any questions, feel free to send them onto the CO before you apply.</p>
	<!-- End Rules -->
	</td>
</tr>
<tr>
	<td>
		<hr />
		<p>Items marked with <b>*</b> must be completed or your application will be ignored. For Character Names, a last/common/family name is required however a first and middle are optional since many characters from Star Trek only have one name.</p>
		<hr />
	
	</td>
</tr>
</table>
<form action="main.php?pageref=apply2" method="post" name="theForm" id="theForm">
<table width="85%" align="center" border="1">
<tr>
	<td class="lcars" rowspan="26" width="20px">&nbsp;</td>
	
	<td><h1>Personal Details</h1>
</tr>
<tr>	
	<td>*Real Name: <input type="text" name="realname" /></td>
</tr>
<tr>
	<td>*Email Address: <input type="text" name="email" /></td>
</tr>
<tr> 
	<td>*Password: <input type="password" name="password" size="30"></td>
</tr>
<tr> 
	<td>*Verify Password: <input type="password" name="vpassword" size="30"></td>
</tr>
<tr> 
	<td>AOL Instant Messenger ID: <input type="text" name="aol" size="30" value="" /></td>
</tr>
<tr> 
	<td >MSN Instant Messenger ID: <input type="text" name="msn" size="30" value="" /></td>
</tr>
<tr> 
	<td>Yahoo Instant Messenger ID: <input type="text" name="yahoo" size="30" value="" /></td>
</tr>
<tr> 
	<td>ICQ Instant Messenger ID: <input type="text" name="icq" size="30" value="" /></td>
</tr>
<tr>
	<td>&nbsp;<br /><h1>Character Details</h1>
</tr>
<tr> 
        <td>Character Name: (first middle *Last) only last is required:</td>
      </tr>
<tr>
	<td><input type="text" name="charfirstname" size="20">
          &nbsp 
          <input type="text" name="charmiddlename" size="20">
          <input type="text" name="charlastname" size="20">* </td>
</tr>
<tr>
	<td>*Position you are applying for: <select name="position"><?php
	while($position = mysql_fetch_assoc($positionResult))
	{
		if(isset($_GET["posid"]) && $_GET["posid"] == $position["posid"])
		{
			echo "<option value=\"".$position["posid"]."\" selected=\"selected\">".$position["data"]."</option>";
		}
		else
		{
			echo "<option value=\"".$position["posid"]."\">".$position["data"]."</option>";
		}
	}
	?>
	</select></td>
</tr>
<tr> 
        <td>*Character Race:<input type="text" name="race" size="20"></td>
      </tr>
      <tr> 
        <td width="580" colspan="2" align="left"><i><font size="1">The following 
          are typically not allowed to be played as races: Android, Borg, Founders (or other 
          shapeshifter), Jem Haddar, Q-continuum, Romulan, Cardassian. If you 
          feel you have a legitimate reason and way to play a character of these 
          races, e-mail the Commanding Officer at <?php echo $COemail; ?> and 
          explain what character you want to play, why, and all the bio information 
          required on this page.<br>&nbsp;</font></i></td>
      </tr>
      <tr> 
        <td>*Characer Gender: <select name="gender" size="1">
	  <?php
	  while($gender= mysql_fetch_assoc($genderResult))
	  {
		echo "<option value=\"".$gender["num"]."\">".$gender["data"]."</option>";
	  }
	  ?>
          </select>
        </td>
      </tr>
      <tr> 
        <td>*Character BirthDate (Modify Using the Fields Below):
	<input type="hidden" name="birthdate" size="20">
	<input type="text" disabled="disabled" name="displayBD" size="20">
        </td>
      </tr>
      <tr> 
        <td>*Character Age: <input type="text" name="age" size="10" onblur="CalculateBD()">
        </td>
      </tr>
      <tr> 
        <td>*Character Birth Month: <input type="text" name="birthmonth" size="2" onblur="CalculateBD()"></td>
      </tr>
      <tr> 
        <td>*Character Birth Day: <input type="text" name="birthday" size="2" onblur="CalculateBD()">
        </td>
      </tr>
      <tr>
      	<td>A year is not required. Only a month and Day The current sim year is <script language="JavaScript">document.write(s_simmYear);</script>.<td>
      </tr>
      <tr>
        <td>*Character Birthplace: <input type="text" name="birthplace" size="10"></td>
      </tr>
      <tr> 
        <td> *Brief description of character's 
          appearance and general attitude ( Your character should fit into the 
          StarFleet Lifestyle This has a lot to do with getting your character 
          accepted.):<br>
          <textarea name="appearance" rows="5" cols="60" wrap="physical"></textarea>
        </td>
      </tr>
      <tr> 
        <td> *Character's biography, history 
          and other relavent factors ( This effects your characters Rank. Make 
          it Good. Examine the CO and XO bios on the crew roster page (click the 
          comunicator) if you need help with this.) :<br>
          <textarea name="history" rows="5" cols="60" wrap="physical"></textarea>
        </td>
      </tr>
      <tr> 
        <td> Past RPG Experience (both e-mail 
          RPG and non-E-mail RPG experience is a plus. This will help determine 
          your position or Rank)<br>
          <textarea name="rpgexperience" rows="5" cols="60" wrap="physical"></textarea>
        </td>
      </tr>  
      <tr> 
        <td> Please Submit a writting sample/Sample post as the character/position you are applying for. Respond to the following:<br>
          It is 04:00, you are asleep in your bunk in the middle of a dream when you hear the Red Alert Klaxon. <br>
	  CO: Red Alert! All Hands to Battle Stations! <br>
          <textarea name="post" rows="5" cols="60" wrap="physical"></textarea>
        </td>
      </tr>
     <td colspan="2"> <p> How did you hear about the USS Horizon? Why did you decide to join the simm? <br>
          <textarea name="postri" rows="5" cols="60" wrap="physical"></textarea>
        </td>
     <tr>
        <td colspan="2" align="center"><p>&nbsp;<br>Did you fill out <i>EVERYTHING</i> and <b>PROOFREAD</b> it all?<br />
	If so then it's time to submit your application. Click "Apply!" below.<br />&nbsp;</p>
        </td>
      </tr>
	<tr>
		<td colspan="2">
			<div id="QapTcha"></div>
		</td>
	</tr>
      <tr>
      	<td align="center" colspan="2"><input type="submit" name="apply" value="Apply Now" onClick="return validateApp();" /></td>
      </tr>
</table>
</form>
