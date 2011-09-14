<?php
// Get Crew Information From the DB
$sql = "SELECT *, ".$prefix."_position.data as position, ".$prefix."_crew.secondofficer, ".$prefix."_gender.data as gender, ".$prefix."_rank.image as rankimage, 
    ".$prefix."_colors.class FROM ".$prefix."_crew
 LEFT JOIN ".$prefix."_crewposition ON ".$prefix."_crewposition.crewid=".$prefix."_crew.crewid
 LEFT JOIN ".$prefix."_rank ON ".$prefix."_crew.rank=".$prefix."_rank.rankid
 LEFT JOIN ".$prefix."_gender ON ".$prefix."_gender.num=".$prefix."_crew.sex
 LEFT JOIN ".$prefix."_position ON ".$prefix."_position.posid=".$prefix."_crewposition.posid
 LEFT JOIN ".$prefix."_colors ON ".$prefix."_colors.id=".$prefix."_crewposition.colorid
 WHERE ".$prefix."_crew.crewid=".$_GET["crewid"];

//print $sql; 

$bioResult = mysql_query($sql) or die("Mysql Error: ".mysql_error());

$bio = mysql_fetch_assoc($bioResult);

//print_r($bio);

// Debug Value - Used for showing or hiding personal information right now
$debug = 1;

?>


<table border="0" width="640" cellspacing="0" align="center">
<tr>
 <td colspan="3" class="<?php echo $bio["class"]; ?>">Biography</td>
</tr>
<tr>
 <td width="40px" class="<?php echo $bio["class"]; ?>">&nbsp;</td>
 <td>
 <!-- Table for the Biography -->
  <table width="100%" border="0">
  <tr>
   <td class="bio_label">Name:</td>
   <td class="bio_entry"><?php echo stripslashes($bio["firstname"])." ".stripslashes($bio["middlename"])." ".stripslashes($bio["lastname"]); ?></td>
 <td valign="top" align="center" rowspan="9" width="110"><center>
  <img src="images/<?php echo $bio["rankimage"]; ?>" alt="Rank Pip" /> </center>
 </td>
  </tr>
  <tr>
   <td class="bio_label">Position:</td>
   <td class="bio_entry"><?php echo $bio["position"]; 
     // Show Second Officer is sec officer flag is shown
     if ($bio["secondofficer"])
     {
      echo ",<br />Second Officer";
     }
   ?></td>
  </tr>
  <tr>
   <td class="bio_label">Rank:</td>
   <td class="bio_entry"><?php echo $bio["rankdesc"]; ?></td>
  </tr>
  <tr>
   <td class="bio_label">Assigned:</td>
   <td class="bio_entry"><?php echo $shipname; ?></td>
  </tr>
  <tr>
   <td class="bio_label">Race</td>
   <td class="bio_entry"><?php echo $bio["race"]; ?></td>
  </tr>
  <tr>
   <td class="bio_label">Gender</td>
   <td class="bio_entry"><?php echo $bio["gender"]; ?></td>
  </tr>
  <tr>
   <td class="bio_label">Birth Place</td>
   <td class="bio_entry"><?php echo $bio["birthplace"]; ?></td>
  </tr>
  <tr>
   <td class="bio_label">Birth Date</td>
   <td class="bio_entry"><?php echo $bio["birthdate"]; ?></td>
  </tr class="bio_label">  
  <tr>
   <td class="bio_label">Age</td>
   <td class="bio_entry"><?php echo $bio["age"]; ?></td>
  </tr>
  </table>
 </td>
</tr>
<tr>
 <td colspan="3" class="<?php echo $bio["class"]; ?>">Personal Description</td>
</tr>
<tr>
 <td width="50px" class="<?php echo $bio["class"]; ?>">&nbsp;</td>
 <td class="bio_entry">
  <?php echo reverse_htmlentities($bio["psd"]); ?>
 </td>
</tr>
<tr>
 <td colspan="3" class="<?php echo $bio["class"]; ?>">Biography</td>
</tr>
<tr>
 <td width="50px" class="<?php echo $bio["class"]; ?>">&nbsp;</td>
 <td class="bio_entry">
  <?php echo reverse_htmlentities($bio["bio"]); ?>
 </td>
</tr>
<?php if ($_SESSION["loggedin"]) 
{
?>
<tr>
 <td colspan="3" class="<?php echo $bio["class"]; ?>">Player Information</td>
</tr>
<tr>
 <td width="50px" class="<?php echo $bio["class"]; ?>">&nbsp;</td>
 <td>
  <table>
  <tr>
   <td class="bio_label">Real Name</td>
   <td class="bio_entry"><?php echo $bio["realname"]; ?></td>
  </tr>
  <tr>
   <td class="bio_label">Email Address</td>
   <td class="bio_entry"><?php echo $bio["email"]; ?></td>
  </tr>
  <tr>
   <td class="bio_label">AIM</td>
   <td class="bio_entry"><?php echo $bio["aol"]; ?></td>
  </tr>
		<tr>
			<td class="bio_label">MSN</td>
			<td class="bio_entry"><?php echo $bio["msn"]; ?></td>
		</tr>
		<tr>
			<td class="bio_label">Y!</td>
			<td class="bio_entry"><?php echo $bio["yahoo"]; ?></td>
		</tr>
		<tr>
			<td class="bio_label">ICQ</td>
			<td class="bio_entry"><?php echo $bio["icq"]; ?></td>
		</tr>
		</table>
	</td>
</tr>
<?php
}
?>
<tr>
	<td class="<?php echo $bio["class"]; ?>" colspan="3">&nbsp;</td>
</tr>
</table>
