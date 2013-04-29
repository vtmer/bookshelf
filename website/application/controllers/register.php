<?php

class Register extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('user_model');
	}	

	public function index()
	{
		$this->load->view('register');	
	}

	//注册时验证函数
	public function check()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('username','Username','required|max_length[40]|valid_email');
		$this->form_validation->set_rules('pwd1','Password1','required|min_length[8]|max_length[16]|alpha_numeric');
		$this->form_validation->set_rules('pwd2','Password2','required|matches[pwd1]');
		$this->form_validation->set_rules('truename','name','required');
		$this->form_validation->set_rules('phone_num','Phone','required|numeric|max_length[12]');
		$this->form_validation->set_rules('subphone_num','Subphone','required|numeric|min_length[4]|max_length[6]');

		if($this->form_validation->run() == FALSE)
		{
			//如何提示错误
			//redirect('register');
			echo "<script >alert('您填写的信息有误!');</script>";
			$this->load->view('register');
		}
		else
		{
            $username = $this->input->post('username');
		    $password = $this->input->post('pwd1');
			$truename = $this->input->post('truename');
			$student_id = $this->input->post('student_id');
			//利用session保存的信息（学院、专业、年级）；
			$faculty = $this->input->post('faculty');
			$major = $this->input->post('major');
			$grade = $this->input->post('grade'); 
			$phone_num = $this->input->post('phone_num');
			$subphone_num = $this->input->post('subphone_num');
			$dormitory = $this->input->post('dormitory');	
			$status = 0;//注册标识码
			$activationKey = mt_rand() . mt_rand() . mt_rand() . mt_rand() . mt_rand();//生成随机激活码	
			$points = 30; //初始积分为30
			//echo $username." ".$password." ".$truename." ".$student_id." ".$dormitory." ".$faculty." ".$major." ".$grade." ".$phone_num." ".$subphone_num; 
		
	
		if($this->user_model->add($username,$password,$truename,$student_id,$faculty,$major,$grade,$phone_num,$subphone_num,$dormitory,$activationKey,$status,$points))
		
		
			{
				//如何提示邮件发送成功提示信息
				echo "<script>alert('we have sent an message to your email,please check it out!')</script>";	
				//postmail($username,$activationKey);//发送验证邮件

				//将用户信息保存至session，邮箱验证后直接可登陆
				$row = $this->user_model->get($username);
				$uid = $row->id;
				$points = $row->points;
				$truename = $row->truename;
				$major = $row->major;
				$grade = $row->grade;
				$messages = $this->user_model->show_message_num($uid);
				$data = array(
					'points' => $points,
					'truename' => $truename,
					'uid' => $uid,
					'major' => $major,
					'grade' => $grade,
					'messages' => $messages,
					'is_logged_in' => TRUE,
				);
				$this->session->set_userdata($data);
				/*echo $data['email']."</br>";
				echo $data['uid']."</br>";
				echo $data['is_logged_in']."</br>";
				echo $data['is_admin']."</br>";*/
			}
			else
			{
				//如何提示错误
				echo "<script>alert('insert failed!')</script>";				
			}
		}
	
	

	/*邮箱验证模块*/
		$configs['protocol'] = 'smtp';
		$configs['smtp_host'] = 'smtp.163.com';
		$configs['smtp_user'] = 'gdutbookshelf@163.com';
		$configs['smtp_pass'] = 'vtmerbookshelf';
		$configs['smtp_port'] = '25';
		$configs['mailtype'] = 'html';
		$configs['charset'] = 'utf-8';

		$this->email->initialize($configs);

		$message = "Thank you for Registration!\nYou have register our website almost.If you want to finish the registration completely,you should follow the next-operation:Clicking the link:\nhttp://localhost/bookshelf/website/index.php/verify/index/".$uid."/".$activationKey."\n if this is a error,ignore this email and you'll be removed from our mailing list.\n www.gdutbookshelf.com";//邮件正文 
		
		$this->email->from('gdutbookshelf@163.com','vtmerbookshelf');
		$this->email->to($username);
		$this->email->subject('Welcome to gdut bookshelf');
		$this->email->message($message);

		if($this->email->send())
		{
			echo "<script>alert('sent successfully！');</script>";
		}
		else
		{
			echo "<script>alert('sent failed!');</script>";
		}
		echo "<script>alert('请验证邮箱后登陆！')</script>";
		$this->load->view('login');
	}
}


/*End of file register.php*/
