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

	//注册时验证邮箱是否存在
	public function check_is($mail)
	{
		$query = $this->db->get_where('user',array('username' => $mail));
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
		$query = $this->db->get_where('message',array('to' => $uid));
		return $query->result_array(); 
	}

	public function confirm($message_id)
	{
		$query_judge = $this->db->get_where('message',array('id' => $message_id));
		if($query_judge->num_rows() == 1)
		{
			$row = $query_judge->row();
			$judge_flag = $row->status;
			if($judge_flag == 0)
			{
				$this->db->where('id',$message_id);
				$this->db->update('message',array('status' => "1"));
		
				//获取该条信息的发送者和接收者
				/*$query = $this->db->get_where('message',array('id' => $message_id)); 
				if($query->num_rows() == 1)
				{
					$row = $query->row();
				}*/
				$from = $row->from;
				$to = $row->to;
				$book_num = $row->book_num;
				$book_array = $row->book_array;
				
				//获取信息发送者的积分
				$query_user_from = $this->db->get_where('user',array('id' => $from));
				if($query_user_from->num_rows() == 1)
				{
					$row_from = $query_user_from->row();
					$from_point = $row_from->points - 10 * $book_num;
					$borrow_book = $row_from->borrow_book + $book_num;
				}
		
				//获取信息接收者的积分
				$query_user_to = $this->db->get_where('user',array('id' => $to));
				if($query_user_to->num_rows() == 1)
				{
					$row_to = $query_user_to->row();
					$to_point = $row_to->points + 5 * $book_num;
					$lend_book = $row_to->lend_book + $book_num;
				}

				//更新信息发送者的积分（积分减少10）
				$this->db->where('id',$from);
				$this->db->update('user',array('points' => $from_point,'borrow_book' => $borrow_book));
		
				//更新信息接收者的积分（积分增加5）
				$this->db->where('id',$to);
				$this->db->update('user',array('points' => $to_point,'lend_book' => $borrow_book));
				/*	
				$this->db->where('id' => $book_id);
				$this->db->update('circulating_book',array('book_status' => '2'));
				i*/
				$book_array_explode = array();
				$book_array_explode = explode(" ",$book_array);
    			foreach($book_array_explode as $value)
    			{
    		  		if(is_numeric($value))
					{
						$this->db->where('book_id',$value);
						$this->db->update('circulating_book',array('book_status' => 2));		
      				}
    			}

				return TRUE;
			}
		}
			return FALSE;
	}

	public function show_message_num($uid)
	{
		$query = $this->db->get_where('message',array('to' => $uid,'status' => '0'));
		return $query->num_rows();
	}

	public function show_user_point($uid)
	{
		$query = $this->db->get_where('user',array('id' => $this->session->userdata('uid')));
	   	if($query->num_rows() == 1)
		{
			$row = $query->row();
		}	
		return $points = $row->points;
	}
}

/*End of file user_model.php*/
