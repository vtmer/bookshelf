<?php
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
		if(!isset($this->session->userdata['is_logged_in']))//如果没被引导，则跳转到引导页
		{
			header('location:/index.php/guide');
		} 
		$data['book_need'] = $this->home_model->get_book_need($this->session->userdata['major'],$this->session->userdata['grade']);
		$match = array();
		$i = 0;
		foreach ($data as $value) 
		{
			foreach ($value as $row) 
			{
				$match[$i]['id'] = $row['id'];
				$match[$i]['name'] = $row['name'];
				$i++;
			}
		}
		$data['system_match'] = $this->home_model->get_system_match($match);
		//分页
		$this->pager->set(0,5);//设置每页显示的条数
		$data['page']['num'] = count($data['system_match']['user']);//获取总数
		$data['system_match']['user'] = $this->pager->get_pagedata($data['system_match']['user'],$page);//当前页数据
		$pager_config = $this->config->item('pager_config');
		$pager_config['base_url'] = site_url('home/index/');
		$pager_config['total_rows'] = $data['page']['num'];
		$pager_config['per_page'] = 5; //设置每页显示的条数
		$this->pagination->initialize($pager_config); 
		//END
		$header = array('title'=>'工大书架','css_file'=>'home.css'); 
		$footer = array('js_file'=>'home.js');
		$this->parser->parse('template/header',$header);
		$this->load->view('home',$data);
		$this->parser->parse('template/footer',$footer);
	}

	public function book_info($book_id)
	{	
		//从URI中获取页数为第四个分段home/book_owner/3/1
		$page = $this->uri->segment(4,1);
		$data['book_info'] = $this->search_model->get_book_by_id($book_id);
		if(!$data['book_info']) 
		{
			show_404();
		}
		$data['user'] = $this->home_model->get_system_match(array(array('ISBN'=>$data['book_info'][0]->ISBN,
																'name'=>$data['book_info'][0]->name,'id'=>$book_id)));
		//分页
		$this->pager->set(0,5);//设置每页显示的条数
		$data['page']['num'] = count($data['user']['user']);//获取总数
		$data['user']['user'] = $this->pager->get_pagedata($data['user']['user'],$page);//当前页数据
		$pager_config = $this->config->item('pager_config');
		$pager_config['uri_segment'] = 4;
		$pager_config['base_url'] = site_url('home/book_info/');
		$pager_config['total_rows'] = $data['page']['num'];
		$pager_config['per_page'] = 5; //设置每页显示的条数
		$this->pagination->initialize($pager_config); 
		//END
		$header = array('title'=>'书籍信息','css_file'=>'book_info.css');
		$footer = array('js_file'=>'book_info.js');
		$this->parser->parse('template/header',$header);
		$this->load->view('book_info',$data);
		$this->parser->parse('template/footer',$footer);
	}
	
	public function check_step()
	{
		$bookArray = $this->input->post();
		$num =count($bookArray)-1;
		if($num<=0)  header('location:/index.php/home');
		if(($this->session->userdata['points']))
		{
			if(($this->session->userdata['points']-$num*10) < 0)
			{
				echo "<script type='text/javascript'>alert('亲，你积分不够咯！');location='".site_url('home')."';</script>";
				exit();
			}
		}
		else
		{
			echo "<script type='text/javascript'>alert('亲，登录后就可以借书咯！');location='".site_url('login')."';</script>";
			exit();
		}
		$data['user'] = $this->home_model->get_userinfo($bookArray['user']);		
		$data['books'] = $this->home_model->get_bookborrow($bookArray);
		$this->session->set_userdata('borrow','');

		$header = array('title'=>'借书页面','css_file'=>'check_step.css');
		$footer = array('js_file'=>'check_step.js');
		$this->parser->parse('template/header',$header);
		$this->load->view('check_step',$data);
		$this->parser->parse('template/footer',$footer);
	}

	public function receipt()
	{
		if($this->session->userdata('borrow') < time()-120)//忽略2分钟内的重复动作
		{
			$info = array(
				'from_id'=>$this->input->post('from_id'),
				'to_id'=>$this->session->userdata('uid'),
				'book'=>$this->input->post(NULL,TRUE)
						);
			$this->session->set_userdata('borrow',time());
			$this->home_model->update_info($info);
			$this->user_model->show_user_point($this->session->userdata('uid'));
			echo "<script type='text/javascript'>setTimeout(\"window.location.href='".site_url('home')."'\",3000);</script>";
		}
		else if($this->session->userdata('borrow'))
		{
			echo "<script type='text/javascript'>setTimeout(\"window.location.href='".site_url('home')."'\",3000);</script>";
		}
		
		$header = array('title'=>'确认借书','css_file'=>'receipt.css');
		$footer = array('js_file'=>'receipt.js');
		$this->parser->parse('template/header',$header);
		$this->load->view('receipt');
		$this->parser->parse('template/footer',$footer);
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
			//密码
			if($this->input->post('pwd')!=$this->input->post('pwd2'))
			{
				$msg = array('type'=>'alert','title'=>'错误信息','content'=>'两次密码不一致，请重试！');
				echo json_encode($msg);
				exit(); 
			}
			if($this->input->post('pwd_old')!=NULL)
			{	
				 if(!preg_match('/^[\w~!@#$%^&*]{6,18}$/',$this->input->post('pwd')))
				 {
					$msg = array('type'=>'alert','title'=>'错误信息','content'=>'密码格式错误，长度大于6且小18，且不包含以下字符:~!@#$%^&*');
					echo json_encode($msg);
					exit(); 
				}
			}
			//END
			$flag = $this->home_model->update_config($this->input->post());
			if($flag==1)
			{
				$msg = array('type'=>'alert','title'=>'提示信息','content'=>'修改成功！');
				echo json_encode($msg);
				exit();
			}
			else if($flag==2)
			{
				$url = site_url('login/logout');
				$msg = array('type'=>'redirect','title'=>'提示信息','content'=>'修改密码成功！请重新登录！','url'=>$url);
				echo json_encode($msg);
				exit();
			}
			else if($flag==3)
			{
				$msg = array('type'=>'alert','title'=>'提示信息','content'=>'与原密码一致，请重试！');
				echo json_encode($msg);
				exit();
			}else if($flag == 4)
			{
				$msg = array('type'=>'alert','title'=>'错误信息','content'=>'密码错误，请重试！');
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


