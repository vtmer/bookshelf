<?php

class Add_book extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('home_model');
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
		$flag = $this->course_model->addbook($ID_arr);
		$points = count($ID_arr)*5;
		if($flag)
		{
			redirect(site_url('add_book/success')."/$points");
		}
		else
			redirect(site_url('add_book/fail'));
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