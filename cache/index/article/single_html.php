<!DOCTYPE HTML>
<html>
<head>
<title>Single page</title>
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
			<div class="col-md-3 top-nav sing-page">
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
		<!--banner-section-->
		<div class="banner-section">
		   <h3 class="tittle">Single Page <i class="glyphicon glyphicon-file"></i></h3>
			<div class="single">
			   <img src="<?=$blog['pic'];?>" class="img-responsive" alt="" />
			    <div class="b-bottom"> 
			      <h5 class="top"><a href="#"><?=$blog['title'];?></a></h5>
				   <p class="sub"><?=$blog['content'];?></p>
			      <p>On <?php  echo date('F d',$blog['addtime']) ?> <a class="span_link" href="#"><span class="glyphicon glyphicon-comment"></span><?=$blog['replycount'];?> </a><a class="span_link" href="#"><span class="glyphicon glyphicon-eye-open"></span><?=$blog['hits'];?></a></p>
				 
				</div>
			 </div>
			  <div class="single-bottom">
								<div class="single-middle">
								<ul class="social-share">
									<li><span>SHARE</span></li>
									<li><a href="#"><i> </i></a></li>						
									<li><a href="#"><i class="tin"> </i></a></li>
									<li><a href="#"><i class="message"> </i></a></li>				
								</ul>
								<a href="#"><i class="arrow"> </i></a>
								<div class="clearfix"> </div>
						   </div>

					    </div>
						<div class="response">
					<h4>Responses</h4>
					<div class="media response-info">
						<div class="media-left response-text-left">
							
						</div>
						<div class="media-body response-text-right">
							
							<div class="media response-info">
								<div class="clearfix"> </div>
							</div>
						</div>
						<?php if(!empty($comment)):?>
						<?php foreach($comment as $value):?>
							<div class="media-left response-text-left">
								<a href="#">

									<img class="media-object" src="public/images/sin1.jpg" alt=""/>
								
								</a>
	
									<h5><a href="#"><?=$value['cname'];?></a></h5>

							</div>
							<div class="media-body response-text-right">
								<p><?=$value['content'];?></p>
								<ul>
									<li><?php  echo date('F d',$value['addtime']) ?>, <?php  echo date('Y',$value['addtime']) ?></li>
								</ul>
								<div class="media response-info">
									<div class="clearfix"> </div>
								</div>
							</div>
							<br /><br /><br /><br /><br /><br />
						<?php endforeach;?>
						<?php endif;?>
					</div>
				</div>	
				<div class="coment-form">
					<h4>Leave your comment</h4>
					<form action="http://localhost/blog/index.php?c=article&a=addcomment" method="post">
						<input type="text" value="Name " onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Name';}" required="" name='cname'>
						<textarea onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Your Comment...';}" required="" name='content'>Your Comment...</textarea>
						<input type="hidden" name="id" value="<?=$_GET['id'];?>">
						<input type="submit" value="Submit Comment" >
					</form>
				</div>	
				<div class="clearfix"></div>
			</div>
			<!--//banner-->
			<!--//banner-section-->
			<div class="banner-right-text">
			 <h3 class="tittle">News  <i class="glyphicon glyphicon-facetime-video"></i></h3>
			<!--/general-news-->
			 <div class="general-news">
				<div class="general-inner">
					<iframe src="app/index/view/news.php" style="width:355px; height:381px;border:0px;" scrolling='no'>dfhgsgdh</iframe>

					<div class="edit-pics">
					    <div class="editor-pics">
					    	<?php foreach($order as $value):?>
					    	<div>
								<div class="col-md-3 item-pic">
								   <img src="<?=$value['pic'];?>" class="img-responsive" alt="">
								</div>
								<div class="col-md-9 item-details">
										<h5 class="inner two"><a href="http://localhost/blog/index.php?c=article&a=single&id=<?=$value['id'];?>"><?=$value['title'];?></a></h5>
										 <div class="td-post-date two"><i class="glyphicon glyphicon-time"></i><?php  echo date('F d',$value['addtime']) ?>, <?php  echo date('Y',$value['addtime']) ?><a href="#"><i class="glyphicon glyphicon-comment"></i><?=$value['replycount'];?> </a></div>
								</div>
							</div>
							<?php endforeach;?>
							<div class="clearfix"></div>
						</div>
										
					</div>
								<div class="media">	
								 <h3 class="tittle media">Media <i class="glyphicon glyphicon-floppy-disk"></i></h3>
								  <div class="general-text two">
									 <a href="http://appdp.com/app/11732/" target="new"><img src="public/images/gen3.jpg" class="img-responsive" alt=""></a>
										<h5 class="top"><a href="http://appdp.com/app/11732/" target="new">新的 iPad App让你成为吉他高手</a></h5>
										<p>把你的iPad摇身一变成为一部随身可玩的结他，软件模拟真正结他的结构，如力求真实的声音和十四个音品...</p>
									
								  </div>
					         </div>
					    <div class="general-text two">
						    <a href="single.html"><img src="public/images/gen2.jpg" class="img-responsive" alt=""></a>
						    <h5 class="top"><a href="http://www.oubk.com/" target="new">数独、消灭你的无聊时光</a></h5>
							<p>数独游戏（日语：数独 すうどく）是一种源自18世纪末的瑞士的游戏，后在美国发展、并在日本得以发扬光大的数学智力拼图游戏。拼图是九宫格（即3格宽×3格高）的正方形状...
					    </div>
				 </div>
			</div>	
			<!--//general-news-->
			<!--/news-->
			<!--/news-->
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