<?php

class Admin_model extends CI_Model
{
	public function index()
	{
		parent::__construct();
	}
    
	//管理员登陆验证
	public function check($admin,$pwd)
	{
		$query = $this->db->get_where('admin',array('username' => $admin,'password' => md5($pwd)));
		return ($query->num_rows() == 1) ? TRUE : FALSE;
	}	

	//更改管理员密码
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
    
	//根据管理员用户名获取对应信息
	public function get($username)
	{
		$query = $this->db->get_where('admin',array('username' => $username));
		if($query->num_rows() == 1)
		{
			$row = $query->row();
		}
		return $row;
	}

	//查找所有的书
	public function show_booklist()
	{
		$query = $this->db->get_where('allbook');
		return $query->result_array();
	}

	//下架指定书本
	public function set_book_down($id)
	{
		$this->db->where('id',$id);
		$this->db->update('allbook',array('status' => '0'));
	}

	//上架指定书本
	public function set_book_up($id)
	{
		$this->db->where('id',$id);
		$this->db->update('allbook',array('status' => '1'));
	}

	//查找所有的用户
	public function show_users()
	{
		$query = $this->db->get_where('user');
		return $query->result_array();
	}

	//冻结用户帐号
	public function	set_user_down($id)
	{
		$this->db->where('id',$id);
		$this->db->update('user',array('status' => -1));
	}

	//恢复用户帐号
	public function set_user_up($id)
	{
		$this->db->where('id',$id);
		$this->db->update('user',array('status' => 1));
	}


	public function add_book($isbn,$title,$author,$publish,$version,$course_name,$course_category,$term,$print,$status)
	{
		if(($isbn !== NULL)&&($print == 0))
		{
			$query = $this->db->get_where('allbook',array('ISBN' => $isbn));
		}
		else if(($isbn == NULL)&&($print == 1))
		{
			$query = $this->db->get_where('allbook',array('name' => $title));
		}

		if($query->num_rows() == 1)
		{
			return FALSE;
		}
		else
		{
			$this->db->insert('allbook',array(
					'ISBN' => $isbn,
					'name' => $title,
					'author' => $author,
					'publish' => $publish,
					'version' => $version,
					'course_name' => $course_name,
					'course_category' => $course_category,
					'term' => $term,
					'print' => $print,
					'status' => $status
			));
			return TRUE;
		}
	}

	public function search($keywords)
	{
		$this->db->like('ISBN',$keywords);
		$this->db->or_like('name',$keywords);
		$this->db->or_like('author',$keywords);
		$this->db->or_like('publish',$keywords);	
		$query = $this->db->get('allbook');
		return $query->result_array();	
	}
}

?>
