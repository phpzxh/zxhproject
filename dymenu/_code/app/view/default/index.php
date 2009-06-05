<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>动态菜单</title>
<link href="css/style.css" rel="stylesheet" type="text/css" />
</head>
<body>
<script language="javascript" type="text/javascript">

function selectReq(req)
{
	if (req != '') {
		id = 'role_' + req;
		document.getElementById(id).checked = true;
	}
}

function checkSubmit(form)
{
	els = form.elements["roles[]"];
	for (i = 0; i < els.length; i++) {
		if (els[i].checked) {
			return true;
		}
	}
	alert('请选中至少一个角色');
	return false;
}

function uncheckAll(form)
{
	els = form.elements["roles[]"];
	for (i = 0; i < els.length; i++) {
		els[i].checked = false;
	}
	return true;
}

</script>
<div id="topNavBar">
  <?php $this->_control('menu','headerMenu',array('name'=>'myMenu'));?>

</div>

<div id="content">

  <div id="current_action">
  	<?php  if($requestUri):  ?>
    选中菜单项访问的 URL：<?php echo h($requestUri);?><br />
	<?php endif;?>
	当前用户具有的角色：<?= h($currentRolesText); ?>
  </div>

  <div id="update_roles_form">
    <form name="update_roles" action="<?php  echo url('default/updateroles');?>" method="post" onsubmit="return checkSubmit(this);">

	  <?php  foreach ($groups as $key=>$item): ?>

	  <div class="block">
	    <h3>组：<?php echo h($item['title']);?></h3>
        <?php foreach ($item['roles'] as $role) :?>
		

		<input type="checkbox" name="roles[]" value="<?= $role['role_id']; ?>" id="<?php echo 'role_'.$role['role_id']; ?>" onclick="selectReq('<?= $role['req']; ?>'); return true;" <?php if(in_array($role['rolename'],$currentRoles)) :?>checked="checked" <?php endif; ?> />
		<?php $this->_control('label','role_'.$role['role_id'],array('caption'=>$role['description']));?>
        
		<br />

        <?php  endforeach; ?>

	  </div>

	  <?php  if (($key % 3)== 2):?>
	  	<div class="nofloat"></div>
	 <?php endif;?>
   <?php endforeach;?>

	  <div class="nofloat"></div>

	  <input type="button" name="btnUncheckAll" value="清除所有" onclick="return uncheckAll(this.form);" />

	  <input type="submit" name="Submit" value="更新用户角色" />

    </form>
  </div>

</div>

</body>
</html>
