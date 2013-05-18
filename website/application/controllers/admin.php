<?php

class Admin extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		if(!$this->is_logged_in())
		{
			$this->load->view('admin_login');
		}
		else
		{
			redirect('manage_booklist','refresh');
		}
	}

	public function login()
	{
		$admin = $this->input->post('admin');
		$pwd = $this->input->post('admin_pwd');		
	
		$row = $this->admin_model->get($admin);
		$uid = $row->id;
		if($this->admin_model->check($admin,$pwd))
		{
			$data = array(
				'uid' => $uid,
				'admin' => TRUE,
			);
			$this->session->set_userdata($data);

			redirect('manage_booklist','refresh');
		}
		else
		{
			redirect('admin/error');
		}	
		

	}

	private function is_logged_in()
	{
		return $this->session->userdata('admin');		
	}

	public function error()
	{
		$this->load->view('admin_login',array('error' => TRUE));
	}

	public function logout()
	{
		if(!$this->is_logged_in())
		{
			redirect('admin');
		}
		else
		{
			$this->session->set_userdata(array('admin' => FALSE));
			$this->session->sess_destroy();
			$this->load->view('admin_login');	
		}
	}
	
	public function search_judge()
	{
		$this->session->unset_userdata('keywords');
		$keywords = $this->input->post('keywords');
		$result = $this->admin_model->search($keywords);

		$data = array('keywords' => $keywords);
		$this->session->set_userdata($data);

		if($keywords == NULL||!$result)
		{
			redirect('admin/error_search');
		}	
		else
		{
			redirect('admin/search');
		}
	}
	public function search()
	{
		$page = 1;
		if(!$this->is_logged_in())
		{
			show_error('You don\'t have the permission to access this site!');
		}
		else
		{
			$keywords = $this->session->userdata('keywords');
			$data['search'] = $this->admin_model->search($keywords);
			$this->pager->set(0,10);
			$data['page']['num'] = $this->pager->get_pagenum($data['search']);//获取总页数
			$data['search'] = $this->pager->get_pagedata($data['search'],$page);//当前页数据
			$data['page']['currentpage'] = $this->pager->get_currentpage();
			$data['page']['nextpage'] = $this->pager->get_nextpage();
			$data['page']['prevpage'] = $this->pager->get_prevpage();
			
			$this->load->view('management/manage_search',$data);
		}
	}

	public function set_book_down($id)
	{
		$this->admin_model->set_book_down($id);
		redirect('admin/success_search');
	}

	public function set_book_up($id)
	{
		$this->admin_model->set_book_up($id);
		redirect('admin/success_search');
	}

	public function error_search()
	{
		if(!$this->is_logged_in())
		{
			show_error('You don\'t have the permission to access this site!');
		}
		else
		{
			$this->load->view('management/manage_search',array('error' => TRUE));
		}
	}

	public function success_search()
	{
		if(!$this->is_logged_in())
		{
			show_error('You don\'t have the permission to access this site!');
		}
		else
		{
			$this->load->view('management/manage_search',array('success' => TRUE));
		}
	}
}

?>
