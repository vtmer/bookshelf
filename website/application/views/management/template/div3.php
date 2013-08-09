<div class='row-fluid' id='div3' style="display:none">
  <div class="page-header">
  <h1>注册用户 <small>分布</small></h1>
  </div>
  <?php foreach($num as $key=>$value):?>
  <div id='bar'>
  <span style='float:left'><?php echo $value['campus']?>校区：</span>
   <div class="progress">
    <div class="bar" style="width: <?php echo $value['num']?>%;"><?php echo $value['num']?>人</div>
  </div>
  </div>
  <?php endforeach;?>
</div>