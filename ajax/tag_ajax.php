<?php
	require '../config.php';
	require '../util/DBHelp.php';
	$dbHelp = new DBHelp();
	$dbHelp->connMySQL();//连接数据库
	
	$task = strip_tags($_POST['task']);
	
	//判断操作类别
	if($task == "add"){
		
		$tag_name = strip_tags($_POST['name']);
		$tag_url = strip_tags($_POST['url']);
		
		$node_id = intval($_POST['node_id']);
		$sql = "INSERT INTO tag(NAME,url,node_id) VALUES('" . strip_tags($tag_name) . "','" . strip_tags($tag_url) . "','" . intval($node_id) . "')";
		
		$dbHelp->runSQL($sql);
	}elseif($task == "del"){
		$id = intval($_POST['id']);
		$sql = "DELETE FROM tag WHERE id = '" . intval($id) . "'";
		
		$dbHelp->runSQL($sql);
	}
	
	mysql_close();
?>
	
	


