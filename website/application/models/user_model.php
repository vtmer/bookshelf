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

	//根据email激活用户帐号
	public function activate($uid)
	{
		$this->db->update('user',array('status' => "1"),array('id' => $uid));
		//return ($query->num_rows() > 0) ? TRUE : FALSE;
	}
	
	//用户预约确认后向其发送确认信息
	public function send_comfirm()
	{
		$from = "系统管理员";
		$uid = $this->session->userdata['uid'];
		$title = "预约确认";
		$content = "恭喜你已经完成预约的第一步，如果您在线下成功借书，请点击确认按钮，否则请点击取消！";
		$status = "0";
		$query = $this->db->insert('message',array('from' => $from,'to' => $to,'title' => $title,'content' => $content,'status' => $status));
		if($query->num_rows() > 0)
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}

	public function select_message($uid)
	{
		$query = $this->db->get_where('message',array('to' => $uid,));
		return $query->result_array(); 
	}

	public function confirm($message_id)
	{
		$this->db->update('message',array('status' => "1"));
	}

	public function show_message_num($uid)
	{
		$query = $this->db->get_where('message',array('to' => $uid,'status' => '0'));
		return $query->num_rows();
	}

}

/*End of file user_model.php*/
