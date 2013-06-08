<?php
class Book_owner extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('home_model');
		$this->config->load('pager_config',TRUE);
	}
	public function index($user_id)
	{		
		if (!isset($user_id)) 
		{
			show_404();
		}
		$data = $this->home_model->get_userbook($user_id,0,5);
		$data['user'] = $this->home_model->get_userinfo($user_id);
		if (!count($data['user'])) 
		{
			show_404();
		}
		$data['user'][0]['booknum'] = $data['pageNum'][0]['num'];
		$data['user'][0]['share'] = $this->home_model->calcul_share($user_id);
		//分页		
		$pager_config = $this->config->item('pager_config');
		$pager_config['uri_segment'] = 4;
		$pager_config['base_url'] = site_url('book_owner/ajaxPage/'.$user_id);
		$pager_config['total_rows'] = $data['user'][0]['booknum'];
		//$pager_config['per_page'] = 5; //设置每页显示的条数,默认为5
		$this->pagination->initialize($pager_config); 
		//END
		$header = array('title'=>'书籍拥有者','css_file'=>'book_owner.css');
		$footer = array('js_file'=>'book_owner.js');
		$this->parser->parse('template/header',$header);
		$this->load->view('book_owner',$data);
		$this->parser->parse('template/footer',$footer);
	}
	public function ajaxPage($user_id)
	{
		if (!isset($user_id)) 
		{
			show_404();
		}
		$user_id  = $this->uri->segment(3);
		$page = $this->uri->segment(4,1);
		$offset = ($page - 1)*5;
		$length = $offset +5;
		$data = $this->home_model->get_userbook($user_id,$offset,$length);

		$pager_config = $this->config->item('pager_config');
		$pager_config['uri_segment'] = 4;
		$pager_config['base_url'] = site_url('book_owner/ajaxPage/'.$user_id);
		$pager_config['total_rows'] = $data['pageNum'][0]['num'];
		//$pager_config['per_page'] = 5; //设置每页显示的条数，默认为5
		$this->pagination->initialize($pager_config); 
		$data['page'] = $this->pagination->create_links();
		echo json_encode($data);
		exit();

	}
}