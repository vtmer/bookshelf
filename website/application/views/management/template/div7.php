<div class='row-fluid' id='div7' style="display:none">
  <div class="page-header">
  <h1>批量添加书籍</h1>
  </div>
  <div class="step">
    <h3>操作步骤：</h3>
    <h4>一、先把所有书籍添加到书架的书库</h4><p>1、先下载书架书库的模板，按照模板内容填好书籍信息。</p>
    <p>2、把填好的模板文件提交回网站。</p>
    <h4>二、分专业添加书籍</h4><p>1、选择要添加书籍的专业，下载模板，填写书籍信息。<span class="label label-warning">注意！</span>每个专业都含有一个ID，在模板中生成，请不要删除。</p>
    <p>2、把填好的模板文件提交回网站。</p>
    <p><span class="label label-important">注意！</span>请务必按照以上的步骤进行，否则会带来不必要的麻烦！id字段必须为null!</p>
  </div>
  <hr>
  <div id="download">
   <div class="span4">下载书架书库的模板：<a class="btn btn-primary" href="./home/download_tmpl?type=ab" >下载</a></div>
  <div id="select" class="span8">
  <ul class="nav nav-pills">
    <div style="float:left;margin-top:4px">学院：</div>
    <li> 
    <select  id="div7_faculty" style="margin-right: 10px;">
      <option value="0"></option> 
     <?php foreach($faculty as $key=>$value):?>
     <option value="<?php echo (int)$key+1;?>"><?php echo $value['name'];?></option>
     <?php endforeach;?> 
    </select>  
    </li>
    <div style="float:left;margin-top:4px">专业：</div> 
    <li>
     <select id="div7_major" style="margin-right: 10px;" disabled>
    </select>  
    </li>
    <div style="float:left;"><a class="btn btn-primary" id="ab_mg" disabled>下载</a></div> 
  </ul>
</div><!--End select-->
</div><!--End download-->
<div class="row-fluid">
  <h3>上传数据：</h3>
  <div class="span5">
    <span>书架书库模板:</span>
    <?php $attributes = array('class' => 'ajaxForm'); echo form_open_multipart('management/home/div7_upload' ,$attributes);?>
    <input type="file" name="file"/>
    <input type="submit" value="提交" />
        <input type="hidden" name="type" value="ab"/>
    </form>
  </div>
     <div class="span5">
      <span>专业模板:</span>
    <?php echo form_open_multipart('management/home/div7_upload',$attributes);?>
    <input type="file" name="file"/>
    <input type="submit" value="提交" />
    <input type="hidden" name="type" value="ab_mg"/>
    </form>
  </div>
  <div id="result" class="span10" style="display:none">
    <textarea style="width:800px;height:100px;"></textarea >
  </div>
</div>
</div>
 <script type="text/javascript">
  $("#div7_faculty").change(function(){
    $parent_id = $(this).val();
    if($parent_id > 0){
      $.get("./home/div5_major",{id:5,parent_id:$parent_id},function(data){
         (typeof data !== 'object') ? jsonobj = JSON.parse(data) : jsonobj = data;
          var length = jsonobj.length;
          $("#div7_major").html('');
          for(var i=0;i<length;i++){
            $("#div7_major").append("<option value="+jsonobj[i].id+">"+jsonobj[i].name+"</option>");
          }
          $("#div7_major").removeAttr("disabled");
          $("#ab_mg").removeAttr("disabled");
          $("#ab_mg").attr("href",'./home/download_tmpl?type=ab_mg&faculty='+$("#div7_faculty").val()+'&major='+$("#div7_major").val());
      });
    }
    else{
      $("#div7_major").attr("disabled",'');
       $("#ab_mg").attr("disabled",'');
       $("#ab_mg").removeAttr("href");
    }
  });
  $("#div7_major").change(function(){
    $("#ab_mg").attr("href",'./home/download_tmpl?type=ab_mg&faculty='+$("#div7_faculty").val()+'&major='+$("#div7_major").val());
  });
  </script>