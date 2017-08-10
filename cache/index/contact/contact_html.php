<!DOCTYPE HTML>
<html>
<head>
<title>Contact</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<link href="public/css/bootstrap.css" rel='stylesheet' type='text/css' />

<!--Custom-Theme-files-->
	<link href="public/css/style.css" rel='stylesheet' type='text/css' />	
	<script src="public/js/jquery.min.js"> </script>
<!--/script-->
<script type="text/javascript" src="public/js/move-top.js"></script>
<script type="text/javascript" src="public/js/easing.js"></script>
<script type="text/javascript">
			jQuery(document).ready(function($) {
				$(".scroll").click(function(event){		
					event.preventDefault();
					$('html,body').animate({scrollTop:$(this.hash).offset().top},900);
				});
			});
</script>
 <script type="text/javascript" src="http://api.map.baidu.com/api?v=2.0&ak=e7Eyec5kSihtstCNajlR56IY1D5t8EQy"></script>
</head>
<body>
	<!-- header-section-starts -->
      <div class="h-top" id="home">
		   <div class="top-header">
				  <ul class="cl-effect-16 top-nag">
						<?php if(empty($_SESSION['username'])):?>
				  		<li><a href="http://localhost/blog/" data-hover="首页">首页</a></li>
				  		<li><a href="http://localhost/blog/index.php?c=user&a=login" data-hover="登录">登录</a></li>
						<li><a href="http://localhost/blog/index.php?c=user&a=registration" data-hover="注册">注册</a></li>
						<li><a href="http://localhost/blog/index.php?c=gallery&a=gallery" data-hover="画廊">画廊</a></li>
						<li><a href="http://localhost/blog/index.php?c=contact&a=contact" data-hover="联系我们">联系我们</a></li>
					<?php else: ?>
						<li><a href="http://localhost/blog/" data-hover="登录">首页</a></li>
						<?php if(1==$_SESSION['usertype']):?>
							<li><a href="http://localhost/blog/index.php?m=admin" data-hover="个人中心">个人中心</a></li>
						<?php endif;?>
						<li><a href="http://localhost/blog/index.php?c=contact&a=contact" data-hover="联系我们">联系我们</a></li>
						<li><a href="http://localhost/blog/index.php?c=gallery&a=gallery" data-hover="画廊">画廊</a></li>
						<li><a href="http://localhost/blog/index.php?c=article&a=newblog" data-hover="发博文">发博文</a></li>
						<li><a href="http://localhost/blog/index.php?c=user&a=exit" data-hover="退出">退出</a></li>
					<?php endif;?>
					</ul>
					<div class="search-box">
					   
						</div>

					<div class="clearfix"></div>
				</div>
       </div>
	<div class="full">
			<div class="col-md-3 top-nav contact">
				     <div class="logo">
						<a href="http://localhost/blog"><h1>博客</h1></a>
					</div>
				<div class="top-menu">
					 <span class="menu"> </span>
						<ul class="cl-effect-16">
						<?php if(empty($_SESSION['username'])):?>
				  		<li><a href="http://localhost/blog/" data-hover="首页">首页</a></li>
				  		<li><a href="http://localhost/blog/index.php?c=user&a=login" data-hover="登录">登录</a></li>
						<li><a href="http://localhost/blog/index.php?c=user&a=registration" data-hover="注册">注册</a></li>
						<li><a href="http://localhost/blog/index.php?c=gallery&a=gallery" data-hover="画廊">画廊</a></li>
						<li><a href="http://localhost/blog/index.php?c=contact&a=contact" data-hover="联系我们">联系我们</a></li>
					<?php else: ?>
						<li><a href="http://localhost/blog/" data-hover="登录">首页</a></li>
						<?php if(1==$_SESSION['usertype']):?>
							<li><a href="http://localhost/blog/index.php?m=admin" data-hover="个人中心">个人中心</a></li>
						<?php endif;?>
						<li><a href="http://localhost/blog/index.php?c=contact&a=contact" data-hover="联系我们">联系我们</a></li>
						<li><a href="http://localhost/blog/index.php?c=gallery&a=gallery" data-hover="画廊">画廊</a></li>
						<li><a href="http://localhost/blog/index.php?c=article&a=newblog" data-hover="发博文">发博文</a></li>
						<li><a href="http://localhost/blog/index.php?c=user&a=exit" data-hover="退出">退出</a></li>
					<?php endif;?>
					</ul>
					<!-- script-for-nav -->
					<script>
						$( "span.menu" ).click(function() {
						  $( ".top-menu ul" ).slideToggle(300, function() {
							// Animation complete.
						  });
						});
					</script>
				<!-- script-for-nav --> 	
					<ul class="side-icons">
							<li><a class="fb" href="#"></a></li>
							<li><a class="twitt" href="#"></a></li>
							<li><a class="goog" href="#"></a></li>
							<li><a class="drib" href="#"></a></li>
					   </ul>
			    </div>
			</div>
