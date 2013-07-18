<?php 

class Message extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->config->load('pager_config',TRUE);
	}

	public function index($page = 1)
	{
		$uid = $this->session->userdata['uid'];
		$status = '0';
		$data['messages'] = $this->user_model->select_message($uid,$status);
		$this->pager->set(0,8);//设置每页显示的条数
		$data['page']['num'] =count($data['messages']);//获取总页数
		$data['messages'] = $this->pager->get_pagedata($data['messages'],$page);//当前页数据
		$pager_config = $this->config->item('pager_config');
		$pager_config['base_url'] = site_url('message/index/');
		$pager_config['total_rows'] = $data['page']['num'];
		$pager_config['per_page'] = 8; //设置每页显示的条数
		$this->pagination->initialize($pager_config); 
	 
        $messages = $this->user_model->show_message_num($this->session->userdata['uid']);
		$header = array('title' => '我收到的信息','css_file' => 'message.css','messages' => $messages);
		$footer = array('js_file' => 'message.js');
		$this->parser->parse('template/header',$header);
		$this->load->view('message',$data);		
		$this->parser->parse('template/footer',$footer);
	}

	public function confirm()
	{
		if($this->input->post())
		{
			$bookArray = $this->input->post();
			if($this->user_model->confirm($bookArray))
			{
				$msg = array('type'=>'alert','title'=>'提示信息','content'=>'已确认！');
				echo json_encode($msg);
				exit();
			}
			else
			{
				$msg = array('type'=>'alert','title'=>'提示信息','content'=>'你已经确认过了！');
				echo json_encode($msg);
				exit();
			}
		}
		else
		{
			redirect('message','refresh');
		}		
	}
	public function msg_readed($msg_id)
	{
		$flag = $this->user_model->msg_readed($msg_id);
		if($flag!=0)
		{
			echo "true";
			exit;
		}
		else
		{
			echo "false";
			exit;
		}
	}
	public function del_msg($msg_id)
	{
		$flag = $this->user_model->del_msg($msg_id);
		if($flag!=0)
		{
			echo "true";
			exit;
		}
		else
		{
			echo "false";
			exit;
		}
	}
}
