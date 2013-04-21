<?php

class Registera extends CI_Controller
{
	public function index()
	{
	//	$this->load->model('user_model');

	$username = "1liehui92@gmail.com";
/*	$password = "12qwaszx";
	$truename = "wangsayue";
	$student_id = "3111006048";
	$faculty = "computer";
	$major = "science";
	$grade = "11";
	$phone_num = "13802414171";
	$subphone_num = "684171";	
	$dormitory = "westa";
	$activationkey = "adadd12qwaszx122";
	$status = "1";
	$points = "30";

	if($this->user_model->add($username,$password,$truename,$student_id,$faculty,$major,$grade,$phone_num,$subphone_num,$dormitory,$activationkey,$status,$points))
	{
		echo "insert successfully!";
	}*/
	if($result = $this->user_model->get_id($username))
	{
		echo $result->id;
	}
	else
	{
		echo "failed!";
	}
	}
}

?>
