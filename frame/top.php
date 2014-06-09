   <!-- Navbar-->
   <!-- **************************************************** -->
    <div class="navbar navbar-inverse navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container">
          <a class="brand" href="./index.php">Nav</a>
          <div class="nav-collapse collapse navbar-inverse-collapse">
	            <ul class="nav pull-right">
	              	<?php 
	              		if(isset($_SESSION['id']) && isset($_SESSION['name']) && isset($_SESSION['pwd'])){
	              			?>
	              			<li class="dropdown">
		              			<a data-toggle="dropdown" class="dropdown-toggle" href="#"><?php echo $_SESSION['name']?><b class="caret"></b></a>
		              			<ul class="dropdown-menu">
			                        <li><a href="user.php">管理导航</a></li>
			                        <li><a href="javascript:void(0)" id="exit_user">安全退出</a></li>
                       			</ul>
                       			<!-- 关联用户u_id,读取导航信息时使用 -->
			    				<input id="add_node_u_id" type="hidden" value="<?php echo $_SESSION['id']; ?>" />
	              			</li>
	              		<?php 
	              		}else{
	              		?>
	              			<li><a href="signin.php">登录</a></li>
		              	<?php 
		              		}
		              	?>
	            </ul>
	          </div>
        </div>
      </div>
    </div>