<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>茶叶网管理后台</title>
<link rel="stylesheet" type="text/css" href="<?php echo $_BASE_DIR; ?>css/admin/login.css"/>
<body>
<div id="main">
  <div id="contents">
    
      <div id="flash_message">
        <h3><?php echo $message_caption; ?></h3>
        <p>
          <?php echo nl2br(h($message_body)); ?>
        </p>
        <p>
          <a href="<?php echo $redirect_url; ?>">如果您的浏览器没有自动跳转，请点击这里</a>
        </p>

<script type="text/javascript">
setTimeout("window.location.href ='<?php echo $redirect_url; ?>';", <?php echo $redirect_delay * 1000; ?>);
</script>

<?php echo $hidden_script; ?>

      </div>

  </div>
</div>
</body>
</html>

