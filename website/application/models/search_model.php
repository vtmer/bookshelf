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
  		$sql = "SELECT * FROM `allbook` WHERE ISBN=? ";
  		$query = $this->db->query($sql,array($ISBN));
  		return $query->result();
  	}
  	public function get_book_by_keywords($keywords)
  	{
      $keywords=mysql_real_escape_string($keywords);
  		$sql = "SELECT * FROM `allbook` ab,`circulating_book` cb WHERE `name` LIKE ('%$keywords%') AND `ab`.`id`=`cb`.`book_id` AND `cb`.`book_status`=0";
  		$query=$this->db->query($sql);
  		$result=$query->result_array();
  		//var_dump($result);
  		return $result;
  	}	
 }