<?php 
var_dump($system_match);
foreach ($system_match['user'] as  $value)
	{   
		//var_dump($value);
			echo $value['id'].'---';
			echo $value['truename'].'---';
			echo $value['dormitory'].'---';
	
		foreach ($system_match['book'] as $key ) {
			if($value['id']==$key['from_id']	)
			echo $key['name'].'|||';
		}
	}
	?>