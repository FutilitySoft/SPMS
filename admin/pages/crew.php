<?php
if(!defined("IN_ADMIN"))
{
	die("Direct access is not allowed!");
}
/*
 * File Name: addcharacter.php
 *
 * Purpose: to allow the addition of new character without using the join form.
 *
 * Author: Dan Taylor
 *
 * Date Created: 01/05/04
 *
 */
 
function crewStatus($id)
{
	switch ($id) {
		case 4:
			return "LOA";
		case 3:
			return "NPC";
		case 2:
			return "PPC";
		case 1:
			return "Player";
		default: // Or 0
			return "Inactive Character";
	
	}
}

// SQL Query for this page, minus the type value
$sql = "SELECT 	".$prefix."_crew.crewid, ".$prefix."_crew.firstname, ".$prefix."_crew.lastname, 
				".$prefix."_position.data as position, ".$prefix."_crew.admin, 
				".$prefix."_crewposition.type as status, ".$prefix."_crew.secondofficer
		FROM ".$prefix."_crew 
		LEFT JOIN ".$prefix."_crewposition ON ".$prefix."_crewposition.crewid=".$prefix."_crew.crewid
		LEFT JOIN ".$prefix."_position ON ".$prefix."_position.posid=".$prefix."_crewposition.posid
		WHERE ".$prefix."_crewposition.crewid>0
		ORDER BY ".$prefix."_crewposition.posid";
		
/* Position Type Key
 *
 * 0 = Position Available [Available]
 * 1 = Player Position [Not Available]
 * 2 = Owned Non Player Character [Not available]
 * 3 = Non Player Character [Available]
 * 4 = LOA Player Character
 * 
 */		
 
$crewResult = mysql_query($sql) or die ("could not query database because mysql said: ".mysql_error());
?>
<div align='center'>
<p><a href='switchboard.php?pageref=addcharacter'>Add Character</a></p>
<p>Note: Users in italic are new users</p>
</div>
<br />
<div align="center">
<table border="1" width="780px">
<tr>
	<th>Position</th>
	<th>Name</th>
	<th>Status</th>
	<th>Password</th>
	<th>2nd Officer</th>
	<th>Edit</th>
	<th>Delete</th>
	<th>Administrator</th>
</tr>
<?php
$i = 0;
while($crew = mysql_fetch_assoc($crewResult))
{
	echo "
	<tr>
		<td align=\"center\">".$crew["position"]."</td>
		<td align=\"center\">".stripslashes($crew["firstname"])." ".stripslashes($crew["lastname"])."</td>
		<td align=\"center\">".crewStatus($crew["status"])."</td>
		<td align=\"center\"><a href=\"switchboard.php?pageref=password&id=".$crew["crewid"]."\">Reset</a></td>
		<td align=\"center\">";
		if ($crew["secondofficer"])
		{
			echo "<a href=\"switchboard.php?pageref=2xo&id=".$crew["crewid"]."&op=del\">Yes</a>";
		}
		else
		{
			echo "<a href=\"switchboard.php?pageref=2xo&id=".$crew["crewid"]."&op=add\">No</a>";
		}
		echo "</td>
		<td align=\"center\"><a href=\"switchboard.php?pageref=editcharacter&op=edit&id=".$crew["crewid"]."\">Edit</a></td>
		<td align=\"center\"><a href=\"switchboard.php?pageref=deletecharacter&id=".$crew["crewid"]."\">Delete</a></td>
		<td align=\"center\">";
		if ($crew["admin"])
		{
			echo "<a href=\"switchboard.php?pageref=admin&id=".$crew["crewid"]."\">Admin<a/>";
		}
		else
		{
			echo "<a href=\"switchboard.php?pageref=admin&id=".$crew["crewid"]."\">User<a/>";
		}
		echo "</td>
	</tr>
	";
}

