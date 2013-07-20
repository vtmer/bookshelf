<?php
class Search_Model extends CI_Model
{
	public function __construct()
  	{
    	$this->load->database();
  	}
  	public function get_book_by_id($book_id)
  	{
  		$sql = "SELECT * FROM `allbook` WHERE id=? ";
  		$query = $this->db->query($sql,array($book_id));
  		return $query->result();
  	}
  	public function get_book_by_ISBN($ISBN)
  	{
      $ISBN = mysql_real_escape_string($ISBN);
  		$sql = "SELECT * FROM `allbook` WHERE ISBN LIKE ('%$ISBN%') ";
  		$query = $this->db->query($sql);
  		return $query->result();
  	}
  	public function get_book_by_keywords($keywords,$offset = -1,$length = -1)
  	{
      $keywords = mysql_real_escape_string($keywords);
      if($offset>=0&&$length>=0)
      {
        $this->db->select('id , ISBN , name , author , publish ,version , course_name , term , course_category')
                  ->from('allbook')
                  ->like('name' , $keywords)
                  ->where('status' , 1)
                  ->limit($length,$offset);
        $this->db->like('name', $keywords); 
        $query = $this->db->get();
        $result['books'] = $query->result_array();
        $sql2 = "SELECT count(*) AS num FROM `allbook` WHERE `name` LIKE ('%$keywords%')";
        $query2 = $this->db->query($sql2);
        $num = $query2->result_array();
    		$result['num'] = $num[0]['num'];
      }
      else
      {
        $this->db->select('id , ISBN , name , author , publish ,version , course_name , term')
                 ->from('allbook')
                 ->like('name' , $keywords)
                 ->where('status' , 1);
        $query = $this->db->get();
        $result = $query->result_array();
      }
   		return $result;
  	}	
 }