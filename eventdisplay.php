<?
/*
	=================================================================
	# Online Calendar WESPA CALENDAR 2.0
	# Author / Coder: Weslley A. Harakawa
	# weslley@wcre8tive.com
	#
	# PHP Script and SQL source.
	# Copyright � 2014. Wcre8tive // Weslley A. Harakawa. All rights reserved.
	=================================================================
*/ 
session_start();
require("config.php");
require("./lang/lang." . LANGUAGE_CODE . ".php");
require("functions.php");

$id 	= (int) $HTTP_GET_VARS['id'];
$auth	= auth();

mysql_connect(DB_HOST, DB_USER, DB_PASS) or die(mysql_error());
mysql_select_db(DB_NAME) or die(mysql_error());

$sql = "SELECT d, m, y FROM " . DB_TABLE_PREFIX . "mssgs WHERE id=" . $id;
$result = mysql_query($sql) or die(mysql_error());
$row = mysql_fetch_array($result);

$d 			= $row["d"];
$m 			= $row["m"];
$y 			= $row["y"];
$dateline 	= "$d de "  . $lang['months'][$m-1] . " de $y";
$wday 		= date("w", mktime(0,0,0,$m,$d,$y));

writeHeader($m, $y, $dateline, $wday, $auth);

// display selected posting first
writePosting($id, $auth);

// give some space
echo '<img src="images/clear.gif" width="1" height="25" border="0"><br clear="all">';

// query for rest of this day's postings
$sql = "SELECT id, start_time FROM " . DB_TABLE_PREFIX . "mssgs ";
$sql .= "WHERE y = " . $y . " AND m = " . $m . " AND d = " . $d . " AND id != $id ";
$sql .= "ORDER BY start_time ASC";

$result = mysql_query($sql) or die(mysql_error());

if (mysql_num_rows($result)) {
	echo '<span class="display_header">' . $lang['otheritems'] . '</span>';
	echo '<br clear="all"><img src="/images/clear.gif" width="1" height="3" border="0"><br clear="all">';
	
	// display rest of this day's postings
	while ($row = mysql_fetch_array($result)) {
		writePosting($row[0], $auth);
		echo '<img src="images/clear.gif" width="1" height="12" border="0"><br clear="all">';
	}
}

echo "</body></html>";


