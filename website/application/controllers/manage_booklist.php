<?php 

class Manage_booklist extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('Pager');
	}

	public function index($page = 1)
	{
		if(!$this->is_logged_in())
		{
			show_error('You don\'t have the permission to access this site!');
		}
		else
		{
			$status = '1';
			$data['booklists'] = $this->admin_model->show_booklist();
		
			$this->pager->set(0,5);
			$data['page']['num'] = $this->pager->get_pagenum($data['booklists']);//获取总页数
			$data['booklists'] = $this->pager->get_pagedata($data['booklists'],$page);//当前页数据
			$data['page']['currentpage'] = $this->pager->get_currentpage();
			$data['page']['nextpage'] = $this->pager->get_nextpage();
			$data['page']['prevpage'] = $this->pager->get_prevpage();

			$this->load->view('management/manage_booklist',$data);
		}
	}

	public function set_book_down($id)
	{
		$this->admin_model->set_book_down($id);
		redirect('manage_booklist','refresh');
	}

	public function set_book_up($id)
	{
		$this->admin_model->set_book_up($id);
		redirect('manage_booklist','refresh');
	}

	private function is_logged_in()
	{
		return $this->session->userdata('admin');
	}	
}

?>
