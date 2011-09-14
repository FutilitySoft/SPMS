<?php
// Start Sessions
session_start();
require_once("class/timer.php");
require_once("class/template.php");
$pgTimer = new timer();
// Check for a page reference 
if (!isset($_GET["pageref"]))
{
	$pageref='main';
}
else
{
	$pageref=$_GET["pageref"];
}
// Set Pagename
?>

<?php
switch ($pageref) {
	  case "bio" : $pagename = "Biography";
	  	break;
	  case "man" : $pagename = "Manifest";
	  	break;
	  default: $pagename = "Main";	
	}

// Get Configuration
include("include/conf.php");  // supress errors

// get header
include ("include/header.php");
include ("functions.inc.php");
?>
<table width='100%' border='0'>
<tr>
	<td width='120px' valign='top'>
	<!-- Get Menu -->
	<?php include("include/menu.php"); ?>
	</td>
	<td valign='top'>
	<!-- Do the content thing -->
	<?php
	switch ($pageref) {
	  case "apply":
	  include("application.php");
	  break;
	  
	  case "man":
	  include("manifest.php");
	  break;

	  case "apply2":
	  include("apply.php");
	  break;
	  
  	  case "bio":
	  include_once("bio.php");
	  break;
	  
	  default: 
	  if(isset($_GET["pageref"]))
	  {
	  	include("pages/".$_GET["pageref"].".php");
	  }
	  else
	  {
	  	include("pages/index.php");	
	  }
	}
	?>
	</td>
</tr>
</table>
<?php
// Include Page Footer
include("include/footer.php");
?>
