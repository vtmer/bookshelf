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
	  $this->load->library('captcha_code');
	  $captcha_code = $this->captcha_code->show();
	  $this->session->set_userdata(array('captcha_code'=>$captcha_code));//将验证码存入session
	}
}
/*----End of captcha.php----*/