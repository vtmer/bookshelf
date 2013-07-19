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
		//$title = $_POST['booktitle'];
		/*$keywords = $_POST['isbncode'];
		$print = $_POST['print'];
		//echo "<script>alert(".$title.$isbn.$print.");</script>";

		if($this->course_model->addbook($keywords,$print))
		{
			echo "<meta http-equiv='Content-Type' content='text/html; charset=utf-8'>";
			echo "<script>alert('恭喜你!你已经成功捐出书本!');</script>";
			redirect('add_book','refresh');		
		}
		else
		{
			//redirect('add_book');
			echo "<meta http-equiv='Content-Type' content='text/html; charset=utf-8'>";
			echo "<script>alert('不好意思哦!我们书库暂时还不支持这本书！欢迎反馈哦！');</script>";
			redirect('add_book','refresh');
		}*/

		$ID_arr = $this->input->post();
		if(!$ID_arr) redirect('add_book');
		$flag = $this->course_model->addbook($ID_arr);
		$data['points'] = count($ID_arr)*5;
		if($flag)
		{
			$header = array('title'=>'捐书成功','css_file'=>'add_succ.css');
			$footer = array('js_file'=>'add_succ.js');
			$this->parser->parse('template/header',$header);
			$this->load->view('add_succ',$data);
			$this->parser->parse('template/footer',$footer);
		}
		else
			show_404();
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