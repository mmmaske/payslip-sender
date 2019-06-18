<?php
	define("ADMIN_UNAME"		,	"lohica-dev"); // administrator username
	define("ADMIN_PWORD"		,	"tEoqpvKXPan3Mzi53ypfYkpYu"); // administrator password
	define("EMAIL_HOST"			,	""); // email server or hostname
	define("EMAIL_SENDER"		,	""); // email 'from' address
	define("SENDER_PWORD"		,	""); // password for email_sender

	####################################
	####################################
	#####                          #####
	#####   System config below    #####
	#####           ---            #####
	#####   Do not change unless   #####
	#####   you know what you're   #####
	#####   doing!                 #####
	#####                          #####
	####################################
	####################################
	session_start();
	define("DBHOST"		,	"");
	define("DBUSER"		,	"");
	define("DBPASS"		,	"");
	define("DBNAME"		,	"");
	define("WPATH"		,	$_SERVER['DOCUMENT_ROOT']."/");
	define("SITEDIR"	,	$_SERVER['DOCUMENT_ROOT']."/");
	define("SITEURL"	,	"http://".$_SERVER['SERVER_NAME']);
	define("LINK"		,	SITEURL."/");
	define("HTTP_PATH"	,	SITEURL."/");

	$browser	=	$_SERVER['HTTP_USER_AGENT'];
	$chrome		=	'/Chrome/';
	$firefox	=	'/Firefox/';
	$ie			=	'/MSIE/';
	$using		=	"unknown";
	if (preg_match($chrome, $browser))	{ $using="Chrome/Opera"; }
	if (preg_match($firefox, $browser))	{ $using="Firefox"; }
	if (preg_match($ie, $browser))		{ $using="IE"; }

	define("USERBROWSER"	,	$using);
?>
