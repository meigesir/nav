<?php ob_start();session_start();?>
<!DOCTYPE html>
<html>
	
	<head>
		<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
		<title>管理导航页</title>
		
		<!-- css -->
		<link href="style/bootstrap.css" rel="stylesheet">
		<style type="text/css">
			body{
					padding-top:45px;
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
            
            <!-- 添加节点  modal -->
		<!-- **************************************************** -->
			<div id="add_node_modal" class="modal fade hide form-horizontal">
			   <div class="modal-header">
			    <button type="button" class="close" data-dismiss="modal">&times;</button>
			    <h4>添加节点</h4>
			  </div>
              <div class="modal-body">
	              	 <div class="control-group">
					    <label class="control-label">节点名称</label>
					    <div class="controls">
					      <input type="text" id="node_name"  placeholder="请输入节点名称">
					    </div>
					  </div>
	    			
              </div>
              <div class="modal-footer">
                <a href="#" class="btn" data-dismiss="modal">取消</a>
                <a href="javascript:void(0)" id="add_node_ajax" class="btn btn-primary">确认添加</a>
              </div>
            </div>
			
			<!-- 编辑节点  modal -->
		<!-- **************************************************** -->
			<div id="edit_node_modal" class="modal fade hide form-horizontal">
			   <div class="modal-header">
			    <button type="button" class="close" data-dismiss="modal">&times;</button>
			    <h4>编辑节点</h4>
			  </div>
              <div class="modal-body">
				<div class="control-group">
				    <label class="control-label">节点名称</label>
				    <div class="controls">
				      <input type="text" id="node_name_edit"  placeholder="请输入节点名称">
				    </div>
				  </div>	    			
              </div>
              <div class="modal-footer">
                <a href="#" class="btn" data-dismiss="modal">取消</a>
                <a href="javascript:void(0)" id="edit_node_ajax" class="btn btn-primary">确认编辑</a>
              </div>
            </div>
			
			<!-- 删除节点  modal -->
		<!-- **************************************************** -->
			<div id="del_node_modal" class="modal fade hide form-horizontal">
			   <div class="modal-header">
			    <button type="button" class="close" data-dismiss="modal">&times;</button>
			    <h4>删除警告</h4>
			  </div>
              <div class="modal-body">
				<p>删除此节点，那么此节点下的所有标签将被删除！</p>	    			
              </div>
              <div class="modal-footer">
                <a href="#" class="btn" data-dismiss="modal">取消</a>
                <a href="javascript:void(0)" id="del_node_ajax" class="btn btn-primary">确认删除</a>
              </div>
            </div>
			
			<!-- 添加标签  modal -->
			<!-- **************************************************** -->
			<div id="add_tag_modal" class="modal fade hide form-horizontal">
			   <div class="modal-header">
			    <button type="button" class="close" data-dismiss="modal">&times;</button>
			    <h4>添加节点</h4>
			  </div>
              <div class="modal-body">
	              	 <div class="control-group">
					    <label class="control-label">标签名称</label>
					    <div class="controls">
					      <input type="text" id="tag_name"  placeholder="请输入标签名称">
					    </div>
					  </div>
					  
					  <div class="control-group">
					    <label class="control-label">标签网址</label>
					    <div class="controls">
					      <input type="text" id="tag_url"  placeholder="请输入标签网址">
					    </div>
					  </div>
	    			
              </div>
              <div class="modal-footer">
                <a href="#" class="btn" data-dismiss="modal">取消</a>
                <a href="javascript:void(0)" id="add_tag_ajax" class="btn btn-primary">确认添加</a>
              </div>
            </div>
	
	   <!-- Navbar-->
	   <!-- **************************************************** -->
	    <?php require 'frame/top.php';?>
	
		
		<!-- content -->
		<!-- **************************************************** -->
		<div class="container">
			<a href="javascript:void(0)" id="add_node"><b>添加节点</b><i class="icon-plus"></i></a>
			<table class="table" style="margin-top: 5px;">
            <tbody>
             
             <!-- 获取数据库数据 -->
			<?php 			
				
				//没有登录就跳转到首页
				if (!isset($_SESSION['id'])){
					header("Location:index.php");
				}
				
				require 'config.php';
				require 'util/DBHelp.php';
				$sql = "SELECT id,NAME FROM node where u_id = '" . intval($_SESSION['id']) . "'";
				
				/*执行SQL语句*/
				$dbHelp = new DBHelp();
				$dbHelp->connMySQL();
				$result = $dbHelp->getData($sql);
				
				if(mysql_num_rows($result) == 0){
					echo "没有导航数据";
				}else{
				
			?>
			 	<!-- 循环开始 -->
              	<?php 
              	while($ROW = mysql_fetch_array($result)){
				?>
			
				 <tr>
	                <td style="width:90px;text-align: center;">
	                  	<span><?php echo $ROW['NAME']?></span><a href="javascript:void(0)" rel="<?php echo $ROW['id']?>" class="edit_node"><i class="icon-edit"></i></a><a href="javascript:void(0)" rel="<?php echo $ROW['id']?>" class="del_node"><i class="icon-trash"></i></a>
	                </td>
	                <td>
	                <!-- 内部循环开始 -->
	                <?php 			
				
					$tag_sql = "SELECT id,NAME,url FROM tag WHERE node_id = '" .intval($ROW['id']) . "'";
					$tag_result = $dbHelp->getData($tag_sql);
					if(mysql_num_rows($tag_result)){
		              	while($TAG_ROW = mysql_fetch_array($tag_result)){
						?> 
							  <a href="<?php echo $TAG_ROW['url']?>" target="_blank"><?php echo $TAG_ROW['NAME']?></a>
							  <span style="margin-left:-4px;"><a href="javascript:void(0)" class="del_tag" rel="<?php echo $TAG_ROW['id']?>"><i class="icon-trash"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;</span>
	              		<?php 
	              			}
	              		?>
              	<?php 
              		}
              	?>
              			<span class="pull-right"><a href="javascript:void(0)" class="add_tag" rel="<?php echo $ROW['id']?>">添加标签<i class="icon-plus"></i></a></span>
              		  </td>
	              </tr>
              <?php 
              	}
              ?>
			
			<?php 
			}
			mysql_close();
			?>
			
			<!-- 
               <tr>
                <td style="width: 80px;text-align: center;">
                  	校园招聘
                </td>
                <td>
					  <a href="http://campus.sina.com.cn/index.php/info/sina" target="_blank">新浪</a>&nbsp;&nbsp;&nbsp;&nbsp; 
					  <a href="http://tongxue.baidu.com/baidu/" target="_blank">百度</a>&nbsp;&nbsp;&nbsp;&nbsp; 
					  <a href="http://join.qq.com/index.php" target="_blank">腾讯</a>&nbsp;&nbsp;&nbsp;&nbsp; 
					  <span class="pull-right"><a href="javascript:void(0)" target="_blank">添加标签<i class="icon-plus"></i></a></span>
                </td>
              </tr>
              
               <tr>
                <td style="width: 80px;text-align: center;">
                  	不错站点
                </td>
                <td>
					  <a href="http://www.36kr.com" target="_blank">36氪</a>&nbsp;&nbsp;&nbsp;&nbsp; 
					  <a href="http://douban.fm" target="_blank">豆瓣电台</a>&nbsp;&nbsp;&nbsp;&nbsp; 
					  <a href="http://www.getpocket.com" target="_blank">Pocket</a>&nbsp;&nbsp;&nbsp;&nbsp;
					  <a href="http://www.evernote.com" target="_blank">evernote</a>&nbsp;&nbsp;&nbsp;&nbsp;
					  <a href="https://www.dropbox.com" target="_blank">dropbox</a>&nbsp;&nbsp;&nbsp;&nbsp;
                </td>
              </tr>
              
               <tr>
                <td style="width: 80px;text-align: center;">
                  	前端框架
                </td>
                <td>
					  <a href="http://twitter.github.com/bootstrap/index.html" target="_blank">bootstrap</a>&nbsp;&nbsp;&nbsp;&nbsp; 
					  <a href="http://jquery.com" target="_blank">jquery</a>&nbsp;&nbsp;&nbsp;&nbsp; 
                </td>
              </tr>
              
              
               <tr>
                <td style="width: 80px;text-align: center;">
                  	社交
                </td>
                <td>
					  <a href="http://weibo.com" target="_blank">新浪微博</a>&nbsp;&nbsp;&nbsp;&nbsp; 
					  <a href="http://www.renren.com" target="_blank">人人</a>&nbsp;&nbsp;&nbsp;&nbsp; 
                </td>
              </tr>
			  
			  <tr>
                <td style="width: 80px;text-align: center;">
                  	建站
                </td>
                <td>
					  <a href="https://www.dnspod.cn/" target="_blank">DNSPod</a>&nbsp;&nbsp;&nbsp;&nbsp; 
					  <a href="http://www.dot.tk/zh/index.html?lang=zh" target="_blank">dot.tk</a>&nbsp;&nbsp;&nbsp;&nbsp; 
                </td>
              </tr>
              
			   <tr>
                <td style="width: 80px;text-align: center;">
                  	云平台
                </td>
                <td>
					  <a href="http://sae.sina.com.cn/" target="_blank">sae</a>&nbsp;&nbsp;&nbsp;&nbsp; 
					  <a href="http://open.weibo.com/" target="_blank">新浪微博开放平台</a>&nbsp;&nbsp;&nbsp;&nbsp;
                </td>
              </tr>
			  
			   <tr>
                <td style="width: 80px;text-align: center;">
                  	学习
                </td>
                <td>
					  <a href="http://www.w3school.com.cn/" target="_blank">w3school(中文)</a>&nbsp;&nbsp;&nbsp;&nbsp;
					  <a href="http://www.w3schools.com/" target="_blank">w3schools(英文)</a>&nbsp;&nbsp;&nbsp;&nbsp; 
                </td>
              </tr>
			  
			  <tr>
                <td style="width: 80px;text-align: center;">
                  	商城
                </td>
                <td>
					  <a href="http://www.taobao.com" target="_blank">淘宝</a>&nbsp;&nbsp;&nbsp;&nbsp;
					  <a href="http://www.360buy.com" target="_blank">京东</a>&nbsp;&nbsp;&nbsp;&nbsp;
					  <a href="http://www.vancl.com" target="_blank">凡客</a>&nbsp;&nbsp;&nbsp;&nbsp;
					  <a href="http://www.51buy.com" target="_blank">易讯</a>&nbsp;&nbsp;&nbsp;&nbsp;
                </td>
              </tr> -->
			  
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




				/*=====================添加节点================*/
				
				$('#add_node').click(function(){
					$('#node_name').focus();
					$('#add_node_modal').modal('show');
				});

				
				$('#add_node_ajax').click(function(){

					var node_name = $('#node_name').val();
					var add_node_u_id = $('#add_node_u_id').val();
					$.post("ajax/node_ajax.php",{"task":"add","name":node_name,"u_id":add_node_u_id},function(json){
						$('#add_node_modal').modal('hide');

						//响应成功，清除表单
						$('#node_name').val('');
						//初始版本→刷新
						window.location.reload();
					});
				});


				/*=====================编辑节点================*/
				var node_edit = null;
				$('.edit_node').click(function(){
					node_edit = $(this);
					$('#edit_node_modal').modal('show');
				});

				
				$('#edit_node_ajax').click(function(){
					var edit_node_id = node_edit.attr('rel');
					var node_name_edit = $('#node_name_edit').val();
					$.post("ajax/node_ajax.php",{"task":"edit","name":node_name_edit,"id":edit_node_id},function(json){
						$('#edit_node_modal').modal('hide');

						//响应成功，清除表单
						$('#node_name_edit').val('');

						//初始版本→刷新
						window.location.reload();
						
					});
				});
				


				/*=====================删除节点================*/
				var node_del = null;
				$('.del_node').click(function(){
					node_del = $(this);
					$('#del_node_modal').modal('show');
				});

				
				$('#del_node_ajax').click(function(){
					var node_del_id = node_del.attr('rel');
					$.post("ajax/node_ajax.php",{"task":"del","id":node_del_id},function(json){
						$('#del_node_modal').modal('hide');

						//响应成功
						node_del.parent().parent().remove();//动态删除
						node_del = null;
						
					});
				});
				
				/*=====================添加标签================*/
				var a = null;
				
				$('.add_tag').click(function(){
					a = $(this);
					$('#add_tag_modal').modal('show');
				});

				
				$('#add_tag_ajax').click(function(){

					//要添加到的节点的id
					var node_id = a.attr('rel');
					
					var tag_name = $('#tag_name').val();
					var tag_url = $('#tag_url').val();
					$.post("ajax/tag_ajax.php",{"task":"add","name":tag_name,"url":tag_url,"node_id":node_id},function(json){
						$('#add_tag_modal').modal('hide');
						
						//响应成功，清除表单
						$('#tag_name').val('');
						$('#tag_url').val('');



						//初始版本→刷新
						window.location.reload();
						/*
						var a_new = document.createElement("a");
						a_new.setAttribute("href",json.url);
						a_new.setAttribute("target","_blank");
						var textNode = document.createTextNode(json.name);

						a_new.appendChild(textNode);

						a.before(a_new);

						a = null;
						*/
						
						/*
						if(json == "success"){
							alert("添加成功！(*^__^*) 嘻嘻……");
						}else{
							alert("不好意思，服务器异常...");
						}
						*/
					});
				});


				/*======================删除标签========================*/
				$('.del_tag').click(function(){
					var rel = $(this).attr('rel');
					var tag_span_del = $(this).parent();//要删除的
					var a_tag_del = tag_span_del.prev();
					$.post("ajax/tag_ajax.php",{"task":"del","id":rel},function(json){
						tag_span_del.remove();
						a_tag_del.remove();
					});
				});
				


				$('.dropdown-toggle').dropdown();

				//退出登录
				$('#exit_user').click(function(){
					$.post("ajax/user.php",{"task":"exit_user"},function(){
						window.location.reload();
					});
				});
				

			});
		</script>
		
	</body>
</html>