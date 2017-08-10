<!DOCTYPE HTML>
<html>
<head>
<title>Registration</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<link href="public/css/bootstrap.css" rel='stylesheet' type='text/css' />
<!-- <link href='http://fonts.useso.com/css?family=Open+Sans:700,700italic,800,300,300italic,400italic,400,600,600italic' rel='stylesheet' type='text/css'> -->
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
			<div class="col-md-3 top-nav register">
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
	<!-- register -->
			<div class="sign-up-form">
				 <h3 class="tittle">注册 <i class="glyphicon glyphicon-file"></i></h3>
					<p>请输入以下信息进行注册</p>
				<div class="sign-up">
					 <h3 class="tittle reg">个人信息 <i class="glyphicon glyphicon-user"></i></h3>
					<div class="sign-u">
					<form action="http://localhost/blog/index.php?c=user&a=doregister" method="post">
						<div class="sign-up1">
							<h4 class="a">姓氏*:</h4>
						</div>
						<div class="sign-up2">
							
								<input type="text" class="text" value="First Name" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Name';}" name='firstName'>

							
						</div>
						<div class="clearfix"> </div>
					</div>
					<div class="sign-u">
						<div class="sign-up1">
							<h4 class="b">名字* :</h4>
						</div>
						<div class="sign-up2">
							
									<input type="text" class="text" value="Last Name" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Last Name';}" name='lastName'>

						
						</div>
						<div class="clearfix"> </div>
					</div>
					<div class="sign-u">
						<div class="sign-up1">
							<h4 class="c">邮箱* :</h4>
						</div>
						<div class="sign-up2">
							
								 <input type="text" class="text" value="Email Address" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Email Address';}" name='email'>

							
						</div>
						<div class="clearfix"> </div>
					</div>
					 <h3 class="tittle reg">登录信息 <i class="glyphicon glyphicon-off"></i></h3>
					<div class="sign-u">
						<div class="sign-up1">
							<h4 class="d">密码* :</h4>
						</div>
						<div class="sign-up2">
							
								 <input type="password" class="Password" onfocus="this.value = '';" }" name='password'>

							
						</div>
						<div class="clearfix"> </div>
					</div>
					<div class="sign-u">
						<div class="sign-up1">
							<h4>重复密码* :</h4>
						</div>
						<div class="sign-up2">
							
								
											 <input type="password" class="Password" onfocus="this.value = '';" }" name='repassword'>
	

							
						</div>
						<div class="clearfix"> </div>
					</div>
					<div class="sign-u">
						<div class="sign-up1">
							<h4>验证码* :</h4>
						</div>
						<div class="sign-up2">
							
								
											 <input type="text" class="Password" onfocus="this.value = '';" }" name='code' style="width:130px;"><img src="http://localhost/blog/index.php?c=user&a=showyzm" id='12' onclick="update()" style="margin-left: 20px;">
	

							
						</div>
						<div class="clearfix"> </div>
					</div>
					
						<input type="submit" value="提交审核">
						
					</form>
				</div>
			</div>
<!-- //register -->
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

<script type="text/javascript">
	function update()
	{
		var obj = document.getElementById('12');
		obj.src = 'http://localhost/blog/index.php?c=user&a=showyzm&'+Math.random();
	}
</script>
</body>
</html>