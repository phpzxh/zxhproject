<?php $this->_extends('_layouts/default_layout'); ?>

<?php $this->_block('contents'); ?>

<ul id="flash_message"  style="margin-left:300px;margin-top:20px;">
<li style="height:35px;">
<h3 style="border:none;  padding: 0px 0px 0px 50px; background:url(css/admin/icon_notice.gif) no-repeat center left; height: 35px;"> <?php echo $message_caption; ?></h3>
</li>
<li style="margin-top:20px;">
  <?php echo nl2br(h($message_body)); ?>
</li>
<li style="margin-top:20px;">
  <a href="<?php echo $redirect_url; ?>">如果您的浏览器没有自动跳转，请点击这里</a>
</li>

<script type="text/javascript">
setTimeout("window.location.href ='<?php echo $redirect_url; ?>';", <?php echo $redirect_delay * 1000; ?>);
</script>

<?php echo $hidden_script; ?>

</ul>

<?php $this->_endblock(); ?>

