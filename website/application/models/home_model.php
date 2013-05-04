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
        $grade = '大一';
        break;
      case $year - 1:
        $grade = '大二';
        break;
      case $year - 2:
        $grade = '大三';
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
		$sql = "SELECT `id`,`username`,`truename`,`faculty`,`major`,`grade`,`dormitory`,`phone_number`,`subphone_number` FROM `user` WHERE `id`=?";
		$query = $this->db->query($sql,array($from_id));
		return $query->result_array();
	}

	public function get_userbook($user_id)
	{
		$sql = "SELECT `allbook`.`id`,`name`,`course_name`,`author`,`course_category`,`publish`,`version`,`book_right`,`book_status` 
            FROM `circulating_book`,`allbook` WHERE `circulating_book`.`from_id`=? AND `allbook`.`id`=`circulating_book`.`book_id`";
		$query = $this->db->query($sql,array($user_id));
		return $query->result_array();
	}
	
	public function get_bookborrow($segs,$num)
  {
    $book = $this->get_userbook($segs[4]);
    $match = array();
    foreach ($book as $key => $value) 
    {
       for($i=6;$i<=$num;$i++)
       {
          if($value['id']==$segs[$i])
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
    $n = (count($info['book'])-1)*10;
    foreach($info['book'] as $key=>$value)
    {
      if($key!='from_id')
      {
        $query = $this->db->query($sql,array($info['to_id'],$value));
      }
    }
    $this->db->query("UPDATE `user` SET `points`=`points`-$n WHERE `id`=".$info['to_id']);
    $this->db->query("UPDATE `user` SET `points`=`points`+$n WHERE `id`=".$info['from_id']);
    //发送站内信息
    $books = array();
    $from = $info['to_id'];
    $to = $info['from_id'];
    $from_user = $this->get_userinfo($from);
    $title = $from_user[0]['truename']."向你预约了书本";
    $content = "你好，<strong><a href='".site_url('home/book_owner').'/'.$from."'>".$from_user[0]['truename']."</a></strong>向你预约了书本如下：</br>";
    $create_time = date("Y/m/d");
      
    foreach($info['book'] as $key=>$value)
    {
      if($key!='from_id')
      {
        $books = $this->search_model->get_book_by_id($value);
        $content .= "<strong><a href='".site_url('home/book_info').'/'.$value."'>《".$books[0]->name."》</a></strong><br/>";
      }
    }
    $message_id = $this->count_message() + 1;
    $url = "message/confirm/".$message_id;
    $content .= "若你核对完信息后，请点击后面的确认链接<a href='".site_url($url)."'><strong>确认</strong></a>";
    $content = mysql_real_escape_string($content);//转义特殊字符
    $sql2 = "INSERT INTO `message` (`from`,`to`,`title`,`content`,`create_time`) VALUES ('$from','$to','$title','$content','$create_time')";
    $this->db->query($sql2);
  }  

  public function pull_off($id)
  {
    $sql = "DELETE FROM `circulating_book` WHERE `book_id`=$id";
    $this->db->query($sql);
  }
  
  public function count_userbook($id)
  {
    $num = array();
    $sql = "SELECT COUNT(*) as lend_book FROM `circulating_book` WHERE `from_id`=$id ";
    $sql2 = "SELECT COUNT(*) as borrow_book FROM `circulating_book` WHERE `to_id`=$id ";
    $result = $this->db->query($sql);
    $result2 = $this->db->query($sql2);
    $num[0] = $result->result();
    $num[1] = $result2->result();
    var_dump($num);
  }
  public function update_config($data)
  {
    $sql = "UPDATE `user` SET `faculty`=?,`major`=?,`grade`=?,`phone_number`=?,`subphone_number`=?,`dormitory`=?,`username`=? WHERE `id`=?";
    //$query = $this->db->query($sql,$data);
  }
}
