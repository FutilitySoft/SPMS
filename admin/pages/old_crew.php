<?php
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

// SQL Query for this page, minus the type value
$sql = "SELECT ".$prefix."_crew.crewid, ".$prefix."_crew.firstname, ".$prefix."_crew.middlename, ".$prefix."_crew.lastname, ".$prefix."_position.data as position, ".$prefix."_crew.admin FROM ".$prefix."_crew 
		LEFT JOIN ".$prefix."_crewposition ON ".$prefix."_crewposition.crewid=".$prefix."_crew.crewid
		LEFT JOIN ".$prefix."_position ON ".$prefix."_position.posid=".$prefix."_crewposition.posid
		WHERE ".$prefix."_crewposition.crewid>0 AND ".$prefix."_crewposition.type=";
/* Position Type Key
 *
 * 0 = Position Available [Available]
 * 1 = Player Position [Not Available]
 * 2 = Owned Non Player Character [Not available]
 * 3 = Non Player Character [Available]
 * 4 = LOA Player Character
 * 
 */		
?>
<div align='center'>
<p><a href='switchboard.php?pageref=addcharacter'>Add Character</a></p>
</div>
<br />

<b>Active Crew</b>
<?php

$result = mysql_query($sql."1;") or die ("Could not query active character list.<br /> Error: ".mysql_error());
if (mysql_num_rows($result))
{
?>
<table>
<tr>
	<td>Position</td>
	<td>Name</td>
	<td>Second Officer/td>
	<td>Edit</td>
	<td>Delete</td>
	<td>Admin</td>
</tr>
<?php
while($active = mysql_fetch_assoc($result))
{
	echo "
	<tr>
		<td>".stripslashes($active["position"])."</td>
		<td>".stripslashes($active["firstname"])." ".stripslashes($active["middlename"])." ".stripslashes($active["lastname"])."</td>
		<td></td>
		<td><a href='switchboard.php?pageref=editcharacter&op=edit&id=".$active["crewid"]."'>Edit</a></td>";
	
	if ($active["crewid"] == 1)
	{
		echo "<td>&nbsp;</td><td>&nbsp;</td>";	
	}
	else
	{
		echo "<td><a href='switchboard.php?pageref=deletecharacter&op=del&id=".$active["crewid"]."'>Delete</a></td>";
			
		if ($active["admin"])
		{
			echo "<td><a href='switchboard.php?pageref=adminuser&id=".$active["crewid"]."'>Administrator</a></td>";
		}
		else
		{
			echo "<td><a href='switchboard.php?pageref=adminuser&id=".$active["crewid"]."'>User</a></td>";
		}
	}
	echo "</tr>";
}
?>
</table>
<?php
} else {
	echo "<h2 align='center'>No Active Characters</h2>";
}
?>

<b>Crew on Leave Of Absence</b>
<?php

$result = mysql_query($sql."4;") or die ("Could not query active character list.<br /> Error: ".mysql_error());
if (mysql_num_rows($result))
{
?>
<table>
<tr>
	<td>Position</td>
	<td>Name</td>
	<td>Edit</td>
	<td>Delete</td>
	<td>Admin</td>
</tr>
<?php
while($loa = mysql_fetch_assoc($result))
{
	echo "
	<tr>
		<td>".stripslashes($loa["position"])."</td>
		<td>".stripslashes($loa["firstname"])." ".stripslashes($loa["middlename"])." ".stripslashes($loa["lastname"])."</td>
		<td><a href='switchboard.php?pageref=editcharacter&op=edit&id=".$loa["crewid"]."'>Edit</a></td>";
	
	if ($loa["crewid"] == 1)
	{
		echo "<td>&nbsp;</td><td>&nbsp;</td>";	
	}
	else
	{
		if (!$loa["crewid"] == 1)
		{
			echo "<td><a href='switchboard.php?pageref=deletecharacter&op=del&id=".$loa["crewid"]."'>Delete</a></td>";
		}
		else
		{
			echo "<td>&nbsp;</td>";
		}
		
		if ($loa["admin"])
		{
			echo "<td><a href='switchboard.php?pageref=adminuser&id=".$loa["admin"]."'>Administrator</a></td>";
		}
		else
		{
			echo "<td><a href='switchboard.php?pageref=adminuser&id=".$loa["admin"]."'>User</a></td>";
		}
	}
	
	echo "</tr>";
}
}
else
{
	echo "<h2 align='center'>No Crew LOA</h2>";
}
?>
</table>
<b>Inactive Crew</b>
<?php

