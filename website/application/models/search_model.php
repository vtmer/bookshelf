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
  		$sql = "SELECT * FROM `allbook` WHERE `name` LIKE ('%$keywords%')";
  		$query=$this->db->query($sql);
  		$result=$query->result_array();
  		//var_dump($result);
  		return $result;
  	}	
 }