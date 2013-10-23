<?php

class Manage_model extends CI_Model
{
	public function index()
	{
		parent::__construct();
	}
    
	//管理员登陆验证
	public function check($admin,$pwd)
	{
		$query = $this->db->get_where('admin',array('username' => $admin,'password' => md5($pwd)));
		return $query->row();
	}	

	//更改管理员密码
	public function update_pwd($pwd_old1,$pwd_old2,$pwd_new)
	{
		$id = $this->session->userdata('uid');
		if($pwd_old1 == $pwd_old2)
		{
			$query = $this->db->get_where('admin',array('id' => $id,'password' => md5($pwd_old1)));
			if($query->num_rows() == 1)
			{
				$this->db->update('admin',array('password' => md5($pwd_new)));
				return TRUE;
			}
		}
		else
		{
			return FALSE;
		}
	}
    
    public function global_info()
    {
    	$this->db->select('count(*) AS num');
    	$query = $this->db->get('user');
    	$user_num = $query->row();

    	$this->db->select('count(*) AS num');
    	$query = $this->db->get('allbook');
    	$book_num = $query->row();

    	$this->db->select('count(*) AS num');
    	$query = $this->db->get('circulating_book');
    	$cb_num = $query->row();

    	$this->db->select('count(*) AS num');
    	$this->db->where('to_id !=','');
    	$query = $this->db->get('circulating_book');
    	$finish_num = $query->row();

    	return array('user_num'=>$user_num->num,'book_num'=>$book_num->num,'cb_num'=>$cb_num->num,'finish_num'=>$finish_num->num);
    }

