<?php
function generatePassword()
{
	$password_size = 6;
	$pwd_array[] = "A";
	$pwd_array[] = "B";
	$pwd_array[] = "C";
	$pwd_array[] = "D";
	$pwd_array[] = "E";
	$pwd_array[] = "F";
	$pwd_array[] = "G";
	$pwd_array[] = "H";
	$pwd_array[] = "I";
	$pwd_array[] = "J";
	$pwd_array[] = "K";
	$pwd_array[] = "L";
	$pwd_array[] = "M";
	$pwd_array[] = "N";
	$pwd_array[] = "O";
	$pwd_array[] = "P";
	$pwd_array[] = "Q";
	$pwd_array[] = "R";
	$pwd_array[] = "S";
	$pwd_array[] = "T";
	$pwd_array[] = "U";
	$pwd_array[] = "V";
	$pwd_array[] = "W";
	$pwd_array[] = "X";
	$pwd_array[] = "Y";
	$pwd_array[] = "Z";
	$pwd_array[] = "a";
	$pwd_array[] = "b";
	$pwd_array[] = "c";
	$pwd_array[] = "d";
	$pwd_array[] = "e";
	$pwd_array[] = "f";
	$pwd_array[] = "g";
	$pwd_array[] = "h";
	$pwd_array[] = "i";
	$pwd_array[] = "j";
	$pwd_array[] = "k";
	$pwd_array[] = "l";
	$pwd_array[] = "m";
	$pwd_array[] = "n";
	$pwd_array[] = "o";
	$pwd_array[] = "p";
	$pwd_array[] = "q";
	$pwd_array[] = "r";
	$pwd_array[] = "s";
	$pwd_array[] = "t";
	$pwd_array[] = "u";
	$pwd_array[] = "v";
	$pwd_array[] = "w";
	$pwd_array[] = "x";
	$pwd_array[] = "y";
	$pwd_array[] = "z";
	$pwd_array[] = "0";
	$pwd_array[] = "1";
	$pwd_array[] = "2";
	$pwd_array[] = "3";
	$pwd_array[] = "4";
	$pwd_array[] = "5";
	$pwd_array[] = "6";
	$pwd_array[] = "7";
	$pwd_array[] = "8";
	$pwd_array[] = "9";
	$i = 0; // Loop Var
	$password = ""; // Password
	
	for ($i =0; $i < $password_size; $i++)
	{
		$password .= $pwd_array[rand(0, sizeof($pwd_array))];
	}
	
	return $password;
}

function doQuote($align, $dbprefix)
{
	// Get random quote
	$query = "SELECT count(*) as count FROM ".$dbprefix."_quotes;";
	$result = mysql_query($query);
	$numquotes = mysql_fetch_array($result);

	if ($numquotes["count"])
	{
		$randNum = rand (1, $numquotes["count"]);

		$query = "SELECT ".$dbprefix."_quotes.quote, ".$dbprefix."_crew.firstname, ".$dbprefix."_crew.lastname, ".$dbprefix."_rank.rankdesc FROM ".$dbprefix."_quotes
				  LEFT JOIN ".$dbprefix."_crew ON ".$dbprefix."_crew.crewid=".$dbprefix."_quotes.crewid 
				  LEFT JOIN ".$dbprefix."_rank ON ".$dbprefix."_rank.rankid=".$dbprefix."_crew.rank
		  		  WHERE ".$dbprefix."_quotes.id='".$randNum."';";
		// echo $query;
		$result = mysql_query($query) or die("Error: ".mysql_error());
		$quote = mysql_fetch_array($result);

		mysql_free_result($result);

echo "<table width=\"500px\" align=\"$align\">
<tr>
	<td class=\"quote\"><b>Character Quote:</b> <i>".$quote["quote"]."</i><span class=\"quotee\"> ~ ".$quote["rankdesc"]." ".$quote["firstname"]." ".$quote["lastname"]."</span></td>
</tr>
</table>";
	}
}

function reverse_htmlentities($mixed)
{
   $htmltable = get_html_translation_table(HTML_ENTITIES);
   foreach($htmltable as $key => $value)
   {
       $mixed = ereg_replace(addslashes($value),$key,$mixed);
   }
   return $mixed;
}
?>
