  <div class='row-fluid' id='div11' style="display:none">
  <div class="page-header">
  <h1>管理员账户</h1>
  </div>
   <form class="form-horizontal">
    <div class="control-group">
      <label class="control-label" for="old_pwd">旧密码</label>
      <div class="controls">
        <input type="password" id="old_pwd" placeholder="旧密码" name="old_pwd">
      </div>
    </div>
    <div class="control-group">
      <label class="control-label" for="new_old">新密码</label>
      <div class="controls">
        <input type="password" id="new_pwd" placeholder="新密码" name="new_old">
        <span class="help-inline" style="display:none">两次密码不一致</span>
      </div>
    </div>
      <div class="control-group">
      <label class="control-label" for="rep_pwd">重复密码</label>
      <div class="controls">
        <input type="password" id="rep_pwd" placeholder="重复密码" name="rep_pwd">
        <span class="help-inline" style="display:none">两次密码不一致</span>
      </div>
    </div>
    <div class="control-group">
      <div class="controls">
         <button type="submit" class="btn" id="chang_pwd">修改密码</button>
      </div>
    </div>
  </form>            
</div>
<script type="text/javascript">
var flag = false;
$("#rep_pwd").change(function() {
  if($("#new_pwd").val()!=$(this).val()){
    $("#new_pwd").parent().parent().addClass("error");
    $(this).parent().parent().addClass("error");
    $(".help-inline").fadeIn();
    flag = false;
  }else
  {
    $("#new_pwd").parent().parent().removeClass("error");
    $(this).parent().parent().removeClass("error");
    $(".help-inline").fadeOut();
    flag = true;
  }
});
$("#change_pwd").click(function() {
  $a = $(this);
  var old_pwd = $("#old_pwd").val();
  var new_pwd = $("#new_pwd").val();
  var rep_pwd = $("#rep_pwd").val();
  if(flag==true)
  $.post('./home/update_user',{old_pwd:old_pwd,new_pwd:new_pwd,rep_pwd:rep_pwd,id:11},function(data) {
    console.log(data);
      if(data=='true'){
        alert('修改成功！')
      }
      else if(data=='pwd_error'){
      alert('密码错误');
      $("#old_pwd").val('');
      $("#old_pwd").focus();
      }
      else{
        alert('修改失败，请重试！')
      }
  });
  return false;
});
</script>