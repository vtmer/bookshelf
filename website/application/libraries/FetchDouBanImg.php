<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); 
class FetchDouBanImg
{
	private function get_data($url ,$timeout)
	{
		$conn = curl_init($url);//创建个curl语柄
		curl_setopt($conn, CURLOPT_TIMEOUT, $timeout);//设置超时时间
		curl_setopt($conn,CURLOPT_RETURNTRANSFER,1);// 返回结果，而不是输出它
		$res = curl_exec($conn);//获得返回信息
	    if($res === false)
	    {
		    return 'Error:'.curl_error($conn);
	    }
	    // $header = curl_getinfo($conn);//返回头信息
		curl_close($conn);//关闭语柄
		return $res;
	}

    public function get_img($ISBN)
    {
    	 // $ISBN = array('9787115263544','9787040215502','9787122080950','9787562330660','9787040144735','9787122104021');
    	$url = 'http://api.douban.com/v2/book/isbn/';
    	$img = array();
    	$n = count($ISBN);
    	for($i=0;$i<$n;$i++)
		{
	    	$address = $url.$ISBN[$i];
	    	$data = $this->get_data($address , 3);
	    	array_push($img , json_decode($data)->image);
	    	usleep(300000);//300ms (sleep microseconds>>1s==1&10^6us)
    	}
		
		foreach ($img as $key => $value) 
		{
			$file = './downloads/'.$ISBN[$key].'.jpg';
			$data =  $this->get_data($value , 3);
			usleep(300000);
			$f = fopen($file, 'w+');
			fputs($f, $data);
			fclose($f);
		}
		return 'success';
    }
}
/*END OF FetchDouBanImg Location:library/FetchDouBanImg.php*/