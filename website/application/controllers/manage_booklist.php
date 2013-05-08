<?php 

class Manage_booklist extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$this->load->view('management/manage_booklist');
	}
}

?>
