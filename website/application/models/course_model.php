<?php

class Course_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}
	
	public function addbook($isbn,$title,$print)
	{
		if($print == "0")//该书不是胶印
		{
			$query = $this->db->get_where('allbook',array('ISBN' => $isbn));
			$query_points = $this->db->get_where('user',array('id' => $this->session->userdata('uid')));
		}
		else//该书为胶印
		{
			$query = $this->db->get_where('allbook',array('name' => $title,'ISBN' => NULL));
			$query_points = $this->db->get_where('user',array('id' => $this->session->userdata('uid')));
		}

		if($query->num_rows() == 1 && $query_points->num_rows() == 1)
		{
			$row = $query->row();
			$row_user = $query_points->row();
			$points = $row_user->points;
			$points = $points + 8;
			$book_id = $row->id;
			$from_id = $this->session->userdata('uid');	
			$this->db->insert('circulating_book',array(
					'from_id' => $from_id,
					'book_id' => $book_id,
				));	
			$this->db->where('id',$this->session->userdata('uid'));
			$this->db->update('user',array('points' => $points));
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}

}

?>
