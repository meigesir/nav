<?php
	require '../config.php';
	require '../util/DBHelp.php';
	session_start();
	/**
		管理用户Ajax
	 */
	$dbHelp = new DBHelp();
	$dbHelp->connMySQL();
	
	$task = $_POST['task'];
	$name = strip_tags($_POST['name']);
	$pwd = md5(strip_tags($_POST['pwd']));
	
	if($task == "signin"){
		signin($dbHelp,$name,$pwd);
		return;
	}elseif($task == "exit_user"){
		//清除session
		session_destroy();
		
		//清除cookie
		if(isset($_COOKIE['name'])){
			setcookie("user","",time() - 3600);
		}
		if(isset($_COOKIE['pwd'])){
			setcookie("pwd","",time() - 3600);
		}
	}
	
	/**
	 * cookie login
	 */
	function cookie_login(){
		if(isset($_COOKIE['user']) && isset($_COOKIE['pwd'])){
			$name = $_COOKIE['user'];
			$pwd = $_COOKIE['pwd'];
			signin($name, $pwd);
		}
	}
	
	
	/**
	 * 登录方法
	 */
	function signin($dbHelp,$name,$pwd){
		$sql = "SELECT id,name,pwd FROM t_user WHERE name='{$name}' AND pwd = '{$pwd}'";
			
		$result = $dbHelp->getData($sql);
			
		$ROW = mysql_fetch_array($result);
		if($ROW){
			$_SESSION['id'] = $ROW['id'];
			$_SESSION['name'] = $ROW['name'];
			$_SESSION['pwd'] = $ROW['pwd'];
			
			setcookie("user",$ROW['name'],time() + 60*60*24*7);//默认保存一周
			setcookie("pwd",$ROW['pwd'],time() + 60*60*24*7);
			echo 1;
		}else{
			echo 0;
		}
	}
	
	mysql_close();
	
	
	
	