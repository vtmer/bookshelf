<?php
class Home_Model extends CI_Model
{
	public function __construct()
  	{
    $this->load->database();
  	}
  	public function get_book_need()
  	{

		$sql="SELECT name,author,publish,version,course_name,course_category FROM allbook WHERE major=? AND grade=?";
		$query=$this->db->query($sql,array('网络工程','2011'));
		return $query->result_array();  		
  	}

}