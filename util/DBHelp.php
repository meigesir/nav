<?php
	/**
	 * DBHelp 类
	 *
	 */
	class DBHelp{
		
		/**
		 * 连接MySQL数据库
		 */
		function connMySQL(){
			$mysql = mysql_connect(DB_HOST,DB_USER,DB_PASSWORD);
			if(!$mysql){
				die('Could not connect : ' . mysql_error());
			}
			mysql_select_db(DB_NAME);
		}
		
		/**
		 * 执行SQL语句
		 * @param  $sql
		 */
		function runSQL($sql){
			//解决中文乱码问题
			mysql_query('set names utf8');
			mysql_query($sql);
			if(mysql_errno() != 0){
				die("Error:" . mysql_error());
			}
		}
		
		/**
		 * 获取数据
		 * @param  $sql
		 */
		function getData($sql){
			//解决中文乱码问题
			mysql_query('set names utf8');
			$result = mysql_query($sql);
			
			if(mysql_errno() != 0){
				die("Error:" . mysql_error());
			}
			return $result;
		}
	}	
		
	