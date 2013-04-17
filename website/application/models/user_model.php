<?php

class User_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	public function is($email,$password)
	{
		$query = $this->db->get_where('user',array('email' => $email,'password' => md5($password)));
		return ($query->num_rows == 1) ? TRUE : FALSE;
	}	


}

?>
