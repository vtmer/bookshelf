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
		$footer = array('js_file' => 'sign_up.js');
		$this->load->view('sign_up');	
		$this->parser->parse('template/footer',$footer);
	}

	//注册时验证函数
	public function check()
	{
		
		$this->load->library('form_validation');
		$this->form_validation->set_rules('username','Username','required|max_length[50]|valid_email');
		$this->form_validation->set_rules('pwd','Password1','required|min_length[6]|max_length[16]|alpha_numeric');
		$this->form_validation->set_rules('pwd_confirm','Password2','required|matches[pwd]');
		$this->form_validation->set_rules('truename','name','required');
		$this->form_validation->set_rules('student_id','student_id','exact_length[10]');
		$this->form_validation->set_rules('phone_num','Phone','required|numeric|max_length[12]');
		/*
		if($this->form_validation->run() == FALSE)
		{
			//如何提示错误
			//redirect('register');
			echo "<script >alert('请按要求填写相关信息!');</script>";
			redirect('register','refresh');
		}
		*/
            $username = $this->input->post('username');
			if($this->user_model->check_is($username))
			{
				redirect('register/error','refresh');	
			}
			$password = $this->input->post('pwd');
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
				//postmail($username,$activationKey);//发送验证邮件

				//将用户信息保存至session，邮箱验证后直接可登陆
				$row = $this->user_model->get($username);
				$uid = $row->id;
				/*$points = $row->points;
				$truename = $row->truename;
				$major = $row->major;
				$grade = $row->grade;
				$data = array(
					'points' => $points,
					'truename' => $truename,
					'uid' => $uid,
					'major' => $major,
					'grade' => $grade,
					'is_logged_in' => TRUE,
				);
				$this->session->set_userdata($data);
				echo $data['email']."</br>";
				echo $data['uid']."</br>";
				echo $data['is_logged_in']."</br>";
				echo $data['is_admin']."</br>";*/
			}
			else
			{
				//如何提示错误
				echo "<script>alert('系统错误！')</script>";				
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

		$message = "感谢你的注册！接下来请点击验证链接,便能完成注册:\n <a href='http://book.vtmer.com/index.php/verify/index/".$uid."/".$activationKey."'>验证链接</a>\n @维生数-工大书架";//邮件正文 
		
		$this->email->from('gdutbookshelf@163.com','维生数工作室');
		$this->email->to($username);
		$this->email->subject('欢迎注册工大书架');
		$this->email->message($message);

		if($this->email->send())
		{
			echo "<script>alert('验证邮件已发送，请注意查收！');</script>";
		}
		else
		{
			echo "<script>alert('sent failed!');</script>";
		}
		redirect('login','refresh');
	}

	public function error()
	{
		$footer = array('js_file' => 'sign_up.js');
		$this->load->view('sign_up',array('error' => TRUE));	
		$this->parser->parse('template/footer',$footer);
	}
}


/*End of file register.php*/
