<div class='row-fluid' id='div2' style="display:none">
 <div class="page-header">
 <h1>已录书目</h1>
</div>
  <div id='top_circulate'>
    <h4>流通书目排名前10：</h4>
    <table class="table table-hover">
    <thead><th>#</th><th>书名</th><th>流通次数</th><th></th></thead>
    <?php foreach($top_ten as $key=>$value) :?>
    <tr><td><span class="badge"><?php echo (int)$key+1;?></span></td><td><?php echo $value['name'];?></td><td><?php echo $value['num'];?></td><td></td></tr>
   <?php endforeach;?>
    </table>
  </div>
  <div id='booking'>
    <h4>正在预约的书：</h4>
    <table class="table table-hover">
    <thead><th>#</th><th>书名</th><th>预约人</th><th>捐书人</th></thead>
     <?php foreach($booking as $key=>$value) :?>
    <tr><td><span class="badge"><?php echo (int)$key+1;?></span></td><td><?php echo $value['name'];?></td><td><?php echo $value['to_name'];?></td><td><?php echo $value['from_name'];?></td></tr>
     <?php endforeach;?>
    </table>
    <?php echo $page;?><!--输出分页-->
  </div>
</div>
<?php if($page!=''):?>
 <script type="text/javascript">
$(".ajax_page").bind('click', function(){
var url = $(this).attr("href");
        $.get(url,{},function(data){
           if (typeof data !== 'object') {
              jsonobj = JSON.parse(data);
            } else {
                jsonobj = data;
            }
          update_table(jsonobj);
        });
window.event.returnValue = false;//支持IE
});
function update_table(dat){
  $("#booking table tr:gt(0)").remove();
  var length = dat.booking.length;
  var data = dat.booking;
  for(var i=0;i<length;i++){
    $("#booking table tbody").append("<tr><td><span class='badge'>"+(i+1)+"</span></td><td>"+data[i].name+"</td><td>"+data[i].to_name+"</td><td>"+data[i].from_name+"</td></tr>");
  }
  //替换分页
  var page = dat['page'];
  $(".pagination").replaceWith(page);
  //重新绑定事件
  $(".ajax_page").bind('click', function(){
  var url = $(this).attr("href");
          $.get(url,{},function(data){
            if (typeof data !== 'object') {
                jsonobj = JSON.parse(data);
            } else {
                jsonobj = data;
            }
            update_table(jsonobj);
          });
  window.event.returnValue = false;
  });
}
</script>
<?php endif;?>