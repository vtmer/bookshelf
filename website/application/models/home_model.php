<?php
class Home_Model extends CI_Model
{
	public function __construct()
	{
  		$this->load->database();
	}

	public function get_book_need($major,$grade)
	{
    	$data = getdate();
    	$year =$data['year'];
    	$month = $data['mon'];
    	if($month < 9)
    	{
      		$year-=1;
    	}
    	switch ($grade) {
      	case $year:
        	$grade = '大二';
        	break;
      	case $year - 1:
       	 	$grade = '大三';
        	break;
      	case $year - 2:    
        	$grade = '大四';
        	break;
      	case $year - 3:
        	$grade = '大四';
        	break;
      	default:
        	#code...
        	break;
    }
  	$sql = "SELECT ab.`id`,`name`,`course_name`,`author`,`course_category`,`publish`,`version` FROM `allbook` ab,`allbook_mg` abmg WHERE major=? AND grade=? AND `ab`.`id`=`abmg`.`book_id`";
  	$query = $this->db->query($sql,array($major,$grade));
  	return $query->result_array();  		
	}

  	public function get_system_match(array $match)
  	{
		$book = array();
		$user = array();
    	$uid = $this->session->userdata['uid'];
    	if($uid==NULL)
    	{
      		$uid = 0;
    	}
		$i = 0;
		$sql = "SELECT `from_id`,`book_id` FROM `circulating_book` WHERE book_status=0 AND `from_id`!=$uid";
		$query = $this->db->query($sql);
		$result = $query->result_array();
		foreach ($match as $value) 
		{  			
  			foreach ($result as $row) 
  			{
  				if($value['id']==$row['book_id'])
  				{
  					$book[$i] = $row;
	        		$book[$i]['name'] = $value['name'];
  					$i++;
  				}
  			}  		
		}
		$sql2 = "SELECT `id`,`truename`,`dormitory`,`major` FROM `user` WHERE `id`!=$uid"; 
		$query2 = $this->db->query($sql2);
		$result = $query2->result_array();
		foreach ($result as $key=>$row) 
  		{  		
  			$j = 1;	
	  		foreach ($book as $value)
	  		{
	  			if($value['from_id']==$row['id'])
	  			{
	  				$user[$key] = $row;
	  				$user[$key]['number'] = $j;
	  				$j++;	
	  			}
	  		}	  			
		}
		return array('user'=>$user,'book'=>$book);
	}

  	public function get_userinfo($from_id)
	{
    $this->db->select('id,username,truename,faculty,major,grade,dormitory,phone_number,subphone_number,points');
    $query = $this->db->get_where('user', array('id' => $from_id));
		return $query->result_array();
	}

	public function calcul_share($from_id)
	{
		$query = $this->db->get_where('user',array('id' => $from_id));
		if($query->num_rows() == 1)
		{
			$row = $query->row();
		}
		$donate = $row->donate_book;
		$borrow = $row->borrow_book;
		$lend = $row->lend_book;
		if($donate == 0 && $lend == 0)
		{
			return $share = 0;
		}
		else
		{
			$share = ($donate + $lend * 0.8 + $borrow * 0.5)/($donate + $lend + $borrow);
			return round($share * 100,1);
		}
	}

	public function get_userbook($user_id,$offset,$length)
	{
    if(isset($offset)&&isset($length))
    {
		  $sql = "SELECT ab.`id` AS book_id,cb.`id` AS cb_id,`name`,`course_name`,`author`,`course_category`,`publish`,`version`,`book_right`,`book_status` 
            FROM `circulating_book` AS cb INNER JOIN `allbook` AS ab WHERE cb.`from_id`=? AND ab.`id`=cb.`book_id` LIMIT $offset,$length";
    }
    else
    {
      //没有限制条数
      $sql = "SELECT ab.`id` AS book_id,cb.`id` AS cb_id,`name`,`course_name`,`author`,`course_category`,`publish`,`version`,`book_right`,`book_status` 
            FROM `circulating_book` AS cb INNER JOIN `allbook` AS ab WHERE cb.`from_id`=? AND ab.`id`=cb.`book_id` ";
    }
		$query = $this->db->query($sql,array($user_id));
		$data['books'] = $query->result_array();
    $query2 = $this->db->query("SELECT count(*) AS num FROM `circulating_book` WHERE from_id='$user_id'"); 
    $rowNum['pageNum'] = $query2->result_array();
    return array_merge($data,$rowNum);
	}
	
