<?php

class Manage_addbook extends CI_Controller
{
	public function index()
	{
		$this->load->view('management/manage_addbook');

	}

	public function add()
	{
		if($this->input->post('isbn1'))
		{
			$flag1 = TRUE;
			$isbn1 = $this->input->post('isbn1');
			$title1 = $this->input->post('title1');
			$author1 = $this->input->post('author1');
			$publish1 = $this->input->post('publish1');
			$version1 = $this->input->post('version1');
			$course_name1 = $this->input->post('course_name1');
			$course_category1 = $this->input->post('course_category1');
			$term1 = $this->input->post('term1');
			$print1 = $this->input->post('print1');
		}

		if($this->input->post('isbn2'))
		{
			$flag2= TRUE;
			$isbn2 = $this->input->post('isbn2');
			$title2 = $this->input->post('title2');
			$author2 = $this->input->post('author2');
			$publish2 = $this->input->post('publish2');
			$version2 = $this->input->post('version2');
			$course_name2 = $this->input->post('course_name2');
			$course_category2 = $this->input->post('course_category2');
			$term2 = $this->input->post('term2');
			$print2 = $this->input->post('print2');
		}

		if($this->input->post('isbn3'))
		{
			$flag3 = TRUE;
			$isbn3 = $this->input->post('isbn3');
			$title3 = $this->input->post('title3');
			$author3 = $this->input->post('author3');
			$publish3 = $this->input->post('publish3');
			$version3 = $this->input->post('version3');
			$course_name3 = $this->input->post('course_name3');
			$course_category3 = $this->input->post('course_category3');
			$term3 = $this->input->post('term3');
			$print3 = $this->input->post('print3');
		}

		if($this->input->post('isbn4'))
		{
			$flag4 = TRUE;
			$isbn4 = $this->input->post('isbn4');
			$title4 = $this->input->post('title4');
			$author4 = $this->input->post('author4');
			$publish4 = $this->input->post('publish4');
			$version4 = $this->input->post('version4');
			$course_name4 = $this->input->post('course_name4');
			$course_category4 = $this->input->post('course_category4');
			$term4 = $this->input->post('term4');
			$print4 = $this->input->post('print4');
		}

		if($this->input->post('isbn5'))
		{
			$flag5 = TRUE;
			$isbn5 = $this->input->post('isbn5');
			$title5 = $this->input->post('title5');
			$author5 = $this->input->post('author5');
			$publish5 = $this->input->post('publish5');
			$version5 = $this->input->post('version5');
			$course_name5 = $this->input->post('course_name5');
			$course_category5 = $this->input->post('course_category5');
			$term5 = $this->input->post('term5');
			$print5 = $this->input->post('print5');
		}

		if($this->input->post('isbn6'))
		{
			$flag6 = TRUE;
			$isbn6 = $this->input->post('isbn6');
			$title6 = $this->input->post('title6');
			$author6 = $this->input->post('author6');
			$publish6 = $this->input->post('publish6');
			$version6 = $this->input->post('version6');
			$course_name6 = $this->input->post('course_name6');
			$course_category6 = $this->input->post('course_category6');
			$term6 = $this->input->post('term6');
			$print6 = $this->input->post('print6');
		}

		if(isset($flag1))
		{
			$status = 1;
			$flag1 = $this->admin_model->add_book($isbn1,$title1,$author1,$publish1,$version1,$course_name1,$course_category1,$term1,$print1,$status);
		}	
		
		if(isset($flag2))
		{
			$status = 1;
			$flag2 = $this->admin_model->add_book($isbn2,$title2,$author2,$publish2,$version2,$course_name2,$course_category2,$term2,$print2,$status);
		}	
	
		if(isset($flag3))
		{
			$status = 1;
			$flag3 = $this->admin_model->add_book($isbn3,$title3,$author3,$publish3,$version3,$course_name3,$course_category3,$term3,$print3,$status);
		}	

		if(isset($flag4))
		{
			$status = 1;
			$flag4 = $this->admin_model->add_book($isbn4,$title4,$author4,$publish4,$version4,$course_name4,$course_category4,$term4,$print4,$status);
		}	

		if(isset($flag5))
		{
			$status = 1;
			$flag5 = $this->admin_model->add_book($isbn5,$title5,$author5,$publish5,$version5,$course_name5,$course_category5,$term5,$print5,$status);
		}	
		
		if(isset($flag6))
		{
			$status = 1;
			$flag6 = $this->admin_model->add_book($isbn6,$title6,$author6,$publish6,$version6,$course_name6,$course_category6,$term6,$print6,$status);
		}	

		if(((isset($flag1)&&$flag1 == TRUE)||(!isset($flag1))) && ((isset($flag2)&&$flag2 == TRUE)||(!isset($flag2))) && ((isset($flag3)&&$flag3 == TRUE)||(!isset($flag2))) && ((isset($flag4)&&$flag4 == TRUE)||(!isset($flag2))) && ((isset($flag5)&&$flag5 == TRUE)||(!isset($flag2))) && ((isset($flag6)&&$flag6 == TRUE)||(!isset($flag2))))
		{
			redirect('manage_addbook/success');
		}
		else
		{
			redirect('manage_addbook/error');
		}
	}

	public function error()
	{
		$this->load->view('management/manage_addbook',array('error' => TRUE));
	}

	public function success()
	{
		$this->load->view('management/manage_addbook',array('success' => TRUE));
	}
}

?>
