<?php
	require '../config.php';
	require '../util/DBHelp.php';
	
	$sql = "DELETE FROM suggest WHERE id = '" . intval($_POST['id']) . "'";
	
	$dbHelp = new DBHelp();
	$dbHelp->connMySQL();
	$dbHelp->runSQL($sql);
	
	echo "1";
	
	mysql_close();