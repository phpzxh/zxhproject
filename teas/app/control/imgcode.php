<?php 

class Control_ImgCode extends QUI_Control_Abstract
{
    function render()
    {
    	//访问的uri
        $udi     = $this->get('udi', 'default/imgcode');
        //得到控件的id
        $id      = h($this->id());
        $url     = h(url($udi, array('rand' => '_RAND_')));

        $out = <<<EOT
<span id="{$id}_span" style=" margin-top:2px; display: none;">
  <img id="{$id}_img" border="0" style="cursor: pointer;" onclick="this.src = String('{$url}').replace('_RAND_', Math.random()); document.getElementById('{$id}').focus();" title="点击更换图像" />
  <br />
</span>

EOT;

        $out .= "<input type=\"text\" class=\"imgcode\" ";
        //得到控件的id号及名字
        $out .= $this->_printIdAndName();
        $out .= $this->_printAttrs('id, name');
		$out .= $this->_printDisabled();
        $out .= " onfocus=\"e = document.getElementById('{$id}_span'); if (e.style.display != 'block') { e.style.display = 'block'; url = new String('{$url}'); document.getElementById('{$id}_img').src = url.replace('_RAND_', Math.random()); } \" />\n";

        return $out;
    }
}
