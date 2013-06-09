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
				<a class="brand" href="<?php echo site_url('admin'); ?>">工大书架后台管理</a>
    			<div class="nav-collapse collapse">
    				<p class="navbar-text pull-right">
    					<br>
    				</p>
    				<ul class="nav">
						<li class="active">
							<a href="<?php echo site_url('manage_booklist'); ?>">图书列表</a>
						</li>
    					<li>
							<a href="<?php echo site_url('manage_addbook'); ?>">添加图书</a>
    					</li>
    					<li>
							<a href="<?php echo site_url('manage_edituser'); ?>">编辑用户权限</a>
    					</li>
    					<li>
							<a href="<?php echo site_url('manage_editpwd'); ?>" class="text-right">修改密码</a>
    					</li>
                        <li>
                            <a href="<?php echo site_url('manage_upload'); ?>">上传资料</a>
                        </li>        
						<li>
							<form action="<?php echo site_url('admin/search_judge'); ?>" class="navbar-search pull-left" method="post">
								<input type="text" class="search-query" placeholder="Search" name="keywords">
								<input class="btn btn-inverse" type="submit" value="搜索"/>
							</form>
						</li>
    				</ul>
    			</div>
    			<!--/.nav-collapse -->
				<a href="<?php echo site_url('admin/logout'); ?>" class="btn pull-right" id="logout">退出</a>
    		</div>
    	</div>
    </div>
    <div class="container jetstrap-highlighted jetstrap-selected">
    	<div class="control-group">
    		<div class="controls">
    		</div>
    	</div>
    	<div class="container">
    	</div>
    	<div class="navbar">
    	</div>

    		<div class="row-fluid">
    		</div>
    		<table class="table">
    			<tbody>
    				<tr>
    					<td>
    						图书ID	
    					</td>
    					<td>
    						ISBN
    					</td>
    					<td>
    						书名
    					</td>
    					<td>
    						作者
    					</td>
    					<td>
    						出版社
    					</td>
    					<td>
    						操作
    					</td>
    				</tr>
					<?php foreach($booklists as $row): ?>
    				<tr>
    					<td>
							<?php echo $row['id'];?>
    					</td>
    					<td>
							<?php echo $row['ISBN'];?>
    					</td>
    					<td>
    						<?php echo $row['name'];?>	
    					</td>
    					<td>
							<?php echo $row['author'];?>
    					</td>
    					<td>
							<?php echo $row['publish'];?>
    					</td>
						<?php if($row['status'] == 1):?>
						<form action="<?php echo site_url('manage_booklist/set_book_down/'.$row['id']); ?>" method="post" >
    					<td>
    						<button type="submit" class="btn">
    							下架
    						</button>
    					</td>
						</form>
						<?php elseif($row['status'] == 0):?>
						<form action="<?php echo site_url('manage_booklist/set_book_up/'.$row['id']); ?>" method="post" >
    					<td>
    						<button type="submit" class="btn">
    							上架
    						</button>
    					</td>
						</form>
						<?php endif;?>
    				</tr>
					<?php endforeach;?>

    			</tbody>
    		</table>

    	<div class="row-fluid">
    	</div>
    	<table class="table">
    		<tbody>
    			<tr>
                    <ul class="pager">
                    <li class="previous">
					<a href='<?php echo site_url('manage_booklist/index')."/".($page['prevpage']);?>'>&larr; Older</a>
                     </li>
                     <li class="next">
					 <a href='<?php echo site_url('manage_booklist/index')."/".($page['nextpage']);?>'>Newer &rarr;</a>
                    </li>
                    </ul>
    			</tr>
    		</tbody>
    	</table>
    	
    </div>
    <div class="container-fluid">
    	<div class="row-fluid">
    		<!--/span-->
    		<!--/span-->
    	</div>
    	<!--/row-->
    	<div class="container">
    	</div>
    	<hr>
    	<footer>
    		<p class="pull-right">
    			© 2013 vtmer-studio. All rights reserved. 
    		</p>
    	</footer>
    </div>
    <!--/.fluid-container-->

    <style>
      
      body {
        padding-top: 60px;
        padding-bottom: 40px;
      }
      .sidebar-nav {
        padding: 9px 0;
      }
      .navbar-search .search-query{
        margin-left: 20px;
      }
      @media (max-width: 980px) {
        /* Enable use of floated navbar text */
        .navbar-text.pull-right {
          float: none;
          padding-left: 5px;
          padding-right: 5px;
        }
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
