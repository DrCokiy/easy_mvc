<!DOCTYPE html>
<html lang="zh-cn">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta name="renderer" content="webkit">
    <title>网站信息</title>  
    <link rel="stylesheet" href="public/css/pintuer.css">
    <link rel="stylesheet" href="public/css/admin.css">
    <script src="public/js/jquery.js"></script>
    <script src="public/js/pintuer.js"></script>  
</head>
<body>
<div class="panel admin-panel">
  <div class="panel-head"><strong><span class="icon-pencil-square-o"></span> 个人信息</strong></div>
  <div class="body-content">
    <form method="post" class="form-x" action="http://localhost/blog/index.php?m=admin&c=user&a=updateuser" enctype="multipart/form-data">
      <div class="form-group">
        <div class="label">2
          <label>用户名：</label>
        </div>
        <div class="field">
          <input type="text" class="input" disabled value="<?=$data['username'];?>" />
          <div class="tips"></div>
        </div>
      </div>
      <div class="form-group">
        <div class="label">
          <label>用户头像：</label>
        </div>
        <div class="field">
          <input type="text" id="url1"  class="input tips" style="width:120px; height:120px; float:left;" value="" data-toggle="hover" data-place="right" data-image="<?=$data['picture'];?>"  />
          <input type="file" class="button bg-blue margin-left" id="image1" name="file" >
        </div>
      </div>
      <div class="form-group">
        <div class="label">
          <label>手机：</label>
        </div>
        <div class="field">
          <input type="text" class="input" name="phone" placeholder="<?=$data['phone'];?>" />
          <div class="tips"></div>
        </div>
      </div>
      <div class="form-group">
        <div class="label">
          <label>QQ：</label>
        </div>
        <div class="field">
          <input type="text" class="input" name="qq" placeholder="<?=$data['qq'];?>" />
          <div class="tips"></div>
        </div>
      </div>
     
      <div class="form-group">
        <div class="label">
          <label>Email：</label>
        </div>
        <div class="field">
          <input type="text" class="input" name="email" placeholder="<?=$data['email'];?>" />
          <div class="tips"></div>
        </div>
      </div>
      <div class="form-group">
        <div class="label">
          <label></label>
        </div>
        <div class="field">
          <input class="button bg-main icon-check-square-o" type="submit" value="提交"> 
        </div>
      </div>
    </form>
  </div>
</div>
</body></html>