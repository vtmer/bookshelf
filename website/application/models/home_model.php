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
      $term = 1;
      $year =$data['year'];
      $month = $data['mon'];
      $school_year = $year.'-'.(int)($year+1);//9月到12月
      if($month < 9&&$month > 2)
      {
          $school_year = (int)($year).'-'.(int)($year+1);
          $year-=1;
          $term = 2;
      }
      else
      if($month>=1&&$month<=2)
      {
        $school_year = (int)($year).'-'.(int)($year+1);//由于之前已经减1了
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
    $uid = $this->session->userdata('uid');
    $sql = "SELECT SQL_CALC_FOUND_ROWS `user`.`id`, `user`.`truename`, `user`.`major`, `user`.`dormitory` 
            FROM (`allbook` AS ab) 
            LEFT JOIN `circulating_book` AS cb ON `ab`.`id` = `cb`.`book_id` 
            LEFT JOIN `user` ON `user`.`id` = `cb`.`from_id` 
            WHERE `cb`.`book_status` = 0 AND `cb`.`book_id` = ? AND `user`.`id`!=?
            LIMIT ?,?";
    $query = $this->db->query($sql , array($book_id,$uid,$offset,$length));
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
    $this->db->select('u.id,u.username,u.truename,u.faculty,m.name AS major,u.grade,u.dormitory,u.phone_number,u.subphone_number,u.points')
              ->from('user AS u')
              ->join('major AS m', 'u.major = m.id')
              ->where('u.id', $from_id);
    $query = $this->db->get();
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

	public function get_userbook($user_id,$offset = -1,$length = -1)
	{
    if($offset != -1&&$length!= -1)
    {
		  $sql = "SELECT SQL_CALC_FOUND_ROWS ab.`id` AS book_id,cb.`id` AS cb_id,`name`,`course_name`,`author`,`course_category`,`publish`,`version`,`book_right`,`book_status` 
            FROM `circulating_book` AS cb LEFT JOIN `allbook` AS ab ON ab.`id`=cb.`book_id` WHERE `cb`.`book_status` != 2 AND cb.`from_id`=? OR cb.`to_id`=? LIMIT $offset,$length";
    }
    else
    {
      //没有限制条数
      $sql = "SELECT SQL_CALC_FOUND_ROWS ab.`id` AS book_id,cb.`id` AS cb_id,`name`,`course_name`,`author`,`course_category`,`publish`,`version`,`book_right`,`book_status` 
            FROM `circulating_book` AS cb LEFT JOIN `allbook` AS ab ON ab.`id`=cb.`book_id` WHERE `cb`.`book_status` != 2 AND cb.`from_id`=? OR cb.`to_id`=? ";
    }
		$query = $this->db->query($sql,array($user_id,$user_id));
		$data['books'] = $query->result_array();
    $query2 = $this->db->query("SELECT FOUND_ROWS() AS num "); 
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
          //var_dump($match);    
    return $match;
  	}

	public function count_message()
	{
		return $this->db->count_all_results('message');	
	}
	

  	public function appoint_info($info)
  	{
      //更新书本的状态，为预约中
      //var_dump($info);exit;
      // $this->db->trans_start();
      $from = $info['to_id'];
      $to = $info['from_id'];
      $from_user = $this->get_userinfo($from);
      $to_user = $this->get_userinfo($to);
      $data['from_user'] = $from_user;
      $data['to_user'] = $to_user;
      if($info['status']=='fail')
      {
        //预约失败
        $data['type'] = '3';
        $content = $this->load->view('template/msg_content',$data,TRUE);
        //echo $content;exit;
         $arr = array(
              'from' => $from,
              'to' =>$to,
              'title' =>'我们需要收集你的书本状态信息',
              'content' =>$content,
              'status'=>'30',
              'create_time' => date("Y/m/d")
          );
        $this->db->insert('message',$arr);
      }
      else if($info['status']=='success')
      {
        $books = array();
      	$sql = "UPDATE `circulating_book` SET `to_id`=? , `book_status`=1 WHERE `id`=?";
        $sql2 = "SELECT name FROM `allbook` WHERE `id`=?";
        //array_shift($info['book']);
      	foreach($info['book'] as $key=>$value)
      	{
          if(is_numeric($key))
          {
              $query = $this->db->query($sql,array($info['to_id'],$value));
              $query2 = $this->db->query($sql2,array($key));
              $result = $query2->result_array();
              array_push($books ,array('book_name'=>$result[0]['name'],'cb_id'=>$value,'book_id'=>$key));
          }
          		
      	}
      	//预约成功发送站内信息
        $data['book'] = $books;
         //发给捐书人
        $data['type'] = '1';
        $content_lend = $this->load->view('template/msg_content',$data,TRUE);
        $arr = array(
              'from' => $from,
              'to' =>$to,
              'title' =>substr($from_user[0]['truename'],0,3).'同学向你预约了书本',
              'content' =>$content_lend,
              'status'=>'20',
              'create_time' => date("Y/m/d")
          );
        $this->db->insert('message',$arr);
        //发给借书人
        $data['type'] = '2';
        $content_borr = $this->load->view('template/msg_content',$data,TRUE);
        $arr = array(
              'from' => $to,
              'to' =>$from,
              'title' =>'你向'.substr($to_user[0]['truename'],0,3).'同学预约了书本',
              'content' =>$content_borr,
              'status'=>'20',
              'create_time' => date("Y/m/d")
          );
        $this->db->insert('message',$arr);
      }
      // $this->db->trans_complete(); 
      // if ($this->db->trans_status() == FALSE)
      // {
      //   $this->db->trans_off();
      //   return mysql_error();
      //   exit;
      // }
      // $this->db->trans_off();

    //发送邮件
    //给捐书人
     $msg = '<p><strong>注意：请在收到/借出书后回到工大书架确认借书成功</strong></p>
            <p>此信是由工大书架系统发出，系统不接受回信，请勿直接回复。<p>
            <p>如有任何疑问，请联系我们:<a href="http://weibo.com/vtmer">我们的微博</a><p>
            <p>工大书架--@维生数工作室<p>';
    $this->load->library('email');
    $this->config->load('email');
    $this->email->from('gdutbookshelf@163.com','工大书架');
    $this->email->to($to_user[0]['username']);
    $this->email->subject('工大书架——预约成功提醒');
    $this->email->message($content_lend.$msg);
    if($this->email->send())
    {

    }
    //给借书人
    $this->load->library('email');
    $this->config->load('email');
    $this->email->from('gdutbookshelf@163.com','工大书架');
    $this->email->to($from_user[0]['username']);
    $this->email->subject('工大书架——预约成功提醒');
    $this->email->message($content_borr.$msg);
    if($this->email->send())
    {

    }
    return true;
  	} 	 

  	public function pull_off($id)
  	{
      // $this->db->trans_start();
    	$sql = "DELETE FROM `circulating_book` WHERE `id`=$id";
      $this->db->query($sql);
      $query = mysql_affected_rows();
      $sql2 = "UPDATE `user` SET `points` = `points` - 5 ,`donate_book` = `donate_book` - 1 WHERE `id` = ".$this->session->userdata['uid'];
      $this->db->query($sql2);
      $query2 = mysql_affected_rows();
      // $this->db->trans_complete();
      // if ($this->db->trans_status() == FALSE)
      // {
      //    $this->db->trans_off();
      //   return mysql_error();
      // }
      // $this->db->trans_off();
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
    	//$sql = "UPDATE `user` SET `phone_number`=?,`subphone_number`=?,`dormitory`=? WHERE `id`=$id ";
      $data_arr = array(
               'phone_number' => $data['phone_number'],
               'subphone_number' => $data['subphone_number'],
               'dormitory' => $data['dormitory'],
               'username' => $data['mail']
            );
      $this->db->where('id', $id);
      $this->db->update('user', $data_arr);
      //var_dump(mysql_affected_rows());exit;
      return mysql_affected_rows(); 
  	}	
}
