<div class="main">
	
<?php include "template/search_bar.php"; ?>

	<div class="mid_content">
		<h3>书籍信息</h3>
		<div class="content_box">
			<div class="box_demo search_results">
				<div class="book_img">
				<?php $book_url = base_url('images')."/".$book_info[0]->ISBN.".jpg";?>
				<img src="<?php echo $book_url;?>" id="image" onerror="this.onerror=null; this.src='/img/loading.gif'"/>
				</div>
				<dl>
					<input type="hidden" id="isbncode" value="<?php echo $book_info[0]->ISBN; ?>" />
					<dt>《<?php if(strlen($book_info[0]->name) > 50) {echo substr($book_info[0]->name,0,40)."...";} else{echo $book_info[0]->name;}?>》</dt>
					<dd>作者：<span><?php echo $book_info[0]->author;?></span></dd>
					<dd>出版社：<span><?php echo $book_info[0]->publish;?></span></dd>
					<dd>版次：<span><?php echo $book_info[0]->version;?></span></dd>
					<dd>发放对象：<span><?php echo $book_info[0]->course_category;?></span></dd>
					<dd class="button">
						<!-- <a href="#">我要捐</a> -->
						<form action="<?php echo site_url('add_book/add');?>" method='post' class='ajaxForm'>
							<input type='hidden' value="<?php echo $book_info[0]->id;?>" name='book_id'/>
						<input type='submit' value='我要捐'/>
						</form>
						<div>
						<script type="text/javascript" charset="utf-8">
						(function(){
						  var _w = 90 , _h = 24;
						  var param = {
						    url:location.href,
						    type:'2',
						    count:'1', /**是否显示分享数，1显示(可选)*/
						    appkey:'1693113172', /**您申请的应用appkey,显示分享来源(可选)*/
						    title:'我在工大书架找到一本教材《<?php if(strlen($book_info[0]->name) > 50) {echo substr($book_info[0]->name,0,40)."...";} else{echo $book_info[0]->name;}?>》，妈妈再也不用担心我借不到教材了。', /**分享的文字内容(可选，默认为所在页面的title)*/
						    pic:'<?php echo base_url("images/" . $book_info[0]->ISBN . ".jpg");?>', /**分享图片的路径(可选)*/
						    ralateUid:'', /**关联用户的UID，分享微博会@该用户(可选)*/
						    language:'zh_cn', /**设置语言，zh_cn|zh_tw(可选)*/
						    dpc:1
						  }
						  var temp = [];
						  for( var p in param ){
						    temp.push(p + '=' + encodeURIComponent( param[p] || '' ) )
						  }
						  document.write('<iframe allowTransparency="true" frameborder="0" scrolling="no" src="http://service.weibo.com/staticjs/weiboshare.html?' + temp.join('&') + '" width="'+ _w+'" height="'+_h+'"></iframe>')
						  })();
						</script>
						</div>	
					</dd>
				</dl>

				<table>
					<tbody>
						<tr>
							<th>姓名</th>
							<th>专业</th>
							<th>生活区</th>
							<th>操作</th>
						</tr>
						<?php 
						if(empty($data['user']))
						{
							echo "
							<tr>
							<th colspan='4'>暂时没找到哦！</th>
							</tr>";
						}
						$n = 0;
						foreach ($data['user'] as $value) 
						{
							echo
							"<tr>
							<td><a href='".site_url('book_owner').'/'.$value['id']."'>".substr($value['truename'],0,3)."同学</a></td>
							<td>".$value['major']."</td>
							<td>".$value['dormitory']."</td>
							<td>
							<form action='".site_url('home/check_step')."' method='post'>
							<input type='hidden' name='user' value='".$value['id']."' />
							<input type='hidden' name='book' value='".$book_info[0]->id."' />
							<input type='submit' value='借 阅' /></form>
							</td>
						</tr>";
						}?>
					</tbody>
				</table>
<!-- 				<ul class="get_book">
					// <?php foreach ($data['user'] as $value)
					// { 
						// echo "<form action='".site_url('home/check_step')."' method='post'>";
						// echo "<input type='hidden' name='user' value='".$value['id']."''>";
						// echo "<input type='hidden' name='book' value='".$book_info[0]->id."''>";
						// echo '<li><input type="submit" value="借 阅" /></li>';
						// echo '</form>';
					// }?>
				</ul> -->
				<?php echo $this->pagination->create_links();?><!-- 输出分页模块 -->
			</div>
			<div class="bottom_shadow"></div><!-- 块级区域下方的底层阴影 -->
		</div><!-- 包裹整块质感效果的div -->
	</div>
</div><!--end of main-->
