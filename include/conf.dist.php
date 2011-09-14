<?php
    /* SPMS Database Connection Info */
        $dbname = "spms"; // SPMS Database
        /* THIS IS USUALLY CALLED localhost */
        $dbserv = "localhost";

        /* DATABASE USERNAME IN HERE */
        $dbuser = ""; // For SPMS

        /* PASSWORD TO DATABASE */
        $dbpass = "";

        /* Table prefix */
        $prefix = "spms";

        /* Second Officer Position ID */
        $secoff = 3; // Do not edit unless you've removed the second officer entry from the crew database and re-added it.

        /* RPG SHIP OR STARBASE NAME */
        /* Ship Info */
        $shipname = "Your game";

        /* CO/XO email address for joining */
        $COemail = "me@example.com";
        $XOemail = "";

        /* CO and XO names for the front pages */
        $COname = "Your Character";
        $XOname = "";

        /* Place for added people to email for joining form should be comma seperated */
        $OTHERemail = "";

        /* Meta Info */

        $keywords = "";
        $description = "";
        $webmaster = "me@example.com";

        $domain = "http://host.tld/";

    /* Development Variables */

    $debug = 0; /* Debug Status: 0 == Release, 1 == Debug Mode */

        /* Connect to server */
        $link = mysql_connect($dbserv, $dbuser, $dbpass)
                       or die("Could not connect to $dbserv");
        mysql_select_db($dbname,$link) or die("Could not connect to $dbname");
?>