<?php
 class Home extends CI_Controller
 {
 	public function __construct()
	{
		parent::__construct();
	}
	public function index()
	{
		$this->load->view('management/home.html',array("username"=>$this->session->userdata('username')));
	}
	public function ajax_base()
	{
		if(!$this->input->get()) show_404();
		$id = $this->input->get('id');
		switch($id)
		{
			case '1' :$this->_div1();break;
			case '2' :$this->_div2();break;
			case '3' :$this->_div3();break;
			case '9' :$this->_div9();break;
		}
	}
	private function _page_config()
	{
		// $config['base_url'] = site_url('management/home/div2_ajaxPage');
		// $config['total_rows'] = $result['total'];
		// $config['per_page'] = 5; 
		//以上按实际情况配置
		$config['use_page_numbers'] = TRUE;
		//自定义起始链接,显示第一页或最后一页
		$config['first_link'] = FALSE;
		$config['last_link'] = FALSE;
		//封装标签
		$config['full_tag_open'] = '<div class="pagination" style="float:right"><ul>';
		$config['full_tag_close'] = '</ul></div>';
		//自定义“下一页”链接
		$config['next_link'] = 'Next';
		$config['next_tag_open'] = '<li>';
		$config['next_tag_close'] = '</li>';
		//自定义“上一页”链接
		$config['prev_link'] = 'Prev';
		$config['prev_tag_open'] = '<li>';
		$config['prev_tag_close'] = '</li>';
		//自定义“当前页”链接
		$config['cur_tag_open'] = '<li class="active"><a href="#">';
		$config['cur_tag_close'] = '</a></li>';
		//自定义“数字”链接
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		$config['anchor_class'] = 'class="ajax_page"';
		return $config;
	}

	private function _div1()
	{
		$data = $this->manage_model->global_info();
		echo $this->load->view('management/template/div1',$data,true);
		return;
	}
	private function _div2()
	{
		$per_page = 5;//设置每页显示的条数
		$data['top_ten'] = $this->manage_model->book_info();
		$result = $this->manage_model->booking_info(0,$per_page);
		$data['booking'] = $result['data'];
		
		$config = $this->_page_config();
		$config['base_url'] = site_url('management/home/div2_ajaxPage?id=2');
		$config['total_rows'] = $result['total'];
		$config['per_page'] = $per_page;
		$config['page_query_string'] = TRUE;
		 $config['query_string_segment'] ='page'; 

		$this->pagination->initialize($config); 

		$data['page'] = $this->pagination->create_links();
		echo $this->load->view('management/template/div2',$data,true);
		return;

	}
	public function div2_ajaxPage()
	{
		if($this->input->get('id')!='2') show_404();
		if($this->input->get('page')!='')
		$page = $this->input->get('page');
		else
			$page = 1;
		$per_page = 5;
		$offset = ($page-1)*$per_page;
		
		$result = $this->manage_model->booking_info($offset,$per_page);
		$data['booking'] = $result['data'];
		
		$config = $this->_page_config();
		$config['base_url'] = site_url('management/home/div2_ajaxPage?id=2');
		$config['total_rows'] = $result['total'];
		$config['per_page'] = $per_page;
		$config['page_query_string'] = TRUE;
		$config['query_string_segment'] ='page';  

		$this->pagination->initialize($config); 

		$data['page'] = $this->pagination->create_links();
		echo json_encode($data);
		return;
	}
	private function _div3()
	{
		$data['num'] = $this->manage_model->user_distribution();
		echo $this->load->view('management/template/div3',$data,true);
		return;
	}
	private function _div9()
	{
		$data['major'] = $this->manage_model->major_mgct();
		
		echo $this->load->view('management/template/div9',$data,true);
		return;
	}
}