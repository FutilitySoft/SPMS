<?php

$url[] = "http://horizon.taylord1.co.uk/images/avatars/avatar1.jpg";

$url[] = "http://horizon.taylord1.co.uk/images/avatars/avatar2.gif";

$url[] = "http://horizon.taylord1.co.uk/images/avatars/avatar3.jpg";

$url[] = "http://horizon.taylord1.co.uk/images/avatars/avatar4.gif";

$url[] = "http://horizon.taylord1.co.uk/images/avatars/avatar5.gif";

$url[] = "http://horizon.taylord1.co.uk/images/avatars/avatar6.jpg";

$url[] = "http://horizon.taylord1.co.uk/images/avatars/avatar7.jpg";

$url[] = "http://horizon.taylord1.co.uk/images/avatars/avatar8.jpg";

$url[] = "http://horizon.taylord1.co.uk/images/avatars/avatar9.jpg";

$url[] = "http://horizon.taylord1.co.uk/images/avatars/avatar10.png";

$url[] = "http://horizon.taylord1.co.uk/images/avatars/avatar11.jpg";

$url[] = "http://horizon.taylord1.co.uk/images/avatars/avatar12.gif";

$url[] = "http://horizon.taylord1.co.uk/images/avatars/avatar13.jpg";

$url[] = "http://horizon.taylord1.co.uk/images/avatars/avatar14.jpg";

$url[] = "http://horizon.taylord1.co.uk/images/avatars/tf93logo.jpg";

srand ((double)microtime()*1000000);

$randomnum = rand(0, count($url)-1);

header ("Location: $url[$randomnum]");

?>
