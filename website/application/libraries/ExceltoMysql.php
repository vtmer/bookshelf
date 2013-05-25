<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); 
/**
 *从Excel批量导入数据到MySql
 *注意Excel必须先转换为CSV格式，首行为字段名且与数据库中的顺序一致
 * @access public
 * @param $table,$file
 * @author chile
 * @return 成功导入的行数$n
 */
class ExceltoMysql
{
	protected $table = 'allbook';		//表名
	protected $file;					//文件目录
	protected $field;					//字段名
	protected $fieldNum;				//字段数目
	public function __construct()
	{
		switch(func_num_args())
		{
			case 1:$this->ExceltoMysql2(func_get_arg(0));break;
			default:$this->ExceltoMysql();break;
		}
	}
	protected function ExceltoMysql() 
	{
		
	}
	protected function ExceltoMysql2($file)
	{
		$this->file = $file;
		$this->get_field();
	}
	public function setFilePath($file)//设置文件目录
	{
		$this->file = $file;
		$this->get_field();
	}
	protected function get_field()
	{
		if($this->table == '') exit("Please set tablename!");
		$query = mysql_query("SHOW COLUMNS FROM $this->table");
		$this->fieldNum = mysql_num_rows($query);
		while($fieldArray = mysql_fetch_assoc($query))
		{
			$this->field[] = $fieldArray['Field'];
		}
	}
	public function InsertToMysql()
	{
		mysql_query("SET NAMES gbk");
	    $handle = fopen($this->file,'r') or exit("Unable to open $this->file file!");
	    //字段匹配验证
	    $firstRow = fgetcsv($handle);//读取第一行
	    if(count($firstRow)!=($this->fieldNum+2))
	    {
	    	exit("Unmatch fields' number!");
		}
		if(count($diff = array_diff($firstRow,$this->field))) 
		{
			$error = "";
	    	foreach ($diff as $key => $value) 
	    	{
	    		if($value=='major'||$value=='grade')
	    		{}
	    		else
	    		{
	    			$error .= " '$value' ";
	    		}	
	    	}
	    	if($error!="")
	    	{
	    		exit('Please check field:'.$error."in the file $this->file!");
	    	}
		}
		//END
		$sql = "INSERT INTO $this->table VALUES (";	
		$n = 2;
		$string =  "SELECT auto_increment as id FROM information_schema.`TABLES` WHERE TABLE_NAME='$this->table'";
		(int)$lastRowID = mysql_fetch_assoc(mysql_query($string));//获取自增的allbook.id的下一个值
		(int)$i = 0;
	    while($charArray = fgetcsv($handle))//这里是第二行开始读取了
	    {
	    	$sql2 = "";
	    	foreach ($charArray as $key => $value) 
	    	{
	    		if($key<11)
	    		{
		    		if($key<10)
		    		{
		    			$sql2 .= "trim(both from '".$value."'),";
		    		}
		    		else
		    		{
		    			$sql2 .= "trim(both from '".$value."'));";
		    		}
	    		}
	    		elseif($key==11)
	    		{
	    			
	    			mysql_query("INSERT INTO `allbook_mg` VALUES(null,trim(both from '".$charArray[11]."'),trim(both from '".$charArray[12]."'),'".(int)($lastRowID['id']+$i)."')") 
	    			or exit(mysql_error());
	    		}	
	    	}
	    	$sql3 = $sql.$sql2;
	    	mysql_query($sql3) or exit("已成功导入".(int)($n-2)."行，错误发生在".$n."行；<br/>错误信息：".mysql_error());
	    	$n++;
	    	$i++;
	    }
	    return $n-2;   	
	}
}

/* End of file ExceltoMysql.php */
