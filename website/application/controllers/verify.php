<?php

class Verify extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		show_404();
	}
	public function activate($uid,$activationkey)
	{
		$activationkey_db = $this->user_model->get_active($uid);
		if($activationkey == $activationkey_db)
		{
			$this->user_model->activate($uid);
			$this->session->unset_userdata('username');//从session删除用户名
			$this->load->view('verify_success');
			$this->parser->parse('template/footer',array('js_file' => 'verify_success.js'));
		}else
		redirect('login','refresh');
	}
	//判断是否为登陆状态
	private function is_logged_in()
	{
		return $this->session->userdata('is_logged_in');
	}
}

/*End of file verify.php*/
