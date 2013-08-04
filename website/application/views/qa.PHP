<div class="main">	
	<div class="mid_content">
		<div class="content_box">
			<div class="box_demo qa">
				<h1>工大书架—Q&A</h1>
				<div class="qabox">
					<h5 class="qaq">Q：我想借书应该怎么做？<span>[查看]</span></h5>
					<div class="qaa">
						<p>情况一：我想借一个多学期的书<br/><strong>查看书源人的持有书 → 勾选你想借的书  → 实时电话预约 →   线下取书 → 确认借书成功</strong></p>
      					<p>情况二：我想某一本书<br/><strong>搜索您想借的书 → 查看 →实时电话预约 → 线下取书 → 确认借书成功 </strong></p> 
					</div>	  
				</div>
				<div class="qabox">
					<h5 class="qaq">Q：我想捐书应该怎么做？<span>[查看]</span></h5>
					<div class="qaa">
						<p>填写书本信息 → 提交</p>
					</div>
				</div>
				<div class="qabox">
					<h5 class="qaq">Q：积分规则是怎样计算？<span>[查看]</span></h5>
					<div class="qaa">
						<p><strong>扣分</strong><br/>
							借书：-10分/本<br/>
							书籍下架：-5分/本
						</p>
						<p><strong>加分</strong><br/>
							捐书：+5分/本<br/>
							成功被借：+5分/本<br/>
							站内信确认：+3分<br/>
							分享：+2分<br/>
							邀请：+2分
						</p>
						<p><strong>PS：初次登陆者将会获得30分积分。</strong></p>
					</div>
				</div>
				<div class="qabox">
					<h5 class="qaq">Q：线下取书成功一定要回到工大书架确认借书成功吗？<span>[查看]</span></h5>
					<div class="qaa">
						<p><strong>可以不用。</strong><br/>
							如果三天内确认借书成功，书源人以及借书者都能获得相应的加分+5分<br/>
							如果三天内没有确认借书成功，系统将默认为借书成功，但是书源人以及借书者都不会获得加分
						</p>
					</div>
				</div>
				<?php if($first_login==true):?>
				<div class="firstqa">
					<p>初次使用书架，请耐心阅读以上细则，能帮助您更快速了解书架</p>
					<p id='time'>15 秒</p>
					<script type="text/javascript">
					function count(sec)
					{
						$('#time').html(sec+" 秒");
						sec-=1;
						var id = setTimeout("count("+sec+")",1000);
						if(sec<0)
						{
							clearTimeout(id);
							$('#time').remove();
						}
					}
					$(document).ready(count(15));
					</script>
					<a href="<?php echo site_url('guide');?>" id='next'>下一步</a>
				</div>
			<?php endif;?>
			</div>
			<div class="bottom_shadow"></div>
		</div><!-- end of content_box 包裹整块质感效果的div -->
	</div>
</div><!--end of main--> 