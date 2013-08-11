<table class="table table-hover">
      <thead><th>#</th><th>书名</th><th>ISBN</th><th>作者</th><th>出版社</th><th>版次</th><th>学期</th><th>操作</th></thead>
      <?php foreach($book as $key=>$value):?>
      <tr><td><?php echo (int)$key+1;?></td><td><?php echo $value['name'];?></td><td><?php echo $value['ISBN'];?></td><td><?php echo $value['author'];?></td><td><?php echo $value['publish'];?></td><td><?php echo $value['version'];?></td><td><?php echo $value['term'];?></td><td>
        <div class="btn-group">
              <a class="btn dropdown-toggle" data-toggle="dropdown" href="#">操作<span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li class="edit_book"><a href="#">编辑</a></li>
                <li class="del_book"><a href="#">删除</a></li>
              </ul>
        </div></td></tr>
      <?php endforeach;?>
</table>
<script type="text/javascript">
$td = $(".edit_book").parent().parent().parent().parent().children();
$(".edit_book").click(function(){
  $("#book_name").attr('value',$td.eq(1).html());
  $("#ISBN").attr('value',$td.eq(2).html());
  $("#author").attr('value',$td.eq(3).html());
  $("#publish").attr('value',$td.eq(4).html());
  $("#version").attr('value',$td.eq(5).html());
  $("#term").attr('value',$td.eq(6).html());
  $("#edit_modal").modal('show');
});
$(".del_book").click(function(){
    $ISBN = $td.eq(2).html();
    $flag = window.confirm("你真的要删除这本书吗？");
    if($flag == true){
      $.post('./home/div5_del',{ISBN:$ISBN},function(data){
        if(data=='true'){
            alert('删除成功');
            $("#del_book").parent().parent().parent().parent().slideUp();
        }else 
          alert('删除失败！请重试！');
      });
    }
  });
</script>
<!-- 输出分页 -->
<?php echo $page;?>
<?php if($page!=''):?>
<script type="text/javascript">
$(".ajax_page").bind('click', function(){
  var url = $(this).attr("href");
    $.get(url,{},function(data){
      $("#books").html(data);
    });
    return false;
  });
</script>
<?php endif;?>