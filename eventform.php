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
require("config.php");
require("./lang/lang.admin." . LANGUAGE_CODE . ".php");
require("functions.php");

$auth 	= auth();
$id 	= $HTTP_GET_VARS['id'];
$uid	= $HTTP_SESSION_VARS['authdata']['uid'];

if ($auth) {
	if (empty($id)) {
		displayEditForm('Add', $uid);
	} else {
		mysql_connect(DB_HOST, DB_USER, DB_PASS) or die(mysql_error());
		mysql_select_db(DB_NAME) or die(mysql_error());
		
		$sql = "SELECT uid FROM " . DB_TABLE_PREFIX . "mssgs WHERE id = $id";
		
		$result = mysql_query($sql) or die(mysql_error());
		$row = mysql_fetch_assoc($result);
		
		if ( $auth == 2 || $uid == $row['uid'] ) {
			displayEditForm('Edit', $uid, $id);
		} else {
			echo $lang['accessdenied'];
		}
	}
} else {
	echo $lang['accessdenied'];
}
	
	
function displayEditForm($mode, $uid, $id="")
{
	global $lang;
	
	if ($mode == "Add") {
		
		global $HTTP_GET_VARS;
		$d 			= $HTTP_GET_VARS['d'];
		$m 			= $HTTP_GET_VARS['m'];
		$y 			= $HTTP_GET_VARS['y'];
		$text 		= $title = "";
		$shour 		= $sminute = 0;
		$ehour 		= $eminute = 0;
		$headerstr 	= $lang['addheader'];
		$buttonstr 	= $lang['addbutton'];
		$pgtitle 	= $lang['addeventtitle'];
		$qstr 		= "?flag=add";
	
	} elseif ($mode == "Edit") {
		
		mysql_connect(DB_HOST, DB_USER, DB_PASS) or die(mysql_error());
		mysql_select_db(DB_NAME) or die(mysql_error());
		
		$sql = "SELECT uid, y, m, d, start_time, end_time, title, text ";
		$sql .= "FROM " . DB_TABLE_PREFIX . "mssgs WHERE id = $id";
		
		$result = mysql_query($sql) or die(mysql_error());
		$row = mysql_fetch_assoc($result);
		
		if (!empty($row)) {
			$qstr 		= "?flag=edit&id=$id";
			$headerstr 	= $lang['editheader'];
			$buttonstr	= $lang['editbutton'];
			$pgtitle 	= $lang['editeventtitle'];
			$title 		= stripslashes($row["title"]);
			$text 		= stripslashes($row["text"]);
			$m 			= $row["m"];
			$d 			= $row["d"];
			$y 			= $row["y"];
		}
		
		getPullDownTimeValues($row["start_time"], $shour, $sminute, $spm);
		getPullDownTimeValues($row["end_time"], $ehour, $eminute, $epm);
	} else {
		$lang['accesswarning'];
	}
?>
	<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
	<html>
	<head>
		<title><?
/*
	=================================================================
	# Online Calendar WESPA CALENDAR 2.0
	# Author / Coder: Weslley A. Harakawa
	# weslley@wcre8tive.com
	#
	# PHP Script and SQL source.
	# Copyright © 2014. Wcre8tive // Weslley A. Harakawa. All rights reserved.
	=================================================================
*/ = $pgtitle ?></title>
		<link rel="stylesheet" type="text/css" href="css/popwin.css">
	
		<script language="JavaScript">
		function formSubmit() {
			if (document.eventForm.title.value != "") {
				document.eventForm.method = "post";
				document.eventForm.action = "eventsubmit.php<?
/*
	=================================================================
	# Online Calendar WESPA CALENDAR 2.0
	# Author / Coder: Weslley A. Harakawa
	# weslley@wcre8tive.com
	#
	# PHP Script and SQL source.
	# Copyright © 2014. Wcre8tive // Weslley A. Harakawa. All rights reserved.
	=================================================================
*/ = $qstr ?>";
				document.eventForm.submit();
			} else {
				alert("<?
/*
	=================================================================
	# Online Calendar WESPA CALENDAR 2.0
	# Author / Coder: Weslley A. Harakawa
	# weslley@wcre8tive.com
	#
	# PHP Script and SQL source.
	# Copyright © 2014. Wcre8tive // Weslley A. Harakawa. All rights reserved.
	=================================================================
*/ = $lang['titlemissing'] ?>");
			}
		}
		</script>
	
	</head>
	<body>
	<span class="add_new_header"><?
/*
	=================================================================
	# Online Calendar WESPA CALENDAR 2.0
	# Author / Coder: Weslley A. Harakawa
	# weslley@wcre8tive.com
	#
	# PHP Script and SQL source.
	# Copyright © 2014. Wcre8tive // Weslley A. Harakawa. All rights reserved.
	=================================================================
*/ = $headerstr ?></span>
	<br><img src="images/clear.gif" width="1" height="5"><br>
		<table border=0 cellspacing=7 cellpadding=0>
		<form name="eventForm">
		<input type="hidden" name="uid" value="<?
/*
	=================================================================
	# Online Calendar WESPA CALENDAR 2.0
	# Author / Coder: Weslley A. Harakawa
	# weslley@wcre8tive.com
	#
	# PHP Script and SQL source.
	# Copyright © 2014. Wcre8tive // Weslley A. Harakawa. All rights reserved.
	=================================================================
*/ =$uid?>">
			<tr>
				<td nowrap valign="top" align="right" nowrap><span class="form_labels"><?
/*
	=================================================================
	# Online Calendar WESPA CALENDAR 2.0
	# Author / Coder: Weslley A. Harakawa
	# weslley@wcre8tive.com
	#
	# PHP Script and SQL source.
	# Copyright © 2014. Wcre8tive // Weslley A. Harakawa. All rights reserved.
	=================================================================
*/ =$lang['date']?></span></td>
				<td><?
/*
	=================================================================
	# Online Calendar WESPA CALENDAR 2.0
	# Author / Coder: Weslley A. Harakawa
	# weslley@wcre8tive.com
	#
	# PHP Script and SQL source.
	# Copyright © 2014. Wcre8tive // Weslley A. Harakawa. All rights reserved.
	=================================================================
*/  dayPullDown($d); monthPullDown($m, $lang['months']); yearPullDown($y); ?></td>
			</tr>
			<tr>
				<td nowrap valign="top" align="right" nowrap>
				<span class="form_labels"><?
/*
	=================================================================
	# Online Calendar WESPA CALENDAR 2.0
	# Author / Coder: Weslley A. Harakawa
	# weslley@wcre8tive.com
	#
	# PHP Script and SQL source.
	# Copyright © 2014. Wcre8tive // Weslley A. Harakawa. All rights reserved.
	=================================================================
*/ =$lang['title']?></span></td>
				<td><input type="text" name="title" size="29" value="<?
/*
	=================================================================
	# Online Calendar WESPA CALENDAR 2.0
	# Author / Coder: Weslley A. Harakawa
	# weslley@wcre8tive.com
	#
	# PHP Script and SQL source.
	# Copyright © 2014. Wcre8tive // Weslley A. Harakawa. All rights reserved.
	=================================================================
*/ = $title ?>" maxlength="50"></td>
			</tr>
			<tr>
				<td nowrap valign="top" align="right" nowrap>
				<span class="form_labels"><?
/*
	=================================================================
	# Online Calendar WESPA CALENDAR 2.0
	# Author / Coder: Weslley A. Harakawa
	# weslley@wcre8tive.com
	#
	# PHP Script and SQL source.
	# Copyright © 2014. Wcre8tive // Weslley A. Harakawa. All rights reserved.
	=================================================================
*/ =$lang['text']?></span></td>
				<td><textarea cols=22 rows=6 name="text"><?
/*
	=================================================================
	# Online Calendar WESPA CALENDAR 2.0
	# Author / Coder: Weslley A. Harakawa
	# weslley@wcre8tive.com
	#
	# PHP Script and SQL source.
	# Copyright © 2014. Wcre8tive // Weslley A. Harakawa. All rights reserved.
	=================================================================
*/ = $text ?></textarea></td>
			</tr>
			<tr>
				<td nowrap valign="top" align="right" nowrap><span class="form_labels"><?
/*
	=================================================================
	# Online Calendar WESPA CALENDAR 2.0
	# Author / Coder: Weslley A. Harakawa
	# weslley@wcre8tive.com
	#
	# PHP Script and SQL source.
	# Copyright © 2014. Wcre8tive // Weslley A. Harakawa. All rights reserved.
	=================================================================
*/ =$lang['start']?></span></td>
				<td><?
/*
	=================================================================
	# Online Calendar WESPA CALENDAR 2.0
	# Author / Coder: Weslley A. Harakawa
	# weslley@wcre8tive.com
	#
	# PHP Script and SQL source.
	# Copyright © 2014. Wcre8tive // Weslley A. Harakawa. All rights reserved.
	=================================================================
*/  hourPullDown($shour, "start"); ?><b>:</b><?
/*
	=================================================================
	# Online Calendar WESPA CALENDAR 2.0
	# Author / Coder: Weslley A. Harakawa
	# weslley@wcre8tive.com
	#
	# PHP Script and SQL source.
	# Copyright © 2014. Wcre8tive // Weslley A. Harakawa. All rights reserved.
	=================================================================
*/  minPullDown($sminute, "start"); amPmPullDown($spm, "start"); ?></td>
			</tr>
			<tr>
				<td nowrap valign="top" align="right" nowrap><span class="form_labels"><?
/*
	=================================================================
	# Online Calendar WESPA CALENDAR 2.0
	# Author / Coder: Weslley A. Harakawa
	# weslley@wcre8tive.com
	#
	# PHP Script and SQL source.
	# Copyright © 2014. Wcre8tive // Weslley A. Harakawa. All rights reserved.
	=================================================================
*/ =$lang['end']?></span></td>
				<td><?
/*
	=================================================================
	# Online Calendar WESPA CALENDAR 2.0
	# Author / Coder: Weslley A. Harakawa
	# weslley@wcre8tive.com
	#
	# PHP Script and SQL source.
	# Copyright © 2014. Wcre8tive // Weslley A. Harakawa. All rights reserved.
	=================================================================
*/  hourPullDown($ehour, "end"); ?><b>:</b><?
/*
	=================================================================
	# Online Calendar WESPA CALENDAR 2.0
	# Author / Coder: Weslley A. Harakawa
	# weslley@wcre8tive.com
	#
	# PHP Script and SQL source.
	# Copyright © 2014. Wcre8tive // Weslley A. Harakawa. All rights reserved.
	=================================================================
*/  minPullDown($eminute, "end"); amPmPullDown($epm, "end"); ?></td>
			</tr>
			<tr><td></td><td><br><input type="button" value="<?
/*
	=================================================================
	# Online Calendar WESPA CALENDAR 2.0
	# Author / Coder: Weslley A. Harakawa
	# weslley@wcre8tive.com
	#
	# PHP Script and SQL source.
	# Copyright © 2014. Wcre8tive // Weslley A. Harakawa. All rights reserved.
	=================================================================
*/ = $buttonstr ?>" onClick="formSubmit()">&nbsp;<input type="button" value="<?
/*
	=================================================================
	# Online Calendar WESPA CALENDAR 2.0
	# Author / Coder: Weslley A. Harakawa
	# weslley@wcre8tive.com
	#
	# PHP Script and SQL source.
	# Copyright © 2014. Wcre8tive // Weslley A. Harakawa. All rights reserved.
	=================================================================
*/ = $lang['cancel'] ?>" onClick="window.close();"></td></tr>
		</form>
		</table>
	</body>
	</html>
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
}

function getPullDownTimeValues($time, &$hour, &$minute, &$pm)
{
	$hour	= (int) substr($time, 0, 2);
	$minute = (int) substr($time, 3, 2);
	
	if ($hour == 55) {
		$hour	= 0;
		$minute	= 0;
		$pm = false;
	} elseif ($hour > 12) {
		$hour = $hour - 12;
		$pm = true;
	} elseif ($hour == 12) {
		$pm = true;
	} elseif ($hour == 0) {
		$hour = 12;
		$pm = false;
	} else {
		$pm = false;
	}
}
?>
