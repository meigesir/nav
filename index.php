<?php 
	session_start();
 ?>
<!DOCTYPE html>
<html>
	
	<head>
		<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
		<title>Welcome to nav !</title>
		
		<!-- css -->
		<link href="style/bootstrap.css" rel="stylesheet">
		<style type="text/css">
			body{
					padding-top:70px;
				}
		</style>
		
	</head>
	<body>
	
		<!-- 意见反馈  modal -->
		<!-- **************************************************** -->
			<div id="send_msg_modal" class="modal fade hide form-horizontal">
			   <div class="modal-header">
			    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			    <h4>意见反馈</h4>
			  </div>
              <div class="modal-body">
              		 <div class="control-group">
					    <label class="control-label">意见或建议</label>
					    <div class="controls">
					      <textarea rows="3" id="message" placeholder="请输入你的意见或建议…" class="span4"></textarea> 
					    </div>
					  </div>
	              	 
	              	 <div class="control-group">
					    <label class="control-label">您的联系方式</label>
					    <div class="controls">
					      <input type="text" id="contact"  placeholder="请输入您的QQ号或邮箱…">
					    </div>
					  </div>
	    			
              </div>
              <div class="modal-footer">
                <a href="#" class="btn" data-dismiss="modal">取消</a>
                <a href="javascript:void(0)" id="send_ajax" class="btn btn-primary">发送反馈</a>
              </div>
            </div>
	
	   <!-- Navbar-->
	   <!-- **************************************************** -->
	    <?php require 'frame/top.php';?>
	
		
		<!-- content -->
		<!-- **************************************************** -->
		<div class="container">
			<table class="table">
            <tbody>
             
             <!-- 获取数据库数据 -->
			<?php 			
				
				$sql = "SELECT id,NAME FROM node";
			
				if(isset($_SESSION['id'])){
					$w_id_session = intval($_SESSION['id']);
					if($w_id_session != null && $w_id_session != ""){
						$sql = $sql . " where u_id = '" . intval($w_id_session) . "'";
					}
				}else{
					$sql = $sql . " where u_id = '1883441410'";
				}
				
				/*连接数据库*/
				require 'config.php';
				require 'util/DBHelp.php';
				$dbHelp = new DBHelp();
				$dbHelp->connMySQL();
				$result = $dbHelp->getData($sql);
				
				//能查询出数据，下面才会有数据
				if(mysql_num_rows($result) == 0){
					echo "默认导航没有数据";
				}else{
				?>
				
				 <!-- 循环开始 -->
	              	<?php 
	              	while($ROW = mysql_fetch_array($result)){
					?>
				
					 <tr>
		                <td style="width:90px;text-align: center;">
		                  	<span><?php echo $ROW['NAME']?></span>
		                </td>
		                <!-- 内部循环开始 -->
		                <?php 			
					
						$tag_sql = "SELECT id,NAME,url FROM tag WHERE node_id = '" . intval($ROW['id']) . "'";
						
						$tag_result = $dbHelp->getData($tag_sql);
						
						?>
						<td>
						<?php 
						if(mysql_num_rows($tag_result) != 0){
		              		while($TAG_ROW = mysql_fetch_array($tag_result)){
						?> 
								  <a href="<?php echo $TAG_ROW['url']?>" target="_blank"><?php echo $TAG_ROW['NAME']?></a>&nbsp;&nbsp;&nbsp;&nbsp;
		              	<?php 
		              		}
		              	}
	              		?>
	              		  </td>
		              </tr>
	              <?php 
	              	}
	              ?>
			
			
			<?php 
				}
				mysql_close();
			?>
			  
            </tbody>
          </table>
              
		</div>
		
		<!-- footer -->
		<!-- **************************************************** -->
		<?php require 'frame/foot.php';?>
	    
	    
	    <!-- script -->
	    <!-- **************************************************** -->
	    <script src="script/jquery.js"></script>
	    <script src="script/bootstrap.js"></script>
	    <script src="script/bootstrap-modal.js"></script>
	    <script src="script/bootstrap-dropdown.js"></script>
		<script type="text/javascript">
			$(document).ready(function(){
				$('.dropdown-toggle').dropdown();

				/*=====================发送反馈================*/
				
				$('#send_msg').click(function(){
					$('#send_msg_modal').modal('show');
				});
				
				$('#send_ajax').click(function(){
					var message = $('#message').val();
					var contact = $('#contact').val();
					$.post("ajax/send_msg.php",{"message":message,"contact":contact},function(json){
						$('#send_msg_modal').modal('hide');

						//响应成功，清除表单
						$('#message').val('');
						$('#contact').val('');
						if(json == "success"){
							alert("发送成功，谢谢...");
						}else{
							alert("服务器出问题啦，不好意思...");
						}
					});
				});		

				//退出登录
				$('#exit_user').click(function(){
					$.post("ajax/user.php",{"task":"exit_user"},function(){
						window.location.href = "index.php";
					});
				});
				
			});
		</script>
		
	</body>
</html>