<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller
{
    public function index()
    {
		if (!$this->is_logged_in()) 
		{
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
		
		
			$email = $this->input->post('username');
			$password = md5($this->input->post('pwd'));
			if($is_user = $this->user_model->is($email,$password))
			{
				echo "<script>alert('check successfully!');</script>";
			}
			else
			{
				echo "<script>alert('check failed!');</script>";
			}
			if ($is_user) 
			{
				$row = $this->user_model->get($email);
				$uid = $row->id;
				$points = $row->points; 
				$truename = $row->truename;
                /*储存用户信息至session*/
                $data = array(
                    'email' => $email,
					'points' => $points,
					'truename' => $truename,
                    'uid' => $uid,
                    'is_logged_in' => TRUE,
                    'is_admin' => FALSE
                );
				$this->session->set_userdata($data);
               	$this->load->view('template/header',$datas);
				redirect('home');
			} 
			else 
			{
                redirect('login/error');
			}
		 
    }
    
    public function error()
    {
        $this->load->view('login', array('error' => TRUE));
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
