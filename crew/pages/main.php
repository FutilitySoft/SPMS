<h2 align='center'>Switchboard - Home</h2>
<p>Welcome to the <?php echo $shipname; ?>'s Crew Panel, this area of the site will allow you to access some of the more advanced functions of the site.</p>

<?php
/* Crew Statistics */
// Total Characters
$sql = "SELECT crewid FROM ".$prefix."_crewposition WHERE crewid>0;";
$totalResult = mysql_query($sql) or die ("Could not query database: ".mysql_error());

// Total Player Characters
$sql = "SELECT crewid FROM ".$prefix."_crewposition WHERE type=1;";
$playerResult = mysql_query($sql) or die ("Could not query database: ".mysql_error());

// No LOA's
$sql = "SELECT count(*) FROM ".$prefix."_crewposition WHERE type=4;";
$loaResult = mysql_query($sql) or die ("Could not query database: ".mysql_error());

// NO NPC's
$sql = "SELECT count(*) FROM ".$prefix."_crewposition WHERE type=2 OR type=3;";
$totalResult = mysql_query($sql) or die ("Could not query database: ".mysql_error());
?>
