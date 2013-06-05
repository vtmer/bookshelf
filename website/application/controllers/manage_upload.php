<?php

class Manage_upload extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form','url'));
	}

	public function index()
	{
		if(!$this->is_logged_in())
		{
			show_error('You don\'t have the permission to access this site!');
		}
		else
		{
			$this->load->view('management/manage_upload');
		}
	}

	public function do_upload()
	{
		$config['upload_path'] = './uploads/';
		$config['allowed_types'] = 'csv';
		$config['max_size'] = '1000';
		//$config['max_width']  = '1024';
		//$config['max_height']  = '768';
					  
		$this->load->library('upload', $config);
					 
		if ( ! $this->upload->do_upload())
		{
			$error = $this->upload->display_errors();
			echo "<script>alert('上传失败！".$error."');</script>";
			//$error = array('error' => $this->upload->display_errors());
								      
			//$this->load->view('management/manage_upload', $error);
		} 
		else
		{
			echo "<script>alert('上传成功！');</script>";
			$data = array('upload_data' => $this->upload->data());
			$this->load->view('management/manage_upload', $data);
		}
	} 

	public function insert()
	{
		$file_name = $this->input->post('file_name');
		$table_name = $this->input->post('table');	
		$full_path = './uploads/'.$file_name;
		$param = array('table' => $table_name,'file' => $full_path);
		$this->load->library('ExceltoMysql');
		$this->exceltomysql->set($table_name,$full_path);
		if($this->exceltomysql->InsertToMysql())
		{
			echo "<script>alert('导入成功！');</script>";
		}
		redirect('manage_upload','refresh');
	}

	public function error()
	{
		if(!$this->is_logged_in())
		{
			show_error('You don\'t have the permission to access this site!');
		}
		else
		{
			$this->load->view('management/manage_editpwd',array('error' => TRUE));
		}
	}

	public function success()
	{
		if(!$this->is_logged_in())
		{
			show_error('You don\'t have the permission to access this site!');
		}
		else
		{
			$this->load->view('management/manage_editpwd',array('success' => TRUE));
		}
	}
	
	private function is_logged_in()
	{
		return $this->session->userdata('admin');
	}
}

?>
