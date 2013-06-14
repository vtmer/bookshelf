<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); 

Class DownloadImages
{
	
    function grabImage($url, $filename = '') 
    {
    	if($url == '') 
    	{
    	    return false; //如果 $url 为空则返回 false;
    	}
    	echo $url."</br>";
    	$ext_name = strrchr($url, '.'); //获取图片的扩展名
    	$fullname = strrchr($url, '/');
    	echo $fullname."</br>";
    	if($ext_name != '.gif' && $ext_name != '.jpg' && $ext_name != '.bmp' && $ext_name != '.png') 
    	{
        	return false; //格式不在允许的范围
    	}
    	if($filename == '') 
    	{
    	    $filename = time().$ext_name; //以时间戳另起名
    	}
    	echo $filename;
    	//开始捕获
    	$filename.=$fullname;
    	ob_start();
    	readfile($url);
    	$img_data = ob_get_contents();
    	ob_end_clean();
    	$size = strlen($img_data);
    	$local_file = fopen($filename , 'a');
    	fwrite($local_file, $img_data);
    	fclose($local_file);
   	 	return $filename;
	}

}

/* End of file DownloadImage.php */