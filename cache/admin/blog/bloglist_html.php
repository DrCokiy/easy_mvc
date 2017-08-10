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
  <div class="panel-head"><strong class="icon-reorder"> 内容列表</strong></div>
  <table class="table table-hover text-center">
    <tr>
      <th width="5%">ID</th>     
      <th>博客标题</th>  
      <th>类型</th>     
      <th width="250">操作</th>
    </tr>
   
    <?php foreach($data as $value):?>
    <tr>
      <td><?=$value['id'];?></td> 
      <?php if(0 == $value['parentid']):?>     
        <td><b><?=$value['title'];?><b</td>
        <td><b>博文</b></td> 
      <?php else: ?>
         <td><?=$value['content'];?></td>
         <td>评论</td> 
      <?php endif;?>
           
      <td>
      <div class="button-group">
      
       <a class="button border-red" href="http://localhost/blog/index.php?m=admin&c=blog&a=delete&id=<?=$value['id'];?>" onclick="delcfm()"><span class="icon-trash-o"></span> 删除</a>
      </div>
      </td>
    </tr>  
    <?php endforeach;?>
  </table>

</div>    
        <div class="yeshutiao">
          <b><a href="<?=$first;?>">首页</a></b>
          <b><a href="<?=$pre;?>">上一页</a></b>
          <?php for($i=$offset;$i<=$max;$i++):?>
            <b><a href="http://localhost/blog/index.php?m=admin&c=blog&a=bloglist&page=<?=$i;?>"><?=$i;?></a></b>
          <?php endfor;?>
          <b><a href="<?=$next;?>">下一页</a></b>
          <b><a href="<?=$last;?>">尾页</a></b> 
          <b>共<?=$total;?>页</b>
          <b>当前第<?=$page;?>页</b>
        </div>
<script language="javascript"> 
        function delcfm() { 
          if (!confirm("确认要删除？")) { 
              window.event.returnValue = false; 
            } 
        } 
</script>

</body></html>