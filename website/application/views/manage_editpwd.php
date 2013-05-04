<!DOCTYPE html>
<html lang="en">
  
  <head>
    <meta charset="utf-8">
    <title>
    </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Le styles -->
	<link href="<?php echo base_url('./css/bootstrap.css'); ?>" rel="stylesheet">
    <style>
      body { padding-top: 60px; /* 60px to make the container go all the way
      to the bottom of the topbar */ }
    </style>
	<link href="<?php echo base_url('./css/bootstrap-responsive.css'); ?>" rel="stylesheet">
    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js">
      </script>
    <![endif]-->
    <!-- Le fav and touch icons -->
    <link rel="shortcut icon" href="assets/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="assets/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="assets/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="assets/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="assets/ico/apple-touch-icon-57-precomposed.png">
    <style>
    </style>
  </head>
  <body>
    <div class="navbar navbar-inverse navbar-fixed-top">
    	<div class="navbar-inner">
    		<div class="container-fluid">
				<a class="brand" href="<?php echo site_url('management'); ?>">工大书架后台管理</a>
    			<div class="nav-collapse collapse">
    				<p class="navbar-text pull-right">
    					<br>
    				</p>
    				<ul class="nav">
						<li>
							<a href="<?php echo site_url('management'); ?>">图书列表</a>
						</li>
    					<li>
							<a href="<?php echo site_url('management/add_book'); ?>">添加图书</a>
    					</li>
    					<li>
							<a href="<?php echo site_url('management/edit_user'); ?>">编辑用户权限</a>
    					</li>
    					<li class="active">
							<a href="<?php echo site_url('management/edit_pwd'); ?>" class="text-right">修改密码</a>
    					</li>
    				</ul>
    			</div>
    			<!--/.nav-collapse -->
				<a href="<?php echo site_url('admin'); ?>" class="btn pull-right" id="logout">退出</a>
    		</div>
    	</div>
    </div>
    <div class="container">

      <form class="form-signin">
        <input type="password" class="input-block-level" placeholder="请输入原密码">
        <input type="password" class="input-block-level" placeholder="请输入新密码">
        <input type="password" class="input-block-level" placeholder="请再一次输入新密码">
        
        <button class="btn btn-large btn-primary" type="submit">确认修改</button>
      </form>

    </div>
    <div class="container-fluid">
    	<div class="row-fluid">
    		<!--/span-->
    		<!--/span-->
    	</div>
    	<!--/row-->
    	<div class="container">
    	</div>
    	
    	<footer>
    		
    	</footer>
    <div class="container"><div class="container"></div></div></div>
    <!--/.fluid-container-->

    <style>
      
      body {
        padding-top: 60px;
        padding-bottom: 40px;
      }
      .sidebar-nav {
        padding: 9px 0;
      }
      
      @media (max-width: 980px) {
        /* Enable use of floated navbar text */
        .navbar-text.pull-right {
          float: none;
          padding-left: 5px;
          padding-right: 5px;
        }
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

      
    </style>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js">
    </script>
	<script src="<?php echo base_url('./js/bootstrap.js'); ?>">
    </script>
    <script>

    </script>
  </body>
</html>
