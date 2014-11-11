<?php

$printjobs_config = [
   // Base path for logging
   'path' => '/home/sheil/www/PrintJobs',

    // Printer definitions
    'printers' => [
        ['name' => '2nd_Floor', 'ip' => '129.128.183.8'], 
        ['name' => '3rd_Floor_A', 'ip' => '129.128.183.22'],
        ['name' => '3rd_Floor_B', 'ip' => '129.128.183.21'],
        ['name' => '4th_Floor', 'ip' => '129.128.183.51'],
        ['name' => 'ESQ_5890', 'ip' => '142.244.15.5'],
    ],

    // The querystring that is concatenated to the end of the printer URL to view the current jobs.
    'jobs_path' => "jobs/active.php?tab=jobs",

    // An array of email addresses that should recieve notification if a printer is down.
    'send_to' => [
        "tpavlek@ualberta.ca",
	"sheil@ualberta.ca",
	"gjfink@ualberta.ca",
	"rmedeiro@ualberta.ca",

    ],

    // Time, in seconds, that a print job can remain at the top of the queue before an email is sent
    'max_stall_time' => 180,
];
