<?php

ob_start();

class Add_book extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
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
		$keywords = $_POST['isbncode'];
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
		}
	}

	public function search()
	{
		$queryString = $_POST['queryString']; 
		if(strlen($queryString) >0) 
		{ 
			$sql= "SELECT name FROM allbook WHERE name LIKE '".$queryString."%' LIMIT 8"; 
			$query = mysql_query($sql); 
			while ($result = mysql_fetch_array($query,MYSQL_BOTH))
			{ 
				$name=$result['name'];
				echo '<li onClick="fill(\''.$name.'\');">'.$name.'</li>'; 
			} 
		} 
	}


}

?>
