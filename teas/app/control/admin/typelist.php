<?php
	/**
	 * 下拉列表
	 *
	 */
	class Control_Admin_TypeList extends QUI_Control_Abstract {
		
		function render(){
			//得到属性的值	
			$id = $this->_extract('id','parent_id');
			$value =$this->_extract('value');
			$out =null;
			//得到所有的类别
			$teaType = TeaType::find()->asArray()->getAll();
			 //转换成item=>name数据
			 $teaTree = Helper_Array::toTree($teaType,'id','parent_id');
			 $teaTree = TeaType::treeToArray($teaTree);
			 
			//生成有落差下拉类表的html
			$out.="<select  id=\"$id\" name=\"$id\" >";
			$out.="<option value=\"-1\" >请选择类别</option>";
			foreach ($teaTree as $option){
				
				$out.="<option value=\"{$option['id']}\"  ";
				//是否该分类 是父分类
				if($option['id'] ==$value){
					$out .="selected=\"selected\"";
				}
				$out .=">";
				for ($i=0;$i<$option['level'];$i++){
						$out .="&nbsp;&nbsp;";
				}
				$out .=$option['name'];
				$out .="</option>";
			}
			$out .="</select>";
			return $out;
		}
		
		
	}