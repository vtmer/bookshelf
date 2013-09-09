<?php
 class Home extends CI_Controller
 {
 	public function __construct()
	{
		parent::__construct();
	}
	public function index()
	{
		$this->load->view('management/home.html',array("username"=>$this->session->userdata('username')));
	}
	public function ajax_base()
	{
		if(!$this->input->get()) show_404();
		$id = $this->input->get('id');
		switch($id)
		{
			case '1' :$this->_div1();break;//概况
			case '2' :$this->_div2();break;//已录书目
			case '3' :$this->_div3();break;//注册用户
			case '5' :$this->_div5();break;//增、删、改（书籍）
			case '6' :$this->_div6();break;//图书自检
			case '7' :$this->_div7();break;//批量增加书籍
			case '9' :$this->_div9();break;//学院&专业管理
			case '11': $this->_div11();break;//管理员账户
		}
	}
	private function _page_config()
	{
		// $config['base_url'] = site_url('management/home/div2_ajaxPage');
		// $config['total_rows'] = $result['total'];
		// $config['per_page'] = 5; 
		//以上按实际情况配置
		$config['use_page_numbers'] = TRUE;
		//自定义起始链接,显示第一页或最后一页
		$config['first_link'] = FALSE;
		$config['last_link'] = FALSE;
		//封装标签
		$config['full_tag_open'] = '<div class="pagination" style="float:right"><ul>';
		$config['full_tag_close'] = '</ul></div>';
		//自定义“下一页”链接
		$config['next_link'] = 'Next';
		$config['next_tag_open'] = '<li>';
		$config['next_tag_close'] = '</li>';
		//自定义“上一页”链接
		$config['prev_link'] = 'Prev';
		$config['prev_tag_open'] = '<li>';
		$config['prev_tag_close'] = '</li>';
		//自定义“当前页”链接
		$config['cur_tag_open'] = '<li class="active"><a href="#">';
		$config['cur_tag_close'] = '</a></li>';
		//自定义“数字”链接
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		$config['anchor_class'] = 'class="ajax_page"';
		return $config;
	}

	private function _div1()
	{
		$data = $this->manage_model->global_info();
		echo $this->load->view('management/template/div1',$data,true);
		return;
	}
	private function _div2()
	{
		$per_page = 5;//设置每页显示的条数
		$data['top_ten'] = $this->manage_model->book_info();
		$result = $this->manage_model->booking_info(0,$per_page);
		$data['booking'] = $result['data'];
		
		$config = $this->_page_config();
		$config['base_url'] = site_url('management/home/div2_ajaxPage?id=2');
		$config['total_rows'] = $result['total'];
		$config['per_page'] = $per_page;
		$config['page_query_string'] = TRUE;
		 $config['query_string_segment'] ='page'; 

		$this->pagination->initialize($config); 

		$data['page'] = $this->pagination->create_links();
		echo $this->load->view('management/template/div2',$data,true);
		return;

	}
	public function div2_ajaxPage()
	{
		if($this->input->get('id')!='2') show_404();
		if($this->input->get('page')!='')
		$page = $this->input->get('page');
		else
			$page = 1;
		$per_page = 5;
		$offset = ($page-1)*$per_page;
		
		$result = $this->manage_model->booking_info($offset,$per_page);
		$data['booking'] = $result['data'];
		
		$config = $this->_page_config();
		$config['base_url'] = site_url('management/home/div2_ajaxPage?id=2');
		$config['total_rows'] = $result['total'];
		$config['per_page'] = $per_page;
		$config['page_query_string'] = TRUE;
		$config['query_string_segment'] ='page';  

		$this->pagination->initialize($config); 

		$data['page'] = $this->pagination->create_links();
		echo json_encode($data);
		return;
	}
	private function _div3()
	{
		$data['num'] = $this->manage_model->user_distribution();
		echo $this->load->view('management/template/div3',$data,true);
		return;
	}

	private function _div5()
	{
		$this->db->select('name,id')->from('major')->where('parent_id','');
		$query = $this->db->get();
		$data['faculty'] = $query->result_array();
		echo $this->load->view('management/template/div5',$data,true);
	}
	public function div5_major()
	{
		if($this->input->get('id')!=5||!$this->input->get('parent_id')) show_404();
		$parent_id = $this->input->get('parent_id');
		$this->db->select('name,id')->from('major')->where('parent_id',$parent_id);
		$query = $this->db->get();
		$result = $query->result_array();
		echo json_encode($result);
	}
	public function div5_book()
	{
		if($this->input->get('id')!=5||!$this->input->get('major')||!$this->input->get('grade')) show_404();
		if(!$this->input->get('page'))
			$page = 1;
		else
			$page = $this->input->get('page');
		$per_page = 5;
		$offset = ($page-1)*$per_page;
		$major = $this->input->get('major');
		$grade = $this->input->get('grade');
		switch($grade)
		{
			case 1: $grade = '大一';break;
			case 2: $grade = '大二';break;
			case 3: $grade = '大三';break;
			case 4: $grade = '大四';break;
		}
		$result = $this->manage_model->major_book($major,$grade,$offset,$per_page);
		$data['book'] = $result['data'];

		$config = $this->_page_config();
		$config['base_url'] = site_url("management/home/div5_book?id=5&major=$major&grade=$grade");
		$config['total_rows'] = $result['total'];
		$config['per_page'] = $per_page;
		$config['page_query_string'] = TRUE;
		$config['query_string_segment'] ='page';  

		$this->pagination->initialize($config); 

		$data['page'] = $this->pagination->create_links();
		echo $this->load->view("management/template/div5_table",$data,true);
		return;
	}
	public function div5_update()
	{
		if(!$this->input->post()) show_404();
		$flag = $this->manage_model->update_book($this->input->post());
		if($flag > 0)  
			echo 'true';
		else 
			echo 'false';
		return; 
	}
	public function div5_del()
	{
		if(!$this->input->post()) show_404();
		$ISBN = $this->input->post('ISBN');
		$this->db->delete('allbook', array('ISBN' => $ISBN)); 
		if(mysql_affected_rows()>0)
			echo 'true';
		else
			echo 'false';
		return ;
	}
	private function _div6()
	{
		$data['check_majorBook'] = $this->manage_model->check_majorBook();
		echo $this->load->view('management/template/div6',$data,true);
	}
	public function div6_check()
	{
		if($this->input->get('id')!=6) show_404();
		$this->load->helper('file');
		$this->db->select('ISBN,id')->from('allbook');
		$query = $this->db->get();
		$result = $query->result_array();
		$isbn_arr = array();
		foreach ($result as $key => $value) {
			$string = file_exists('./images/'.$value['ISBN'].'.jpg');
			if($string==false)
			{
				if($value['ISBN']!='')
				array_push($isbn_arr, $value['ISBN']);
			}
		}
		$data = $this->manage_model->div6_book($isbn_arr);
		echo json_encode($data);
		if($this->input->get('act')=='saveIMG')
		{
			$this->load->library('FetchDouBanImg');
		    echo $this->fetchdoubanimg->get_img($isbn_arr);
		}
		return;
	}

	private function _div7()
	{
		$this->db->select('name,id')->from('major')->where('parent_id','');
		$query = $this->db->get();
		$data['faculty'] = $query->result_array();
		$this->load->helper('form');
		$this->load->view('management/template/div7',$data);
	}
	public function download_tmpl()
	{
		if($this->input->get('type')=='ab')
		$str = "id,ISBN,name,author,publish,version,course_name,course_category,term,print,status\nnull,xxx,xxx,xxx,xxx,xxx,xxx,xxx,xxx,xxx,1";
		else if($this->input->get('type')=='ab_mg')
		{
			$faculty = $this->input->get('faculty');
			$major = $this->input->get('major');
			$str = "id,grade,major,book_id\nnull,grade,$major,please input isbn";
		}
		else show_404();
		Header("Content-type: application/octet-stream");
		Header("Accept-Ranges: bytes");
		Header("Accept-Length: ".strlen($str));
		Header("Content-Disposition: attachment; filename=template.csv");
		echo $str;
	}
	public function div7_upload()
	{
		if(!isset($_FILES['file'])) show_404();
		$file = $_FILES['file'];
 		if($file['type']!='text/csv')
		{
			echo "illagel type!";
			exit;
		}
		if($file['size']>1024*1024)
		{
			echo "too large file";
			exit;
		}
		$this->load->library('ExceltoMysql');
		$table = '';
		if($this->input->post('type')=='ab') $table = 'allbook';
		else if($this->input->post('type')=='ab_mg') $table = 'allbook_mg';
		$this->exceltomysql->set($table,$file['tmp_name']);
		echo '已添加'.$this->exceltomysql->InsertToMysql().'行数据<br/>';

	}

	private function _div9()
	{
		$data['major'] = $this->manage_model->major_info();
		echo $this->load->view('management/template/div9',$data,true);
		return;
	}
	public function div9_update()
	{
		if(!$this->input->post()) show_404();
		$id = $this->input->post('id');
		$name = $this->input->post('name');
		$flag = $this->manage_model->update_major($id, $name);
		if($flag > 0) 
			echo 'true' ;
		else
			 echo 'false';
		return;
	}
	private function _div11()
	{
		echo $this->load->view('management/template/div11',true);
	}
	public function update_user()
	{
		if($this->input->post('id')!=11) show_404();
		$old_pwd = $this->input->post('old_pwd');
		$new_pwd = $this->input->post('new_pwd');
		$rep_pwd = $this->input->post('rep_pwd');
		if($new_pwd!=$rep_pwd)
		{
			echo 'error';
			return ;
		}
		$uid = $this->session->userdata('uid');
		$this->db->where('id',$uid);
		$this->db->where('password',md5($old_pwd));
		$this->db->update('admin',array('password'=>md5($new_pwd)));
		if(mysql_affected_rows()>0)
		echo 'true';
		else
		echo 'pwd_error';
		return ;
	}
}