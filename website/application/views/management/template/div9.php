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
          <input class="input-xlarge" id="<?php echo $v['id'];?>" type="text" placeholder="<?php echo $v['name'];?>" name='major' disabled value="">
          <a class="btn" id="edit" href="#" style="margin: 0px 20px 10px 10px;">编辑</a>
          <?php endforeach;?>
      </div>
        <?php endforeach;?>
    </div>
  </div>
  <script type="text/javascript">
  $(".btn").click(function(){
      $(this).prev(".input-xlarge").removeAttr("disabled");
      $(this).prev(".input-xlarge").attr("value",$(this).prev().attr("placeholder"));
      $(this).prev(".input-xlarge").focus();
      $(this).prev(".input-xlarge").change(function(){
        $(this).text("更新");
      });
       return false;
    });
  </script>
</div>