<?php
// $Id$

/**
 * Links 封装来自 links 数据表的记录及领域逻辑
 */
class Links extends QDB_ActiveRecord_Abstract
{
	
	public function setImg($img){
		$this->img =$img;
	}
	public function getImg(){
		
		return $this->ico->value;
	}
	/**
	 * 保存前要处理的操作
	 *
	 */
	protected function _before_save(){
		//是否不需要上传图片
		if(is_null($this->ico)) return ;
		// 是否通过验证
		if(!$this->ico->isValid()){
				throw new QDB_ActiveRecord_ValidateFailedException(array('ico' => '图标未通过验证'),$this);
		}
		// 添加图片 创建目录
        $dir = rtrim(Q::ini('appini/teapics/upload_dir'), '/\\') . DS;
        $dest_dir = $dir . 'links';
		Helper_Filesys::mkdirs($dest_dir);
		$md5 =md5(rand().'-'.microtime(true));
		//上传图片
		$img_url =$md5.'.'.$this->ico->extname();
		$this->ico->move($dest_dir.DS.$img_url);
		
		$this->ico ='links'.DS.$img_url;
	}
	protected function _after_destroy(){
		$dir =rtrim(Q::ini('appini/teapics/upload_dir'),'/\\').DS;
		if($this->ico->value !=null)
			@unlink($dir.$this->ico);
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
            'table_name' => 'links',

            // 指定数据表记录字段与对象属性之间的映射关系
            // 没有在此处指定的属性，QeePHP 会自动设置将属性映射为对象的可读写属性
            'props' => array
            (
                // 主键应该是只读，确保领域对象的“不变量”
                'link_id' => array('readonly' => true),

                /**
                 *  可以在此添加其他属性的设置
                 */
                # 'other_prop' => array('readonly' => true),
               	 'img' =>array('getter'=>'getImg','setter'=>'setImg'),

                /**
                 * 添加对象间的关联
                 */
                # 'other' => array('has_one' => 'Class'),

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
            'attr_protected' => 'link_id',

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
                    array('max_length', 255, '链接名不能超过 255 个字符'),
                    array('not_empty','链接的名字不能为空'),

                ),

                'url' => array
                (
                    array('max_length', 255, '网站地址不能超过 255 个字符'),
                    array('not_empty','链接的网址不能为空'),

                ),

                'ico' => array
                (
                    array('max_length', 255, '图标不能超过 255 个字符'),

                ),

                'order_num' => array
                (
                    array('is_int', '排序数字必须是一个整数'),

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

