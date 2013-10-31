<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
        $this->load->library('eswis');
	}
    public function index()
    {
		if (!$this->is_logged_in()) 
		{
			if(isset($_COOKIE['uid']))
			{
				ob_start();
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
	            redirect('guide');
	            ob_end_flush();
			}
			$this->load->view('login');
		} 
		else 
		{
            redirect('guide');
        }
    }
    
	//登陆验证
    public function check()
	{
		$student_id = $this->input->post('username');
		$pwd = $this->input->post('pwd');
		$login = false;
		$row = $this->user_model->get($student_id);
		if($row==null)//如果是第一次登录
		{
            $result = $this->eswis->login($student_id, $pwd);
			if(!$result['session_id'])
			{
				$msg = array('type'=>'alert','title'=>'提示信息','content'=>$result);
	           	echo json_encode($msg);
	            exit;
			}
            else
            {
        		$this->session->set_userdata('student_id',$student_id);
        		$this->session->set_userdata('s_id',$result['session_id']);
                $this->session->set_userdata('eswis_key',$result['key']);
        		$url = site_url('register');
                $msg = array('type'=>'redirect','url'=>$url,'content'=>'正在获取用户数据,请稍后');
                echo json_encode($msg);
                exit;//跳转到信息填写
            }
		}
		else
		{//检查数据库
			$query = $this->db->get_where('user', array('student_id' => $student_id,'password'=>md5($pwd)));
			$flag = $query->num_rows() == 1 ? TRUE : FALSE;
			if($flag==FALSE)
			{
                $result = $this->eswis->login($student_id, $pwd);
				if(!$result['session_id'])
				{
					$msg = array('type'=>'alert','title'=>'提示信息','content'=>$result);
		           	echo json_encode($msg);
		            exit;
				}else
				{//success
					//update pwd into database
					$uid = $row->id;
					$this->db->update('user',array('password'=>md5($pwd)),array('id'=>$uid));
					$login = TRUE;
				}
			}else
			{	
				$login = TRUE;
			}
		}
		if($login==TRUE)
		{
			$uid = $row->id;
	    	//储存用户信息至session
	    	$data = array(
				'points' => $row->points,
				'truename' => $row->truename,
	    	    'uid' => $uid,
				'major' => $row->major,
				'grade' => $row->grade,
	    	    'is_logged_in' => TRUE,
	    	);
	        $this->session->set_userdata($data);
	        //设置cookies
	        if($this->input->post('auto_login'))
	        {
	            $user_id = md5($uid).$uid;//按照md5(uid)+uid加密
	            setcookie('uid',$user_id,time()+3600*24*7);//持续一周
	        }
	        $url = site_url('guide');
	        $msg = array('type'=>'redirect','url'=>$url);
	        echo json_encode($msg);
	        exit;		
		}
		else 
		{
            $msg = array('type'=>'alert','title'=>'提示信息','content'=>'系统错误');
           	echo json_encode($msg);
            exit;
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
            $this->session->sess_destroy();
            $this->session->set_userdata(array('is_logged_in' => FALSE));
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
