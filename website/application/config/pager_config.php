<?php
		$config['base_url'] = site_url('home/index/');
		$config['total_rows'] = 1;
		$config['per_page'] = 5; 
		$config['use_page_numbers'] = TRUE;
		//自定义起始链接,显示第一页或最后一页
		$config['first_link'] = FALSE;
		$config['last_link'] = FALSE;
		//封装标签
		$config['full_tag_open'] = '<ul class="pages">';
		$config['full_tag_close'] = '</ul>';
		//自定义“下一页”链接
		$config['next_link'] = '';
		$config['next_tag_open'] = '<li class="next">';
		$config['next_tag_close'] = '</li>';
		//自定义“上一页”链接
		$config['prev_link'] = '';
		$config['prev_tag_open'] = '<li class="prev">';
		$config['prev_tag_close'] = '</li>';
		//自定义“当前页”链接
		$config['cur_tag_open'] = '<li class="page on_select"><a href="#">';
		$config['cur_tag_close'] = '</a></li>';
		//自定义“数字”链接
		$config['num_tag_open'] = '<li class="page">';
		$config['num_tag_close'] = '</li>';
		$config['anchor_class'] = 'class="ajax_page"';
 
/*------END of pager_config-------------------*/