function writeHeader($m, $y, $dateline, $wday, $auth)
{
	global $lang;
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
	<title>Eventos</title>
	<link rel="stylesheet" type="text/css" href="css/popwin.css">
<?
/*
	=================================================================
	# Online Calendar WESPA CALENDAR 2.0
	# Author / Coder: Weslley A. Harakawa
	# weslley@wcre8tive.com
	#
	# PHP Script and SQL source.
	# Copyright � 2014. Wcre8tive // Weslley A. Harakawa. All rights reserved.
	=================================================================
*/  	if ($auth) { ?>
	<script language="JavaScript">
		function deleteConfirm(eid) {
			var msg = "<?
/*
	=================================================================
	# Online Calendar WESPA CALENDAR 2.0
	# Author / Coder: Weslley A. Harakawa
	# weslley@wcre8tive.com
	#
	# PHP Script and SQL source.
	# Copyright � 2014. Wcre8tive // Weslley A. Harakawa. All rights reserved.
	=================================================================
*/ = $lang['deleteconfirm'] ?>";
			
			if (confirm(msg)) {
				opener.location = "eventsubmit.php?flag=delete&id=" + eid + "&month=<?
/*
	=================================================================
	# Online Calendar WESPA CALENDAR 2.0
	# Author / Coder: Weslley A. Harakawa
	# weslley@wcre8tive.com
	#
	# PHP Script and SQL source.
	# Copyright � 2014. Wcre8tive // Weslley A. Harakawa. All rights reserved.
	=================================================================
*/ =$m?>&year=<?
/*
	=================================================================
	# Online Calendar WESPA CALENDAR 2.0
	# Author / Coder: Weslley A. Harakawa
	# weslley@wcre8tive.com
	#
	# PHP Script and SQL source.
	# Copyright � 2014. Wcre8tive // Weslley A. Harakawa. All rights reserved.
	=================================================================
*/ =$y?>";
				window.setTimeout('window.close()', 1000);
			} else {
				return;
			}
		}
	</script>
<?
/*
	=================================================================
	# Online Calendar WESPA CALENDAR 2.0
	# Author / Coder: Weslley A. Harakawa
	# weslley@wcre8tive.com
	#
	# PHP Script and SQL source.
	# Copyright � 2014. Wcre8tive // Weslley A. Harakawa. All rights reserved.
	=================================================================
*/ 	} ?>
</head>
<body>

<!-- selected date -->
<table cellspadding="0" cellspacing="0" border="0" width="300">
<tr>
	<td><span class="display_header"><?
/*
	=================================================================
	# Online Calendar WESPA CALENDAR 2.0
	# Author / Coder: Weslley A. Harakawa
	# weslley@wcre8tive.com
	#
	# PHP Script and SQL source.
	# Copyright � 2014. Wcre8tive // Weslley A. Harakawa. All rights reserved.
	=================================================================
*/  echo $dateline ?></span></td>
	<td align="right"><span class="display_header"><?
/*
	=================================================================
	# Online Calendar WESPA CALENDAR 2.0
	# Author / Coder: Weslley A. Harakawa
	# weslley@wcre8tive.com
	#
	# PHP Script and SQL source.
	# Copyright � 2014. Wcre8tive // Weslley A. Harakawa. All rights reserved.
	=================================================================
*/  echo $lang['days'][$wday] ?></span></td>
</tr>
</table>

<img src="images/clear.gif" width="1" height="3" border="0"><br clear="all">
<?
/*
	=================================================================
	# Online Calendar WESPA CALENDAR 2.0
	# Author / Coder: Weslley A. Harakawa
	# weslley@wcre8tive.com
	#
	# PHP Script and SQL source.
	# Copyright � 2014. Wcre8tive // Weslley A. Harakawa. All rights reserved.
	=================================================================
*/ 
}

