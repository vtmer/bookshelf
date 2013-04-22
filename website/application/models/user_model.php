<?php

class User_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	//登陆时验证函数
	public function is($email,$password)
	{
		$query = $this->db->get_where('user',array('username' => $email,'password' => $password,'status' => "1"));
		return ($query->num_rows() == 1) ? TRUE : FALSE;
	}	
	
	//注册时向数据库添加数据
	public function add($username,$password,$truename,$student_id,$faculty,$major,$grade,$phone_num,$subphone_num,$dormitory,$activationkey,$status,$points)
	{
		$query = $this->db->get_where('user',array('username' => $username,));

		if($query->num_rows() == 1)		
		{
			return FALSE;
		}
		else
		{
			$this->db->insert('user',array(
					'username' => $username,
					'password' => md5($password),
					'truename' => $truename,
					'student_id' => $student_id,
					'faculty' => $faculty,
					'major' => $major,
					'grade' => $grade,
					'phone_number' => $phone_num,
					'subphone_number' => $subphone_num,
					'dormitory' => $dormitory,
					'activationkey' => $activationkey,
					'status' => $status,
					'points' => $points));
			return TRUE;
		}	
	}

	//注册后进行邮箱验证
	/*
	public function verify($uid,$activationkey)
	{
		$query = $this->db->get_where('user',array('id' => $uid,'activationkey' => $activationkey));
		return ($query->num_rows() == 1) ? TRUE : FALSE; 
	}*/	
	
	//返回对应用户注册时的激活码
	public function get_active($uid)
	{
		$query = $this->db->get_where('user',array('id' => $uid));
		if($query->num_rows == 1)
		{	
			$row = $query->row();
		}
		return $row->activationkey;
	}

	//根据email获取该用户id
	public function get($username)
	{
		$query = $this->db->get_where('user',array('username' => $username));
		if($query->num_rows() == 1)
		{
			$row = $query->row();
		}	
		return $row;
	}
	
	public function activate($uid)
	{
		$this->db->update('user',array('status' => "1"),array('id' => $uid));
		//return ($query->num_rows() > 0) ? TRUE : FALSE;
	}
}

/*End of file user_model.php*/