$sql = "SELECT ".$prefix."_inactive.crewid, ".$prefix."_inactive.posid, ".$prefix."_crew.firstname, 
				".$prefix."_crew.lastname, ".$prefix."_position.data as position, 
				".$prefix."_crew.admin, ".$prefix."_crewposition.type as status, ".$prefix."_crew.secondofficer,
				".$prefix."_inactive.new
		FROM ".$prefix."_inactive
		LEFT JOIN ".$prefix."_crew ON ".$prefix."_crew.crewid=".$prefix."_inactive.crewid
		LEFT JOIN ".$prefix."_position ON ".$prefix."_position.posid=".$prefix."_inactive.posid
		LEFT JOIN ".$prefix."_crewposition ON ".$prefix."_crewposition.crewid=".$prefix."_inactive.crewid;";

$inactiveResult = mysql_query($sql) or die ("Could not query inactive users: ".mysql_error());

if (mysql_num_rows($inactiveResult))
{
	while ($crew = mysql_fetch_assoc($inactiveResult))
	{
		echo "<tr>";
			if ($crew["new"])
			{
				echo "
					<td align=\"center\"><i>".$crew["position"]."</i></td>
					<td align=\"center\"><i>".stripslashes($crew["firstname"])." ".stripslashes($crew["lastname"])."</i></td>
					<td align=\"center\"><i>".crewStatus($crew["status"])."</i></td>
					<td align=\"center\"><a href=\"switchboard.php?pageref=password&id=".$crew["crewid"]."\">Reset</a></td>
					<td align=\"center\">";
					if ($crew["secondofficer"])
					{
						echo "<i><a href=\"switchboard.php?pageref=2xo&id=".$crew["crewid"]."\">Yes</a></i>";
					}
					else
					{
						echo "<i><a href=\"switchboard.php?pageref=2xo&id=".$crew["crewid"]."\">No</a></i>";
					}
					echo "</td>	
					<td align=\"center\"><i><a href=\"switchboard.php?pageref=editcharacter&op=edit&id=".$crew["crewid"]."\">Edit</a></i></td>
					<td align=\"center\"><i><a href=\"switchboard.php?pageref=deletecharacter&id=".$crew["crewid"]."\">Delete</a></i></td>
					<td align=\"center\">";
					if ($crew["admin"])
					{
						echo "<i><a href=\"switchboard.php?pageref=adminuser&id=".$crew["crewid"]."\">Admin<a/></i>";
					}
					else
					{
						echo "<i><a href=\"switchboard.php?pageref=adminuser&id=".$crew["crewid"]."\">User<a/></i>";
					}
				echo "</td>";
			}
			else
			{
				echo "
					<td align=\"center\">".$crew["position"]."</td>
					<td align=\"center\">".stripslashes($crew["firstname"])." ".stripslashes($crew["lastname"])."</td>
					<td align=\"center\">".crewStatus($crew["status"])."</td>
					<td align=\"center\"><a href=\"switchboard.php?pageref=password&id=".$crew["crewid"]."\">Reset</a></td>
					<td align=\"center\">";
					if ($crew["secondofficer"])
					{
						echo "<a href=\"switchboard.php?pageref=2xo&id=".$crew["crewid"]."\">Yes</a>";
					}
					else
					{
						echo "<a href=\"switchboard.php?pageref=2xo&id=".$crew["crewid"]."\">No</a>";
					}
					echo "</td>	
					<td align=\"center\"><a href=\"switchboard.php?pageref=editcharacter&op=edit&id=".$crew["crewid"]."\">Edit</a></td>
					<td align=\"center\"><a href=\"switchboard.php?pageref=deletecharacter&id=".$crew["crewid"]."\">Delete</a></td>
					<td align=\"center\">";
					if ($crew["admin"])
					{
						echo "<a href=\"switchboard.php?pageref=adminuser&id=".$crew["crewid"]."\">Admin<a/>";
					}
					else
					{
						echo "<a href=\"switchboard.php?pageref=adminuser&id=".$crew["crewid"]."\">User<a/>";
					}
				echo "</td>";
			}
		echo "
		</tr>
		";
	}
}

?>
</table>
</div>
