<?php

ob_start();

class Home extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('home_model');
		$this->load->model('search_model');
		$this->load->helper('form');
		$this->config->load('pager_config',TRUE);
	}
	public function index($page = 1)
	{
		if(!$this->session->userdata('is_logged_in'))//如果没登录，则跳转到登录
		{
			redirect(site_url('login'));
		}
		$data['trans_grade'] = $this->home_model->trans_grade($this->session->userdata('grade'));
		$data['book_need'] = $this->home_model->get_book_need($this->session->userdata('grade'),$this->session->userdata('major'));
		$per_page = 10;//每页显示的条数
	    $offset = ($page - 1)*$per_page;
		$data['system_match'] = $this->home_model->system_match($this->session->userdata('grade'),$this->session->userdata('major'),$offset,$per_page);
		//分页
		$pager_config = $this->config->item('pager_config');
		$pager_config['base_url'] = site_url('home/index/');
		$pager_config['total_rows'] = $data['system_match']['total'];
		$pager_config['per_page'] = $per_page; //设置每页显示的条数
		$this->pagination->initialize($pager_config); 
		//END
		$header = array('title'=>'工大书架','css_file'=>'home.css'); 
		$footer = array('js_file'=>'home.js');
		$this->parser->parse('template/header',$header);
		$this->load->view('home',$data);
		$this->parser->parse('template/footer',$footer);
	}
	public function ajaxPage($page = 1)
	{
		$per_page = 10;//每页显示的条数
	    $offset = ($page - 1)*$per_page;
	    $data = $this->home_model->system_match($this->session->userdata('grade'),$this->session->userdata('major'),$offset,$per_page);
		//分页
		$pager_config = $this->config->item('pager_config');
		$pager_config['base_url'] = site_url('home/index/');
		$pager_config['total_rows'] = $data['total'];
		$pager_config['per_page'] = $per_page; //设置每页显示的条数
		$this->pagination->initialize($pager_config); 
		$data['page'] = $this->pagination->create_links();
		//var_dump($data);exit;
		echo json_encode($data);
		exit();
	}

	public function book_info($book_id,$page = 1)
	{	
		//从URI中获取页数为第四个分段home/book_owner/3/1
		//$page = $this->uri->segment(4,1);
        $bookinfo = $this->search_model->get_book_by_id($book_id);
		$data['book_info'] = $bookinfo;
		if(!$data['book_info']) 
		{
			show_404();
		}
		$per_page = 10;//每页显示的条数
	    $offset = ($page - 1)*$per_page;
		$data['data'] = $this->home_model->user_borrow($book_id , $offset , $per_page);
		//分页
		$pager_config = $this->config->item('pager_config');
		$pager_config['uri_segment'] = 4;
		$pager_config['base_url'] = site_url('home/book_info/');
		$pager_config['total_rows'] = $data['data']['total'];
		$pager_config['per_page'] = $per_page; //设置每页显示的条数
		$this->pagination->initialize($pager_config); 
		//END
		$header = array('title'=>$bookinfo[0]->name . '-工大书架','css_file'=>'book_info.css');
		$footer = array('js_file'=>'book_info.js');
		$this->parser->parse('template/header',$header);
		$this->load->view('book_info',$data);
		$this->parser->parse('template/footer',$footer);
	}
	
	public function check_step($result = '')
	{
		if($result !='')
		{
			if($result=='success')
			{				
				$data['type'] = 'borrow_succ';
				$header = array('title'=>'预约成功','css_file'=>'add_succ.css');
				$footer = array('js_file'=>'add_succ.js');
				$this->parser->parse('template/header',$header);
				$this->load->view('template/all_result',$data);
				$this->parser->parse('template/footer',$footer);
			}
			else if($result=='fail')
			{
				$data['type'] = 'borrow_fail';
				$header = array('title'=>'预约失败','css_file'=>'add_succ.css');
				$footer = array('js_file'=>'add_succ.js');
				$this->parser->parse('template/header',$header);
				$this->load->view('template/all_result',$data);
				$this->parser->parse('template/footer',$footer);
			}
			else
				show_404();
		}
		else
		{
			if($this->session->userdata('is_logged_in')==false) redirect(site_url('login'));
			$bookArray = $this->input->post();
			$num = count($bookArray)-1;
			if($num<=0)  header('location:/index.php/home');
			//var_dump($this->session->all_userdata());
			if(($this->session->userdata['points']))
			{
				if(($this->session->userdata['points']-$num*10) < 0)
				{
					echo "<meta http-equiv='Content-Type' content='text/html; charset=utf-8'>";
					echo "<script type='text/javascript'>alert('亲，你积分不够咯！');location='".site_url('home')."';</script>";
					exit();
				}
			}
			$data['user'] = $this->home_model->get_userinfo($bookArray['user']);		
			$data['books'] = $this->home_model->get_bookborrow($bookArray);
			//$this->session->set_userdata('borrow_time','');
			$this->session->set_userdata('borrow_from' , $data['user'][0]['id']);

			$header = array('title'=>'借书页面','css_file'=>'check_step.css');
			$footer = array('js_file'=>'check_step.js');
			$this->parser->parse('template/header',$header);
			$this->load->view('check_step',$data);
			$this->parser->parse('template/footer',$footer);
		}
	}

	public function receipt()
	{
		if(!$this->input->post()) redirect(site_url('home'));
		if($this->input->post('fail'))
		{
			//预约失败
			//失败发站内信
			$info = array(
				'from_id'=>$this->session->userdata('borrow_from'),
				'to_id'=>$this->session->userdata('uid'),
				'status'=>'fail'
						);
			$this->home_model->appoint_info($info);
			redirect(site_url('home/check_step').'/fail');
		}
		else
		if($this->session->userdata('borrow_time') < time()-180)//忽略3分钟内的重复动作
		{
			$info = array(
				'from_id'=>$this->session->userdata('borrow_from'),
				'to_id'=>$this->session->userdata('uid'),
				'status'=>'success',
				'book'=>$this->input->post(NULL,TRUE)
						);
			if((count($info['book'])-1)==0)
			{
				echo "<meta http-equiv='Content-Type' content='text/html; charset=utf-8'>";
				echo '<script type="text/javascript">alert("请至少选择一本书！");window.history.back(-1);</script>';
				exit();
			}
			$this->session->set_userdata('borrow_time',time());
			$this->home_model->appoint_info($info);
			$this->user_model->show_user_point($this->session->userdata('uid'));
			redirect(site_url('home/check_step').'/success');
		}
		else if($this->session->userdata('borrow_time'))
		{
			echo "<meta http-equiv='Content-Type' content='text/html; charset=utf-8'>";
			echo '<script type="text/javascript">alert("您已经提交过了！");window.location.href="/index.php/home";</script>';
			//echo "<script type='text/javascript'>setTimeout(\"window.location.href='".site_url('home')."'\",5000);</script>";
		}
		
		// $header = array('title'=>'确认借书','css_file'=>'receipt.css');
		// $footer = array('js_file'=>'receipt.js');
		// $this->parser->parse('template/header',$header);
		// $this->load->view('receipt');
		// $this->parser->parse('template/footer',$footer);
	}

	public function personal_config()
	{
		if($this->input->post())
		{
			//表单验证
			//电话
			if(!preg_match("/^13[0-9]{1}[0-9]{8}$|15[0189]{1}[0-9]{8}$|189[0-9]{8}$|188[0-9]{8}$/",$this->input->post('phone_number')))
			{    
			    $msg = array('type'=>'alert','title'=>'错误信息','content'=>'手机号码格式错误！');
				echo json_encode($msg);
				exit();           
			}
			//END
			$flag = $this->home_model->update_config($this->input->post());
			if($flag==1)
			{
				$msg = array('type'=>'alert','title'=>'提示信息','content'=>'修改成功！');
				echo json_encode($msg);
				exit();
			}
			else if($flag == 0)
			{
				$msg = array('type'=>'alert','title'=>'提示信息','content'=>'你未做任何修改！');
				echo json_encode($msg);
				exit();
			}
			else
			{
				$msg = array('type'=>'alert','title'=>'错误信息','content'=>'系统错误，请稍后再试！');
				echo json_encode($msg);
				exit();
			}
		}
		$id = $this->session->userdata('uid');
		$data['user'] = $this->home_model->get_userinfo($id);
		$data['book_num'] = $this->home_model->count_userbook($id);
		$data['user']['share'] = $this->home_model->calcul_share($id);

		$header = array('title'=>'个人信息','css_file'=>'config.css');
		$footer = array('js_file'=>'personal_info.js');
		$this->parser->parse('template/header',$header);
		$this->load->view('personal_info',$data);
		$this->parser->parse('template/footer',$footer);
	}
}


