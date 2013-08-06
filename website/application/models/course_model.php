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
		//运行事务，有问题造成表锁死
		// $this->db->trans_start();
		//插入循环书库表
		foreach ($ID_arr as $key => $value) 
		{
			$data = array(
					'from_id' => $uid,
					'book_id' => $value,
					'create_time' =>null
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

		/*$this->db->trans_complete();//完成

		if ($this->db->trans_status() === FALSE)
		{
			 // 生成一条错误信息... 或者使用 log_message() 函数来记录你的错误信息
			$this->db->trans_off();
			return FALSE;		   
		}
		$this->db->trans_off();*/
		return TRUE;
	}

	public function check_rule($ID_arr)
	{
		$uid = $this->session->userdata('uid');
		$grade = $this->session->userdata('grade');
		$major = $this->session->userdata('major');
		//var_dump($this->session->all_userdata());
		//找出改专业和该年级及以下的书本id
		$this->db->select('ab.id , ab.name ,abmg.grade, ab.term')
				->from('allbook as ab')
				->join('allbook_mg as abmg','abmg.book_id = ab.id')
				->where('abmg.major',$major);
		$query = $this->db->get();
		$allbook = $query->result_array();
		//var_dump($allbook);
		$flag = array();
		foreach ($ID_arr as $num=>$book_id) 
		{
			$flag[$num] = 0;
			foreach ($allbook as $key => $value) 
			{
				if($book_id==$value['id'])//本专业
				{
					$flag[$num] = 1;
					//年级转换为数字
					$term = 1;
					$data = getdate();
					$year =$data['year'];
					$month = $data['mon'];
					if($month < 9&&$month > 2)
					{
						$year-= 1;
						$term = 2;
					}
					switch ($value['grade']) {
						case '大一':
							$value['grade'] = $year;
							break;
						case '大二':
							$value['grade'] = $year - 1;
							break;
						case '大三':
							$value['grade'] = $year - 2;
							break;
						case '大四':
							$value['grade'] = $year - 3;
							break;
						default:
							#code...
							break;
					};
					if($value['grade'] == $grade)
					{
						if($term==2&&$value['term']==1)
						{
							$flag[$num] = 2;
							//检查重复性
							$this->db->select('count(*) as num')
									->from('circulating_book')
									->where('book_id',$value['id'])
									->where('from_id',$uid);
							$query = $this->db->get();
							$result = $query->row();
							if($result->num==0)
							{
								$flag[$num] = 3;
							}
							break;//下一本
						}
					}
					else if($value['grade'] > $grade)
					{
						$flag[$num] = 2;
						//检查重复性
							$this->db->select('count(*) as num')
									->from('circulating_book')
									->where('book_id',$value['id'])
									->where('from_id',$uid);
							$query = $this->db->get();
							$result = $query->row();
							if($result->num==0)
							{
								$flag[$num] = 3;
							}
						break;//下一本
					}
				}
			}
		}
		foreach ($flag as $key => $value) 
		{
			if($value!=3)
			{
				if($value==0)
					return 0;
				if($value==1)
					return 1;
				if($value==2)
					return 2;
			}
		}
		return 3;
	}

}
/*----end of course_model ----*/
