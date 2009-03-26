<?php 
/**
 * FCK编辑器的控件
 *
 */
class Control_FCKEditor extends QUI_Control_Abstract {
	
	function render(){
		//路径
		$baseDir =$this->_context->get('base_dir',$this->_context->baseDir().'js/fckeditor/');
		$baseDir=h(rtrim($baseDir,'/\\').'/');
		$width=$this->get('width',"100%");
		$height=$this->get('height',"250px");
		$value=$this->get('value','');
		$class=$this->get('class','');
		//控件的id 
		$id=$this->id();
		$config=$this->get('config');
		if(!is_array($config)){
			$config= array();
		}
		$out=Q::control('memo',$id,array('value'=>$value,'class'=>$class))->render();
		$out.=<<<EOT
	<script type="text/javascript" src="{$baseDir}fckeditor.js"></script>
<script type="text/javascript">
var oFCKeditor = new FCKeditor('{$id}');
oFCKeditor.BasePath = "{$baseDir}";
oFCKeditor.Height="{$height}";
oFCKeditor.Width="$width";
oFCKeditor.ReplaceTextarea();
</script>	
EOT;
		return $out;
	}
	
}