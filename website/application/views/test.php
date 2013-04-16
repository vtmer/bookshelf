<?php foreach ($book_need as  $value)
	{   
		
			# code...
		
		var_dump($value);
		echo 
		"<tr><td>" . $value['name'] . "</td>".
		"<td>" . $value['course_name'] . "</td>".
		"<td>" . $value['author'] ."</td>".
		"<td>" . $value['course_category']. "</td>".
		"<td>" . $value['publish'] . "</td>".
		"<td>" . $value['version'] . "</td></tr>";	
		
	}
	?>