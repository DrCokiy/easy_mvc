<!DOCTYPE HTML>
<html>
<head>
<title>Login</title>
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
			<div class="col-md-3 top-nav login">
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
	<div class="col-md-9 main">
	<!-- login-page -->
	<div class="login">
		<div class="login-grids">
			<div class="col-md-6 log">
					 <h3 class="tittle">登录 <i class="glyphicon glyphicon-lock"></i></h3>
					 <p>Welcome, 请填写下面信息.</p>
					 <p>如果你还没有账号，请点击右边注册</a></p>
					 <form action="http://localhost/blog/index.php?c=user&a=dologin" method="post">
						 <h5>用户名:</h5>	
						 <input type="text" name='username'>
						 <h5>密码:</h5>
						 <input type="password" name="password">					
						 <input type="submit" value="Login">
						  
					 </form>
					<a href="#">Forgot Password ?</a>
			</div>
			<div class="col-md-6 login-right">
					 <h3 class="tittle">注册 <i class="glyphicon glyphicon-file"></i></h3>
					<p>在这里创建一个账户，你以后将可以享受本站点的所有服务，包括发布博客，评论博客，赶快注册成为会员吧.</p>
					<a href="http://localhost/blog/index.php?c=user&a=registration" class="hvr-bounce-to-bottom button">创建一个账户</a>
			</div>
			<div class="clearfix"></div>
		</div>
	</div>
<!-- //login-page -->
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