<?php
class Captcha extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('session');
	}
	public function index()
	{
		ob_start();
	  $this->load->library('captcha_code');
	  $captcha_code = $this->captcha_code->show();
	  $this->session->set_userdata(array('captcha_code'=>$captcha_code));//将验证码存入session
	  ob_end_flush();
	}
}
/*----End of captcha.php----*/