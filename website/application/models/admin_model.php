<?php

class Admin_model extends CI_Model
{
	public function index()
	{
		parent::__construct();
	}

	public function check($admin,$pwd)
	{
		$query = $this->db->get_where('admin',array('username' => $admin,'password' => md5($pwd)));
		return ($query->num_rows() == 1) ? TRUE : FALSE;
	}	

	public function update_pwd($pwd_old1,$pwd_old2,$pwd_new)
	{
		$id = $this->session->userdata('uid');
		if($pwd_old1 == $pwd_old2)
		{
			$query = $this->db->get_where('admin',array('id' => $id,'password' => md5($pwd_old1)));
			if($query->num_rows() == 1)
			{
				$this->db->update('admin',array('password' => md5($pwd_new)));
				return TRUE;
			}
		}
		else
		{
			return FALSE;
		}
	}

	public function get($username)
	{
		$query = $this->db->get_where('admin',array('username' => $username));
		if($query->num_rows() == 1)
		{
			$row = $query->row();
		}
		return $row;
	}
}

?>
