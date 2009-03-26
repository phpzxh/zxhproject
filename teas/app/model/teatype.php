<?php
// $Id$

/**
 * TeaType 封装来自 teas_types 数据表的记录及领域逻辑
 */
class TeaType extends QDB_ActiveRecord_Abstract
{
	/**
	 * 茶叶类别列表
	 *
	 * @return array
	 */
	function getTypeList(){
		
		$sort =$this->find()->setColumns('id,name')->asArray()->getAll();
		$arr =array('id'=>0,'name'=>'请选择类别');
		array_unshift($sort,$arr);
		$sort=Helper_Array::toHashmap($sort,'id','name');
   		
   		return $sort;
	}
	/**
	 * 树变成数组
	 *
	 * @param array $tree
	 * @param string $nodes
	 * @return array
	 */
	static  function treeToArray(array $tree ,$nodes='childrens',$level=1){
		static  $arr =array();
		
		
		foreach ($tree as $row){
			//保存一条栏目列表
			$arr[$row['id']] = $row;
			$arr[$row['id']][$nodes]=count($arr[$row['id']][$nodes]);
			$arr[$row['id']]['level']=$level;
//			改变父类节点的子节点数目
			for ($i=1;$i<$level;$i++){
//				判断是几级栏目
				if($level>1){
					$arr[$row['parent_id']][$nodes] +=$arr[$row['id']][$nodes];
				}
			}
			
			
			//如果有子栏目
			if(!empty($row[$nodes])){
				//该子类设置为空
				
					self::treeToArray($row[$nodes],$nodes,$level+1);
				continue;
			}
			
		
			
		}
		
		return $arr;
		
	}
	/**
	 * 递归更新栏目的 子栏目数目
	 *
	 * @param int $parent_id
	 */
	function sonsCount($parent_id){
		
		
		//如果是创建目录
		if(!$this->id){
				//如果选择的是根目录
				if($parent_id ==-1) return ;
				$teaType = $this->find('id =?',$parent_id)->asArray()->query();
				$this->meta()->updateDbWhere(new QDB_Expr('sons =sons+1'),'id =?',$parent_id);
				
		}else {
				//修改目录
				
					//没有改变父子关系 则返回
					if($this->parent_id == $parent_id) return ;
			
				$teaType = $this->find('id =?',$parent_id)->asArray()->query();
				//选择的父栏目的儿子数目加一
				$this->meta()->updateDbWhere(new QDB_Expr('sons =sons+1'),'id =?',$parent_id);
				//当前的父栏目减一
				$this->meta()->updateDbWhere(new QDB_Expr('sons =sons-1'),'id =?',$this->parent_id);
		}
		if($teaType['parent_id'] != -1){
			self::sonsCount($teaType['parent_id']);
		}
		
	}
	
    /**
     * 返回对象的定义
     *
     * @static
     *
     * @return array
     */
    static function __define()
    {
        return array
        (
            // 指定该 ActiveRecord 要使用的行为插件
            'behaviors' => '',

            // 指定行为插件的配置
            'behaviors_settings' => array
            (
                # '插件名' => array('选项' => 设置),
            ),

            // 用什么数据表保存对象
            'table_name' => 'teas_types',

            // 指定数据表记录字段与对象属性之间的映射关系
            // 没有在此处指定的属性，QeePHP 会自动设置将属性映射为对象的可读写属性
            'props' => array
            (
                // 主键应该是只读，确保领域对象的“不变量”
                'id' => array('readonly' => true),

                /**
                 *  可以在此添加其他属性的设置
                 */
                # 'other_prop' => array('readonly' => true),
				'list' => array('getter' => 'getTypeList'),
                /**
                 * 添加对象间的关联
                 */
                # 'other' => array('has_one' => 'Class'),
                'teas'=>array(
                		QDB::HAS_MANY =>'Tea',
                		'target_key'=>'type_id',
                		
                )

            ),

            /**
             * 允许使用 mass-assignment 方式赋值的属性
             *
             * 如果指定了 attr_accessible，则忽略 attr_protected 的设置。
             */
            'attr_accessible' => '',

            /**
             * 拒绝使用 mass-assignment 方式赋值的属性
             */
            'attr_protected' => 'id',

            /**
             * 指定在数据库中创建对象时，哪些属性的值不允许由外部提供
             *
             * 这里指定的属性会在创建记录时被过滤掉，从而让数据库自行填充值。
             */
            'create_reject' => '',

            /**
             * 指定更新数据库中的对象时，哪些属性的值不允许由外部提供
             */
            'update_reject' => '',

            /**
             * 指定在数据库中创建对象时，哪些属性的值由下面指定的内容进行覆盖
             *
             * 如果填充值为 self::AUTOFILL_TIMESTAMP 或 self::AUTOFILL_DATETIME，
             * 则会根据属性的类型来自动填充当前时间（整数或字符串）。
             *
             * 如果填充值为一个数组，则假定为 callback 方法。
             */
            'create_autofill' => array
            (
                # 属性名 => 填充值
                # 'is_locked' => 0,
                'created'=>self::AUTOFILL_TIMESTAMP,
            ),

            /**
             * 指定更新数据库中的对象时，哪些属性的值由下面指定的内容进行覆盖
             *
             * 填充值的指定规则同 create_autofill
             */
            'update_autofill' => array
            (
            ),

            /**
             * 在保存对象时，会按照下面指定的验证规则进行验证。验证失败会抛出异常。
             *
             * 除了在保存时自动验证，还可以通过对象的 ::meta()->validate() 方法对数组数据进行验证。
             *
             * 如果需要添加一个自定义验证，应该写成
             *
             * 'title' => array(
             *        array(array(__CLASS__, 'checkTitle'), '标题不能为空'),
             * )
             *
             * 然后在该类中添加 checkTitle() 方法。函数原型如下：
             *
             * static function checkTitle($title)
             *
             * 该方法返回 true 表示通过验证。
             */
            'validations' => array
            (
                'name' => array
                (
                    array('not_empty', '茶叶类名不能为空'),
                    array('max_length', 40, '茶叶类名不能超过 40 个字符'),

                ),


            ),
        );
    }


/* ------------------ 以下是自动生成的代码，不能修改 ------------------ */

    /**
     * 开启一个查询，查找符合条件的对象或对象集合
     *
     * @static
     *
     * @return QDB_Select
     */
    static function find()
    {
        $args = func_get_args();
        return QDB_ActiveRecord_Meta::instance(__CLASS__)->findByArgs($args);
    }

    /**
     * 返回当前 ActiveRecord 类的元数据对象
     *
     * @static
     *
     * @return QDB_ActiveRecord_Meta
     */
    static function meta()
    {
        return QDB_ActiveRecord_Meta::instance(__CLASS__);
    }


/* ------------------ 以上是自动生成的代码，不能修改 ------------------ */

}

