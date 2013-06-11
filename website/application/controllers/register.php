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
		/*
		var_dump($this->session->all_userdata());
		var_dump(site_url());
		var_dump(stripos("zzlchile@gmail.com","@"));
		var_dump("mail.".substr("zzlchile@gmail.com",strripos("zzlchile@gmail.com",'@')+1));
		$address = "http://mail.".substr("zzlchile@gmail.com",strripos("zzlchile@gmail.com",'@')+1);
		$content = "验证邮件已发送，马上登录邮箱激活：<a href = '$address'>点击登录邮箱</a>";
		echo $content;
		*/
		//$row = $this->user_model->get("zzlchile@gmail.com");
		//var_dump($this->user_model->check_is("zzlchile@gmail.com"));
	}

	//注册时验证函数
	public function check()
	{
		//设置验证规则
		$this->load->library('form_validation');
		$this->form_validation->set_rules('username','Username','required|max_length[50]|valid_email');
		$this->form_validation->set_rules('pwd','Password1','required|min_length[6]|max_length[16]|alpha_numeric');
		$this->form_validation->set_rules('pwd_confirm','Password2','required|matches[pwd]');
		$this->form_validation->set_rules('truename','name','required');
		$this->form_validation->set_rules('student_id','student_id','exact_length[10]');
		$this->form_validation->set_rules('phone_num','Phone','required|numeric|max_length[12]');
		$this->form_validation->set_rules('captcha','Captcha','required');
		//设置错误信息
		$this->form_validation->set_message('required', '请检查%s');
		
		if($this->form_validation->run() == FALSE)
		{
			//提示错误
			$error_msg = validation_errors();
			$msg = array('type'=>'alert','title'=>'提示信息','content'=>$error_msg);
			echo json_encode($msg);
			exit();
		}
		
            $username = $this->input->post('username');
			if($this->user_model->check_is($username))
			{
				$msg = array('type'=>'alert','title'=>'提示信息','content'=>"邮箱已被注册，请重试！");
				echo json_encode($msg);
				exit();	
			}
			if(strcasecmp($this->session->userdata('captcha_code'),$this->input->post('captcha')))
			{
				$msg = array('type'=>'alert','title'=>'提示信息','content'=>"验证码错误，请重试！");
				echo json_encode($msg);
				exit();	
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
		
		if($this->user_model->add($username,$password,$truename,$student_id,$faculty,$major,$grade,$phone_num,$subphone_num,$dormitory,$activationKey,$status,$points))
			{
				//将数据插入数据库
				//将用户信息保存至session，邮箱验证后直接可登陆
				$row = $this->user_model->get($username);
				$uid = $row->id;
				$points = $row->points;
				$major = $row->major;
				$grade = $row->grade;
				$data = array(
					'username'=>$username,
					'points' => $points,
					'uid' => $uid,
					'major' => $major,
					'grade' => $grade,
					'is_logged_in' => FALSE,
				);
				$this->session->set_userdata($data);
			}
			else
			{
				//如何提示错误
				$msg = array('type'=>'alert','title'=>'错误信息','content'=>"系统错误，请重试！");
				echo json_encode($msg);
				exit();				
			}

		$message = "感谢你的注册！接下来请点击验证链接,便能完成注册:\n <a href='".site_url()."/verify/index/".$uid."/".$activationKey."'>验证链接</a>\n";//邮件正文 
		$message .="若不是你本人的操作，对您造成的不便，我们深表歉意！\n @维生数-工大书架"; 
	
		/*邮箱验证模块*/
		$this->load->library('email');
		$this->config->load('email');
		$this->email->from('gdutbookshelf@163.com','维生数工作室');
		$this->email->to($username);
		$this->email->subject('欢迎注册工大书架');
		$this->email->message($message);

		if($this->email->send())
		{
			//注册成功
			redirect('register/success');
			/*
			$url = site_url('register/success');
			$msg = array('type'=>'redirect','url'=>$url);
			echo json_encode($msg);
			exit();	
			*/
		}
		else
		{
			$msg = array('type'=>'alert','title'=>'错误信息','content'=>"注册失败！");
			echo json_encode($msg);
			exit();	
		}
	}
	public function success()
	{
		if(!($this->session->userdata('username'))) 
			show_404();
		$address = $this->session->userdata('username');
		$data['url'] = "http://mail.".substr($address,strripos($address,'@')+1);
		$this->load->view('sign_up_success',$data);
		$this->load->view('template/footer');
	} 

	public function ajax_check()
	{
		$username = $this->input->get('mail');
		$captcha = $this->input->get('captcha');
		if($username)
			if($this->user_model->check_is($username))
			{
				echo 0;//邮箱已被注册
				return 0;
			}else
			{
				echo 1;//邮箱可以注册
				return 0;
			}
		if($captcha)
			if(strcasecmp($this->session->userdata('captcha_code'),$captcha))
			{
				echo 0;//验证码不通过
				return 0;
			}else
			{
				echo 1;//验证码通过
				return 0;
			}
	}
}


/*End of file register.php*/
