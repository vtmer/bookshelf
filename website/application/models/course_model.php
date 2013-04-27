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
		}
		else//该书为胶印
		{
			$query = $this->db->get_where('allbook',array('name' => $title,'ISBN' => NULL));
		}

		if($query->num_rows() == 1)
		{
			$row = $query->row();
			$book_id = $row->id;
			$from_id = $this->session->userdata('uid');	
			$this->db->insert('circulating_book',array(
					'from_id' => $from_id,
					'book_id' => $book_id,
				));	
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}

}

?>
