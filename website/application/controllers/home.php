<?php
class Home extends CI_Controller
{
	public  function __construct()
	{
		parent::__construct();
		$this->load->model('home_model');
		$this->load->library('parser');
		$this->load->helper('form');
		$this->load->library('Pager');
	}
	public function index($page=1)
	{	
		$data['book_need'] = $this->home_model->get_book_need('网络工程','2011');
		$match = array();
		$i = 0;
		foreach ($data as $value) 
		{
			foreach ($value as $row) 
			{
				$match[$i]['id'] = $row['id'];
				$match[$i]['ISBN'] = $row['ISBN'];
				$match[$i]['name'] = $row['name'];
				$i++;
			}
		}
		$data['system_match'] = $this->home_model->get_system_match($match);
		//分页
		$this->pager->set(0,1);//设置每页显示的条数
		$data['page']['num'] = $this->pager->get_pagenum($data['system_match']['user']);//获取总页数
		$data['system_match']['user'] = $this->pager->get_pagedata($data['system_match']['user'],$page);
		$data['page']['currentpage'] = $this->pager->get_currentpage();
		$data['page']['nextpage'] = $this->pager->get_nextpage();
		$data['page']['prevpage'] = $this->pager->get_prevpage();
		//END
		$header = array('title'=>'工大书架','css_file'=>'home.css');
		$footer = array('js_file'=>'home.js');

		$this->parser->parse('template/header',$header);
		$this->load->view('home',$data);
		$this->parser->parse('template/footer',$footer);
	}

	public function book_info($book_id,$page=1)
	{
		$header = array('title'=>'书籍信息','css_file'=>'book_info.css');
		$footer = array('js_file'=>'book_info.js');

		$this->load->model('search_model');

		$data['book_info'] = $this->search_model->get_book_by_id($book_id);
		if(!$data['book_info']) 
		{
			show_404();
			exit();
		}
		$data['user'] = $this->home_model->get_system_match(array(array('ISBN'=>$data['book_info'][0]->ISBN,
																'name'=>$data['book_info'][0]->name,'id'=>$book_id)));
		//分页
		$this->pager->set(0,1);//设置每页显示的条数
		$data['page']['num'] = $this->pager->get_pagenum($data['user']['user']);//获取总页数
		$data['user']['user'] = $this->pager->get_pagedata($data['user']['user'],$page);
		$data['page']['currentpage'] = $this->pager->get_currentpage();
		$data['page']['nextpage'] = $this->pager->get_nextpage();
		$data['page']['prevpage'] = $this->pager->get_prevpage();
		//END
		//var_dump($data['user']);
		$this->parser->parse('template/header',$header);
		$this->load->view('book_info',$data);
		$this->parser->parse('template/footer',$footer);
	}
	
	public function book_owner($user_id,$page=1)
	{
		$header = array('title'=>'书籍拥有者','css_file'=>'book_owner.css');
		$footer = array('js_file'=>'book_owner.js');

		$data['user'] = $this->home_model->get_userinfo($user_id);
		if (!$data['user']) 
		{
			show_404();
			exit();
		}
		$data['books'] = $this->home_model->get_userbook($user_id);
		$data['user'][0]['booknum'] = count($data['books']);
		//分页		
		$this->pager->set(0,5);//设置每页显示的条数	
		$data['page']['num'] = $this->pager->get_pagenum($data['books']);//获取总页数
		$data['books'] = $this->pager->get_pagedata($data['books'],$page);
		$data['page']['currentpage'] = $this->pager->get_currentpage();
		$data['page']['nextpage'] = $this->pager->get_nextpage();
		$data['page']['prevpage'] = $this->pager->get_prevpage();
		//END
		$this->parser->parse('template/header',$header);
		$this->load->view('book_owner',$data);
		$this->parser->parse('template/footer',$footer);
	}
	
	public function check_step()
	{
		echo 'book='.$this->uri->segment(4);
		echo '<br/>user='.$this->uri->segment(6);
	}
}


