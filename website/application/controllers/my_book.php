<?php
class My_book extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('home_model');
		$this->config->load('pager_config',TRUE);
	}
	public function index()
	{
		if(!isset($this->session->userdata['is_logged_in']))//如果没被引导，则跳转到引导页
		{
			header('location:/index.php/guide');
		} 
		$data['books'] = $this->home_model->get_userbook($this->session->userdata('uid'));
		//分页		
		$this->pager->set(0,5);//设置每页显示的数据条数	
		$data['page']['num'] = count($data['books']);//获取总数
		$data['books'] = $this->pager->get_pagedata($data['books'],1);//当前页数据
		$pager_config = $this->config->item('pager_config');
		$pager_config['base_url'] = site_url('my_book/ajaxPage/');
		$pager_config['total_rows'] = $data['page']['num'];
		$pager_config['per_page'] = 5; //设置每页显示的条数
		$this->pagination->initialize($pager_config); 
		//END
		$header = array('title'=>'我的书架','css_file'=>'my_book.css');
		$footer = array('js_file'=>'my_book.js');
		$this->parser->parse('template/header',$header);
		$this->load->view('my_book',$data);
		$this->parser->parse('template/footer',$footer);		
	}
	public function ajaxPage($page = 1)
	{
		$data['books'] = $this->home_model->get_userbook($this->session->userdata('uid'));
		//分页		
		$this->pager->set(0,5);//设置每页显示的数据条数	
		$data['page']['num'] = count($data['books']);//获取总数
		$data['books'] = $this->pager->get_pagedata($data['books'],$page);//当前页数据
		$pager_config = $this->config->item('pager_config');
		$pager_config['base_url'] = site_url('my_book/ajaxPage/');
		$pager_config['total_rows'] = $data['page']['num'];
		$pager_config['per_page'] = 5; //设置每页显示的条数
		$this->pagination->initialize($pager_config); 
		$data['page'] = $this->pagination->create_links();
		echo json_encode($data);
		exit();
	}
	public function pull_off()
	{
		if($id = $this->input->post('book_id'))
		{
			if($this->home_model->pull_off($id))
			{
				$msg = array('type'=>'alert','title'=>'提示信息','content'=>'书本下架成功！');
				echo json_encode($msg);
				exit();
			}else
			{
				$msg = array('type'=>'alert','title'=>'提示信息','content'=>'书本下架失败,请重试！');
				echo json_encode($msg);
				exit();
			}
				
		}
		else
		{
			redirect('my_book','refresh');
		}
	}

}