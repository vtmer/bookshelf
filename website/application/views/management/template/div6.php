<div class='row-fluid' id='div6' style="display:none">
  <div class="page-header">
  <h1>图书自检</h1>
  </div>
  <h4>书本数目少于15本的专业将会在这显示,请管理员检查各专业的书本的合理性。</h4>
  <div>
     <table class="table table-hover">
      <thead><th>#</th><th>学院</th><th>专业</th><th>书本数目</th></thead>
      <?php foreach($check_majorBook as $key=>$value):?>
      <tr><td><?php echo (int)$key+1;?></td><td><?php echo $value['faculty'];?></td><td><?php echo $value['major'];?></td><td><?php echo $value['num'];?></td></tr>
      <?php endforeach;?>
      </table>
  </div>
  <h4>书籍封面自检<button type="button" id="check_btn" class="btn" data-loading-text="正在检查" style="float:right">开始检查</button></h4>
  <div id="lost_table" style="display:none">
     <table class="table table-hover">
      <thead><th>#</th><th>书名</th><th>ISBN</th><th>出版社</th><th>作者</th></thead>
      </table>
      <span class="label label-important">提醒：</span><p>以上书本的封面无法显示，请管理员检查；若需要添加封面图片，请打包后联系网站管理者。</p>
  </div>
</div>
<script type="text/javascript">
$("#check_btn").click(function(){
  $("#check_btn").button('loading');
  $.get('./home/div6_check',{id:6},function(data){
    (typeof data !== 'object') ? jsonobj = JSON.parse(data) : jsonobj = data;
    var length = jsonobj.length;
    $("#total_book").html(length);
    for(var i =0;i<length;i++){
      $("#lost_table table").append("<tr><td>"+(i+1)+"</td><td>"+jsonobj[i].name+"</td><td>"+jsonobj[i].ISBN+"</td><td>"+jsonobj[i].publish+"</td><td>"+jsonobj[i].author+"</td></tr>");
    }
   $("#lost_table").slideDown();
   $("#check_btn").html('已完成');
   $("#check_btn").attr('disabled','');
  });
  return false;
});
</script>