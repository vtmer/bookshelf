<?php

class Qa extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
	}
	public function index()
	{
		$header = array('title'=>'工大书架-Q&A','css_file'=>'qa.css'); 
		$footer = array('js_file'=>'qa.js');
		$this->parser->parse('template/header',$header);
		$this->load->view('qa');
		$this->parser->parse('template/footer',$footer);
	}
}