<!-- contact -->
	<div class="col-md-9 main">
	 <div class="contact">
	   <h3 class="tittle">联系我们 <i class="glyphicon glyphicon-map-marker"></i></h3>
		<div class="contact-left">
			<!-- 百度地图 -->
			<div id="allmap" style="width: 470px;height: 330px;overflow: hidden;margin:0;font-family:"微软雅黑";float: right;"></div>

		</div>
		<div class="contact-right">
			<p class="phn">+9100 2481 5842</p>
			<p class="phn-bottom">格拉斯哥
					<span>罗马大道4578号</span></p>
			<p class="lom">以上是我们的地址，如果距离您比较近的话，欢迎您直接前来我们办公区域咨询。您也可以用邮件联系我们：jusazmxcf@sian.com.cn.</p>
		</div>
		<div class="clearfix"> </div>
		<div class="contact-left1">
			<h3>联系我们 <span>无论任何问题</span></h3>
			<div class="in-left">
				<form action="http://localhost/blog/index.php?c=contact&a=server" method="post">
					<p class="your-para">您的姓名 :</p>
							<input type="text" value="" onfocus="this.value='';" onblur="if (this.value == '') {this.value ='';}" name='name'>
							<p class="your-para">您的 Email :</p>
							<input type="text" value="" onfocus="this.value='';" onblur="if (this.value == '') {this.value ='';}" name='email'>
							<p class="your-para">手机号码:</p>
							<input type="text" value="" onfocus="this.value='';" onblur="if (this.value == '') {this.value ='';}" name='phone'>

				
			</div>
			<div class="in-right">
				
					<textarea cols="77" rows="6" onfocus="this.value='';" onblur="if (this.value == '') {this.value = '';}" name='content'></textarea>
					<input type="submit" value="提交">
				</form>
			</div>
			<div class="clearfix"> </div>
		</div>
		<div class="contact-right1">
			<h3><span>官方网站</span></h3>
			<h4>www.isheorshesilly.com<label>www.isheorshesilly.cn</label></h4>
			<p>您可以在我们的官方网站浏览更多信息或者在留言板向我们提出您的意见.</p>
			     <ul class=" side-icons con">
							<li><a class="fb" href="#"></a></li>
							<li><a class="twitt" href="#"></a></li>
							<li><a class="goog" href="#"></a></li>
							<li><a class="drib" href="#"></a></li>
					   </ul>
		</div>
		<div class="clearfix"> </div>
<!-- //contact -->
			</div>
			<div class="clearfix"> </div>
	<!--/footer-->
	     <div class="footer">
				 <div class="footer-top">
				    <div class="col-md-4 footer-grid">
					     <h4>Lorem sadipscing </h4>
				          <ul class="bottom">
							 <li>Consetetur sadipscing elitr</li>
							 <li>Magna aliquyam eratsed diam</li>
						 </ul>
				    </div>
					  <div class="col-md-4 footer-grid">
					     <h4>Message Us Now</h4>
				            <ul class="bottom">
						     <li><i class="glyphicon glyphicon-home"></i>Available 24/7 </li>
							 <li><i class="glyphicon glyphicon-envelope"></i><a href="mailto:info@example.com">mail@example.com</a></li>
						   </ul>
				    </div>
					<div class="col-md-4 footer-grid">
					     <h4>Address Location</h4>
				           <ul class="bottom">
						     <li><i class="glyphicon glyphicon-map-marker"></i>2901 Glassgow Road, WA 98122-1090 </li>
							 <li><i class="glyphicon glyphicon-earphone"></i>phone: (888) 123-456-7899 </li>
						   </ul>
				    </div>
					<div class="clearfix"> </div>
				 </div>
	     </div>
		<div class="copy">
		    <p>Copyright &copy; 2016.Company name All rights reserved.<a target="_blank" href="http://sc.chinaz.com/moban/">&#x7F51;&#x9875;&#x6A21;&#x677F;</a></p>
		</div>
	 <div class="clearfix"> </div>
	</div>
	<div class="clearfix"> </div>
</div>	
		<!--//footer-->
			<!--start-smooth-scrolling-->
						<script type="text/javascript">
									$(document).ready(function() {
										/*
										var defaults = {
								  			containerID: 'toTop', // fading element id
											containerHoverID: 'toTopHover', // fading element hover id
											scrollSpeed: 1200,
											easingType: 'linear' 
								 		};
										*/
										
										$().UItoTop({ easingType: 'easeOutQuart' });
										
									});
								</script>
		<a href="#home" id="toTop" class="scroll" style="display: block;"> <span id="toTopHover" style="opacity: 1;"> </span></a>


</body>
</html>
<script type="text/javascript">
   // 百度地图API功能
   var map = new BMap.Map("allmap");    // 创建Map实例
   map.centerAndZoom(new BMap.Point(116.376, 40.043), 15);  // 初始化地图,设置中心点坐标和地图级别
   map.addControl(new BMap.MapTypeControl());   //添加地图类型控件
  map.setCurrentCity("北京");          // 设置地图显示的城市 此项是必须设置的
   map.enableScrollWheelZoom(true);     //开启鼠标滚轮缩放
</script>