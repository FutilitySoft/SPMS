<?php

$url[] = "http://horizon.taylord1.co.uk/images/banner/horz3.jpg";

$url[] = "http://horizon.taylord1.co.uk/images/banner/horiz6.jpg";

$url[] = "http://horizon.taylord1.co.uk/images/banner/qun.jpg";

$url[] = "http://horizon.taylord1.co.uk/images/banner/horiz5.jpg";

$url[] = "http://horizon.taylord1.co.uk/images/banner/q2.png";

$url[] = "http://horizon.taylord1.co.uk/images/banner/horiz4.jpg";

$url[] = "http://horizon.taylord1.co.uk/images/banner/banner1.jpg";

$url[] = "http://horizon.taylord1.co.uk/images/banner/banner2.jpg";

$url[] = "http://horizon.taylord1.co.uk/images/banner/banner3.jpg";

$url[] = "http://horizon.taylord1.co.uk/images/banner/banner4.jpg";

$url[] = "http://horizon.taylord1.co.uk/images/banner/banner5.jpg";

$url[] = "http://horizon.taylord1.co.uk/images/banner/banner6.jpg";

$url[] = "http://horizon.taylord1.co.uk/images/banner/banner7.jpg";

$url[] = "http://horizon.taylord1.co.uk/images/banner/banner7a.jpg";

$url[] = "http://horizon.taylord1.co.uk/images/banner/banner8.jpg";

$url[] = "http://horizon.taylord1.co.uk/images/banner/banner10.jpg";

$url[] = "http://horizon.taylord1.co.uk/images/banner/banner11.jpg";

$url[] = "http://horizon.taylord1.co.uk/images/banner/qun1.jpg";

$url[] = "http://horizon.taylord1.co.uk/images/banner/sucks5at.gif";

$url[] = "http://horizon.taylord1.co.uk/images/banner/romulan7kz.gif";

$url[] = "http://horizon.taylord1.co.uk/images/banner/fe29xi.gif";

$url[] = "http://horizon.taylord1.co.uk/images/banner/fe11sf.gif";

$url[] = "http://horizon.taylord1.co.uk/images/banner/flight%20II%201.jpg";

$url[] = "http://horizon.taylord1.co.uk/images/banner/flight%20II%202.jpg";

$url[] = "http://horizon.taylord1.co.uk/images/banner/flight%20II%203.jpg";

$url[] = "http://horizon.taylord1.co.uk/images/banner/flight%20II%204.jpg";

$url[] = "http://horizon.taylord1.co.uk/images/banner/flight%20II%205.jpg";

$url[] = "http://horizon.taylord1.co.uk/images/banner/flight%20II%206.jpg";

$url[] = "http://www.sloganizer.net/en/style2,Task-spc-Force-spc-58.png";

$url[] = "http://www.sloganizer.net/en/style4,Task-spc-Force-spc-58.png";

$url[] = "http://www.sloganizer.net/en/style6,Task-spc-Force-spc-58.png";

srand ((double)microtime()*1000000);

$randomnum = rand(0, count($url)-1);

header ("Location: $url[$randomnum]");

?>
