<?php
class Home_Model extends CI_Model
{
	public function __construct()
  	{
    	$this->load->database();
  	}
  	public function get_book_need($major,$grade)
  	{

		$sql = "SELECT * FROM `allbook` WHERE major=? AND grade=?";
		$query = $this->db->query($sql,array($major,$grade));
		return $query->result_array();  		
  	}
/**
 * 系统匹配书源人
 *
 * @todo   get系统匹配书源人
 * @access public
 * @param  $match
 * @return array
 */
  	public function get_system_match(array $match)
  	{
  		$book = array();
  		$user = array();
  		$i = 0;
  		$sql = "SELECT `from_id`,`ISBN`,`name` FROM `circulating_book` WHERE book_status=1";
  		$query = $this->db->query($sql);
  		$result = $query->result_array();
  		foreach ($match as $value) 
  		{  			
	  		foreach ($result as $row) 
	  		{
	  			if($value['ISBN']==$row['ISBN']&&$value['name']==$row['name'])
	  			{
	  				$book[$i] = $row;
	  				$book[$i]['book_id']=$value['id'];
	  				$i++;
	  			}
	  		}  		
		}
		$sql2 = "SELECT `id`,`truename`,`dormitory`,`major` FROM `user`"; 
		$query2 = $this->db->query($sql2);
		$result = $query2->result_array();
		$j = 1;	
		foreach ($result as $row) 
  		{  		
  			$j = 1;	
	  		foreach ($book as $value)
	  		{
	  			if($value['from_id']==$row['id'])
	  			{
	  				$user[$row['id']] = $row;
	  				$user[$row['id']]['number'] = $j;
	  				$j++;	
	  			}
	  		}
	  			
		}
		//var_dump($match);
		return array('user'=>$user,'book'=>$book);
  	}
}