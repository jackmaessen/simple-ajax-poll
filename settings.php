<?php

// GENERAL SETTINGS
$quickpolloptions = ['Firefox', 'Chrome', 'Opera', 'IE', 'Safari']; // set your own vote options here
$quickpolltype = "checkbox"; // set to "radio" or "checkbox"; radio is one choice, checkbox is multiple choices
$quickpollheader = "What is your favorite browser?"; // the question or header


// EXPIRATION SETTINGS
$quickpollexpire = true; // if you want an expiration date for the poll; set to 'true'; otherwise 'false'. When true: fill in date below
$quickpollexpirationdate  = strtotime("August 19, 2016 23:51:00"); // set an expiration date
$expirationtext = 'Poll expired!'; // text appears when poll is expired

/* RESET a POLL:
Reset results: delete file "vote_result.txt" in data folder
Reset ip address of users: delete file "user_ip.txt" in data folder */


// DO NOT EDIT BELOW
$currenttime = strtotime("now");


