<?php
class Home extends CI_Controller
{
	public  function __construct()
	{
		parent::__construct();
		$this->load->model('home_model');
		$this->load->model('search_model');
		$this->load->library('parser');		
		$this->load->library('Pager');
		$this->load->helper('form');
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
				$match[$i]['name'] = $row['name'];
				$i++;
			}
		}
		$data['system_match'] = $this->home_model->get_system_match($match);
		//分页
		$this->pager->set(0,1);//设置每页显示的条数
		$data['page']['num'] = $this->pager->get_pagenum($data['system_match']['user']);//获取总页数
		$data['system_match']['user'] = $this->pager->get_pagedata($data['system_match']['user'],$page);//当前页数据
		$data['page']['currentpage'] = $this->pager->get_currentpage();
		$data['page']['nextpage'] = $this->pager->get_nextpage();
		$data['page']['prevpage'] = $this->pager->get_prevpage();
		//END
		if($this->session->userdata['truename'])
		{
			$header = array('title'=>'工大书架','css_file'=>'home.css','points' => $this->session->userdata['points'],'truename' => $this->session->userdata['truename']);
		}
		else
		{
			$header = array('title'=>'工大书架','css_file'=>'home.css');
		}
		$footer = array('js_file'=>'home.js');
		$this->parser->parse('template/header',$header);
		$this->load->view('home',$data);
		$this->parser->parse('template/footer',$footer);
	}

	public function book_info($book_id)
	{
		$header = array('title'=>'书籍信息','css_file'=>'book_info.css');
		$footer = array('js_file'=>'book_info.js');
		//从URI中获取页数为第四个分段home/book_owner/3/1
		$page = $this->uri->segment(4,1);
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
		$data['user']['user'] = $this->pager->get_pagedata($data['user']['user'],$page);//当前页数据
		$data['page']['currentpage'] = $this->pager->get_currentpage();
		$data['page']['nextpage'] = $this->pager->get_nextpage();
		$data['page']['prevpage'] = $this->pager->get_prevpage();
		//END
		//var_dump($data['user']);
		$this->parser->parse('template/header',$header);
		$this->load->view('book_info',$data);
		$this->parser->parse('template/footer',$footer);
	}
	
	public function book_owner($user_id)
	{
		$header = array('title'=>'书籍拥有者','css_file'=>'book_owner.css');
		$footer = array('js_file'=>'book_owner.js');
		//从URI中获取页数为第四个分段:home/book_owner/3/1
		$page = $this->uri->segment(4,1);
		$data['user'] = $this->home_model->get_userinfo($user_id);
		if (!$data['user']) 
		{
			show_404();
			exit();
		}
		$data['books'] = $this->home_model->get_userbook($user_id);
		$data['user'][0]['booknum'] = count($data['books']);
		//分页		
		$this->pager->set(0,1);//设置每页显示的条数	
		$data['page']['num'] = $this->pager->get_pagenum($data['books']);//获取总页数
		$data['books'] = $this->pager->get_pagedata($data['books'],$page);//当前页数据
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
		$header = array('title'=>'借书页面','css_file'=>'check_step.css');
		$footer = array('js_file'=>'check_step');

		$info = $this->uri->uri_to_assoc(3);
		var_dump($info);

		$data['user'] = $this->home_model->get_userinfo($info['user']);
		
		$data['books'] = $this->home_model->get_bookborrow($info);
		//var_dump($data);
		$this->parser->parse('template/header',$header);
		$this->load->view('check_step',$data);
		$this->parser->parse('template/footer',$footer);
	}
}


