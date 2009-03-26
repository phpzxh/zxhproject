<?php

  class Control_Admin_Picpreview extends QUI_Control_Abstract {
  	
  		function render(){
  			//得到属性的值
  			  $value = $this->_extract('value');
      		  if ($value){
      		  	 
          		  $dir = $this->_context->baseDir() . trim($this->_extract('dir'), '/\\');
          		  $out = "<img src=\"{$dir}/{$value}\" border=\"0\" class=\"preview\" />";
       			 }
       		 else{
            	$out = "还没有上传图像";
       	 	}
       	 	return $out;
  		}
  	
  }