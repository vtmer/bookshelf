<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
	}
    public function index()
    {
		if (!$this->is_logged_in()) 
		{
			if(isset($_COOKIE['uid']))
			{
				echo '正在跳转......';
				$uid = substr($_COOKIE['uid'], 32);
				$user_data = $this->home_model->get_userinfo($uid);
				//储存用户信息至session
                	$data = array(
						'points' => $user_data[0]['points'],
						'truename' => $user_data[0]['truename'],
                	    'uid' => $user_data[0]['id'],
						'major' => $user_data[0]['major'],
						'grade' => $user_data[0]['grade'],
                	    'is_logged_in' => TRUE,
                	);
	            $this->session->set_userdata($data);
	            header("Location:".site_url('home'));
			}
			$this->load->view('login');
		} 
		else 
		{
            redirect('home');
        }
    }
    
	//登陆验证
    public function check()
	{   
			
       /* $this->load->library('form_validation');
        $this->form_validation->set_rules('username', 'Email', 'required|max_length[40]|valid_email');
        $this->form_validation->set_rules('pwd', 'Password', 'required|min_length[8]|max_length[20]|alpha_numeric');

		if ($this->form_validation->run() == FALSE) 
		{
            redirect('login/error');
		}*/ 
		//var_dump($this->input->post('auto_login'));
		//exit()
            $this->output
                ->set_content_type('application/json')
                ->set_status_header('200');
		
			$email = $this->input->post('username');
			if(!$this->user_model->is_active($email))
			{
				$msg = array('type'=>'alert','title'=>'提示信息','content'=>'帐号未激活！');
				echo json_encode($msg);
				exit();
			}
			$password = md5($this->input->post('pwd'));
			if($is_user = $this->user_model->is($email,$password))
			{
				if ($is_user) 
				{
					$row = $this->user_model->get($email);
					$uid = $row->id;
					$points = $row->points; 
					$truename = $row->truename;
					$major = $row->major;
					$grade = $row->grade;
                	//储存用户信息至session
                	$data = array(
						'points' => $points,
						'truename' => $truename,
                	    'uid' => $uid,
						'major' => $major,
						'grade' => $grade,
                	    'is_logged_in' => TRUE,
                	);
	                $this->session->set_userdata($data);
	                //设置cookies
	                if($this->input->post('auto_login'))
	                {
		                $user_id = md5($uid).$uid;//按照md5(uid)+uid加密
		                setcookie('uid',$user_id,time()+3600*24*7);//持续一周
		            }
	                $this->output->set_output(json_encode(array(
	                    'type' => 'redirect',
	                    'title' => '提示信息',
	                    'content' => '登录成功',
	                    'url' => site_url('home')
	                )));
	                return;
				}
			}
			else 
			{
                $msg = array('type'=>'alert','title'=>'提示信息','content'=>'密码错误！');
                $this->output->set_output(json_encode($msg));
                return;
			}
		 
    }

	//退出登陆
    public function logout()
    {
		if (!$this->is_logged_in()) 
		{
            redirect('login');
		} 
		else 
		{
            $this->session->set_userdata(array('is_logged_in' => FALSE));
            $this->session->sess_destroy();
            setcookie("uid", "", time()-3600*24*7);//让cookie过期
            $this->load->view('login');
        }
    }
	
	//判断登陆状态
    private function is_logged_in()
    {
        return $this->session->userdata('is_logged_in');
    }
}
/*End of file login.php*/
