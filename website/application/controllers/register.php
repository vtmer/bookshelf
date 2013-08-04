<?php
ob_start();
class Register extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('email');
		$this->load->library('catch_msg');
	}	

	public function index()
	{
		if(!$this->session->userdata('s_id'))
            redirect('login');
        $s_id = $this->session->userdata('s_id');
        $user_info = '';
        if(!$this->session->userdata('campus'))
        {
        	$user_info = $this->catch_msg->get_info($s_id);
            if(count($user_info)==2) redirect('login');
           
            //var_dump($user_info);exit;
	        //将信息存储到session
			$array = array(
					'campus'=>substr($user_info[0], 0, stripos($user_info[0],'校区',0)),
					'faculty'=>$user_info[1],
					'major'=>substr($user_info[2], 0, stripos($user_info[2],'专业',0)),
					'grade'=>substr($user_info[3],0,4),
					'truename'=>$user_info[5]
				);
			$this->session->set_userdata($array);
		}
		else
		{
			$array = array(
					'campus'=>$this->session->userdata('campus'),
					'faculty'=>$this->session->userdata('faculty'),
					'major'=>$this->session->userdata('major'),
					'grade'=>$this->session->userdata('grade'),
					'truename'=>$this->session->userdata('truename')
				);
		}
		$data['user'] = $array;
		$header = array('title'=>'加入工大书架','css_file'=>'sign_up.css'); 
		$footer = array('js_file' => 'sign_up.js');
		$this->parser->parse('template/header',$header);
		$this->load->view('sign_up',$data);	
		$this->parser->parse('template/footer',$footer);

	}

	//注册时验证函数
	public function check()
	{
        ob_start();
		//设置验证规则
		$this->load->library('form_validation');
		 $this->form_validation->set_rules('username','Username','required|max_length[50]|valid_email');//这个为邮箱
		// $this->form_validation->set_rules('pwd','Password1','required|min_length[6]|max_length[16]|alpha_numeric');
		// $this->form_validation->set_rules('pwd_confirm','Password2','required|matches[pwd]');
		// $this->form_validation->set_rules('truename','name','required');
		// $this->form_validation->set_rules('student_id','student_id','exact_length[10]');
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
		
            $username = str_replace(" ","",$this->input->post('username'));
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
			// $password = str_replace(" ","",$this->input->post('pwd'));
			// $truename = str_replace(" ","",$this->input->post('truename'));
			// $student_id = str_replace(" ","",$this->input->post('student_id'));

			$student_id = $this->session->userdata('student_id');
			$campus = $this->session->userdata('campus');
			$faculty = $this->session->userdata('faculty');
			$major = $this->session->userdata('major');
			$grade = $this->session->userdata('grade');
			$truename = $this->session->userdata('truename'); 
			$phone_num = str_replace(" ","",$this->input->post('phone_num'));
			$subphone_num = str_replace(" ","",$this->input->post('subphone_num'));
			
			if($campus == '龙洞')
			{
				$dormitory = '龙洞';
		   	}
			else if($campus == '东风路')
		   	{
				$dormitory = '东风路';
	        }
	        else
	        {
	        	$dormitory = $this->input->post('dormitory');
	        }

			$activationKey = mt_rand() . mt_rand() . mt_rand() . mt_rand() . mt_rand();//生成随机激活码	
		
			$user_data = array(
				'username' => $username,
				'student_id' => $student_id,
				'truename' => $truename,
				'campus' => $campus,
				'faculty' => $faculty,
				'major' => $major,
				'grade' => $grade,
				'phone_number' => $phone_num,
				'subphone_number' => $subphone_num,
				'activationKey' => $activationKey,
				'dormitory' => $dormitory,
				'status' => 0,
				'points' => 30,				
				'register_time' => null
				);
        if($uid = $this->user_model->add($user_data)) {
				//将数据插入数据库
				//将用户信息保存至session，邮箱验证后直接可登陆
				//清除不必要的session
            //$this->session->unset_userdata('s_id');
            //$this->session->unset_userdata('campus');
            // $this->session->unset_userdata('faculty');

	            $array = array(
	            	'username'=>$username,
	                'points'=>30,
	                'uid'=>$uid,
	                'is_logged_in'=>true
	            );
	            $this->session->set_userdata($array);
	            //print_r($this->session->all_userdata());exit;

				//发送站内信
				$content = "<strong>致 ".$this->session->userdata('truename').":</strong>
				<p>您好，欢迎加入 <strong>工大书架</strong> ，这是一个致力于让广工的同学们快捷放心的借到教材书的平台。</p>
				<p>在这里，你可以轻松查看/自下学期所需要的的教材，然后系统会主动向您推送适合的借书人。</p>
				<p>当然，你还可以直接搜索教材名称，找到自己想要的教材，然后进行借书。</p>
				<p>同时，为了让更多的同学可以借到想要的书，请您将自己手头多余或者不需要的教材进行网上捐书，</p>
				<p>您所捐的书将为我们广工学子们共同所有，在一届一届中交接下去，你更可以在书籍中夹入自己的心语、对学习的建议，</p>
				<p>让更多的师弟师妹能够感受到我们广工师兄师姐的关怀和我们广工人之间的团结互助。</p>
				<p>而且，如果你觉得 <strong>工大书架</strong> 的确可以帮助到学生解决问题，请将它进行推广，只有更多的人加入进来，我们借书的渠道</p>
				<p>和数量才会更加宽广，同学们借书才会更加轻松和保障。或者，如果您对我们有什么建议，请在网页下方点击留言，联系我们。</p>
				<p>感谢您对本书架的支持，希望您可以愉快地借到所需要的教材！</p>
				<p>谢谢!</p>                                                   
				<p style='text-align:right;' >--数字中心&维生数工作室</p>
				<span class='hide'></span>
				";
				$uid = $this->session->userdata('uid');
            $this->user_model->send_sys_msg($uid,$content);
			}
			else
			{
				//如何提示错误
                echo '系统错误！注册失败';
                exit;				
			}
	
		/*邮箱验证模块*/
		$link['link'] = site_url()."verify/index/".$uid."/".$activationKey;//验证链接
		$message = $this->load->view('template/email_content', $link, true);//装载邮件模板

		$this->load->library('email');
		$this->config->load('email');
		$this->email->from('gdutbookshelf@163.com','维生数工作室');
		$this->email->to($username);
		$this->email->subject('工大书架——邮箱地址验证');
		$this->email->message($message);
        if($this->email->send())
		{
			//注册成功
            redirect(site_url('register/success'));
			// echo "success";exit;
			// $url = site_url('');
			// $msg = array('type'=>'redirect','url'=>$url);
			// echo json_encode($msg);
			// exit();	
		}
		else
		{	
			echo "邮件发送错误！请检查邮件地址是否正确";exit;
			// $msg = array('type'=>'alert','title'=>'错误信息','content'=>"注册失败！");
			// echo json_encode($msg);
			// exit();	
		}
 ob_end_flush();
	}
	public function success()
	{
        // if(!($this->session->userdata('username'))) 
        // show_404();
        //print_r($this->session->all_userdata());
		/*$address = $this->session->userdata('username');
		if(substr($address,strripos($address,'@')+1)=="gmail.com")
		{
			$data['url'] = "https://mail.google.com";
		}
		else
		{
			$data['url'] = "http://mail.".substr($address,strripos($address,'@')+1);
		}
		$this->load->view('sign_up_success',$data);
		$this->parser->parse('template/footer',array('js_file' => 'sign_up_success.js'));  */  
		//显示QA
		$data['first_login'] = true;
		$header = array('title'=>'工大书架-Q&A','css_file'=>'qa.css'); 
		$footer = array('js_file'=>'qa.js');
		$this->parser->parse('template/header',$header);
		$this->load->view('qa',$data);
		$this->parser->parse('template/footer',$footer);   
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
