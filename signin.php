<!DOCTYPE html>
<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
    <title>Sign in &middot; Twitter Bootstrap</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
    <link href="style/bootstrap.css" rel="stylesheet">
    <style type="text/css">
      body {
        padding-top: 40px;
        padding-bottom: 40px;
        background-color: #f5f5f5;
      }

      .form-signin {
        max-width: 300px;
        padding: 19px 29px 29px;
        margin: 0 auto 20px;
        background-color: #fff;
        border: 1px solid #e5e5e5;
        -webkit-border-radius: 5px;
           -moz-border-radius: 5px;
                border-radius: 5px;
        -webkit-box-shadow: 0 1px 2px rgba(0,0,0,.05);
           -moz-box-shadow: 0 1px 2px rgba(0,0,0,.05);
                box-shadow: 0 1px 2px rgba(0,0,0,.05);
      }
      .form-signin .form-signin-heading,
      .form-signin .checkbox {
        margin-bottom: 10px;
      }
      .form-signin input[type="text"],
      .form-signin input[type="password"] {
        font-size: 16px;
        height: auto;
        margin-bottom: 15px;
        padding: 7px 9px;
      }

    </style>

    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="../assets/js/html5shiv.js"></script>
    <![endif]-->

    <!-- Fav and touch icons -->
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="../assets/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="../assets/ico/apple-touch-icon-114-precomposed.png">
      <link rel="apple-touch-icon-precomposed" sizes="72x72" href="../assets/ico/apple-touch-icon-72-precomposed.png">
                    <link rel="apple-touch-icon-precomposed" href="../assets/ico/apple-touch-icon-57-precomposed.png">
                                   <link rel="shortcut icon" href="../assets/ico/favicon.png">
  </head>

  <body>

    <div class="container">

      <form class="form-signin">
      		<!-- 登录失败提示信息 -->
      		<div class="alert alert-error fade in" style="display:none">
              <button type="button" class="close" onclick="javascript:dismiss()">×</button>
              <strong>用户名或密码错误！</strong>
            </div>
        <h2 class="form-signin-heading">Please sign in</h2>
        <input type="text" name="name" class="input-block-level" placeholder="User name">
        <input type="password" name="pwd" class="input-block-level" placeholder="Password">
        <a class="btn btn-large btn-primary" id="signin" href="javascript:void(0)">Sign in</a>
      </form>

    </div> <!-- /container -->

    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="script/jquery.js"></script>
    <script src="script/bootstrap.js"></script>
    <script src="script/bootstrap-alert.js"></script>
    <script type="text/javascript">

	    /*关闭登录失败提示信息*/
		function dismiss(){
			$(".alert").css('display','none');
	    }
		
		$(document).ready(function(){
			$('#signin').click(function(){
				$.post("ajax/user.php",{"task":"signin","name":$("input[name='name']").val(),"pwd":$("input[name='pwd']").val()},function(json){
					//存在此用户
					if(json == '1'){
						window.location.href="index.php";
					}else{
						$(".alert").css('display','block');
					}
				});
			});
		});
    </script>

  </body>
</html>
