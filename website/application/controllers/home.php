<?php
class Home extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('home_model');
		$this->load->model('search_model');
		$this->load->library('parser');		
		$this->load->library('Pager');
		$this->load->helper('form');
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
		$data['page']['num'] = $this->pager->get_pagenum($data['system_match']['user']);//获取总页数
		$data['system_match']['user'] = $this->pager->get_pagedata($data['system_match']['user'],$page);//当前页数据
		$data['page']['currentpage'] = $this->pager->get_currentpage();
		$data['page']['nextpage'] = $this->pager->get_nextpage();
		$data['page']['prevpage'] = $this->pager->get_prevpage();
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
		$data['page']['num'] = $this->pager->get_pagenum($data['user']['user']);//获取总页数
		$data['user']['user'] = $this->pager->get_pagedata($data['user']['user'],$page);//当前页数据
		$data['page']['currentpage'] = $this->pager->get_currentpage();
		$data['page']['nextpage'] = $this->pager->get_nextpage();
		$data['page']['prevpage'] = $this->pager->get_prevpage();
		//END
		//var_dump($data);
		$header = array('title'=>'书籍信息','css_file'=>'book_info.css');
		$footer = array('js_file'=>'book_info.js');
		$this->parser->parse('template/header',$header);
		$this->load->view('book_info',$data);
		$this->parser->parse('template/footer',$footer);
	}
	
	public function book_owner($user_id)
	{
		//从URI中获取页数为第四个分段:home/book_owner/3/1
		$page = $this->uri->segment(4,1);
		$data['user'] = $this->home_model->get_userinfo($user_id);
		if (!$data['user']) 
		{
			show_404();
		}
		$data['books'] = $this->home_model->get_userbook($user_id);
		$data['user'][0]['booknum'] = count($data['books']);
		//分页		
		$this->pager->set(0,1);//设置每页显示的条数	
		$data['page']['num'] = $this->pager->get_pagenum($data['books']);//获取总页数
		$data['books'] = $this->pager->get_pagedata($data['books'],$page);//当前页数据
		$data['page']['currentpage'] = $this->pager->get_currentpage();
		$data['page']['nextpage'] = $this->pager->get_nextpage();
		$data['page']['prevpage'] = $this->pager->get_prevpage();
		//END
		$header = array('title'=>'书籍拥有者','css_file'=>'book_owner.css');
		$footer = array('js_file'=>'book_owner.js');
		$this->parser->parse('template/header',$header);
		$this->load->view('book_owner',$data);
		$this->parser->parse('template/footer',$footer);
	}

	public function check_step()
	{
		$bookArray = $this->input->post();
		$num =count($bookArray)-1;
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
		$this->load->view('receipt',$data);
		$this->parser->parse('template/footer',$footer);
	}

	public function my_book($page = 1)
	{
		if($id = $this->input->post('book_id'))
		{
			$this->home_model->pull_off($id);
		}
		$data['books'] = $this->home_model->get_userbook($this->session->userdata('uid'));
		//分页		
		$this->pager->set(0,5);//设置每页显示的条数	
		$data['page']['num'] = $this->pager->get_pagenum($data['books']);//获取总页数
		$data['books'] = $this->pager->get_pagedata($data['books'],$page);//当前页数据
		$data['page']['currentpage'] = $this->pager->get_currentpage();
		$data['page']['nextpage'] = $this->pager->get_nextpage();
		$data['page']['prevpage'] = $this->pager->get_prevpage();
		//END

		$header = array('title'=>'我的书架','css_file'=>'my_book.css');
		$footer = array('js_file'=>'my_book.js');
		$this->parser->parse('template/header',$header);
		$this->load->view('my_book',$data);
		$this->parser->parse('template/footer',$footer);		
	}

	public function personal_config()
	{
		if($this->input->post())
		{
			$flag = $this->home_model->update_config($this->input->post());
			if($flag==1)
			{
				echo "<script type='text/javascript'>alert('修改成功！');</script>";
			}
			else if($flag==2)
			{
				echo "<script type='text/javascript'>alert('修改密码成功！请重新登录！');window.location.href='".site_url('login/logout')."'</script>";
			}
			else if($flag==3)
			{
				echo "<script type='text/javascript'>alert('与原密码一致，请重试！');</script>";
			}
			else
			{
				echo "<script type='text/javascript'>alert('修改失败，请重试！');</script>";
			}
		}
		$id = $this->session->userdata('uid');
		$data['user'] = $this->home_model->get_userinfo($id);
		$data['book_num'] = $this->home_model->count_userbook($id);

		$header = array('title'=>'个人信息','css_file'=>'config.css');
		$footer = array('js_file'=>'personal_info.js');
		$this->parser->parse('template/header',$header);
		$this->load->view('personal_info',$data);
		$this->parser->parse('template/footer',$footer);
	}
}


