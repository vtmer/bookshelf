<?php

class Register extends CI_Controller
{
	
	public function index()
	{
		$this->load->view('register');	
	}

	//注册时验证函数
	public function check()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('username','Username','required|max_length[40]|valid_emails');
		$this->form_validation->set_rules('pwd1','Password1','required|min_length[8]|max_length[20]|alpha_numeric');
		$this->form_validation->set_rules('pwd2','Password2','required|matches[pwd1]');
		$this->form_validation->set_rules('truename','name','required');
		$this->form_validation->set_rules('phone_num','Phone','required|numeric|exact_length[11]');
		$this->form_validation->set_rules('subphone_num','Subphone','required|min_length[4]|max_length[6]');

		if($this->form_validation->run == FALSE)
		{
			//如何提示错误
			redirect('register');
		}
		else
		{
            $username = $this->input->post('username');
		    $password = $this->input->post('pwd1');
			$truename = $this->input->post('truename');
			$student_id = $this->input->post('student_id');
			//利用session保存的信息（学院、专业、年级）；
			$faculty $this->input->post('faculty');
			$major = $this->input->post('major');
			$grade = $this->input->post('grade'); 
			$phone_num = $this->input->post('phone_num');
			$subphone_num = $this->input->post('subphone_num');
			$dormitory = $this->input->post('dormitory');	
			$status = 1;//注册标识码
			$activationKey = mt_rand() . mt_rand() . mt_rand() . mt_rand() . mt_rand();//生成随机激活码	
			
			if($this->user_model->add($username,$password,$truename,$student_id,$faculty,$major,$grade,$phone_num,$subphone_num,$dormitory,$activationKey,$status))
			{
				//如何提示邮件发送成功提示信息
				echo "<script>alert("we have sent an message to your email,please check it out!")</script>";	
				postmail($username,$activationKey);//发送验证邮件

				//将用户信息保存至session，邮箱验证后直接可登陆
				$uid = $this->user_model->get_id($username);
				$data = array(
					'email' => $username,
					'uid' => $uid,
					'is_logged_in' => TRUE,
					'is_admin' => FALSE,
				);
				$this->session->set_userdata($data);
			}
			else
			{
				//如何提示错误
				redirect('register');
			}
		}

	/*	
	    利用jq控制views页面来显示成功/错误信息提示
	
		private function json_response($successful,$message)
		{
			echo json_encode(array(
				'issuccessful' => $successful;
				'message' => $message;
			));
		}
	*/
	}

	/*使用PHPMailer类来发送邮件*/
	public function postmail($to,$activationKey)
	{
		error_reporting(E_STRICT);
		date_default_timezone_set("Asia/Beijing");
		require('./controllers/phpmailer/class.phpmailer.php');
		require('./controllers/phpmailer/class.smtp.php');

		$mail = new PHPMailer();
		$mail->CharSet = "UTF-8";
		$mail->IsSMTP();
		$mail->SMTPDebug = 2;//启用SMTP调试 
							 //1 => error and messages
							 //2 => messages only
		$mail->SMTPAuth = TRUE;
		$mail->SMTPSecure = "ssl";
		$mail->Host = "smtp.gmail.com";
		$mail->Port = "465";
		$mail->Username = "gdutbookshelf@gmail.com";
		$mail->Password = "vtmerbookshelf";

		$mail->SetForm('gdutbookshelf@gmail.com','gdutbookshelf');//设置发信人信息

		$subject = "welcome to gudt bookshelf!";//邮件标题
		$message = "Thank you for Registration!\rYou have register our website almost.If you want to finish the registration completely,you should follow the next-operation:Clicking the link:\rhttp://www.gdutbookshelf.com/verify.php?$activationKey\r\rAnd if this is a error,ignore this email and you'll be removed from our mailing list.\rwww.gdutbookshelf.com";//邮件正文 
		
		$mail->Subject = $subject;
		$mail->AltBody = "To view the message,please use an HTML compatible email viewer!";
		$mail->Body = MsgHTML($message);
		$address = $to;
		$mail->AddAddress($address);

		if(!$mail->Send())
		{
			//发送成功
			echo "Mailer Error!" . $mail->ErrorInfo;
		}
		else
		{
			echo "Email has sent!";
		}
	
	}
}


/*End of file register.php*/
