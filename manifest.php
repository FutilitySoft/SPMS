<?php /*
 * File Name: Manifest.php
 *
 * Purpose: to show the manifest of the RPG
 *
 * Author: Dan Taylor
 *
 * Date Created: 01/03/04
 *
 * Status: Alpha Code
 *
 */
 
/* Developement Information */ /* Position Type Key
 *
 * 0 = Position Available [Available]
 * 1 = Player Position [Not Available]
 * 2 = Owned Non Player Character [Not Available]
 * 3 = Non Player Character [Available]
 * 4 = LOA Player Character [Not Available]
 * 5 = ELOA Player Character [Not Available] / [Not Currently Used By SPMS]
 *
 */ ?> <!-- BEGIN PAGE TITLE --> <!-- div style="position:absolute; left:0px; top:0px; width:300px; height:60px;"> <span class="TopicTitle" align="center">CREW MANIFEST</span><br> <span class="t1">[ <a 
href="javascript:history.go(-1)">BACK</a> | <a href="javascript:history.go(+1)">NEXT</a> ]</span> </div --> <br><br><br><br> <!-- END PAGE TITLE --> <!-- BEGIN EDITABLE AREA --> <!-- BEGIN EDITABLE AREA --> <table align="center" 
width="90%" border="0"> <tr> <td> <p align="center" style="text-align: center"><font face="Tahoma" size="3">This page is graphic intensive. Please be patient and wait for it to fully load!</font></p> <p align="center" 
style="text-align: center"><font face="Tahoma" size="3">All NPC character positions are considered open unless they are protected NPCs. NPCs are characters created for everyone to use and interact with. A new player may take the 
position held by most NPCs at any time. If the character name is <font color="#4C6EFF"><b>this colour</b></font> then the NPC position is not available to apply for unless you speak with the CO first.</font></p> <p align="center" 
style="text-align: center">Normal Players are coloured <b> <font color="#FFFFFF">White </font></b><br> Protected NPCs are coloured <b> <font color="#4C6EFF"> Blue</font> </b> <br>Open NPCs are coloured in <b> <font 
color="#FFA500">Orange</font></b></p> <p align="center" style="text-align: center"><font face="Tahoma" size="3">Don't see a position that interests you? Please <a href="mailto:<?php echo $COemail; ?>">email the CO</a>.</font></p> 
</td> </tr> </table> <br clear="all"> 
<?php // Get sections first 
$sql = "SELECT id, clrtext, class FROM ".$prefix."_colors WHERE ".$prefix."_colors.viewid>0 ORDER BY ".$prefix."_colors.viewid ASC;"; $deptResult = 
mysql_query($sql) or die ("Error 1: ".mysql_error()." Query: ".$sql); $numdepts = mysql_num_rows($deptResult); while($dept = mysql_fetch_array($deptResult)) {
	echo "
	<table borderColor='#000000' border='0' width='510px' cellspacing='0' align='center'>
	<tr>
		<td class='".$dept["class"]."'>".$dept["clrtext"]."</td>
	</tr>
	<tr>
		<td>";
		// get crew from DB and display them
		echo "<table width='510px' border='0'>";
		// Get crew for this section
		$sql = "SELECT ".$prefix."_crewposition.crewid, ".$prefix."_crewposition.posid, ".$prefix."_crewposition.type FROM ".$prefix."_crewposition
						LEFT JOIN ".$prefix."_position ON ".$prefix."_position.posid=".$prefix."_crewposition.posid
						WHERE ".$prefix."_crewposition.colorid=".$dept["id"]."
						AND ".$prefix."_position.viewid>0
						ORDER BY ".$prefix."_position.viewid ASC;";
		$posResult = mysql_query($sql) or die("Error: ".mysql_error());
		
		if ($debug)
		{
			print "Developement Hack to show number of crew in each section: ".mysql_num_rows($posResult)."<br />";
		}
		if (!mysql_num_rows($posResult))
		{
			echo "<tr><th colspan='4'>No Positions</th></tr>";
		}
		else
		{
			echo "
			<tr>
				<td class='t0' width='115'>RANK/RATE</td>
				<td class='t0' width='323'>NAME/POSITION</td>
				<td class='t0' width='36'>BIO</td>
				<td class='t0' width='36'>HAIL</td>
			</tr>";
			
		while($pos = mysql_fetch_assoc($posResult))
		{
			switch ($pos["type"])
			{
			  case 5:
			    // ELOA
			    $sql = "SELECT ".$prefix."_rank.rankdesc, ".$prefix."_crew.firstname, ".$prefix."_crew.lastname,
						   ".$prefix."_rank.image, ".$prefix."_position.data as position,
						   ".$prefix."_crew.email, ".$prefix."_position.posid, ".$prefix."_position.viewid FROM ".$prefix."_crewposition
					RIGHT JOIN ".$prefix."_crew ON ".$prefix."_crewposition.crewid=".$prefix."_crew.crewid
					RIGHT JOIN ".$prefix."_rank ON ".$prefix."_rank.rankid=".$prefix."_crew.rank
					LEFT JOIN ".$prefix."_position ON ".$prefix."_position.posid=".$prefix."_crewposition.posid
					WHERE ".$prefix."_crew.crewid=".$pos["crewid"]." AND ".$prefix."_position.posid=".$pos["posid"];
			
				$crewResult = mysql_query($sql) or die("Crew Error: ".mysql_error());
				$crew = mysql_fetch_assoc($crewResult);
				
				echo "
				<tr>
					<td class='t1' height='30'><img src='images/".$crew["image"]."' /></td>
					<td class='t0' height='30'><strong>".stripslashes($crew["firstname"])." ".stripslashes($crew["lastname"])."</strong><br /><a href=\"javascript: 
PopupWindow('job.php?posid=".$crew["posid"]."')\" class='manifestpos'>".stripslashes($crew["position"])."</a></td>
					<td class='t1' height='30'><a href='main.php?pageref=bio&crewid=".$pos["crewid"]."' class='manifest'><img src='images/loa.gif' border='0' width='34' height='22'></a></td>
					<td class='t1' height='30'><a href='mailto:".$crew["email"]."' class='manifest'><img src='images/hailon.gif' border='0' width='28' height='30'></a></td>
				</tr>
				";
			  break;
			  
			  case 4:
			  	// Loa
			  	$sql = "SELECT ".$prefix."_crew.firstname, ".$prefix."_crew.lastname, ".$prefix."_rank.image, ".$prefix."_position.data as position,
						   ".$prefix."_crew.email, ".$prefix."_position.posid, ".$prefix."_position.viewid FROM ".$prefix."_crewposition
					RIGHT JOIN ".$prefix."_crew ON ".$prefix."_crewposition.crewid=".$prefix."_crew.crewid
					RIGHT JOIN ".$prefix."_rank ON ".$prefix."_rank.rankid=".$prefix."_crew.rank
					LEFT JOIN ".$prefix."_position ON ".$prefix."_position.posid=".$prefix."_crewposition.posid
					WHERE ".$prefix."_crew.crewid=".$pos["crewid"]." AND ".$prefix."_position.posid=".$pos["posid"];
			
				$crewResult = mysql_query($sql) or die("Crew Error: ".mysql_error());
				$crew = mysql_fetch_assoc($crewResult);
				
				echo "
				<tr>
					<td class='t1' height='30'><img src='images/".$crew["image"]."' /></td>
					<td class='t0' height='30'><strong>".stripslashes($crew["firstname"])." ".stripslashes($crew["lastname"])."</a></span></strong><br /><a href=\"javascript: 
PopupWindow('job.php?posid=".$crew["posid"]."')\" class='manifestpos'>".stripslashes($crew["position"])."</a></td>
					<td class='t1' height='30'><a href='main.php?pageref=bio&crewid=".$pos["crewid"]."' class='manifestloa'><img src='images/loa.gif' border='0' width='34' height='22'></a></td>
					<td class='t1' height='30'><a href='mailto:".$crew["email"]."' class='manifest'><img src='images/hailon.gif' border='0' width='28' height='30'></a></td>
				</tr>
				";
			  break;
			  
			  case 3:
			    // NPC - Applyable Job
			    $sql = "SELECT ".$prefix."_crew.firstname, ".$prefix."_crew.lastname, ".$prefix."_rank.image, ".$prefix."_position.data as position,
						   ".$prefix."_crew.email, ".$prefix."_position.posid, ".$prefix."_position.viewid FROM ".$prefix."_crewposition
					RIGHT JOIN ".$prefix."_crew ON ".$prefix."_crewposition.crewid=".$prefix."_crew.crewid
					RIGHT JOIN ".$prefix."_rank ON ".$prefix."_rank.rankid=".$prefix."_crew.rank
					LEFT JOIN ".$prefix."_position ON ".$prefix."_position.posid=".$prefix."_crewposition.posid
					WHERE ".$prefix."_crew.crewid=".$pos["crewid"]." AND ".$prefix."_position.posid=".$pos["posid"];
			
				$crewResult = mysql_query($sql) or die("Crew Error: ".mysql_error());
				$crew = mysql_fetch_assoc($crewResult);
				
				echo "
				<tr>
					<td class='t1' height='30'><img src='images/".$crew["image"]."' /></td>
					<td class='t0' height='30'><strong><a href='main.php?pageref=apply&posid=".$pos["posid"]."'>".stripslashes($crew["firstname"])." ".stripslashes($crew["lastname"])."</a></span></strong><br 
/><a href=\"javascript: PopupWindow('job.php?posid=".$crew["posid"]."')\" class='manifestpos'>".stripslashes($crew["position"])."</a></td>
					<td class='t1' height='30'><a href='main.php?pageref=bio&crewid=".$pos["crewid"]."' class='manifestnpc'><img src='images/npc.gif' border='0' width='34' height='22'></a></td>
					<td class='t1' height='30'><img src='images/hailoff.gif' border='0' width='28' height='30'></td>
				</tr>
				";
			  break;
			  case 2:
			  	// Owned NPC
			  	$sql = "SELECT ".$prefix."_crew.firstname, ".$prefix."_crew.lastname, ".$prefix."_rank.image, ".$prefix."_position.data as position,
						   ".$prefix."_crew.email, ".$prefix."_position.posid, ".$prefix."_position.viewid FROM ".$prefix."_crewposition
					RIGHT JOIN ".$prefix."_crew ON ".$prefix."_crewposition.crewid=".$prefix."_crew.crewid
					RIGHT JOIN ".$prefix."_rank ON ".$prefix."_rank.rankid=".$prefix."_crew.rank
					LEFT JOIN ".$prefix."_position ON ".$prefix."_position.posid=".$prefix."_crewposition.posid
					WHERE ".$prefix."_crew.crewid=".$pos["crewid"]." AND ".$prefix."_position.posid=".$pos["posid"];
			
				$crewResult = mysql_query($sql) or die("Crew Error: ".mysql_error());
				$crew = mysql_fetch_assoc($crewResult);
				
				echo "
				<tr>
					<td class='t1' height='30'><img src='images/".$crew["image"]."' /></td>
					<td class='t0' height='30'><strong><font color='#4C6EFF'>".stripslashes($crew["firstname"])." ".stripslashes($crew["lastname"])."</a></font></strong><br /><a href=\"javascript: 
PopupWindow('job.php?posid=".$crew["posid"]."')\" class='manifestpos'>".stripslashes($crew["position"])."</a></td>
					<td class='t1' height='30'><a href='main.php?pageref=bio&crewid=".$pos["crewid"]."' class='manifestnpc'><img src='images/npc.gif' border='0' width='34' height='22'></a></td>
					<td class='t1' height='30'><img border='0' src='../images/hailoff.gif' width='28' height='30' onMouseOver='window.status='Hail this Crewmember';return true;' onMouseOut='window.status='USS 
Farragut';return true;'></td>
				</tr>
				";
			  break;
			
			  case 1:
			  
			  	if ($pos["posid"] != $secoff)
				{
			  	// Valid Player, Display player information
				$sql = "SELECT ".$prefix."_crew.firstname, ".$prefix."_crew.lastname, ".$prefix."_rank.image, ".$prefix."_position.data as position,
						   ".$prefix."_crew.email, ".$prefix."_position.posid, ".$prefix."_position.viewid FROM ".$prefix."_crewposition
					RIGHT JOIN ".$prefix."_crew ON ".$prefix."_crewposition.crewid=".$prefix."_crew.crewid
					RIGHT JOIN ".$prefix."_rank ON ".$prefix."_rank.rankid=".$prefix."_crew.rank
					LEFT JOIN ".$prefix."_position ON ".$prefix."_position.posid=".$prefix."_crewposition.posid
					WHERE ".$prefix."_crew.crewid=".$pos["crewid"]." AND ".$prefix."_position.posid=".$pos["posid"];
			
				$crewResult = mysql_query($sql) or die("Crew Error: ".mysql_error());
				$crew = mysql_fetch_assoc($crewResult);
				
				
					echo "
					<tr>
 						<td class='t1' height='30'><img src='images/".$crew["image"]."' /></td>
						<td class='t0' height='30'><strong>".stripslashes($crew["firstname"])." ".stripslashes($crew["lastname"])."</a></strong><br /><a href=\"javascript: 
PopupWindow('job.php?posid=".$crew["posid"]."')\" class='manifestpos'>".stripslashes($crew["position"])."</a></td>
						<td class='t1' height='30'><a href='main.php?pageref=bio&crewid=".$pos["crewid"]."' class='manifest'><img src='images/bioon.gif' border='0' width='34' height='22'></a></td>
						<td class='t1' height='30'><a href='mailto:".$crew["email"]."' class='manifest'><img src='images/hailon.gif' border='0' width='28' height='30'></a></td>
					</tr>
					";
				}
				else
				{
					// Get User marked as second officer
					$sql = "SELECT ".$prefix."_crew.crewid, ".$prefix."_crew.firstname, ".$prefix."_crew.middlename, ".$prefix."_crew.lastname,
							   ".$prefix."_crew.email, ".$prefix."_rank.image, ".$prefix."_position.data as position
								   	FROM ".$prefix."_crew
								   	RIGHT JOIN ".$prefix."_rank ON ".$prefix."_rank.rankid=".$prefix."_crew.rank
								   	LEFT JOIN ".$prefix."_position ON ".$prefix."_position.posid=$secoff
								   	WHERE ".$prefix."_crew.secondofficer=1";
					
					$secondOfficerResult = mysql_query($sql) or die ("Could not query for second officer because mysql said: ".mysql_error());
					
					if (mysql_num_rows($secondOfficerResult))
					{
						$sec = mysql_fetch_assoc($secondOfficerResult);
						echo "
						<tr>
							<td class='t1' height='30'><img src='images/".$sec["image"]."' /></td>
							<td class='t0' height='30'><strong>".stripslashes($sec["firstname"])." ".stripslashes($sec["lastname"])."</a></strong><br /><a href=\"javascript: 
PopupWindow('job.php?posid=".$pos["posid"]."')\" class='manifestpos'>".stripslashes($sec["position"])."</a></td>
							<td class='t1' height='30'><a href='main.php?pageref=bio&crewid=".$sec["crewid"]."' class='manifest'><img src='images/bioon.gif' border='0' width='34' height='22'></a></td>
							<td class='t1' height='30'><a href='mailto:".$sec["email"]."'><img src='images/hailon.gif' border='0' width='28' height='30'></a></td>
						</tr>
						";
						mysql_free_result($secondOfficerResult);
						$sec = NULL;
					}
					else
					{
						// Show position not taken info
						$sql = "SELECT data as position, viewid FROM ".$prefix."_position WHERE ".$prefix."_position.posid=".$pos["posid"]." ORDER BY ".$prefix."_position.viewid ASC;";
						$crewResult = mysql_query($sql) or die("Error: ".mysql_error());
						$crew = mysql_fetch_assoc($crewResult);
						echo "
						<tr>
							<td class='t1' height='30'><img src='images/ranks/generic/blank.jpg' /></td>
							<td class='t0' height='30'><strong><a href='main.php?pageref=apply&posid=".$pos["posid"].">Position Available - Apply Today!</a></strong><br><a href=\"javascript: 
PopupWindow('job.php?posid=".$pos["posid"]."')\" class='manifestpos'>".stripslashes($crew["position"])."</a></td>
							<td class='t1' height='30'><img src='images/biooff.gif' border='0' width='34' height='22'></td>
							<td class='t1' height='30'><img src='images/hailoff.gif' border='0' width='28 height='30></td>
						</tr>";
					}
				}
			  break;
			  
			  default:
			    // 0 or an invalid selection, show position available
			 	
			 	$sql = "SELECT data as position, viewid FROM ".$prefix."_position WHERE ".$prefix."_position.posid=".$pos["posid"]." ORDER BY ".$prefix."_position.viewid ASC;";
				$crewResult = mysql_query($sql) or die("Error: ".mysql_error());
				$crew = mysql_fetch_assoc($crewResult);
				echo "
				<tr>
					<td class='t1' height='30'><img src='images/ranks/generic/blank.jpg' /></td>
					<td class='t0' height='30'><strong><a href='main.php?pageref=apply&posid=".$pos["posid"]."'>Position Available - Apply Today!</a></strong><br><a href=\"javascript: 
PopupWindow('job.php?posid=".$pos["posid"]."')\" class='manifestpos'>".stripslashes($crew["position"])."</a></td>
					<td class='t1' height='30'><img src='images/biooff.gif' border='0' width='34' height='22'></td>
					<td class='t1' height='30'><img src='images/hailoff.gif' border='0' width='28 height='30></td>
				</tr>";
			  break;
			}
			}
		}
		echo "</table>
		</td>
	</tr>
	</table>
	<br />
	";
}
?>