    public function book_info()
    {
    	$this->db->select('SUM(cb.circulate_number) AS num  ,ab.name')
    			->from('circulating_book AS cb')
    			->join('allbook AS ab', 'cb.book_id = ab.id')
    			->limit(10)
    			->group_by('ab.name')
    			->order_by('num', "desc");
		$query = $this->db->get();
		$result = $query->result_array();
		return $result;
    }
    public function booking_info($offset, $length)
    {
    	/*$this->db->select('ab.name , u.truename AS from_name, uu.truename AS to_name')
    			 ->from('circulating_book AS cb')
    			 ->join('allbook AS ab', 'ab.id = cb.book_id')
    			 ->join('user AS u' , 'u.id = cb.from_id')
    			 ->join('user AS uu' , 'uu.id = cb.to_id')
    			 ->limit($length,$offset)
    			 ->where('cb.book_status',1);*/
    	$sql = "SELECT SQL_CALC_FOUND_ROWS `ab`.`name`, `u`.`truename` AS from_name, `uu`.`truename` AS to_name
    			FROM (`circulating_book` AS cb)
    			LEFT JOIN `allbook` AS ab ON `ab`.`id` = `cb`.`book_id` 
    			LEFT JOIN `user` AS u ON `u`.`id` = `cb`.`from_id` 
    			LEFT JOIN `user` AS uu ON `uu`.`id` = `cb`.`to_id` 
    			WHERE `cb`.`book_status` = '1' LIMIT ?,?";

    	$query = $this->db->query($sql,array($offset , $length));
    	$result = $query->result_array();
    	$res_num = $this->db->query('SELECT FOUND_ROWS() AS total');//获取总数
    	$res_num = $res_num->row();
    	// var_dump($res_num);exit;
    	return array('data'=>$result,'total'=>$res_num->total);
    }
    public function user_distribution()
    {
    	$this->db->select('campus , count(*) AS num ')
    			 ->from('user')
    			 ->group_by('campus');
    	$query = $this->db->get();
    	$result = $query->result_array();
    	return $result;
    }
    public function major_info()
    {
    	$this->db->select('a.name AS faculty , b.name AS major, b.id , b.parent_id ')
    			->from('major AS a')
    			->join('major AS b', 'a.id=b.parent_id');
    	$query = $this->db->get();
    	$result = $query->result_array();
    	// var_dump($result);exit;
    	$faculty = array();
		$dat_arr = array();
		foreach ($result as $key => $value) //获取所有学院
		{
			array_push($faculty, $value['faculty']);
		}
		$faculty = array_unique($faculty);
		foreach ($faculty as $key => $value) 
		{
			array_push($dat_arr, array('faculty'=>$value,'major'=>array()));
		}
		foreach ($result as $key => $value) 
		{
			foreach($dat_arr as $k=>$v)
			{
				if($v['faculty']==$value['faculty'])
				{
					array_push($dat_arr[$k]['major'], array('name'=>$value['major'],'id'=>$value['id'],'parent_id'=>$value['parent_id']));
					break;
				 }
			}
		}
    	return $dat_arr;
    }
    public function update_major($id,$name)
    {	
    	$this->db->update('major',array('name'=>$name),array("id"=>$id));
    	return mysql_affected_rows();
    }
    public function major_book($major,$grade,$offset,$length)
    {
        /*$this->db->select('ab.name, ab.ISBN, ab.author, ab.publish , ab.version, ab.term')
                ->from('allbook AS ab')
                ->join('allbook_mg AS abmg' , 'ab.id=abmg.book_id')
                ->where('abmg.major',$major)
                ->where('abmg.grade',$grade)
                ->limit($length,$offset);
        $query = $this->db->get();*/
        $sql = " SELECT SQL_CALC_FOUND_ROWS `ab`.`name`, `ab`.`ISBN`, `ab`.`author`, `ab`.`publish`, `ab`.`version`, `ab`.`term` 
                FROM (`allbook` AS ab) 
                LEFT JOIN `allbook_mg` AS abmg ON `ab`.`id`=`abmg`.`book_id` 
                WHERE `abmg`.`major` = ? AND `abmg`.`grade` = ? LIMIT ?,?";
        $query = $this->db->query($sql,array($major,$grade,$offset,$length));
        $result = $query->result_array();
        $res_num = $this->db->query('SELECT FOUND_ROWS() AS total');//获取总数
        $res_num = $res_num->row();
        return array('data'=>$result,'total'=>$res_num->total);
    }
    public function update_book($info)
    {
        $arr = array(
                'name'=>$info['name'],
                'author'=>$info['author'],
                'publish'=>$info['publish'],
                'version'=>$info['version'],
                'term'=>$info['term']
            );
        $this->db->where('ISBN', $info['ISBN']);
        $this->db->update('allbook',$arr);
        return mysql_affected_rows();
    }
    public function check_majorBook()
    {
        $this->db->select('a.name AS faculty, b.name AS major,count(*) AS num')
                ->from('major AS a')
                ->join('major AS b', 'b.parent_id = a.id')
                ->join('allbook_mg AS abmg', 'abmg.major = b.id','left')
                ->group_by('b.name')
                ->having('num <',15)
                ->order_by('num');
        $query = $this->db->get();
        $result = $query->result_array();
        return $result;
    }
    public function div6_book($isbn_arr)
    {
        $this->db->select('ISBN, name , publish, author')
                ->from('allbook')
                ->where_in('ISBN',$isbn_arr);
        $query  = $this->db->get();
        $result = $query->result_array();
        return $result;
    }
    public function div12()
    {
        $this->db->select('truename AS username, name AS bookname, cb.change_time AS borrow_time, TIMESTAMPDIFF(day,cb.change_time,now()) AS day, cb.id AS cb_id, cb.to_id')
                  ->from('user')
                  ->join('circulating_book cb','cb.to_id = user.id')
                  ->join('allbook','allbook.id = cb.book_id')
                  ->where('cb.book_status','2');
        $query = $this->db->get();
        $result = $query->result_array();
        return $result;          
    }
    public function reset_book()
    {
        $data = $this->div12();
        foreach ($data as $key => $value) 
        {
            $arr = array(
               'from_id' => $value['to_id'],
               'to_id' => NULL,
               'book_status' => 0
            );
            $this->db->where('id', $value['cb_id']);
            $this->db->update('circulating_book', $arr);
            if(mysql_error()) 
            {
                return false;
            }
        }
        if(!mysql_error()) return true;
    }
}
/*---END OF manage_model 
location: models/manage_model--*/