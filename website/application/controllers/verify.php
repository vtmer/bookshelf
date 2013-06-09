<?php

class Verify extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
	}

	public function index($uid,$activationkey)
	{
		$this->user_model->activate($uid);
		$activationkey_db = $this->user_model->get_active($uid);
		if($activationkey == $activationkey_db)
		{
			echo "<script>alert('验证成功！');</script>";
		}
		$this->user_model->activate($uid);
		redirect('login','refresh');
	}

	/*  利用jq在views页面显示提示信息
	private json_response($issuccessful,$message)
	{
		return json_encode(array(
			   'issuccessful' => $issuccessful,
			   'message' => $message
		   ));	
	}
	*/

	//判断是否为登陆状态
	private function is_logged_in()
	{
		return $this->session->userdata('is_logged_in');
	}
}

/*End of file verify.php*/
