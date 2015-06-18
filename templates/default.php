<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
	<title>Calendário de Eventos</title>
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
*/  javaScript() ?>
	<link rel="stylesheet" type="text/css" href="css/default.css">
</head>
<body>
<table cellpadding="0" cellspacing="0" border="0" align="center">
<tr>
	<td>
		<table BORDER=0 CELLSPACING=0 CELLPADDING=0 COLS=1 >
<tr>
<td><img SRC="images/tit-calendario.gif" height=59 width=310></td>
</tr>
</table>
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
*/ = $scrollarrows ?><span class="date_header">&nbsp;<?
/*
	=================================================================
	# Online Calendar WESPA CALENDAR 2.0
	# Author / Coder: Weslley A. Harakawa
	# weslley@wcre8tive.com
	#
	# PHP Script and SQL source.
	# Copyright © 2014. Wcre8tive // Weslley A. Harakawa. All rights reserved.
	=================================================================
*/ = $lang['months'][$m-1] ?>&nbsp;<?
/*
	=================================================================
	# Online Calendar WESPA CALENDAR 2.0
	# Author / Coder: Weslley A. Harakawa
	# weslley@wcre8tive.com
	#
	# PHP Script and SQL source.
	# Copyright © 2014. Wcre8tive // Weslley A. Harakawa. All rights reserved.
	=================================================================
*/ = $y ?></span>
	</td>

	<!-- form tags must be outside of <td> tags -->
	<form name="monthYear">
	<td align="right">
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
*/  monthPullDown($m, $lang['months']); yearPullDown($y); ?>
	<input type="button" value="Exibir" onClick="submitMonthYear()">
	</td>
	</form>

</tr>

<tr>
	<td colspan="2" bgcolor="#000000">
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
*/  echo writeCalendar($m, $y); ?>
	</td>
</tr>

<tr>
	<td colspan="2" align="center">
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
*/ = footprint($auth, $m, $y) ?>
	
	</td>
</tr>
</table>



</body>
</html>
