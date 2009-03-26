<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>茶叶网管理后台</title>
<link rel="stylesheet" type="text/css" href="<?php echo $_BASE_DIR; ?>css/admin/admin.css"/>
<script type="text/javascript" src="<?php echo $_BASE_DIR; ?>js/jquery-1.2.6.min.js"></script>
<script type="text/javascript">
function adjuctContents()
{
	h = document.documentElement.offsetHeight;
	w = document.documentElement.offsetWidth;
	$("#contents").width(w - 159).height(h - 90);
	if ($.browser.version == '6.0')
	{
		$("#mask").width(w - 166).height(h - 104);
	}
	else
	{
		$("#mask").width(w - 160).height(h - 100);
	}
}

$(document).ready(function() {
	if ($.browser.msie) {
		adjuctContents();
		$(window).resize(adjuctContents);
	}
});

function fnOnTabClick(tab, title)
{
    $("#header_tabs > ul > li").removeClass("current");
    $(tab).parent().parent().addClass("current");
    $("#menus > ul").css("display", "none");

    id = "#menu_" + title;
    $(id).css("display", "");
    fnOnMenuClick($(id + " > li > a:first").get(0));
}

function fnOnMenuClick(menu)
{
    $("#menus > ul > li").removeClass("current");
    $(menu).parent().addClass("current");
    m = $("#mask").get(0);
    m.src = menu.href;
    m.focus();
}

</script>
</head>
<body>

<!-- header -->

<div id="header">
  <div id="logo">茶叶网管理后台</div>
  <div id="panel">

    <div id="header_tabs">
      <ul>
        
<?php

$current_tab = false;
foreach ($admin_tabs as $title => $menus):
    $class = array();
    if (!$current_tab) { $current_tab = $title; $class[] = 'current'; }
    if (isset($menus['url'])) { $class[] = 'more'; }

    if (!empty($class))
    {
        $class = ' class="' . implode(' ', $class) . '"';
    }
    else
    {
        $class = '';
    }
?>

        <li<?php echo $class; ?>>
          <span>
            <?php if (isset($menus['url'])): ?>
            <a href="<?php echo $menus['url']; ?>" target="_blank"><?php echo h($title); ?></a>
            <?php else: ?>
            <a href="#" onclick="fnOnTabClick(this, '<?php echo $title; ?>'); return false;"><?php echo h($title); ?></a>
            <?php endif; ?>
          </span>
        </li>

<?php
endforeach;
?>

      </ul>

      <div id="header_links">
        <p>您好, <strong><?=$admin['username'];?></strong> &nbsp;&nbsp;[&nbsp;<a href="<?php echo url('#::default/logout@#'); ?>">退出</a>&nbsp;]</p>
        <p><a href="<?php echo url('#::#/#@#'); ?>" class="btnlink" target="_blank">社区首页</a> </p>
      </div>
    </div>

    <div id="breadcrumbs"></div>

  </div>
</div>
<!-- /header -->

<!-- main -->
<div id="main">
  <div id="sidebar">
    <div id="menus">

<?php
$current_menu = null;
foreach ($admin_tabs as $title => $menus):
?>

      <ul id="menu_<?php echo $title; ?>" <?php if ($current_menu): ?>style="display: none;"<?php endif; ?>>

<?php
    foreach ($menus as $menu):
?>

        <li<?php if (!$current_menu): $current_menu = $menu; ?> class="current"<?php endif; ?><?php if (isset($menu['more'])): ?> class="more"<?php endif; ?>>
          <a href="<?php echo url($menu['udi']); ?>" onclick="fnOnMenuClick(this); return false;"><?php echo h($menu['title']); ?></a>
        </li>

<?php
    endforeach;
?>

      </ul>

<?php
endforeach;
?>

    </div>
  </div>
  <div id="contents">
    <iframe id="mask" src="<?php echo url($current_menu['udi']); ?>" frameborder="0"></iframe>
  </div>
</div>
<div id="copyright">
  <p>Powered by <a href="http://www.codes51.cn/" target="_blank">teas</a></p>
  <p>&copy; 2005-2008, <a href="http://www.codes51.cn" target="_blank">恒誉科技</a></p>
</div>
<!-- /main -->
</body>
</html>

