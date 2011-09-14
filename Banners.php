<?php

$url[] = "http://www.usshorizon.org/images/banner/Image4.gif";

$url[] = "http://www.usshorizon.org/images/banner/horiz4.jpg";

$url[] = "http://www.usshorizon.org/images/banner/horizontop.jpg";

$url[] = "http://www.usshorizon.org/images/banner/horz3.jpg";

$url[] = "http://www.usshorizon.org/images/banner/horiz5.jpg";

$url[] = "http://www.usshorizon.org/images/banner/horiz6.jpg";

$url[] = "http://www.usshorizon.org/images/banner/horizd.jpg";

$url[] = "http://www.usshorizon.org/images/banner/horizk.jpg";

srand ((double)microtime()*1000000);

$randomnum = rand(0, count($url)-1);

header ("Location: $url[$randomnum]");

?>
