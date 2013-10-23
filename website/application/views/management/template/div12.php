<div class='row-fluid' id='div12' style="display:none">
  <div class="page-header">
  <h1>书架计划任务</h1>
  </div>
  <div class="span10">
      <h3>1、重置书源人</h3>
    <p>说明：每本借入教材的有效期为半年（一个学期），期满后，持书者将自动成为该教材书源者。</p>
    <p><span class="label label-important">注意：</span>请谨慎操作，重置后不可恢复！</p>
    <span><button id="reset" type="button" class="btn btn-primary" data-loading-text="正在处理...">重置书源人</button></span>
    <?php if(!empty($data)):?>
    <h5>用户持书情况：</h5>
    <table class="table table-hover">
              <thead>
                <tr>
                  <th>#</th>
                  <th>姓名</th>
                  <th>书名</th>
                  <th>借入时间</th>
                  <th>持续时间</th>
                </tr>
              </thead>
              <tbody>
                  <?php foreach ($data as $key => $value) :?>  
                <tr>
                  <td><?php echo $key;?></td>
                  <td><?php echo $value['username'];?></td>
                  <td><?php echo $value['bookname'];?></td>
                  <td><?php echo $value['borrow_time'];?></td>
                  <td><?php echo ((int)$value['day'] - (int)$value['day']%30)/(30) .'月'.$value['day']%(int)30;?>天</td>
                </tr>
                <?php endforeach;?>
              </tbody>
        </table>
  </div>
</div>
<script type="text/javascript">
$("#reset").click(function() {
      $(this).button('loading');
      $.get("./home/div12_reset", {id: '12',op:'reset'}, function(data){
          alert(data);
           $("#reset").html('已完成');
           $("#reset").attr('disabled','');
            location.reload();
     });
});
</script>
<?php else :?>
 </div>
</div>
<script type="text/javascript">
$(document).ready(function(){
           $("#reset").html('已完成过重置任务！');
           $("#reset").attr('disabled','');
         });
</script>
<?php endif;?>