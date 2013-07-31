//还需要将ul、li的样式分离出去
//
var nowid;
var totalid;
var can1press = false;
var emailafter;
var emailbefor;
$(document).ready(function(){
  //文本框获得焦点，插入Email提示层
  $("#mail").focus(function(){
    $("#myemail").remove();
    $(this).after("<ul id='myemail' style='width:"+$(this).width()+"px; height:auto; position:absolute; left:"+$(this).get(0).offsetLeft+"px; top:"+($(this).get(0).offsetTop+$(this).height()+2)+"px;z-index:100; '></ul>");
    if($("#myemail").html()){
      $("#myemail").css("display","block");
      $(".newemail").css("width",$("#myemail").width());
       can1press = true;
    }else{
      $("#myemail").css("display","none");
      can1press = false;
    }  
  }).keyup(function(){
  //文本框输入文字时，显示Email提示层和常用Email
    var press = $("#mail").val();
    if (press!="" || press!=null){
        var emailtxt = "";   
        var emailvar = new Array("@163.com","@126.com","@yahoo.com","@qq.com","@sina.com","@gmail.com","@hotmail.com","@foxmail.com");
        totalid = emailvar.length;
        var emailmy = "<li class='newemail'><span>" + press + "</span></li>";
        if(!(isEmail(press))){
            for(var i=0; i<emailvar.length; i++) {
            emailtxt = emailtxt + "<li class='newemail'><span>" + press + "</span>" + emailvar[i] + "</li>"
          }
        } else {
            emailbefor = press.split("@")[0];
            emailafter = "@" + press.split("@")[1];
            for(var i=0; i<emailvar.length; i++) {
                var theemail = emailvar[i];
                if(theemail.indexOf(emailafter) == 0) {
                  emailtxt = emailtxt + "<li class='newemail'><span>" + emailbefor + "</span>" + emailvar[i] + "</li>"
                }
            }
        }
      $("#myemail").html(emailmy+emailtxt);
      if($("#myemail").html()){
        $("#myemail").css("display","block");
        $(".newemail").css("width",$("#myemail").width());
        can1press = true;
      } else {
        $("#myemail").css("display","none");
        can1press = false;
      }
      beforepress = press;
    }
    if (press=="" || press==null){
        $("#myemail").html("");  
        $("#myemail").css("display","none");    
    }    
  })
//文本框失焦时删除层
  $(document).click(function(){ 
    if(can1press){
      $("#myemail").remove();
      can1press = false; 
      if($("#mail").focus()){
        can1press = false;
      }
    }
  })
  //鼠标经过提示Email时，高亮该条Email
  $(".newemail").live("mouseover",function(){ 
    $(".newemail").css("background","#FFF");
    $(this).css("background","#CACACA");  
    $(this).focus();
    nowid = $(this).index();
  }).live("click",function(){ 
    //鼠标点击Email时，文本框内容替换成该条Email，并删除提示层
    var newhtml = $(this).html();
    newhtml = newhtml.replace(/<.*?>/g,"");
    $("#mail").val(newhtml); 
    $("#myemail").remove();
  })
  //键盘选择
  $(document).bind("keyup",function(e){     
    if(can1press){
      switch(e.which) {            
        //up键
        case 38:
        if (nowid > 0){  
          $(".newemail").css("background","#FFF");
          $(".newemail").eq(nowid).prev().css("background","#CACACA").focus();
          nowid = nowid-1;  
        }
        if(!nowid){
          nowid = 0;
          $(".newemail").css("background","#FFF");
          $(".newemail").eq(nowid).css("background","#CACACA");  
          $(".newemail").eq(nowid).focus();    
        }
        break;       
        //down键
        case 40:
        if (nowid < totalid){    
          $(".newemail").css("background","#FFF");
          $(".newemail").eq(nowid).next().css("background","#CACACA").focus(); 
          nowid = nowid+1;   
        }
        if(!nowid){
          nowid = 0;
          $(".newemail").css("background","#FFF");
          $(".newemail").eq(nowid).css("background","#CACACA");  
          $(".newemail").eq(nowid).focus();    
        }
        break;  
        //enter
        case 13 :
        var newhtml = $(".newemail").eq(nowid).html();
        newhtml = newhtml.replace(/<.*?>/g,"");
        $("#mail").val(newhtml); 
        $("#myemail").remove();
        break;
      }
    }   
  })
}) 
//检查输入是否含@
function isEmail(str){
  if(str.indexOf("@") > 0) {     
    return true;
  } else {
    return false;
  }
}