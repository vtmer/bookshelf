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
							<a href="<?php echo site_url('manage_booklist'); ?>">图书列表</a>
						</li>
    					<li class="active">
							<a href="<?php echo site_url('manage_addbook'); ?>">添加图书</a>
    					</li>
    					<li>
							<a href="<?php echo site_url('manage_edituser'); ?>">编辑用户权限</a>
    					</li>
    					<li>
							<a href="<?php echo site_url('manage_editpwd'); ?>" class="text-right">修改密码</a>
    					</li>
    				</ul>
    			</div>
    			<!--/.nav-collapse -->
				<a href="<?php echo site_url('admin/logout'); ?>" class="btn pull-right" id="logout">退出</a>
    		</div>
    	</div>
    </div>
    <div class="container">
    	<div class="control-group">
    		<div class="controls">
    		</div>
    	</div>
    	<div class="container">
    	</div>
    	<div class="navbar">
    	</div>
    	<form>
    		<div class="row-fluid">
    			<div class="span4">
    				<div class="control-group">
    					<div class="controls">
    					</div>
    				</div>
    				<div class="control-group">
    					<div class="controls">
    						<div class="control-group">
    							<div class="controls pull-right">
    							</div>
    						</div>
    						<input type="text" id="isbn1" placeholder="请输入ISBN..." class=""></br>
    						<input type="text" id="title1" placeholder="书名..." class="">
    						<div class="control-group">
    							<div class="controls">
    								<input type="text" id="author1" placeholder="作者..." class="">
    							</div>
    						</div>
    					</div>
    				</div>
    				<div class="control-group">
    					<div class="controls">
    						<input type="text" id="publish1" placeholder="出版社..." class="">
    						<div class="control-group">
    							<div class="control-group">
    								<div class="controls">
    									<input type="text" id="version1" placeholder="版次..." class="">
    								</div>
    							</div>
    							<div class="controls">
    								<input type="text" id="course_name1" placeholder="课程名称..." class="">
    							</div>
    						</div>
    						<div class="control-group">
    							<div class="controls">
    								<div class="control-group">
    									<div class="controls">
    									</div>
    								</div>
    								<input type="text" id="course_category1" placeholder="课程种类（如班级课程、公选课程）..." class="">
    							</div>
    						</div>
    					</div>
    				</div>
    				<div class="control-group">
    					<div class="controls">
    						<select id="term1" class="">
    							<option value="1">
    								第一学期
    							</option>
    							<option value="2">
    								第二学期
    							</option>
    							<option value="">
    							</option>
    						</select>
    						<div class="control-group">
    							<div class="controls">
    								<select id="print1" class="">
    									<option value="0">
    										不是胶印
    									</option>
    									<option value="1">
    										胶印
    									</option>
    									<option value="">
    									</option>
    								</select>
    							</div>
    						</div>
    					</div>
    				</div>
    				<button type="submit" class="btn btn-info pull-left" id="get_info1">
    					获取图书信息
    				</button>
    			</div>
    			
    			
    		<div class="span4">
    				<div class="control-group">
    					<div class="controls">
    					</div>
    				</div>
    				<div class="control-group">
    					<div class="controls">
    						<div class="control-group">
    							<div class="controls pull-right">
    							</div>
    						</div>
    						<input type="text" id="isbn2" placeholder="请输入ISBN..." class="">
    						<input type="text" id="title2" placeholder="书名..." class="">
    						<div class="control-group">
    							<div class="controls">
    								<input type="text" id="author2" placeholder="作者...">
    							</div>
    						</div>
    					</div>
    				</div>
    				<div class="control-group">
    					<div class="controls">
    						<input type="text" id="publish2" placeholder="出版社..." class="">
    						<div class="control-group">
    							<div class="control-group">
    								<div class="controls">
    									<input type="text" id="version2" placeholder="版次..." class="">
    								</div>
    							</div>
    							<div class="controls">
    								<input type="text" id="course_name2" placeholder="课程名称..." class="">
    							</div>
    						</div>
    						<div class="control-group">
    							<div class="controls">
    								<div class="control-group">
    									<div class="controls">
    									</div>
    								</div>
    								<input type="text" id="course_category2" placeholder="课程种类（如班级课程、公选课程）...">
    							</div>
    						</div>
    					</div>
    				</div>
    				<div class="control-group">
    					<div class="controls">
    						<select id="term2">
    							<option value="1">
    								第一学期
    							</option>
    							<option value="2">
    								第二学期
    							</option>
    							<option value="">
    							</option>
    						</select>
    						<div class="control-group">
    							<div class="controls">
    								<select id="print2" class="">
    									<option value="0">
    										不是胶印
    									</option>
    									<option value="1">
    										胶印
    									</option>
    									<option value="">
    									</option>
    								</select>
    							</div>
    						</div>
    					</div>
    				</div>
    				<button type="submit" class="btn btn-info pull-left" id="get_info2">
    					获取图书信息	
    				</button>
    			</div><div class="span4">
    				<div class="control-group">
    					<div class="controls">
    					</div>
    				</div>
    				<div class="control-group">
    					<div class="controls">
    						<div class="control-group">
    							<div class="controls pull-right">
    							</div>
    						</div>
    						<input type="text" id="isbn3" placeholder="请输入ISBN..." class="">
    						<input type="text" id="title3" placeholder="书名..." class="">
    						<div class="control-group">
    							<div class="controls">
    								<input type="text" id="author3" placeholder="作者..." class="">
    							</div>
    						</div>
    					</div>
    				</div>
    				<div class="control-group">
    					<div class="controls">
    						<input type="text" id="publish3" placeholder="出版社..." class="">
    						<div class="control-group">
    							<div class="control-group">
    								<div class="controls">
    									<input type="text" id="version3" placeholder="版次..." class="">
    								</div>
    							</div>
    							<div class="controls">
    								<input type="text" id="course_name3" placeholder="课程名称..." class="">
    							</div>
    						</div>
    						<div class="control-group">
    							<div class="controls">
    								<div class="control-group">
    									<div class="controls">
    									</div>
    								</div>
    								<input type="text" id="course_category3" placeholder="课程种类（如班级课程、公选课程）..." class="">
    							</div>
    						</div>
    					</div>
    				</div>
    				<div class="control-group">
    					<div class="controls">
    						<select id="term3" class="">
    							<option value="1">
    								第一学期
    							</option>
    							<option value="2">
    								第二学期
    							</option>
    							<option value="">
    							</option>
    						</select>
    						<div class="control-group">
    							<div class="controls">
    								<select id="print3" class="">
    									<option value="0">
    										不是胶印
    									</option>
    									<option value="1">
    										胶印
    									</option>
    									<option value="">
    									</option>
    								</select>
    							</div>
    						</div>
    					</div>
    				</div>
    				<button type="submit" class="btn btn-info pull-left" id="get_info3">
    					获取图书信息
    				</button>
    			</div></div>
    	</form>
    	<div class="row-fluid">
    	</div>
    	<hr class=""><div class="container">
    		<div class="control-group">
    			<div class="controls">
    			</div>
    		</div>
    		<div class="container">
    		</div>
    		<div class="navbar">
    		</div>
    		
    		<form><div class="row-fluid"><div class="span4">
    				<div class="control-group">
    					<div class="controls">
    					</div>
    				</div>
    				<div class="control-group">
    					<div class="controls">
    						<div class="control-group">
    							<div class="controls pull-right">
    							</div>
    						</div>
    						<input type="text" id="isbn4" placeholder="请输入ISBN..." class="">
    						<input type="text" id="title4" placeholder="书名..." class="">
    						<div class="control-group">
    							<div class="controls">
    								<input type="text" id="author4" placeholder="作者..." class="">
    							</div>
    						</div>
    					</div>
    				</div>
    				<div class="control-group">
    					<div class="controls">
    						<input type="text" id="publish4" placeholder="出版社..." class="">
    						<div class="control-group">
    							<div class="control-group">
    								<div class="controls">
    									<input type="text" id="version4" placeholder="版次...">
    								</div>
    							</div>
    							<div class="controls">
    								<input type="text" id="course_name4" placeholder="课程名称..." class="">
    							</div>
    						</div>
    						<div class="control-group">
    							<div class="controls">
    								<div class="control-group">
    									<div class="controls">
    									</div>
    								</div>
    								<input type="text" id="course_category4" placeholder="课程种类（如班级课程、公选课程）..." class="">
    							</div>
    						</div>
    					</div>
    				</div>
    				<div class="control-group">
    					<div class="controls">
    						<select id="term4" class="">
    							<option value="1">
    								第一学期
    							</option>
    							<option value="2">
    								第二学期
    							</option>
    							<option value="">
    							</option>
    						</select>
    						<div class="control-group">
    							<div class="controls">
    								<select id="print4" class="">
    									<option value="0">
    										不是胶印
    									</option>
    									<option value="1">
    										胶印
    									</option>
    									<option value="">
    									</option>
    								</select>
    							</div>
    						</div>
    					</div>
    				</div>
    				<button type="submit" class="btn btn-info jetstrap-selected pull-left" id="get_info4">
    					获取图书信息
    				</button>
    			</div><div class="span4">
    				<div class="control-group">
    					<div class="controls">
    					</div>
    				</div>
    				<div class="control-group">
    					<div class="controls">
    						<div class="control-group">
    							<div class="controls pull-right">
    							</div>
    						</div>
    						<input type="text" id="isbn5" placeholder="请输入ISBN..." class="">
    						<input type="text" id="title5" placeholder="书名..." class="">
    						<div class="control-group">
    							<div class="controls">
    								<input type="text" id="author5" placeholder="作者..." class="">
    							</div>
    						</div>
    					</div>
    				</div>
    				<div class="control-group">
    					<div class="controls">
    						<input type="text" id="publish5" placeholder="出版社..." class="">
    						<div class="control-group">
    							<div class="control-group">
    								<div class="controls">
    									<input type="text" id="version5" placeholder="版次..." class="">
    								</div>
    							</div>
    							<div class="controls">
    								<input type="text" id="course_name5" placeholder="课程名称...">
    							</div>
    						</div>
    						<div class="control-group">
    							<div class="controls">
    								<div class="control-group">
    									<div class="controls">
    									</div>
    								</div>
    								<input type="text" id="course_category5" placeholder="课程种类（如班级课程、公选课程）...">
    							</div>
    						</div>
    					</div>
    				</div>
    				<div class="control-group">
    					<div class="controls">
    						<select id="term5">
    							<option value="1">
    								第一学期
    							</option>
    							<option value="2">
    								第二学期
    							</option>
    							<option value="">
    							</option>
    						</select>
    						<div class="control-group">
    							<div class="controls">
    								<select id="print5" class="">
    									<option value="0">
    										不是胶印
    									</option>
    									<option value="1">
    										胶印
    									</option>
    									<option value="">
    									</option>
    								</select>
    							</div>
    						</div>
    					</div>
    				</div>
    				<button type="submit" class="btn btn-info pull-left" id="get_info5">
    					获取图书信息
    				</button>
    			</div><div class="span4 pull-right">
    				<div class="control-group">
    					<div class="controls">
    					</div>
    				</div>
    				<div class="control-group">
    					<div class="controls">
    						<div class="control-group">
    							<div class="controls pull-right">
    							</div>
    						</div>
    						<input type="text" id="isbn6" placeholder="请输入ISBN..." class="">
    						<input type="text" id="title6" placeholder="书名..." class="">
    						<div class="control-group">
    							<div class="controls">
    								<input type="text" id="author6" placeholder="作者..." class="">
    							</div>
    						</div>
    					</div>
    				</div>
    				<div class="control-group">
    					<div class="controls">
    						<input type="text" id="publish6" placeholder="出版社..." class="">
    						<div class="control-group jetstrap-highlighted">
    							<div class="control-group">
    								<div class="controls">
    									<input type="text" id="version6" placeholder="版次..." class="">
    								</div>
    							</div>
    							<div class="controls">
    								<input type="text" id="course_name6" placeholder="课程名称..." class="">
    							</div>
    						</div>
    						<div class="control-group">
    							<div class="controls">
    								<div class="control-group">
    									<div class="controls">
    									</div>
    								</div>
    								<input type="text" id="course_category6" placeholder="课程种类（如班级课程、公选课程）..." class="">
    							</div>
    						</div>
    					</div>
    				</div>
    				<div class="control-group">
    					<div class="controls">
    						<select id="term6" class="">
    							<option value="1">
    								第一学期
    							</option>
    							<option value="2">
    								第二学期
    							</option>
    							<option value="">
    							</option>
    						</select>
    						<div class="control-group">
    							<div class="controls">
    								<select id="print6" class="">
    									<option value="0">
    										不是胶印
    									</option>
    									<option value="1">
    										胶印
    									</option>
    									<option value="">
    									</option>
    								</select>
    							</div>
    						</div>
    					</div>
    				</div>
    				<button type="submit" class="btn btn-info pull-left" id="get_info6">
    					获取图书信息
    				</button>
    			</div></div></form><div class="container"></div><div class="row-fluid">
    		</div>
    	</div>
    </div>
    <div class="container"><div class="alert"><h3 class="">Alert!</h3><p class="">This is not a test</p></div><button type="submit" class="btn pull-right btn-large" id="submit_all">确认添加书本</button></div><div class="container-fluid">
    	<div class="row-fluid">
    		<!--/span-->
    		<!--/span-->
    	</div>
    	<!--/row-->
    	<div class="container">
    	</div>
    	<hr class="">
    	<footer>
    		<p class="">
    			© Company 2013
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
