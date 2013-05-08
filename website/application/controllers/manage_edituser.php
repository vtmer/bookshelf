<?php 

class Manage_edituser extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('Pager');
	}
	
	public function index($page = 1)
	{
		$data['users'] = $this->admin_model->show_users();
				
		$this->pager->set(0,1);
		$data['page']['num'] = $this->pager->get_pagenum($data['users']);//获取总页数
		$data['users'] = $this->pager->get_pagedata($data['users'],$page);//当前页数据
		$data['page']['currentpage'] = $this->pager->get_currentpage();
		$data['page']['nextpage'] = $this->pager->get_nextpage();
		$data['page']['prevpage'] = $this->pager->get_prevpage();


		$this->load->view('management/manage_edituser',$data);
	}

	public function set_user_down($id)
	{
		$this->admin_model->set_user_down($id);
		redirect('manage_edituser','refresh');
	}

	public function set_user_up($id)
	{
		$this->admin_model->set_user_up($id);
		redirect('manage_edituser','refresh');
	}
}

?>
