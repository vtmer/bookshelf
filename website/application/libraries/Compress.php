<?php
/**
 * 压缩html : 清除换行符,清除制表符,去掉注释标记，不支持<pre>和<textarea>标签,里面的格式会被压缩
 * @param   $string
 * @return  压缩后的$string 
 * */
  class compress{  
  public  function compress_html($string) 
    {  
        $string = str_replace("\r\n", '', $string); //清除换行符  
        $string = str_replace("\n", '', $string); //清除换行符  
        $string = str_replace("\t", '', $string); //清除制表符  
        $pattern = array (  
                        "/> *([^ ]*) *</",  
                        "/[\s]+/",  
                        "/<!--[^!]*-->/",  //去掉注释标记 
                        "/\" /",  
                        "/ \"/",  
                        "'/\*[^*]*\*/'" 
                        );  
        $replace = array (  
                        ">\\1<",  
                        " ",  
                        "",  
                        "\"",  
                        "\"",  
                        "" 
                        );  
        return preg_replace($pattern, $replace, $string);  
    } 
}