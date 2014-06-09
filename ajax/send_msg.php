<?php
	
	require '../config.php';
	require '../util/DBHelp.php';
	$dbHelp = new DBHelp();
	$dbHelp->connMySQL();
	
	$message = strip_tags($_POST['message']);
	$contact = strip_tags($_POST['contact']);
	
	$sql = "insert into suggest(message,contact) values('" . strip_tags($message) . "','" . strip_tags($contact) . "')";
	
	$dbHelp->runSQL($sql);
	
	echo "success";
	
	mysql_close();
	
	
	