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
		$data = $this->home_model->get_userbook($this->session->userdata('uid'),0,5);
		//分页		
		$data['page']['num'] = $data['pageNum'][0]['num'];//获取总数
		$pager_config = $this->config->item('pager_config');
		$pager_config['base_url'] = site_url('my_book/ajaxPage/');
		$pager_config['total_rows'] = $data['page']['num'];
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
		if (!isset($page)) 
		{
			show_404();
		}
		$offset = ($page - 1)*5;
		$length = $offset +5;
		$data = $this->home_model->get_userbook($this->session->userdata('uid'),$offset,$length);
		//分页		
		$data['page']['num'] = $data['pageNum'][0]['num'];//获取总数
		$pager_config = $this->config->item('pager_config');
		$pager_config['base_url'] = site_url('my_book/ajaxPage/');
		$pager_config['total_rows'] = $data['page']['num'];
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
/*----End of my_book.php----*/