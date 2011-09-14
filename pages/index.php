
<table width='100%' border='0'>
<?php
// Get random quote
$query = "SELECT count(*) as count FROM ".$prefix."_quotes;";
$result = mysql_query($query);
$numquotes = mysql_fetch_array($result);

if ($numquotes["count"])
{
	$randNum = rand (1, $numquotes["count"]);

	$query = "SELECT ".$prefix."_quotes.quote, ".$prefix."_crew.firstname, ".$prefix."_crew.lastname, ".$prefix."_rank.rankdesc FROM ".$prefix."_quotes
		  LEFT JOIN ".$prefix."_crew ON ".$prefix."_crew.crewid=".$prefix."_quotes.crewid 
		  LEFT JOIN ".$prefix."_rank ON ".$prefix."_rank.rankid=".$prefix."_crew.rank
		  WHERE ".$prefix."_quotes.id='".$randNum."';";
	// echo $query;
	$result = mysql_query($query) or die("Error: ".mysql_error());
	$quote = mysql_fetch_array($result);

	mysql_free_result($result);
?>
<tr>
	<td class='quote'><b>Character Quote:</b> <i><?php echo $quote["quote"]; ?></i><span class='quotee'> <br>~ <?php echo $quote["rankdesc"]." ".$quote["firstname"]." ".$quote["lastname"]; ?></span></tr>
</tr>
<?php
}
?>

<tr>
<p><p></p><td align='center'>
<p align="left"><br><br><b>Welcome</b>!
</p>
<p align="justify">I am the ship's Commanding 
Officer, Jackie Clawson (at least Out of Character) and I would like to invite you to take a 
trip aboard the Horizon...if you can stand the lunacy waiting for you aboard. </p>
<p align="justify">The USS Horizon is an Intrepid-class 
ship, but we're not your typical ship staffed with your typical normal crew setting 
out to explore space. Oh no, far from that. That wouldn't be too much fun, now would it? </p>

<p align="justify">
After the Fourth Annual betleH tournament several of the attendees/participants have tagged along with the Caitian 
Commanding Officer, dubbed as the 'Killer Kitty'. Amongst the crew currently aboard the USS Horizon you'll find a 
variety of crewmembers with different backgrounds and each having their own story to tell. But that's not all... 
Things take on another twist after the conclusion of the Fifth Annual betleH tournament during which Jackie Clawson won the tournament and resigned from Starfleet following her involvement with the Horizon's XO Alex Chadwick.  </p>

<p align="justify">The crew of the Horizon undertage a journey of a lifetime as they board the USS Venture Star and head towards a mysterious force in another part of the  galaxy. A force that may cost some of the crew members very dearly. Meanwhilst, the USS Horizon is under command of Admiral Mark Harmon as he oversees final repairs and preparations whilst waiting for his former chief of security to return with the rest of the crew. A wait that would take a while. <p>

<p align="justify"> The crew of the Venture Star returns nearly a year later, with some devastating news. Alex Chadwick has been lost. Harmon remains aboard the Horizon, in command, whilst the ship re-crews and prepares to set out again to boldly go. However, the ship is in a state of flux once again and the crew wonders if a certain grieving caitian will ever come back to Star Fleet and take command of the Horizon again. Meanwhilst the new Executive Officer tries to restablish himself back into the life known to Star Fleet. <p> 

<p align="justify">Feel free to browse the Horizon's website and our forums. Check out the crew manifest to see what's available 
and join our continuing adventures today!
<p align="justify">If you don't find something 
you are looking for on the manifest, or you have any questions and queries, please feel free to <a href="mailto:jess@taylord1.co.uk?subject=USS Horizon Website">e-mail me</a> directly.<p><img src='images/ship/ambas1.jpg' align="center"/><p>
<b>USS Horizon:</b> 3 years running and still a whole lotta nuts aboard! We're always looking to add more crazies to our midst! So what are you waiting for? Sign up! And tell your friends to sign up too!<p align="left">
<font face="Papyrus" color="#0000FF" size="4">
<i><b>Jackie Clawson</b></i></font><br>
<b>Commanding Officer (OOC)<br>
USS Horizon - A<br>
<br>
</b></td>
</tr>
<p>
<tr>
<td align='center'>&nbsp;</td>
</tr>
</table>
<p>
<p>
