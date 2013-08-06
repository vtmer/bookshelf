<?php

class Add_book extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('search_model');
	}

	public function index()
	{	
        $messages = $this->user_model->show_message_num($this->session->userdata['uid']);
		$header = array('title'=>'捐书页面','css_file'=>'add_book.css','messages' => $messages);
		$footer = array('js_file'=>'add_book.js');
		$this->parser->parse('template/header',$header);
		$this->load->view('add_book');
		$this->parser->parse('template/footer',$footer);
		
	}
	
	public function add()
	{

		$ID_arr = $this->input->post();
		if(!$ID_arr) redirect('add_book');
		//验证捐书规则
		$flag = $this->course_model->check_rule($ID_arr);
		if($flag == 0)//非本专业的书
		{
			$msg = array('type'=>'alert','title'=>'提示信息','content'=>'对不起，部分书籍非您本专业课程所用书，请选择适当的书籍进行捐赠！');
			echo json_encode($msg);
			exit;
		}
		else if($flag == 1)//非本年级的书
		{
			$msg = array('type'=>'alert','title'=>'提示信息','content'=>'对不起，您还没上这门课喔，请选择其他书籍进行捐赠');
			echo json_encode($msg);
			exit;
		}
		else if($flag==2)//重复捐书
		{
			$url = site_url('my_book');
			$msg = array('type'=>'alert','title'=>'提示信息','content'=>"对不起，部分书籍您已经捐过了，到<a href='$url'><strong>我的书架</strong></a>看看吧");
			echo json_encode($msg);
			exit;
		}
		else if($flag==3)//通过
		{
			$flag = $this->course_model->addbook($ID_arr);
			$points = count($ID_arr)*5;
			if($flag)
			{
				$url = site_url('add_book/success')."/$points";
			}
			else
			$url = site_url('add_book/fail');

			$msg = array('type'=>'redirect','url'=>$url);
			echo json_encode($msg);
			exit;
		}
		show_404();
	}

	public function success($points='')
	{
		$data['type'] = 'add_succ';
		$data['points'] = $points;
		$header = array('title'=>'捐书成功','css_file'=>'add_succ.css');
		$footer = array('js_file'=>'add_succ.js');
		$this->parser->parse('template/header',$header);
		$this->load->view('template/all_result',$data);
		$this->parser->parse('template/footer',$footer);
	}

	public function fail()
	{
		$data['type'] = 'add_fail';
		$header = array('title'=>'捐书失败','css_file'=>'add_succ.css');
		$footer = array('js_file'=>'add_succ.js');
		$this->parser->parse('template/header',$header);
		$this->load->view('template/all_result',$data);
		$this->parser->parse('template/footer',$footer);
	}

	public function search()
	{

		$keywords = $this->input->get('keywords');
		if(is_numeric($keywords))
		{
			$books = $this->search_model->get_book_by_ISBN($keywords);
		}else
		{
			$books = $this->search_model->get_book_by_keywords($keywords);
		}
		echo json_encode($books);
		exit;			

	}


}