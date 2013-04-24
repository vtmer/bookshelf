<?php

class Guide extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$datas = array(
			'one' => '机电工程学院',
			'two' => '自动化学院',
			'three' => '轻工化工学院',
			'four' => '信息工程学院',
			'five' => '土木与交通学院',	
			'six' => '计算机学院',
			'seven' => '材料与能源学院',
			'eight' => '环境科学与工程学院',
			'nine' => '外国语学院',
			'ten' => '物理与光电工程学院');

		$this->load->view('guide',$datas);
	}
}

?>