$result = mysql_query($sql."0;") or die ("Could not query active character list.<br /> Error: ".mysql_error());
if (mysql_num_rows($result))
{
?>
<table>
<tr>
	<td>Position</td>
	<td>Name</td>
	<td>Edit</td>
	<td>Delete</td>
	<td>Admin</td>
</tr>
<?php
while($inactive = mysql_fetch_assoc($result))
{
	echo "
	<tr>
		<td>".stripslashes($inactive["position"])."</td>
		<td>".stripslashes($inactive["firstname"])." ".stripslashes($inactive["middlename"])." ".stripslashes($inactive["lastname"])."</td>
		<td><a href='switchboard.php?pageref=editcharacter&op=edit&id=".$inactive["crewid"]."'>Edit</a></td>";
	
	if ($inactive["crewid"] == 1)
	{
		echo "<td>&nbsp;</td><td>&nbsp;</td>";	
	}
	else
	{
	
		echo "<td><a href='switchboard.php?pageref=deletecharacter&op=del&id=".$inactive["crewid"]."'>Delete</a></td>";
		
		if ($inactive["admin"])
		{
			echo "<td><a href='switchboard.php?pageref=adminuser&id=".$inactive["admin"]."'>Administrator</a></td>";
		}
		else
		{
			echo "<td><a href='switchboard.php?pageref=adminuser&id=".$inactive["admin"]."'>User</a></td>";
		}
	}
	echo "</tr>";
}
}
else
{
	echo "<h2 align='center'>No Inactive Crew</h2>";
}
?>
</table>

<b>Non Player Character Crew</b>
<?php

$result = mysql_query($sql."3;") or die ("Could not query active character list.<br /> Error: ".mysql_error());
if (mysql_num_rows($result))
{
?>
<table>
<tr>
	<td>Position</td>
	<td>Name</td>
	<td>Edit</td>
	<td>Delete</td>
	<td>Admin</td>
</tr>
<?php
while($loa = mysql_fetch_assoc($result))
{
	echo "
	<tr>
		<td>".stripslashes($loa["position"])."</td>
		<td>".stripslashes($loa["firstname"])." ".stripslashes($loa["middlename"])." ".stripslashes($loa["lastname"])."</td>
		<td><a href='switchboard.php?pageref=editcharacter&op=edit&id=".$loa["crewid"]."'>Edit</a></td>";
	
	if ($loa["crewid"] == 1)
	{
		echo "<td>&nbsp;</td><td>&nbsp;</td>";	
	}
	else
	{
		echo "<td><a href='switchboard.php?pageref=deletecharacter&op=del&id=".$loa["crewid"]."'>Delete</a></td>";
		
		if ($loa["admin"])
		{
			echo "<td><a href='switchboard.php?pageref=adminuser&id=".$loa["admin"]."'>Administrator</a></td>";
		}
		else
		{
			echo "<td><a href='switchboard.php?pageref=adminuser&id=".$loa["admin"]."'>User</a></td>";
		}
	}
	echo "</tr>";
}
}
else
{
	echo "<h2 align='center'>No NPC Crew</h2>";
}
?>
<b>Player Played Character Crew</b>
<?php

$result = mysql_query($sql."2;") or die ("Could not query active character list.<br /> Error: ".mysql_error());
if (mysql_num_rows($result))
{
?>
<table>
<tr>
	<td>Position</td>
	<td>Name</td>
	<td>Edit</td>
	<td>Delete</td>
	<td>Admin</td>
</tr>
<?php
while($ppc = mysql_fetch_assoc($result))
{
	echo "
	<tr>
		<td>".stripslashes($ppc["position"])."</td>
		<td>".stripslashes($ppc["firstname"])." ".stripslashes($ppc["middlename"])." ".stripslashes($ppc["lastname"])."</td>
		<td><a href='switchboard.php?pageref=editcharacter&op=edit&id=".$ppc["crewid"]."'>Edit</a></td>";
	if ($ppc["crewid"] == 1)
	{
		echo "<td>&nbsp;</td><td>&nbsp;</td>";	
	}
	else
	{
		echo "<td><a href='switchboard.php?pageref=deletecharacter&op=del&id=".$ppc["crewid"]."'>Delete</a></td>";
	
		if ($ppc["admin"])
		{
			echo "<td><a href='switchboard.php?pageref=adminuser&id=".$ppc["admin"]."'>Administrator</a></td>";
		}
		elseif (!$ppc["admin"])
		{
			echo "<td><a href='switchboard.php?pageref=adminuser&id=".$ppc["admin"]."'>User</a></td>";
		}
	}	
	echo "</tr>";
}
}
else
{
	echo "<h2 align='center'>No PPC Crew</h2>";
}
?>
