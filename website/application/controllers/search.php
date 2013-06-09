<?php 
class Search extends CI_Controller
{
	public  function __construct()
	{
		parent::__construct();
		$this->load->model('search_model');
		$this->load->library('parser');
		$this->load->library('Pager');
	}

	public function index()
	{
		if(!$page = $this->input->get('page'))
			{
				$page = 1;
			}
		$this->load->helper('form');

		$header = array('title'=>'搜索书籍','css_file'=>'search.css');
	    $footer = array('js_file'=>'search.js');

		if($keywords = $this->input->get('keywords'))
		{
			$data['books'] = $this->search_model->get_book_by_keywords($keywords);
			//分页		
			$this->pager->set(0,5);//设置每页显示的条数	
			$data['page']['num'] = $this->pager->get_pagenum($data['books']);//获取总页数
			$data['books'] = $this->pager->get_pagedata($data['books'],$page);//当前页数据
			$data['page']['currentpage'] = $this->pager->get_currentpage();
			$data['page']['nextpage'] = $this->pager->get_nextpage();
			$data['page']['prevpage'] = $this->pager->get_prevpage();
			//END
			$this->parser->parse('template/header',$header);	
			$this->load->view('search',$data);
			$this->parser->parse('template/footer',$footer);
		}
		else
		{
			redirect('home');
		}	
	}
		
}