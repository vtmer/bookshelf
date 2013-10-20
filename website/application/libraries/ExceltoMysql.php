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
	protected $table;
	protected $file;
	protected $field;
	protected $fieldNum;
	protected $CI;
	public function __construct()
	{
		switch(func_num_args())
		{
			case 2:$this->ExceltoMysql2(func_get_arg(0),func_get_arg(1));break;
			default:$this->ExceltoMysql();break;
		}
		$this->CI =& get_instance();
	}
	protected function ExceltoMysql() 
	{
		
	}
	protected function ExceltoMysql2($table,$file)
	{
		$this->table = $table;
		$this->file = $file;
		$this->get_field();
	}
	public function set($table,$file)
	{
		$this->table = $table;
		$this->file = $file;
		$this->get_field();
	}
	protected function get_field()
	{
		if($this->table == '') exit("请设置表名!");
		$query = $this->CI->db->query("SHOW COLUMNS FROM $this->table");
		$this->fieldNum = $query->num_rows();
		$result = $query->result_array();
		$this->fieldNum = count($result);
		foreach ($result as $key => $value) 
		{
			$this->field[] = $value['Field'];
		}
	}
	protected function get_bookid($ISBN)
	{
		$sql = "SELECT `id` from `allbook` where `ISBN` = trim(both from '$ISBN')";
		$query = $this->CI->db->query($sql);
		return $query->result_array();
	}
	public function InsertToMysql()
	{
		$this->CI->db->query("SET NAMES gbk");
	    $handle = fopen($this->file,'r') or exit("不能打开文件 $this->file !");
	    //验证字段数目
	    $firstRow = fgetcsv($handle);
	    if(count($firstRow)!=$this->fieldNum)
	    {
	    	exit("数据表字段不匹配，请检查数据文件的首行!");
		}
		if(count($diff = array_diff($firstRow,$this->field))) 
		{
			$error = "";
	    	foreach ($diff as $key => $value) 
	    	{
	    		$error .= " '$value' ";
	    	}
	    	exit('请检查文件首行字段:'.$error." 文件： $this->file!");
		}
		//END
		// mysql_query("BEGIN");//开启事务处理，如果可以的话
		$sql = "INSERT INTO $this->table VALUES (";	
		$n = 2;
	    while($charArray = fgetcsv($handle))//这里是第二行读取了    
	    {
	    	if($this->table=='allbook_mg')	//如果是'allbook_mg'表则进行字段转换
    		{
    			$result = $this->get_bookid($charArray[3]);
    			if($result)
    			{
    				$charArray[3] = $result[0]['id'];
    			}
    			else
    			{
    				// mysql_query("ROLLBACK");//数据回滚
    				echo ("错误发生在第".$n."行,《".$charArray[3]."》课本不存在！系统默认跳过该记录,请检查后重新导入！<br/>");
    				continue;//跳该记录
    			} 				
    		}
	    	$sql2 = "";
	    	foreach ($charArray as $key => $value)
	    	{
	    		if($key!=$this->fieldNum-1)
	    		{
	    			$sql2 .= "trim(both from '".$value."'),";
	    		}
	    		else
	    		{
	    			$sql2 .= "trim(both from '".$value."'));";
	    		}
	    	}
	    	$sql3 = $sql.$sql2;
	    	mysql_query($sql3);
	    	if(mysql_error())
	    	{
	    		// mysql_query("ROLLBACK");//数据回滚
				exit("已成功导入".(int)($n-2)."行,错误发生在".$n."行，该行之后的数据不会被导入。<br/>错误信息：".mysql_error());
			}
	    	$n++;
	    }
	    // mysql_query("COMMIT");//提交确认
	    return $n-2;   	
	}
}

/* End of file ExceltoMysql.php */