<?php

class Qa extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
	}
	public function index()
	{
		$header = array('title'=>'工大书架-Q&A','css_file'=>'QA.css'); 
		$footer = array('js_file'=>'QA.js');
		$this->parser->parse('template/header',$header);
		$this->load->view('Qa');
		$this->parser->parse('template/footer',$footer);
	}
}