	public function get_bookborrow($bookArray)
  	{
    	$book = $this->get_userbook($bookArray['user']);
    	$match = array();
    	foreach ($book['books'] as $key => $value) 
    	{       		
        foreach ($bookArray as $bookkey => $books) 
        {
         if($value['book_id']==$books)
          {
              $match[$key] = $value;
          }           		 
       	}
   		}	
    return $match;     
  	}

	public function count_message()
	{
		return $this->db->count_all_results('message');	
	}
	

  	public function update_info(array $info)
  	{
    	$sql = "UPDATE `circulating_book` SET `to_id`=?,`circulate_number`=`circulate_number`+1,`book_right`=1,`change_time`=NOW() ,`book_status`=1
          WHERE `book_id`=?";
    	foreach($info['book'] as $key=>$value)
    	{
      		if(is_numeric($key))
      		{
        		$query = $this->db->query($sql,array($info['to_id'],$value));
      		}
    	}
    	//发送站内信息
    	$books = array();
    	$from = $info['to_id'];
    	$to = $info['from_id'];
    	$from_user = $this->get_userinfo($from);
    	$title = $from_user[0]['truename']."向你预约了书本";
    	$content = "你好，<strong><a href='".site_url('book_owner').'/'.$from."'>".$from_user[0]['truename']."</a></strong>向你预约了书本如下：</br>";
    	$create_time = date("Y/m/d");
    	foreach($info['book'] as $key=>$value)
    	{
    		if(is_numeric($key))
  			{   
      		$books = $this->search_model->get_book_by_id($value);
      		$content .= "<input type='checkbox' name='book".$value."' value='".$value."' /><strong><a href='".site_url('home/book_info').'/'.$value."'>《".$books[0]->name."》</a></strong><br/>";
        }
      }
    	$message_id = $this->count_message() + 1;
    	$url = "message/confirm/".$message_id;
      	$content .= "若你核对完信息后，请勾选你已借出的书籍，并点击后面的确认";
    	$content = mysql_real_escape_string($content);//转义特殊字符
      $sql2 = "INSERT INTO `message` (`from`,`to`,`title`,`content`,`create_time`) VALUES ('$from','$to','$title','$content','$create_time')";
    	$this->db->query($sql2);
  	} 	 

  	public function pull_off($id)
  	{
    	$sql = "DELETE FROM `circulating_book` WHERE `id`=$id";
      $this->db->query($sql);
      $query = mysql_affected_rows();
      $sql2 = "UPDATE `user` SET `points` = `points` - 8 ,`donate_book` = `donate_book` - 1 WHERE `id` = ".$this->session->userdata['uid'];
      $this->db->query($sql2);
      $query2 = mysql_affected_rows();
      return 2==$query+$query2 ? true:false;
    }
  
  	public function count_userbook($id)
  	{
    	$num = array();
		$query = $this->db->get_where('user',array('id' => $id)); 
		if($query->num_rows() == 1)
		{
	    	$row = $query->row(); 
		}
    	$num[0] = $row->donate_book; 
    	$num[1] = $row->borrow_book;
    	$num[2] = $row->lend_book;
    	return $num;
  	}
 
  	public function update_config($data)
  	{
  		$id = $this->session->userdata('uid');
    	$sql = "UPDATE `user` SET `phone_number`=?,`subphone_number`=?,`dormitory`=?,`password`=? WHERE `id`=$id ";
    	$sql2 = "UPDATE `user` SET `phone_number`=?,`subphone_number`=?,`dormitory`=? WHERE `id`=$id ";

    	if($data['pwd']!=NULL)
    	{
          $query = $this->db->get_where('user', array('id' => $id,'password'=>md5($data['pwd_old'])));
          if(count($query->result())==0)
          {
            return 4;//密码错误
          }
      		$this->db->query($sql,array($data['phone_number'],$data['subphone_number'],$data['dormitory'],md5($data['pwd'])));
      		if($this->db->affected_rows())
      		{
        		return 2;//修改密码成功
      		}	
      		else return 3;//与原密码一致
    	}	
    	else
    	{
      		$this->db->query($sql2,array($data['phone_number'],$data['subphone_number'],$data['dormitory']));
       		if($this->db->affected_rows())
       		{
          		return 1;//修改信息成功
       		}
       		else return 0;//修改信息与原来的一致
    	}
  	}	
}
