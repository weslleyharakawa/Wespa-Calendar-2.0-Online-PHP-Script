<?
/*
	=================================================================
	# Online Calendar WESPA CALENDAR 2.0
	# Author / Coder: Weslley A. Harakawa
	# weslley@wcre8tive.com
	#
	# PHP Script and SQL source.
	# Copyright © 2014. Wcre8tive // Weslley A. Harakawa. All rights reserved.
	=================================================================
*/ 
session_start();
require("config.php");
require("./lang/lang." . LANGUAGE_CODE . ".php");
require("functions.php");

$month 	= (int) $HTTP_GET_VARS['month'];
$year 	= (int) $HTTP_GET_VARS['year'];

// set month and year to present if month
// and year not received from query string
$m = (!$month) ? date("n") : $month;
$y = (!$year) ? date("Y") : $year;

$scrollarrows	= scrollArrows($m, $y);
$auth 			= auth();

require("./templates/" . TEMPLATE_NAME . ".php");
?>