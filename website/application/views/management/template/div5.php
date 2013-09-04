<div class='row-fluid' id='div5' style="display:none">
  <div class="page-header">
  <h1>书籍管理 <small>增、删、改</small></h1>
  </div>
  <div id="select">
  <ul class="nav nav-pills">
    <div style="float:left;margin-top:4px">学院：</div>
    <li> 
    <select name="faculty" id="faculty" style="margin-right: 10px;">
      <option value="0"></option> 
     <?php foreach($faculty as $key=>$value):?>
     <option value="<?php echo (int)$key+1;?>"><?php echo $value['name'];?></option>
     <?php endforeach;?> 
    </select>  
    </li>
    <div style="float:left;margin-top:4px">专业：</div> 
    <li>
     <select name="major" id="major" style="margin-right: 10px;" disabled>
    </select>  
    </li>
    <div style="float:left;margin-top:4px">年级：</div> 
    <li>
      <select name="grade" id="grade" style="margin-right: 10px;" disabled>  
     <option value="1">大一</option> 
     <option value="2">大二</option>
     <option value="3">大三</option>
     <option value="4">大四</option>
    </select>  
    </li>
    <div style="float:left;"><a class="btn" href="#" id="ok">确定</a></div> 
  </ul>
  <script type="text/javascript">
  $("#faculty").change(function(){
    $parent_id = $(this).val();
    if($parent_id > 0){
      $.get("./home/div5_major",{id:5,parent_id:$parent_id},function(data){
         (typeof data !== 'object') ? jsonobj = JSON.parse(data) : jsonobj = data;
          var length = jsonobj.length;
          $("#major").html('');
          for(var i=0;i<length;i++)
          {
            $("#major").append("<option value="+jsonobj[i].id+">"+jsonobj[i].name+"</option>");
          }
          $("#major").removeAttr("disabled");
          $("#grade").removeAttr("disabled");
      });
    }
    else{
      $("#major").attr("disabled",'');
      $("#grade").attr("disabled",'');
    }
  });
  $('#ok').click(function(){
    var major = $('#major').val();
    var grade = $('#grade').val();
    $.get("./home/div5_book",{id:5,major:major,grade:grade},function(data)
      {
        $("#books").html(data);
        $("#books").slideDown();
      });
  });
  </script>
</div><!--End select-->
<div id="books" style="display:none">
<!-- 书本表格 -->
</div>
 <!-- Modal -->
<div id="edit_modal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="myModalLabel">编辑书本</h3>
  </div>
  <div class="modal-body">
  <form class="form-horizontal">
    <div class="control-group">
      <label class="control-label" for="bookName">书名</label>
      <div class="controls"><input id="book_name" type="text"  name="name"></div>
    </div>
    <div class="control-group">
      <label class="control-label" for="ISBN">ISBN</label>
    <div class="controls"><input id="ISBN" type="text"  name="ISBN" disabled></div>
    </div>
    <div class="control-group">
      <label class="control-label" for="author">作者</label>
   <div class="controls"><input id="author" type="text"  name="author"></div>
     </div>
    <div class="control-group">
      <label class="control-label" for="publish">出版社</label>
    <div class="controls"><input id="publish" type="text"  name="publish"></div>
    </div>
    <div class="control-group">
      <label class="control-label" for="version">版次</label>
    <div class="controls"><input id="version" type="text"  name="version"></div>
    </div>
    <div class="control-group">
      <label class="control-label" for="term">学期</label>
     <div class="controls"><select id="term" name="term">
      <option value="1">1</option>
      <option value="2">2</option>
     </select>
      </div>
    </div>
  </form>
  </div>
  <div class="modal-footer">
    <button class="btn" data-dismiss="modal" aria-hidden="true">关闭</button>
    <button id="submit" class="btn btn-primary">保存</button>
  </div>
<script type="text/javascript">
$("#submit").click(function(){
  $book_name = $("#book_name").val();
  $ISBN = $("#ISBN").val();
  $author = $("#author").val();
  $publish = $("#publish").val();
  $version = $("#version").val();
  $term = $("#term").val();
  $.post('./home/div5_update',{ISBN:$ISBN,name:$book_name,author:$author,publish:$publish,version:$version,term:$term},function(data){
  (data=='true') ? alert('更新成功！'): alert('更新失败！');
  $('#edit_modal').modal('hide')
  });
});
</script>
</div><!--End Modal -->
