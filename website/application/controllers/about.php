<?php 
class About extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
	}
	public function index()
	{
		$header = array('title'=>'关于工大书架','css_file'=>'about.css'); 
		$footer = array('js_file'=>'about.js');
		$this->parser->parse('template/header',$header);
		$this->load->view('about');
		$this->parser->parse('template/footer',$footer);
	}
	public function submit()
	{
		if($this->input->post())
		{
			$email = $this->input->post('email');
			$title = $this->input->post('title');
			$content = $this->input->post('fb_content');
			//发邮件
			$this->load->library('email');
			$this->config->load('email');
			$this->email->from('gdutbookshelf@163.com','维生数工作室');
			$this->email->to('gdutbookshelf@163.com');
			$this->email->subject('意见收集--'.$email);
			$this->email->message('<strong>'.$title.'</strong><br/>'.$content);
	        if($this->email->send())
	        {
	        	echo '发送成功!感谢您的支持。';
	        }
	        else
	       	{
	       		echo '发送失败！请重试！';
	       	}
		}
		else
		{
			show_404();
		}
	}
}