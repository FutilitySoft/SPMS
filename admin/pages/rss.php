<?php
require("magpie/rss_fetch.inc");
$url = "http://rss.groups.yahoo.com/group/ussronaldreagan/rss";
$rss = fetch_rss($url);
?>
<h2 align='center'>USS Ronald Reagan RSS Feed</h2>
<p>Here is the RSS feed from the Reagan's Yahoo Group, on this page you can see quick links ot the last few Ronny Posts.</p>
<?php
// Set I
$i = 0;
// Test print out
foreach ($rss->items as $item ) 
{
echo "
<table width='500px' align='center'>
<tr>
	<td class='rss' align='center'><a href='".$item["link"]."' target='_blank' class='rss' id='rss'>".$item["title"]."</a></td>
</tr>
<tr>
	<td class='rss'>".nl2br($item["description"])."</td>
</tr>
<tr>
	<td class='rss' align='right'>Posted: ".$item["pubdate"]."</td>
</tr>
</table>
<br />";
	$i++;
}
?>
