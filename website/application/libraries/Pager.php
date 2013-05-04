<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); 

/**
 *针对查询结果（result_array()）的分页类
 * @access public
 * @param $offset,$length,$data
 * @author chile
 * @return array
 */

class Pager
{
	protected $offset;//初始索引
	protected $length;//长度
	protected $current_page = 1;
	protected $pagenum;

	public function set($offset = 0 , $length = 5)
	{
		$this->offset = $offset;
		$this->length = $length;
	}

	public function get_pagenum(array $data)
	{
		return $this->pagenum = ceil(count($data)/$this->length);
	}
	public function get_currentpage()
	{
		return $this->current_page;
	}
	public function get_nextpage()
	{
		if($this->current_page < $this->pagenum)
		{
			return $this->current_page+1;
		}
		else if($this->pagenum==0)
		{
			return 1;
		}
		else 
		{
			return $this->pagenum;
		}
	}
	public function get_prevpage()
	{
		if($this->current_page > 1)
		{
			return $this->current_page-1;
		}
		else
		{
			return 1;
		}
	}
	public function get_pagedata(array $data,$page = 1)
	{
		if((int)$page)
		{
			$this->offset = ($page-1)*$this->length;
			$this->current_page = $page;
			return array_slice($data,$this->offset,$this->length);
		}
		else show_404();		
	}
}
/* End of file Pager.php */