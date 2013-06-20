$(".main .search_bar input").bind("click",function(){if(this.value=="请输入要查找的书目")this.value=""}).bind("blur",function(){if(!this.value)this.value="请输入要查找的书目"});
function show()
{
	if($("#div_pwd").height()<175) $("#div_pwd").height($("#div_pwd").height()+10); 
	else clearTimeout($timer);
}
$("#config_pwd").click(function(){
if($("#div_pwd").height()<175)
$timer = setInterval('show()',1);
});
function close()
{
	if($("#div_pwd").height()>0) $("#div_pwd").height($("#div_pwd").height()-10); 
	else clearTimeout($timer2);
}
$("#cancle_pwd").click(function(){
if($("#div_pwd").height()>0)
$timer2 = setInterval('close()',1);
$("#password").val("");
$("#password_once").val("");
$("#pwd_old").val("");
});