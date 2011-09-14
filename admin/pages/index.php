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
<p align="left"><br><br><b>Welcome</b> to the USS Horizon, wandering traveller.
</p>
<p align="justify">I am the ship's Commanding 
Officer, Rear Admiral Jackie Clawson and I would like to invite you to take a 
trip aboard the Horizon...if you can stand the lunacy waiting for you aboard. </p>
<p align="justify">The USS Horizon is an Intrepid-class 
ship attached to Bravo Fleet's Task Force 58 as the Task Force Commanding 
Officer's Flagship. But the USS Horizon is not your typical ship staffed with your typical normal crew setting 
out to explore space. Oh no, far from that. </p>

<p align="justify">
After the Fourth Annual betleH tournament several of the attendees/participants have tagged along with the Caitian 
Commanding Officer, dubbed as the 'Killer Kitty'. Amongst the crew currently aboard the USS Horizon you'll find a 
variety of crewmembers with different backgrounds and each having their own story to tell. But that's not all... </p>

<p align="justify">&quot;Task Force 58 - The Peacekeepers, is situated in the
<a title="Raeyan Sector" href="http://www.bfinfobase.org/index.php/Raeyan_Sector">
Raeyan Sector</a>, far from the heart of the Federation. In this area of space, 
an area which has known much war and many threats over the past ten years, there 
is little of the happy utopia of Earth, little of the contented citizens of Sol, 
little of the controlled security of the Alpha Quadrant. This is a frontier, a 
frontier that has asked Starfleet for its protection. Wars with the C'Hakilians 
ravaging the area, the presence of the Corporate Confederation trying to take 
advantage of the indigenous species, the pirates seeing the area as ripe for 
plucking, have all contributed to the sector being a dangerous and volatile 
place.&quot; </p>
<p align="justify">As part of Task Force 58, the USS Horizon 
holds true to Starfleet's primary mission of exploration and discovery, but 
considering the situation in the Rayean Sector we pull out the &quot;big 
guns&quot; to take care of business as necessary. As the Horizon's Commanding 
Officer with a background in security and piloting fighters, I am all for 
pulling out the 'big guns' and jumping into action, but I'm also aware of how 
sensitive the situation with the C'hakilians is, and that at times diplomacy 
might be the key. </p>
<p align="justify">It is up to Task Force 58 to keep the peace in the middle of 
the chaos, but can we keep the peace in the middle of the chaos that is constantly found aboard the Horizon itself? 
It is the USS Horizon, my centre of operations from where I oversee everything what's going on in Task Force 58 and the Raeyan Sector where the action takes place. I'm 
sure our adventures will be numerous and varied. From run-ins with the C'hakilians, to pirate ambushes and chases, betrayal 
and clashes amongst the crew, to diplomatic missions. You name it. We do it! </p>
<p align="justify">Feel free to browse the Horizon's website and our forums. Check out the crew manifest to see what's available 
and join our continuing adventures today!
<p align="justify">If you don't find something 
you are looking for on the manifest, or you have any questions and queries, please feel free to <a href="mailto:jess@taylord1.co.uk?subject=USS Horizon Website">e-mail me</a> directly.<p><img src='images/ship/ambas1.jpg' align="center"/><p>
We could <b>always</b> use another <font color="#FF0000"><b>nut</b></font> in our midst! <font color="#FF0000"><b>Join</b></font> us aboard the <b>USS Horizon</b> today!<p align="left">
<font face="Papyrus" color="#0000FF" size="4">
<i><b> Rear Admiral Jackie Clawson</b></i></font><br>
<b>Commanding Officer<br>
USS Horizon - A<br>
Task Force CO <br>
Task Force 58</b></td>
</tr>
<p>
<tr>
<td align='center'>&nbsp;</td>
</tr>
</table>
<p>
<p>
