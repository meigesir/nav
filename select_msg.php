<?php ob_start();session_start();?>
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
			    <button type="button" class="close" data-dismiss="modal">&times;</button>
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
		
			<!-- 获取数据库数据 -->
			<?php 			
				//检查是否是创建者
				if (!(isset($_SESSION['id']) && $_SESSION['id'] == "1883441410")){
					header("Location:index.php");
				}	
			
				$sql = "SELECT * FROM suggest";
				
				require 'config.php';
				require 'util/DBHelp.php';
				$dbHelp = new DBHelp();
				$dbHelp->connMySQL();
				
				$result = $dbHelp->getData($sql);
				
			?>
			
			<table class="table">
              <thead>
                <tr>
                  <th>信息ID</th>
                  <th>信息内容</th>
                  <th>联系方式</th>
                  <th></th>
                </tr>
              </thead>
              <tbody id="tbody">
              <!-- 循环开始 -->
              	<?php 
              	//查看是否有建议信息
              	if(mysql_num_rows($result) == 0){
              		echo "还没有用户提供建议";
              	}else{
	              	while($ROW = mysql_fetch_array($result)){
					?>
	                <tr>
	                  <td><?php echo $ROW['id']?></td>
	                  <td><?php echo $ROW['message']?></td>
	                  <td><?php echo $ROW['contact']?></td>
	                  <td><a href="javascript:void(0)" class="del" rel="<?php echo $ROW['id']?>">删除</a></td>
	                </tr>
	         <?php
					 } 
				 }
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
		<script type="text/javascript">
			$(document).ready(function(){
				$('#send_msg').click(function(){
					$('#send_msg_modal').modal('show');
				});

				/*=====================发送反馈================*/
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

						window.location.reload();
					});
				});


				/*======================删除反馈信息========================*/
				$('.del').click(function(){
					var rel = $(this).attr('rel');
					var tr = $(this).parent().parent();//要删除的行
					$.post("ajax/del_msg.php",{"id":rel},function(json){
						if(json == "1"){
							tr.remove();
						}
					});
				});
				
			});
		</script>
		
	</body>
</html>