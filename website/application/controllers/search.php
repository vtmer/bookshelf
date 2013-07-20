<?php 
class Search extends CI_Controller
{
	public  function __construct()
	{
		parent::__construct();
		$this->load->model('search_model');
		$this->config->load('pager_config',TRUE);
	}

	public function index()
	{
		if(!$page = $this->input->get('page'))
		{
			$page = 1;
		}
	    $per_page = 10;//每页显示的条数
	    $offset = ($page - 1)*$per_page;
		if($keywords = $this->input->get('keywords'))
		{
			$data = $this->search_model->get_book_by_keywords($keywords , $offset, $per_page);
			//分页		
			$pager_config = $this->config->item('pager_config');
			$pager_config['page_query_string'] = TRUE;
			$pager_config['query_string_segment'] = 'page';
			$pager_config['base_url'] = site_url('search?keywords='.$keywords);
			$pager_config['total_rows'] = $data['num'];//获取总数
			$pager_config['per_page'] = $per_page; //设置每页显示的条数
			$this->pagination->initialize($pager_config); 
			//END
			$header = array('title'=>'搜索书籍','css_file'=>'search.css');
	    	$footer = array('js_file'=>'search.js');
			$this->parser->parse('template/header',$header);	
			$this->load->view('search',$data);
			$this->parser->parse('template/footer',$footer);
		}
		else
		{
			redirect('home');
		}	
	}
	public function ajaxPage()
	{
		if(!$page = $this->input->get('page'))
		{
			$page = 1;			
		}
		$per_page = 10;//每页显示的条数
	    $offset = ($page - 1)*$per_page;
	    $keywords = $this->input->get('keywords');
	    $data = $this->search_model->get_book_by_keywords($keywords,$offset, $per_page);
		//分页		
		$pager_config = $this->config->item('pager_config');
		$pager_config['page_query_string'] = TRUE;
		$pager_config['query_string_segment'] = 'page';
		$pager_config['base_url'] = site_url('search?keywords='.$keywords);
		$pager_config['total_rows'] = $data['num'];//获取总数
		$pager_config['per_page'] = $per_page; //设置每页显示的条数
		$this->pagination->initialize($pager_config); 
		$data['page'] = $this->pagination->create_links();
		//var_dump($data);exit();
		echo json_encode($data);
		exit();
	}
		
}