var check_func = {
    email : function(value){
        var $notice = $("input#mail + span");
        if(!value){
            $notice.addClass("notice alert").text("请填写您的邮箱");
            return false;
        }
        var mailReg = /^([a-zA-Z0-9]+[_|\-|\.]?)*[a-zA-Z0-9]+@([a-zA-Z0-9]+[_|\-|\.]?)*[a-zA-Z0-9]+(\.[a-zA-Z]{2,3})+$/;
        if(!mailReg.test(value)){
            $notice.addClass("notice alert").text("邮箱格式错误");
            return false;
        } else {
            $notice.removeClass("notice alert").text(" ");
            return true;
        };
    },
    fb_title : function(value) {
        var $notice = $("input#fb_title + span");
        if (!value) {
            $notice.addClass("notice alert").text("请输入您的标题");
            return false;
        } else{
            $notice.removeClass("notice alert").text(" ");
            return true;
        };
    },
    fb_content : function(value) {
        var $notice = $("textarea#fb_content + span");
        if (!value) {
            $notice.addClass("notice alert").text("请输入文本内容");
            return false;
        } else{
            $notice.removeClass("notice alert").text(" ");
            return true;
        };
    },
}
$(function(){

    $("input#mail").bind("blur", function(){
        check_func.email(this.value);
        });
    $("input#fb_title").bind("blur", function(){
        check_func.fb_title(this.value);
        });
    $("textarea#fb_content").bind("blur",function(){
        check_func.fb_content(this.value);
        });


    $("input[type=submit]").bind("mouseover focus click", function(){
        var check_control = true;
        check_control = check_func.email($("input#mail")[0].value);
        check_control = check_func.fb_title($("input#fb_title")[0].value);
        check_control = check_func.fb_content($("textarea#fb_content")[0].value);
        if(!check_control){
            $("#submit").addClass("unabled");
            return false;//阻止提交。
        }
        $("#submit").removeClass("unabled");
        $(".ajaxForm").bind('submit', function(){//回调函数

            $(".mainlist").html("<div style='text-align:center'><span id='popContent'>正在提交，请稍后。</span></div>");
            $("#pop_title").html('提交反馈');
            var h = $(document).height();
            $('#screen').css({ 'height': h });  
            $('#screen').show();
            $('.popbox').center();
            $('.popbox').fadeIn();

            ajaxSubmit(this, function(data){  
                        if(data==true)
                        {
                            $(".mainlist").html("<div style='text-align:center'><span id='popContent'>提交成功，感谢您的支持！</span></div>");
                            setTimeout("$('.popbox').fadeOut(function(){$('#screen').hide();}); ",1000);
                            setTimeout("window.location='http://"+document.domain+"'",1500);
                        }
                        else
                        {
                            $(".mainlist").html("<div style='text-align:center'><span id='popContent'>提交失败，请重试！</span></div>");
                            setTimeout("$('.popbox').fadeOut(function(){$('#screen').hide();}); ",1000);
                        } 
                 });
            return false;
        });
        //关闭按钮
        $('.close-btn,.ok-btn ').click(function(){
            $('.popbox').fadeOut(function(){ $('#screen').hide(); 
            // window.top.location.reload();
        });
            return false;
        });    
    });
});

