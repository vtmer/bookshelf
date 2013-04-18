<?php
class Book_info extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('search_model');
	}
	public function index($id)
	{
		echo $id;
		$this->load->view('book_info');
	}
}