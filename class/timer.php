<?php
/************************************************************************/
/* giztimer.inc.php                                                     */
/* ===========================                                          */
/* Copyright (c) 2003 by David Rolston  (gizmo@gizmola.com)             */
/* http://www.gizmola.com                                               */
/*                                                                      */
/* This program is free software. You can redistribute it and/or modify */
/* it under the terms of the GNU General Public License as published by */
/* the Free Software Foundation; either version 2 of the License.       */
/************************************************************************/
//
// Credit to Brian Grayless for some of the ideas used in the class,
// particularly the Show_Timer() function, based on his note in the
// php.net microtime() manual page.
//
// Use:
// // Create a timer object.  At creation, Start time is recorded
// $t1 = new timer();
// // When code or section of code is complete, stop the timer.
// $t1->Stop_Timer();
// // Display the Elapsed Time in seconds.  Defaults to 2 decimal places
// // or override the display by passing a parameter.
// $t1->Show_Timer(4);
/************************************************************************/
class timer {
    var $starttime;
    var $endtime;
    // Constructor.  
    // Purpose: Starts Timer.
       function timer() {
           $this->starttime = microtime();
           return true;
    }
    // Member Function: Stop_Timer
    // Purpose: Stop Timing.
    function Stop_Timer() {
          $this->endtime = microtime();
        return true;
      }
    // Member Function: Show_Timer
    // Purpose: Display elapsed time in seconds to precision passed in optional parameter
       function Show_Timer($decimals=2) {
        // $decimals will set the number of decimals you want for your milliseconds.
           // format start time
        $decimals = intval($decimals);
        if ($decimals > 8)
          $decimals = 8;
        if ($decimals < 0)
          $decimals = 0;
        $endtime = explode(" ", $this->endtime);
           $endtime = (float)$endtime[1] + (float)$endtime[0];
           $starttime = explode (" ", $this->starttime);
           $starttime = (float)$starttime[1] + (float)$starttime[0];
        return number_format($endtime - $starttime, $decimals);
   }
       // Member Function: Stop_Show_Timer
    // Purpose: Stop the timer and Display elapsed time in seconds to precision passed in optional parameter
   function Stop_Show_Timer($decimals=2) {
     $this->Stop_Timer();
     return $this->Show_Timer($decimals);
   }
}
?>