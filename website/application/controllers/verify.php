<?php

class Verify extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
	}

	public function index($uid,$activationkey)
	{
		if($this->user_model->verify($uid,$activationkey))
		{
			echo "<script>alert('Your email verification has been successed!');</script>";	
			if($this->is_logged_in())
			{
				$this->load->view('register');
			}
		}
	 
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
