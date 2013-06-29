<?php

class User_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	//登陆时验证函数

	public function is_active($email)
	{
		$query = $this->db->get_where('user',array('username' => $email,'status' => '1'));
		return($query->num_rows() == 1) ? TRUE : FALSE ;
	}

	public function is($email,$password)
	{
		$query = $this->db->get_where('user',array('username' => $email,'password' => $password,'status' => "1"));
		return($query->num_rows() == 1) ? TRUE : FALSE;
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
		$this->db->order_by("id", "desc");
		$query = $this->db->get_where('message',array('to' => $uid));
		return $query->result_array(); 
	}

	public function confirm($bookArray)
	{
		$message_id = $bookArray['message_id'];
		$books = array();
		$bookArray = array_values($bookArray);//重设键值，改为索引数组
		for($i=1;$i<count($bookArray);$i++)
		{
			$books[$i-1] = $bookArray[$i]; 
		}
		//获取该条信息的发送者和接收者
		$sql = "SELECT `from`,`to` FROM  `message` WHERE `id`='$message_id'";
		$query = mysql_query($sql);
		$msgRelation = mysql_fetch_assoc($query);
		//获取信息状态
		$query = mysql_query("SELECT `status` FROM `message` WHERE `id`='$message_id'");
		$status = mysql_result($query,0);
		if($status==1) //如果信息已确认
		{
			return FALSE;
		} 
		//更新信息为已读
		$this->db->where('id',$message_id);
		$this->db->update('message',array('status' => "1"));
		$book_num = count($books);
		//获取信息发送者的积分
		$query_user_from = $this->db->get_where('user',array('id' => $msgRelation['from']));
		if($query_user_from->num_rows() == 1)
		{
			$row_from = $query_user_from->row();
			$from_point = $row_from->points - 10 * $book_num;
			$borrow_book = $row_from->borrow_book + $book_num;
		}		
		//获取信息接收者的积分
		$query_user_to = $this->db->get_where('user',array('id' => $msgRelation['to']));
		if($query_user_to->num_rows() == 1)
		{
			$row_to = $query_user_to->row();
			$to_point = $row_to->points + 5 * $book_num;
			$lend_book = $row_to->lend_book + $book_num;
		}
		//更新信息发送者的积分（积分减少10）
		$this->db->where('id',$msgRelation['from']);
		$this->db->update('user',array('points' => $from_point,'borrow_book' => $borrow_book));		
		//更新信息接收者的积分（积分增加5）
		$this->db->where('id',$msgRelation['to']);
		$this->db->update('user',array('points' => $to_point,'lend_book' => $lend_book));
		//更新所有书本状态
		$sql = "SELECT * FROM  `circulating_book` WHERE `book_id`='$books[0]'";
		$query = mysql_query($sql);
		$bookDetail = mysql_fetch_assoc($query);
		foreach ($books as $key => $value) 
		{		
			$sql = "UPDATE `circulating_book` SET `book_status` = '2',`book_right`='1',
								`circulate_number` = ".(int)($bookDetail['circulate_number']+1).",
								`from_id`='".$msgRelation['from']."',`to_id`='".$msgRelation['to']."',`change_time`=NOW() WHERE `book_id`='$value'";
			mysql_query($sql);
		}	
		return TRUE;
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
                    return $points = $row->points;
		}	
		return -1;
	}
	public function send_sys_msg($uid,$content)
	{
		$data = array(
			'from'=>'系统',
			'to'=>$uid,
			'title'=>'欢迎加入工大书架',
			'content'=>$content,
			'status'=>0,
			'create_time'=>date('Y-m-d')
			);
		$this->db->insert('message', $data);
		return mysql_affected_rows();
	}
}

/*End of file user_model.php*/
