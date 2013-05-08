<!DOCTYPE html>
<html lang="en"><head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Sign in · GDUT-Bookshelf</title>
    <!-- Le styles -->
	<link href="<?php echo base_url('./css/bootstrap.css'); ?>" type="text/css" rel="stylesheet">
    <style type="text/css">
      body {
        padding-top: 40px;
        padding-bottom: 40px;
        background-color: #f5f5f5;
      }

      .form-signin {
        max-width: 300px;
        padding: 19px 29px 29px;
        margin: 60px auto 20px;
        background-color: #fff;
        border: 1px solid #e5e5e5;
        -webkit-border-radius: 5px;
           -moz-border-radius: 5px;
                border-radius: 5px;
        -webkit-box-shadow: 0 1px 2px rgba(0,0,0,.05);
           -moz-box-shadow: 0 1px 2px rgba(0,0,0,.05);
                box-shadow: 0 1px 2px rgba(0,0,0,.05);
      }
	  .form-signin .form-signin-heading{
	  	margin: 10px 22px 30px;
	  }
	  
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
	  .alert{
		margin-top:25px;
		margin-bottom:0px;
	  }

    </style>
</head>
    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="//cdnjs.bootcss.com/ajax/libs/html5shiv/3.6.2/html5shiv.js"></script>
    <![endif]-->

    <!-- Fav and touch icons -->

  <body>

    <div class="container">

	  <form action="<?php echo site_url('admin/login'); ?>" class="form-signin" method="post">
        <h2 class="form-signin-heading">工大书架后台管理</h2>
        <input type="text" class="input-block-level" placeholder="请输入管理员帐号" name="admin" />
        <input type="password" class="input-block-level" placeholder="请输入密码" name="admin_pwd" />
        <label class="checkbox">
          <input type="checkbox" value="remember-me">记住我 
        </label>
        <button class="btn btn-large btn-primary" type="submit">登陆</button>
		<?php if(isset($error)): ?>
 			<div class="row">
 		   	<div class="span4">
     			<div class="alert alert-error">
   				     <strong>Login Failed!</strong>
  			    </div>
    		</div>
			</div>
		<?php endif;?>
      </form>
    </div> <!-- /container -->

    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
	<script src="<?php echo base_url('./js/jquery.min.js'); ?>"></script>
	<script src="<? echo base_url('./js/bootstrap.js'); ?>"></script>

  

