<?php

class Course_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}
	
	public function addbook($ID_arr)
	{
		/*if($print == 0)//该书不是胶印
		{
			if(!is_numeric($keywords))
			{
				$query = $this->db->get_where('allbook',array('name' => $keywords,'print' => 0));
				$query_points = $this->db->get_where('user',array('id' => $this->session->userdata('uid')));
			}
			else
			{
			$query = $this->db->get_where('allbook',array('ISBN' => $keywords,'print' => 0));
			$query_points = $this->db->get_where('user',array('id' => $this->session->userdata('uid')));
			
			}
		}
		else//该书为胶印
		{
			$query = $this->db->get_where('allbook',array('name' => $keywords,'print' => '1'));
			$query_points = $this->db->get_where('user',array('id' => $this->session->userdata('uid')));
		}

		if($query->num_rows() > 0  && $query_points->num_rows() == 1)
		{
			//echo "<script>alert(".$query->num_rows().");</script>";
			//echo "<script>alert(".$query_points->num_rows().");</script>";
			$row = $query->row();
			$row_user = $query_points->row();
			$points = $row_user->points;
			$donate_book = $row_user->donate_book;
			$points = $points + 8;
			$donate_book = $donate_book + 1;  
			$book_id = $row->id;
			$from_id = $this->session->userdata('uid');	
			$this->db->insert('circulating_book',array(
					'from_id' => $from_id,
					'book_id' => $book_id,
				));	
			$this->db->where('id',$this->session->userdata('uid'));
			$this->db->update('user',array('points' => $points,'donate_book' => $donate_book));
			return TRUE;
		}
		else
		{
			return FALSE;
		}*/


		$uid = $this->session->userdata('uid');
		//运行事务
		$this->db->trans_start();
		//插入循环书库表
		foreach ($ID_arr as $key => $value) 
		{
			$data = array(
					'from_id' => $uid,
					'book_id' =>$value,
					'create_time' =>date('YY-MM-DD')
				);
			$this->db->insert('circulating_book',$data);
		}
		//更新用户积分
		$n = count($ID_arr);
		$points = $n * 5;//每捐一本本+5分
		$this->db->select('points , donate_book')
				->from('user')
				->where('id' , $uid);
		$query = $this->db->get();
		$result = $query->result_array();
		$data = array(
				'points' => $result[0]['points'] + $points,
				'donate_book' => $result[0]['donate_book'] + $n,
			);
		$this->db->update('user', $data , array('id'=>$uid));

		$this->db->trans_complete();//完成

		if ($this->db->trans_status() === FALSE)
		{
			 // 生成一条错误信息... 或者使用 log_message() 函数来记录你的错误信息
			return FALSE;		   
		}
		return TRUE;
	}


}
/*----end of course_model ----*/
