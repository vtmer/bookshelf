<?php
if (!defined('BASEPATH')) exit('No direct script access allowed'); 
class catch_msg
{
/*
curl 多线程抓取
*/
 /** 
     * curl 多线程 
     *  
     * @param array $array 并行网址 
     * @param int $timeout 超时时间
     * @param string $curlPost post数据
     * @param string $sessionid 会话sessionid
     * @return array 
     */
    private $session_id = ''; 
    private function Curl_http($array,$timeout,$curlPost='',$sessionid='')
    {
     	$res = array();
     	$mh = curl_multi_init();//创建多个curl语柄
    	$startime = $this->getmicrotime();
     	foreach($array as $k=>$url)
        {
     		$conn[$k]=curl_init($url);
            curl_setopt($conn[$k], CURLOPT_TIMEOUT, $timeout);//设置超时时间
            curl_setopt($conn[$k], CURLOPT_USERAGENT, 'Mozilla/5.0 (compatible; MSIE 5.01; Windows NT 5.0)');
            curl_setopt($conn[$k], CURLOPT_MAXREDIRS, 7);//HTTp定向级别
            curl_setopt($conn[$k], CURLOPT_HEADER,1);
            if($sessionid!='')
            {
                curl_setopt($conn[$k],CURLOPT_COOKIESESSION,true);//发送会话id
                curl_setopt($conn[$k], CURLOPT_COOKIE,'ASP.NET_SessionId='.$sessionid);
            }
            curl_setopt($conn[$k], CURLOPT_FOLLOWLOCATION, 1); // 302 redirect
            if($curlPost!='')
            {
                curl_setopt($conn[$k], CURLOPT_POST, 1);//发送表单数据
                curl_setopt($conn[$k], CURLOPT_POSTFIELDS, $curlPost);
            }
            curl_setopt($conn[$k],CURLOPT_RETURNTRANSFER,1);// 返回结果，而不是输出它
            ob_start();  
            curl_multi_add_handle ($mh,$conn[$k]);
     	}
    	 //防止死循环耗死cpu 这段是根据网上的写法
		do {
			$mrc = curl_multi_exec($mh,$active);//当无数据，active=true
		} while ($mrc == CURLM_CALL_MULTI_PERFORM);//当正在接受数据时
		while ($active and $mrc == CURLM_OK) 
        {//当无数据时或请求暂停时，active=true
			if (curl_multi_select($mh) != -1) 
            {
				do {
					$mrc = curl_multi_exec($mh, $active);
				} while ($mrc == CURLM_CALL_MULTI_PERFORM);
			}
		}
     	foreach ($array as $k => $url) 
        {
 		  curl_error($conn[$k]);
    	  $res[$k]=curl_multi_getcontent($conn[$k]);//获得返回信息
    	  $header[$k]=curl_getinfo($conn[$k]);//返回头信息
    	  curl_close($conn[$k]);//关闭语柄
    	  curl_multi_remove_handle($mh  , $conn[$k]);   //释放资源  
		}
    		
		curl_multi_close($mh);
		$endtime = $this->getmicrotime();
		$diff_time = $endtime - $startime;
		
		return array('diff_time'=>$diff_time,
					 'return'=>$res,
					'header'=>$header		
					);
     	
    }
    //计算当前时间
    private function getmicrotime() 
    {
	    list($usec, $sec) = explode(" ",microtime());
	    return ((float)$usec + (float)$sec);
	}

    public function is_login($username,$pwd)//登录验证
    {
        $array = array(
                "http://eswis.gdut.edu.cn/"
                //"http://jwgl.gdut.edu.cn/(vppjnrnauy3acvni03k3whig)/default2.aspx",
                //"http://jwgldx.gdut.edu.cn/(vppjnrnauy3acvni03k3whig)/default2.aspx"
                );
        $data = $this->Curl_http($array,10);//调用
        $html = $data['return'][0];//第一次获取网页
        //抓取表单数据
        $location = strpos($html,'__EVENTVALIDATION');
        $sub1 = substr($html,$location);
        $location2 = strpos($sub1,'value="');
        $eventvalidation=substr($sub1,$location2+7,80);

        $location3 = strpos($html,'__VIEWSTATE');
        $sub3 = substr($html, $location3);
        $location4 = strpos($sub3, 'value="');
        $viewstate = substr($sub3,$location4+7,3856);

        $location4 = strpos($html,'__PREVIOUSPAGE');
        $sub4 = substr($html, $location4);
        $location5 = strpos($sub4, 'value="');
        $previouspage = substr($sub4,$location5+7,23);

        $location6 = strpos($html,'ASP.NET_SessionId=');
        $this->session_id = substr($html, $location6+18,24);
        unset($html);//释放资源
        $postdata = array(
                    'ctl00$log_username='.urlencode($username),
                    'ctl00$log_password='.urlencode($pwd),
                    '__EVENTVALIDATION='.urlencode($eventvalidation),
                    '__VIEWSTATE='.urlencode($viewstate),
                    '__EVENTTARGET='.'',
                    '__EVENTARGUMENT='.'',
                    '__PREVIOUSPAGE='.urlencode($previouspage),
                    'ctl00$logon='.urlencode('登录'),
                );
        $post_data = implode('&',$postdata);
        //以上是抓取表单数据
        $data2 = $this->Curl_http(array('http://eswis.gdut.edu.cn/default.aspx'),10,$post_data,$this->session_id);//验证登录
        $html2 = $data2['return'][0];

        $msg_pos = strpos($html2,'ctl00_msg_logon');//抓取错误信息
        $msg1 = substr($html2,$msg_pos+32, 50);
        $msg_pos = strpos($msg1,'</span>');
        $msg = substr($msg1, 0 ,$msg_pos);

        if($msg!='') 
        {
            return array('status'=>false,'msg'=>$msg);//返回错误信息
        }
        else
        {
            return array('status'=>true,'s_id'=>$this->session_id);
        } 
    }

    public function get_info()//获取信息
    {
        if($this->session_id=='') return '';
        //个人信息页面   
        $data3 = $this->Curl_http(array('http://eswis.gdut.edu.cn/default.aspx?fid=7'),10,'',$this->session_id);
        $html3 = $data3['return'][0];

        $location3 = strpos($html3,'信息汇总');//获取信息汇总链接
        $url3 = '/'.substr($html3, $location3-42,40);
        unset($html3);//释放资源

        $data4 = $this->Curl_http(array('http://eswis.gdut.edu.cn'.$url3),10,'',$this->session_id); //信息汇总页面
        $html4 = $data4['return'][0];

        $pos = strpos($html4,'<table id="ctl00_cph_right_table_userinf_stu" class=');//获取表格
        $str = substr($html4, $pos,3072);   
        unset($html4);//释放资源

        $unit_pos = strpos($str,'l00_cph_right_inf_dw');//获取校区，学院，专业，年级
        $unit1 = substr($str, $unit_pos+22,160);
        $unit_pos = strpos($unit1,'</span>');
        $unit = substr($unit1, 0 ,$unit_pos);
        $data = explode(' ',$unit);//数组

        $name_pos = strpos($str,'l00_cph_right_inf_xm');//获取姓名
        $name1 = substr($str, $name_pos+22,20);
        $name_pos = strpos($name1,'</span>');
        $name = substr($name1, 0 ,$name_pos);

        array_push($data, $name);//把姓名加入data数组
        return $data;   
    }
}

/*END OF catch_msg.php*/