function writePosting($id, $auth)
{
	global $lang, $HTTP_SESSION_VARS;
	
	mysql_connect(DB_HOST, DB_USER, DB_PASS) or die(mysql_error());
	mysql_select_db(DB_NAME) or die(mysql_error());
	
	$sql = "SELECT y, m, d, title, text, start_time, end_time, ";
	$sql .= DB_TABLE_PREFIX . "users.uid, fname, lname, ";
	
	if (TIME_DISPLAY_FORMAT == "12hr") {
		$sql .= "TIME_FORMAT(start_time, '%l:%i%p') AS stime, ";
		$sql .= "TIME_FORMAT(end_time, '%l:%i%p') AS etime ";
	} elseif (TIME_DISPLAY_FORMAT == "24hr") {
		$sql .= "TIME_FORMAT(start_time, '%H:%i') AS stime, ";
		$sql .= "TIME_FORMAT(end_time, '%H:%i') AS etime ";
	} else {
		echo "Bad time display format, check your configuration file.";
	}
	
	$sql .= "FROM " . DB_TABLE_PREFIX . "mssgs ";
	$sql .= "LEFT JOIN " . DB_TABLE_PREFIX . "users ";
	$sql .= "ON (" . DB_TABLE_PREFIX . "mssgs.uid = " . DB_TABLE_PREFIX . "users.uid) ";
	$sql .= "WHERE id = " . $id;
	
	$result = mysql_query($sql) or die(mysql_error());
	$row = mysql_fetch_assoc($result);
	
	$title		= stripslashes($row["title"]);
	$body		= stripslashes(str_replace("\n", "<br />", $row["text"]));
	$postedby 	= $lang['postedby'] . ": " . $row['fname'] . " " . $row['lname'];
	
	if (!($row["start_time"] == "55:55:55" && $row["end_time"] == "55:55:55")) {
		if ($row["start_time"] == "55:55:55")
			$starttime = "- -";
		else
			$starttime = $row["stime"];
			
		if ($row["end_time"] == "55:55:55")
			$endtime = "- -";
		else
			$endtime = $row["etime"];
		
		$timestr = "$starttime - $endtime";
	} else {
		$timestr = "";
	}
	
	if ($auth == 2 || ($auth != 0 && $HTTP_SESSION_VARS['authdata']['uid'] == $row['uid'])) {
		$editstr = "<span class=\"display_edit\">";
		$editstr .= "[<a href=\"eventform.php?id=" . $id . "\">editar</a>]&nbsp;";
		$editstr .= "[<a href=\"#\" onClick=\"deleteConfirm(" . $id . ");\">apagar</a>]&nbsp;</span>";
	} else {
		$editstr = "";
	}
?>
	<table cellspacing="0" cellpadding="0" border="0" width="300">
		<tr><td bgcolor="#000000">
			<table cellspacing="1" cellpadding="1" border="0" width="100%">
				<tr>
					<td class="display_title_bg"><table cellspacing="0" cellpadding="0" border="0" width="100%"><tr>
							<td width="100%"><span class="display_title">&nbsp;<?
/*
	=================================================================
	# Online Calendar WESPA CALENDAR 2.0
	# Author / Coder: Weslley A. Harakawa
	# weslley@wcre8tive.com
	#
	# PHP Script and SQL source.
	# Copyright � 2014. Wcre8tive // Weslley A. Harakawa. All rights reserved.
	=================================================================
*/ = $title ?></span></td>
							<td><img src="images/clear.gif" width="20" height="1" border="0"></td>
							<td align="right" nowrap="yes"><span class="display_title"><?
/*
	=================================================================
	# Online Calendar WESPA CALENDAR 2.0
	# Author / Coder: Weslley A. Harakawa
	# weslley@wcre8tive.com
	#
	# PHP Script and SQL source.
	# Copyright � 2014. Wcre8tive // Weslley A. Harakawa. All rights reserved.
	=================================================================
*/ = $timestr ?>&nbsp;</span></td>
					</tr></table></td>
				</tr>
				<tr><td class="display_txt_bg">
					<table cellspacing="1" cellpadding="1" border="0" width="100%">
						<tr>
							<td><span class="display_txt"><?
/*
	=================================================================
	# Online Calendar WESPA CALENDAR 2.0
	# Author / Coder: Weslley A. Harakawa
	# weslley@wcre8tive.com
	#
	# PHP Script and SQL source.
	# Copyright � 2014. Wcre8tive // Weslley A. Harakawa. All rights reserved.
	=================================================================
*/ = $body ?></span></td>
						</tr>
						<tr>
							<td align="right"><span class="display_user"><?
/*
	=================================================================
	# Online Calendar WESPA CALENDAR 2.0
	# Author / Coder: Weslley A. Harakawa
	# weslley@wcre8tive.com
	#
	# PHP Script and SQL source.
	# Copyright � 2014. Wcre8tive // Weslley A. Harakawa. All rights reserved.
	=================================================================
*/ = $postedby ?></td>
						</tr>
						<tr>
							<td align="right"><?
/*
	=================================================================
	# Online Calendar WESPA CALENDAR 2.0
	# Author / Coder: Weslley A. Harakawa
	# weslley@wcre8tive.com
	#
	# PHP Script and SQL source.
	# Copyright � 2014. Wcre8tive // Weslley A. Harakawa. All rights reserved.
	=================================================================
*/ = $editstr ?></td>
						</tr>
					</table>
				</td></tr>
			</table>
	</td></tr></table>
<?
/*
	=================================================================
	# Online Calendar WESPA CALENDAR 2.0
	# Author / Coder: Weslley A. Harakawa
	# weslley@wcre8tive.com
	#
	# PHP Script and SQL source.
	# Copyright � 2014. Wcre8tive // Weslley A. Harakawa. All rights reserved.
	=================================================================
*/ 
}
?>
