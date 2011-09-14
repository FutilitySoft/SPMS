<?	
        //include("setup/conf.php");	
	//include("include/header.php");	
	$qry = "UPDATE crew SET psd='" . $desc . "'" .
		",bio='" . $bio . "' WHERE crewid=" . $crewid;
	$result = mysql_query($qry,$link) 

		or die(mysql_error() . "<br><br>" . $qry);
	//mysql_close($link);//

?>
<h2 align='center'>Bio Updated</h2>
<?php include("bio_template.php"); ?>
