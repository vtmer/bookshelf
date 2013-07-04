<?php

class Course_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}
	
	public function addbook($keywords,$print)
	{
		if($print == 0)//该书不是胶印
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
		}
	}


}

?>
