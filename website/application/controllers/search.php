<?php 
class Search extends CI_Controller
{
	public  function __construct()
	{
		parent::__construct();
		$this->load->model('search_model');
		$this->load->library('parser');
	}

	public function index()
	{
		$this->load->helper('form');

		$header = array('title'=>'搜索书籍','css_file'=>'search.css');
	    $footer = array('js_file'=>'search.js');

		if($keywords = $this->input->post('keywords'))
		{
			$data['books'] = $this->search_model->get_book_by_keywords($keywords);
			$this->parser->parse('template/header',$header);	
			$this->load->view('search',$data);
			$this->parser->parse('template/footer',$footer);
		}
		else
		{
			header("location:base_url('index.php/home')");
		}	
	}
		
}