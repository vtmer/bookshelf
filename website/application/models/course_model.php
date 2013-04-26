<?php

class Course_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}
	
	public function addbook($isbn,$title,$author,$publish,$version,$course_name,$course_type,$major,$grade,$term,$print)
	{
		$this->db->insert('allbook',array(
				'ISBN' => $isbn,
				'name' => $title,
				'author' => $author,
				'publish' => $publish,
				'version' => $version,
				'course_name' => $course_name,
				'course_category' => $course_type,
				'major' => $major,
				'grade' => $grade,
				'term' => $term,
				'print' => $print
			));	
		return TRUE;
	}

}

?>
