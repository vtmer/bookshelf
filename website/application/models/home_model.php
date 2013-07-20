<?php
class Home_Model extends CI_Model
{
	public function __construct()
	{
  		$this->load->database();
	}

  public function trans_grade($grade)
  {
    $data = getdate();
      $term = 2;
      $year =$data['year'];
      $month = $data['mon'];
      $school_year = $year.'-'.(int)($year+1);//9月到12月
      if($month < 9&&$month > 2)
      {
          $school_year = (int)($year).'-'.(int)($year+1);
          $year-=1;
          $term = 1;
      }
      else
      if($month>=1&&$month<=2)
      {
        $school_year = (int)($year).'-'.(int)($year+1);//由于之前已经减1了
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
    return array('grade'=>$grade , 'school_year'=>$school_year , 'term'=>$term);
  }
  public function get_book_need($grade,$major)
  {
    $trans_grade = $this->trans_grade($grade);
    $grade = $trans_grade['grade'];
    $uid = $this->session->userdata('uid');
    //$sql = "SELECT ab.`id`,`name`,`course_name`,`author`,`course_category`,`publish`,`version` FROM `allbook` ab,`allbook_mg` abmg WHERE major=? AND grade=? AND `ab`.`id`=`abmg`.`book_id`";
    // $query = $this->db->query($sql,array($major,$grade));
    $this->db->select("ab.id , name , course_name , author , course_category , publish , version ")
              ->from('allbook AS ab')
              ->join('allbook_mg AS abmg' , 'ab.id = abmg.book_id')
              ->where('major' , $major)
              ->where('grade' , $grade)
              ->where('term' , $trans_grade['term']);
    $query = $this->db->get();//获取所需要接的书本
    $result = $query->result_array();

    $this->db->select('cb.book_id , cb.book_status  ')//获取所需书本状态
             ->from('circulating_book AS cb')
             ->join('allbook AS ab' , 'ab.id = cb.book_id','left')
             ->join('allbook_mg AS abmg' , 'ab.id = abmg.book_id','left')
             ->where('cb.to_id' , $uid)
             ->where('abmg.major' , $major)
             ->where('abmg.grade' , $grade)
             ->where('ab.term' , $trans_grade['term']);         
    $query2 = $this->db->get();
    $result2 = $query2->result_array();
    foreach ($result as $key => $value) 
    {
      if(!empty($result2))
      {
        foreach ($result2 as $key2 => $value2) 
        {
          if($value['id'] == $value2['book_id'])
          {
            // echo 'a';
             $result[$key]['book_status'] = $value2['book_status'];
             break;
          }   
          else
          {
            //var_dump($key); 
            $result[$key]['book_status'] = 0;
          }
        }
      }
      else
      {
         $result[$key]['book_status'] = 0;
      }   
    }
    return $result;
  }
  public function system_match($grade,$major,$offset,$length)
  {
    $trans_grade = $this->trans_grade($grade);
    $grade = $trans_grade['grade'];
    $uid = $this->session->userdata('uid');
    /*$sql = "SELECT DISTINCT SQL_CALC_FOUND_ROWS `cb`.`from_id` AS uid, `cb`.`book_id`, `ab`.`name`, `user`.`truename`, `user`.`dormitory` 
    FROM (`allbook` AS ab) LEFT JOIN `circulating_book` AS cb ON `cb`.`book_id` = `ab`.`id` 
                           LEFT JOIN `user` ON `cb`.`from_id` = `user`.`id` 
                           LEFT JOIN `allbook_mg` AS abmg ON `abmg`.`book_id`=`ab`.`id` 
                           WHERE `cb`.`book_status` = 0 AND `user`.`id` != ?
                                 AND `abmg`.`grade` = ? AND `abmg`.`major` = ?
                           LIMIT ?, ?";
    $query = $this->db->query($sql, array($uid, $grade, $major ,$offset, $length ));*/
    $this->db->select('cb.from_id AS uid, cb.book_id, ab.name, user.truename, user.dormitory')
            ->from('allbook AS ab')
            ->join('circulating_book AS cb', 'cb.book_id = ab.id', 'left')
            ->join('user', 'cb.from_id = user.id', 'left')
            ->join('allbook_mg AS abmg','abmg.book_id = ab.id','left')
            ->where('cb.book_status',0)
            ->where('user.id !=',$uid)
            ->where('abmg.grade',$grade)
            ->where('abmg.major',$major);
    $this->db->distinct();
    $query = $this->db->get();
    $result = $query->result_array();
    /*$res_num = $this->db->query('SELECT FOUND_ROWS() AS total;');
    $res_num = $res_num->result_array();*/
    $uid = array();
    $books = array();
    $res = array(array('uid'=>'','truename'=>'','dormitory'=>'','book'=>$books));
    foreach ($result as $key => $value) 
    {
        $uid[] = $value['uid'];
    }
    $uid = array_unique($uid);//取出重复值
    $uid = array_values($uid);
    $n = count($uid);
    for($i = 0 ; $i < $n ; $i++)
    {
      foreach ($result as $key => $value) 
      {
        if($value['uid']==$uid[$i])
        {
          array_push($books, array('book_id'=>$value['book_id'],'name'=>$value['name']));
          $res[$i] =array('uid'=>$value['uid'],'truename'=>$value['truename'],'dormitory'=>$value['dormitory'],'book'=>$books);
        }
      }
      $books = array();//清空
    }
    $res_num = count($res);
    $res_perpage = array_slice($res,$offset,$length);// 分页截断
    return array('data'=>$res_perpage,'total'=>$res_num);
   // var_dump($res_perpage);exit;
	}

  public function user_borrow($book_id , $offset , $length)//查找拥有某本书的人
  {
   /* $this->db->select('SQL_CALC_FOUND_ROWS user.id , user.truename , user.major , user.dormitory ')
             ->from('allbook AS ab')
             ->join('circulating_book AS cb' , 'ab.id = cb.book_id' , 'left')
             ->join('user' , 'user.id = cb.from_id','left')
             ->where('cb.book_status',0)
             ->where('cb.book_id',$book_id)
             ->limit($length,$offset);
    $query = $this->db->get();*/
    $sql = "SELECT SQL_CALC_FOUND_ROWS `user`.`id`, `user`.`truename`, `user`.`major`, `user`.`dormitory` 
            FROM (`allbook` AS ab) 
            LEFT JOIN `circulating_book` AS cb ON `ab`.`id` = `cb`.`book_id` 
            LEFT JOIN `user` ON `user`.`id` = `cb`.`from_id` 
            WHERE `cb`.`book_status` = 0 AND `cb`.`book_id` = ?
            LIMIT ?,?";
    $query = $this->db->query($sql , array($book_id,$offset,$length));
    $result = $query->result_array();
    $res_num = $this->db->query('SELECT FOUND_ROWS() AS total;');//获取总数
    $res_num = $res_num->result_array();
    $res_num = $res_num[0]['total'];   
    return array('user'=>$result,'total'=>$res_num);
    //var_dump(array('user'=>$result,'total'=>$res_num));exit;
  }
  public function borrow_log($offset , $length)
  {
    $uid = $this->session->userdata('uid');
    /*$this->db->select('ab.name  user.truename , bl.time')
              ->from('borrow_log AS bl')
              ->join('allbook AS ab' , 'ab.id = bl.book_id')
             ->join('user' , 'user.id = bl.to_id')
              ->where('bl.from_id' , $uid);
    $query = $this->db->get();*/
    $sql = "SELECT SQL_CALC_FOUND_ROWS `ab`.`name` , `user`.`truename`, `bl`.`time` 
      FROM (`borrow_log` AS bl) 
      LEFT JOIN `allbook` AS ab ON `ab`.`id` = `bl`.`book_id` 
      LEFT JOIN `user` ON `user`.`id` = `bl`.`to_id` 
      WHERE `bl`.`from_id` = ?
      LIMIT ?,?";
    $query = $this->db->query($sql,array($uid , $offset , $length));
    $result = $query->result_array();
    $res_num = $this->db->query('SELECT FOUND_ROWS() AS total;');
    $res_num = $res_num->result_array();
    $res_num = $res_num[0]['total'];

    return array('log'=>$result,'total'=>$res_num);
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

	public function get_userbook($user_id,$offset = '',$length = '')
	{
    if($offset!=''&&$length!='')
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
      //var_dump($book['books']);
    	$match = array();
      foreach ($bookArray as $bookkey => $books) 
    	{       		
        foreach ($book['books'] as $key => $value)
        {
         if($value['book_id']==$books)
          {
              $match[$key] = $value;
              break;
          }           		 
       	}
   		}	
          var_dump($match);    
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
