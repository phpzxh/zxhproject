<?php $this->_extends('_layouts/login_layout');?>
<?php $this->_block('contents');?>
<script language="JavaScript">
if(self.parent.frames.length != 0) {
    self.parent.location=document.location;
}
</script>

<table class="logintb">
  <tr>
    <td class="login"><h1>茶叶网管理后台</h1>
     
      <p>&nbsp;</p>
    </td>
    <td>
    <?php if($error):?>
    <div class="correctmsg"><p><?php echo $error; ?></p></div>
    <?php endif;?>
    <form method="post" name="login" id="loginform" action="<?php echo $_ctx->url('default/login'); ?>">
        <p class="logintitle">用户名: </p>
        <p class="loginform">
          <input name="username" tabindex="1" type="text" class="txt" />
        </p>
        <p class="logintitle">密　码:</p>
        <p class="loginform">
          <input name="password" tabindex="2" type="password" class="txt" />
        </p>
        <p class="logintitle">验证码:</p>
        <p class="loginform">
       
        <?php $this->_control('imgcode'); ?>
        </p>
        <p class="loginnofloat">
          <input name="submit" value="提交"   type="submit" class="btn" />
        </p>
      </form>
      <script type="text/JavaScript">document.getElementById('loginform').username.focus();</script>
    </td>
  </tr>
  <tr>
    <td colspan="2" class="footer">
    <div class="copyright">
        <p>Powered by <a href="#" target="_blank">茶叶网</a></p>
        <p>&copy; 2005-2009, <a href="#" target="_blank">深圳恒誉科技</a></p>
    </div>
    </td>
  </tr>
</table>
<?php $this->_endblock();?>