<?php

class Add_book extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{	
		$header = array('title'=>'捐书页面','css_file'=>'add_book.css');
		$footer = array('js_file'=>'add_book');
		$this->parser->parse('template/header',$header);
		$this->load->view('add_book');
		$this->parser->parse('template/footer',$footer);
		
	}
	
	public function add()
	{
		$title = $this->input->post('booktitle');
		$isbn = $this->input->post('isbn');
		$author = $this->input->post('author');
		$publish = $this->input->post('publish');
		$version = $this->input->post('version');
		$course_name = $this->input->post('course_name');
		$course_type = $this->input->post('course_type');	
		$major = $this->input->post('major');
		$grade = $this->input->post('grade');
		$term = $this->input->post('term');
		$print = $this->input->post('print');

		//echo $title."</br>".$isbn."</br>".$author."</br>".$publish."</br>".$version."</br>".$course_name."</br>".$course_type."</br>".$major."</br>".$grade."</br>".$term;
		if($this->course_model->addbook($title,$isbn,$author,$publish,$version,$course_name,$course_type,$major,$grade,$term,$print))
		{
			echo "<script>alert('恭喜你!你已经成功捐出书本!');</script>";
			redirect('add_book');
		}
	}
}

?>
