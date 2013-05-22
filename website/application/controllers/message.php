<?php 

class Message extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('Pager');
	}

	public function index($page = 1)
	{
		$uid = $this->session->userdata['uid'];
		$status = '0';
		$data['messages'] = $this->user_model->select_message($uid,$status);

		$this->pager->set(0,8);//设置每页显示的条数
		$data['page']['num'] = $this->pager->get_pagenum($data['messages']);//获取总页数
		$data['messages'] = $this->pager->get_pagedata($data['messages'],$page);//当前页数据
		$data['page']['currentpage'] = $this->pager->get_currentpage();
		$data['page']['nextpage'] = $this->pager->get_nextpage();
		$data['page']['prevpage'] = $this->pager->get_prevpage();
	 
        $messages = $this->user_model->show_message_num($this->session->userdata['uid']);
		$header = array('title' => '信息页面','css_file' => 'message.css','messages' => $messages);
		$footer = array('js_file' => 'message.js');
		$this->parser->parse('template/header',$header);
		$this->load->view('message',$data);		
		$this->parser->parse('template/footer',$footer);
	}

	public function confirm($message_id)
	{
		$this->user_model->confirm($message_id);
		echo "<script>alert('恭喜你！你已确认成功！');</script>";
		redirect('message','refresh');
	}
}

?>
