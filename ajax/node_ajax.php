<?php
	require '../config.php';
	require '../util/DBHelp.php';
	$dbHelp = new DBHelp();
	$dbHelp->connMySQL();//连接数据库
	
	$task = strip_tags($_POST['task']);
	//判断操作类别
	if($task == "add"){
		$node_name = strip_tags($_POST['name']);
		$u_id = intval($_POST['u_id']);
		
		$sql = "INSERT INTO node(`name`,u_id) VALUES('" . strip_tags($node_name) . "','" . intval($u_id) . "')";
		
		$dbHelp->runSQL($sql);
		
	}elseif($task == "del"){
		$id = intval($_POST['id']);
		$sql = "DELETE FROM node WHERE id = '" . intval($id) . "'";
		
		$dbHelp->runSQL($sql);
	}elseif($task == "edit"){
		$id = intval($_POST['id']);
		$node_name = strip_tags($_POST['name']);
		$sql = "UPDATE node SET `name` = '" . strip_tags($node_name) . "' WHERE id = '" . intval($id) . "'";
		
		$dbHelp->runSQL($sql);
	}
	
	mysql_close();
?>
	
	


