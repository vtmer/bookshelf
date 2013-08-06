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
	public function add($data)
	{
		$faculty = $data['faculty'];
		$major = $data['major'];
		$this->db->select('a.id, a.name')
				->from('major AS a')
				->join('major AS b' ,'a.parent_id = b.id')
				->where('b.name',$faculty);
		$query = $this->db->get();
		$majors = $query->result_array();//获取改学院的所有专业
		$sim = 0;
		$m_name = '';
		foreach ($majors as $key => $value) 
		{
			//匹配专业
			if($major==$value['name'])
			{
				$data['major'] = $value['id'];//替换为专业ID
			}
			else
			{
				//模糊匹配，计算相似度
				similar_text($major,$value['name'],$max);
				if($max > $sim)
				{
					$data['major'] = $value['id'];//替换为专业ID
					$m_name = $value['name'];
					$sim = $max;	
				}
			}
		}
		$this->session->set_userdata('major',$m_name);
		$this->db->insert('user',$data);
		return mysql_insert_id();
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

	//根据学号获取该用户信息
	public function get($student_id)
	{
		$this->db->select('points, truename, grade, major, id');
		$query = $this->db->get_where('user',array('student_id' => $student_id));
		if($query->num_rows() == 1)
		{
			$row = $query->row();
			return $row;
		}	
		else
		{
			return ;
		}
	}
	public function major_name()
	{
		$this->db->select('name');
		$query = $this->db->get_where('major',array('id'=>$this->session->userdata('major')));
		$result = $query->row();
		return $result->name;
	}

	//根据email激活用户帐号
	public function activate($uid)
	{
		$this->db->update('user',array('status' => "1",'activationkey'=>null),array('id' => $uid));
		return (mysql_affected_rows() > 0) ? TRUE : FALSE;
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
		$b_id_arr = array();
		foreach ($bookArray as $key => $value) 
		{
			if(is_numeric($key))
			{
				array_push($b_id_arr, $key);
			}
		}
		array_shift($bookArray);

		//$this->db->trans_start();
		//更新信息为已确认
		$this->db->where('id',$message_id);
		$this->db->update('message',array('status' => "22"));
		//获取该条信息的发送者和接收者
		$this->db->select('from , to ')
				->from('message')
				->where('id',$message_id);
		$query = $this->db->get();
		$result = $query->result_array();

		$from_id = $result[0]['from'];
		$to_id = $result[0]['to'];

		$this->db->select('id')
				 ->from('message')
				 ->where('to',$from_id);
		$query2 = $this->db->get();
		$result2 = $query2->result_array();
		foreach ($result2 as $key => $value) 
		{
			if(abs((int)($value['id'])-(int)($message_id))==1)
			{
				if($value['id'] > $message_id)
				{
					//捐书人点击确认
					  // echo '捐书人点击确认value>msg_id';//exit;
					$this->db->where('id',(int)($message_id) + 1);
					$this->db->update('message',array('status' => "22"));
					$add_id = $to_id;
					$min_id = $from_id;
				}
				else
				{
					//借书点击确认
					// echo '借书人点击确value<msg_id';exit;
					$this->db->where('id',(int)($message_id)-1);
					$this->db->update('message',array('status' => "22"));
					$add_id = $from_id;
					$min_id = $to_id;
				}
			}
		}
		$book_num = count($bookArray);
		//获取信息扣分者的积分
		$query_user_from = $this->db->get_where('user',array('id' => $min_id));
		if($query_user_from->num_rows() == 1)
		{
			$row_from = $query_user_from->row();
			$from_point = $row_from->points - 10 * $book_num;
			$borrow_book = $row_from->borrow_book + $book_num;
		}		
		//获取信息加分者的积分
		$query_user_to = $this->db->get_where('user',array('id' => $add_id));
		if($query_user_to->num_rows() == 1)
		{
			$row_to = $query_user_to->row();
			$to_point = $row_to->points + 8 * $book_num;
			$lend_book = $row_to->lend_book + $book_num;
		}
		//更新信息发送者的积分（积分减少10/本）
		$this->db->where('id',$min_id);
		$this->db->update('user',array('points' => $from_point,'borrow_book' => $borrow_book));		
		//更新信息接收者的积分（积分增加8/本）
		$this->db->where('id',$add_id);
		$this->db->update('user',array('points' => $to_point,'lend_book' => $lend_book));
		//更新所有书本状态
		foreach ($bookArray as $key => $value) 
		{
			$sql = "UPDATE `circulating_book` 
					SET `book_status` = '2',
						`book_right`='1',
						`circulate_number` =`circulate_number`+1,
						`from_id`= $add_id,
						`to_id`= $min_id,
						`change_time`= NOW() 
					WHERE `id`=$value";
			mysql_query($sql);
		}
		foreach ($b_id_arr as $key => $value) 
		{
			//添加捐书记录给捐书人
			$arr = array(
					'book_id'=>$value,
					'from_id'=>$add_id,
					'to_id'=>$min_id,
					'time'=>date('Y-m-d') 
				);
			$this->db->insert('borrow_log',$arr);
		}
		// $this->db->trans_complete();
		// if ($this->db->trans_status() === FALSE)
		// {
		//     // 生成一条错误信息... 或者使用 log_message() 函数来记录你的错误信息
		//     $this->db->trans_off();
		//   	return mysql_error();
		// }
		// $this->db->trans_off();
		return TRUE;
	}

	public function show_message_num($uid)
	{
		$query = $this->db->get_where('message',array('to' => $uid,'status %10=' => 0));
		return $query->num_rows();
	}

	public function show_user_point($uid)
	{
		$query = $this->db->get_where('user',array('id' => $this->session->userdata('uid')));
	   	if($query->num_rows() == 1)
		{
            $row = $query->row();
            $this->session->set_userdata(array('points'=>$row->points));
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
			'status'=>10,
			'create_time'=>date('Y-m-d')
			);
		$this->db->insert('message', $data);
		return mysql_affected_rows();
	}
	public function msg_readed($msg_id)
	{	
		$this->db->select('status');
		$query = $this->db->get_where('message',array('id'=>$msg_id));
		$result = $query->result_array();
		$status = $result[0]['status'];
		if($status%10!=0) return false;
		$this->db->where('id',$msg_id);
		$this->db->update('message',array('status' => (int)($status)+1));
		return mysql_affected_rows();
	}
	public function del_msg($msg_id)
	{
		$this->db->where('id',$msg_id);
		$this->db->delete('message');
		return mysql_affected_rows();
	}
}

/*End of file user_model.php*/
