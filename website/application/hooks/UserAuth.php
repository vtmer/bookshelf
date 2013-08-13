<?php
/** * * 用户登录权限拦截钩子  */
class UserAuth 
{
	private $CI;
	public function __construct()
	{
		$this->CI = &get_instance();//初始化CI资源
	}
	/**     * 权限认证     */
	public function auth() 
	{
		// $this->CI->load->helper('url');

		if(preg_match("/captcha.*/i", uri_string()))//验证码
		{

		}
		else if(preg_match("/management.*/i", uri_string()))
		{
			if(preg_match("/management\/home.*/i", uri_string()))
			{
				if($this->CI->session->userdata('authority')!='admin')
		 		{
		 			//后台管理员登录
		 			redirect('management/login');
					return;
		 		}
			}
		}
		else if ( !preg_match("/login.*/i", uri_string()) )//排除登录页、注册页
		 {
		 	if( !preg_match("/register.*/i", uri_string()) )
		 	{
			    if( !$this->CI->session->userdata('is_logged_in') )
				{
					// 用户未登录		
					redirect('login');
					return;
				}
		 	}
		 }
	}
}
/**END of userAuth.php  location:application/hooks/ **/ 