<!DOCTYPE HTML>
<html>
<head>
<title>About</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<link href="public/css/bootstrap.css" rel='stylesheet' type='text/css' />

	<link href="public/css/newblog.css" rel='stylesheet' type='text/css' />	
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
	<link rel="stylesheet" href="public/md/examples/css/style.css" />
    <link rel="stylesheet" href="public/md/css/editormd.css" />
    <link rel="shortcut icon" href="https://pandao.github.io/editor.md/favicon.ico" type="image/x-icon" />


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
						<li><a href="http://localhost/blog/index.php?m=admin" data-hover="个人中心">个人中心</a></li>
						<?php if(1==$_SESSION['usertype']):?>
							<li><a href="http://localhost/blog/index.php?m=admin" data-hover="个人中心">个人中心</a></li>
						<?php endif;?>
						<li><a href="http://localhost/blog/index.php?c=gallery&a=gallery" data-hover="画廊">画廊</a></li>
						<li><a href="http://localhost/blog/index.php?c=article&a=newblog2" data-hover="发博文">发博文</a></li>
						<li><a href="http://localhost/blog/index.php?c=user&a=exit" data-hover="退出">退出</a></li>
					<?php endif;?>
					</ul>
					<div class="search-box">
					 
						</div>

					<div class="clearfix"></div>
				</div>
       </div>
	<div class="full">
			<div class="col-md-3 top-nav about">
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
						<li><a href="http://localhost/blog/index.php?c=article&a=newblog2" data-hover="发博文">发博文</a></li>
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
		   <h3 class="tittle">发博文</h3>
			<div class="banner">
                <div  class="callbacks_container">
	                <form action="http://localhost/blog/index.php?c=article&a=addblog" method="post">
						标题：<input type="text" name="title" style="width:500px;"><br /><br />
						<div id="test-editormd">
               				 <textarea name='content' style="display:none"></textarea>
       					</div>
						<input type="submit" value="发表">
					</form>
				</div>
					<!--banner-->
	  			<script src="public/js/responsiveslides.min.js"></script>
			 <script>
			    // You can also use "$(window).load(function() {"
			    $(function () {
			      // Slideshow 4
			      $("#slider4").responsiveSlides({
			        auto: true,
			        pager:true,
			        nav:true,
			        speed: 500,
			        namespace: "callbacks",
			        before: function () {
			          $('.events').append("<li>before event fired.</li>");
			        },
			        after: function () {
			          $('.events').append("<li>after event fired.</li>");
			        }
			      });
			
			    });
			  </script>
		 <div class="clearfix"> </div>
			    <div class="b-bottom"> 
			     
				</div>
			 </div>
			   <!--//banner-->
			  <!--/top-news-->
			  <div class="top-news">
				
				 <div class="top-inner second">
					
					 <div class="clearfix"> </div>
				 </div>
	            </div>
					<!--//top-news-->
		     </div>
			<!--//banner-section-->
			<div class="banner-right-text">
			 
			<!--/general-news-->
			 <div class="general-news">
				<div class="general-inner">
				
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


<script src="public/md/examples/js/jquery.min.js"></script>
<script src="public/md/editormd.min.js"></script>
<script type="text/javascript">
    var testEditor;

    $(function() {
        testEditor = editormd("test-editormd", {
            width   : "90%",
            height  : 640,
            syncScrolling : "single",
            path    : "public/md/lib/"
        });

        /*
         // or
         testEditor = editormd({
         id      : "test-editormd",
         width   : "90%",
         height  : 640,
         path    : "../lib/"
         });
         */
    });
</script>
</body>
</html>