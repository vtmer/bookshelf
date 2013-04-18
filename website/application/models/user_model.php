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
		$query = $this->db->get_where('user',array('username' => $email,'password' => md5($password)));
		return ($query->num_rows() == 1) ? TRUE : FALSE;
	}	
	
	//注册时向数据库添加数据
	public function add($username,$password,$truename,$student_id,$faculty,$major,$grade,$phone_num,$subphone_num,$dormitory,$activatekey,$status)
	{
		$query = $this->db->get_where('user',array('username' => $username,));

		if($query->num_rows() == 1)		
		{
			return FALSE;
		}

		$this->db->insert('user',array(
				'username' => $username,
				'password' => md5($password),
				'truename' => $truename,
				'student_id' => $student_id,
				'faculty' => $faculty,
				'major' => $major,
				'grade' => $grade,
				'phone_num' => $phone_num,
				'subphone_num' => $subphone_num,
				'dormitory' => $dormitory,
				'activatekey' => $activatekey,
				'status' => $status));

		return TRUE;
	}

	//注册后进行邮箱验证
	public function verify($queryString)
	{
		$query = $this->db->get_where('user',array('activatekey' => $queryString));
		return ($query->num_rows() ==1) ? TRUE : FALSE; 
	}	

	//根据email获取该用户id
	public function get_id($username)
	{
		$query = $this->db->get_where('user',array('username' => $username));
		if($query->num_rows() > 0)
		{
			$row = $query->row();
			$uid = $row['id'];
		}	
		return $uid;
	}
}

/*End of file user_model.php*/
