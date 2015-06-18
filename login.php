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

$action	= $HTTP_GET_VARS['action'];
$m 		= (int) $HTTP_GET_VARS['month'];
$y 		= (int) $HTTP_GET_VARS['year'];

if ( $action == "login" && auth($HTTP_POST_VARS['username'], $HTTP_POST_VARS['password']) ) {
	
	echo "<script language=\"JavaScript\">";
	echo "opener.location = \"index.php?month=$m&year=$y\";";
	echo "window.setTimeout('window.close()', 500);";
	echo "</script>";
	
} elseif ($action == "logout") {
	
	session_start();
	session_destroy();
	header ("Location: index.php?month=$m&year=$y");
	
} else {
?>
	<html>
	<head>
	<script language="JavaScript">
	function firstFocus()
	{
		if (document.forms.length > 0) {
			var TForm = document.forms[0];
			for (i=0;i<TForm.length;i++) {
				if ((TForm.elements[i].type=="text")|| 
				    (TForm.elements[i].type=="textarea")|| 
					(TForm.elements[i].type.toString().charAt(0)=="s")) {
					document.forms[0].elements[i].focus();
					break;
				}
			}
		}
	}
	</script>
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
*/ =$lang['logintitle']?></title>
	<link rel="stylesheet" type="text/css" href="css/adminpgs.css">
	</head>
	<body onLoad="firstFocus()">
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
	if( isset( $HTTP_POST_VARS['username'] ) ) {
		echo "<span class=\"login_auth_fail\">" . $lang['wronglogin'] . "</span><p>\n";
	}
?>
	<span class="login_header"><?
/*
	=================================================================
	# Online Calendar WESPA CALENDAR 2.0
	# Author / Coder: Weslley A. Harakawa
	# weslley@wcre8tive.com
	#
	# PHP Script and SQL source.
	# Copyright © 2014. Wcre8tive // Weslley A. Harakawa. All rights reserved.
	=================================================================
*/ =$lang['loginheader']?></span>
	<br><img src="images/clear.gif" width="1" height="5"><br>
	
	<table>
	<form action="<?
/*
	=================================================================
	# Online Calendar WESPA CALENDAR 2.0
	# Author / Coder: Weslley A. Harakawa
	# weslley@wcre8tive.com
	#
	# PHP Script and SQL source.
	# Copyright © 2014. Wcre8tive // Weslley A. Harakawa. All rights reserved.
	=================================================================
*/ = $HTTP_SERVER_VARS['PHP_SELF'] ?>?action=login&month=<?
/*
	=================================================================
	# Online Calendar WESPA CALENDAR 2.0
	# Author / Coder: Weslley A. Harakawa
	# weslley@wcre8tive.com
	#
	# PHP Script and SQL source.
	# Copyright © 2014. Wcre8tive // Weslley A. Harakawa. All rights reserved.
	=================================================================
*/ = $m ?>&year=<?
/*
	=================================================================
	# Online Calendar WESPA CALENDAR 2.0
	# Author / Coder: Weslley A. Harakawa
	# weslley@wcre8tive.com
	#
	# PHP Script and SQL source.
	# Copyright © 2014. Wcre8tive // Weslley A. Harakawa. All rights reserved.
	=================================================================
*/ = $y ?>" method="post">
			<tr>
				<td nowrap valign="top" align="right" nowrap>
				<span class="login_label"><?
/*
	=================================================================
	# Online Calendar WESPA CALENDAR 2.0
	# Author / Coder: Weslley A. Harakawa
	# weslley@wcre8tive.com
	#
	# PHP Script and SQL source.
	# Copyright © 2014. Wcre8tive // Weslley A. Harakawa. All rights reserved.
	=================================================================
*/ =$lang['username']?></span></td>
				<td><input type="text" name="username" size="29" maxlength="15"></td>
			</tr>
			<tr>
				<td nowrap valign="top" align="right" nowrap>
				<span class="login_label"><?
/*
	=================================================================
	# Online Calendar WESPA CALENDAR 2.0
	# Author / Coder: Weslley A. Harakawa
	# weslley@wcre8tive.com
	#
	# PHP Script and SQL source.
	# Copyright © 2014. Wcre8tive // Weslley A. Harakawa. All rights reserved.
	=================================================================
*/ =$lang['password']?></span></td>
				<td><input type="password" name="password" size="29" maxlength="15"></td>
			</tr>
			<tr><td colspan="2" align="right"><input type="submit" value="<?
/*
	=================================================================
	# Online Calendar WESPA CALENDAR 2.0
	# Author / Coder: Weslley A. Harakawa
	# weslley@wcre8tive.com
	#
	# PHP Script and SQL source.
	# Copyright © 2014. Wcre8tive // Weslley A. Harakawa. All rights reserved.
	=================================================================
*/ =$lang['login']?>"><td><tr>
	</form>
	</table>

	</body></html>
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
?>
