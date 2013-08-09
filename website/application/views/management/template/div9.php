<div class='row-fluid' id='div9' style="display:none">
  <div class="page-header">
  <h1>学院&专业管理</h1>
  </div>
  <div class="tabbable tabs-left"> <!-- Only required for left/right tabs -->
    <ul class="nav nav-tabs">
      <?php foreach($major as $key=>$value): ?>
      <?php if($key==0):?>
      <li class="active"><a href="#tab<?php echo $key;?>" data-toggle="tab"><?php echo $value['faculty'];?></a></li>
       <?php else:?>
        <li ><a href="#tab<?php echo $key;?>" data-toggle="tab"><?php echo $value['faculty'];?></a></li>
        <?php endif;?>  
       <?php endforeach;?>
    </ul>
    <div class="tab-content">
      <?php foreach($major as $key=>$value): ?>
      <?php if($key==0):?>
      <div class="tab-pane active" id="tab<?php echo $key;?>">
      <?php else:?>
        <div class="tab-pane" id="tab<?php echo $key;?>">  
        <?php endif;?>  
        <?php foreach($value['major'] as $k=>$v):?>
          <input class="input-xlarge" id="<?php echo $v['id'];?>" type="text" placeholder="<?php echo $v['name'];?>" name='major' disabled value="<?php echo $v['name'];?>">
          <a class="btn" id="edit" data-toggle="popover" data-placement="top" data-content="更新成功！" title="" data-original-title="" data-trigger="manual" href="#" style="margin: 0px 20px 10px 10px;">编辑</a>
          <?php endforeach;?>
      </div>
        <?php endforeach;?>
    </div>
  </div>
  <script type="text/javascript">
  $(".btn").bind("click",function(){      
    if($(this).html()=='编辑'){
      $a = $(this);
      $(".btn").html("编辑");
      $(".input-xlarge").attr("disabled",'');
      $a.prev(".input-xlarge").removeAttr("disabled");
      $a.prev(".input-xlarge").focus();

        $a.prev(".input-xlarge").keyup(function(){
          $a.html("更新");      
        });
      }
      if($a.html()=='更新'){
        $id = $a.prev(".input-xlarge").attr("id");
        $name = $a.prev(".input-xlarge").attr("value");
        $.post("./home/div9_update",{id:$id,name:$name},function(data){
              if(data=='true'){
                $a.popover('show');
                setTimeout("$a.popover('hide');",800);
              }else{
                $a.attr("data-content",'更新失败');
                $a.popover('show');
                setTimeout("$a.popover('hide');",800);
              }
        });
      }
       return false;
    });
  </script>
</div>