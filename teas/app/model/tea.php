<?php
// $Id$

/**
 * Tea 封装来自 teas 数据表的记录及领域逻辑
 */
class Tea extends QDB_ActiveRecord_Abstract
{
	/**
	 * 虚拟属性
	 *
	 * @var Helper_upload_file
	 */
	private $_postfile;
	/**
	 * 待删除的文件
	 *
	 * @var array
	 */
	private $_pending_delete_files=array();
	/**
	 * 设置 postfile属性
	 *
	 * @param unknown_type $postfile
	 */
	function setPostfile($postfile){
		$this->_postfile=$postfile;
		
	}

	/**
	 * 返回postfile属性的值
	 *
	 * @return unknown
	 */
	function getPostfile(){
		return $this->_postfile;
	}
	/**
	 * 返回茶叶的图片的地址
	 *
	 * @return string
	 */
	function getThumbSrc(){
		
		return rtrim(Q::ini('appini/teapics/img_dir'),'/\\')."/{$this->thumb_filename}";
	}
	/**
	 * 保存记录前要处理的操作
	 *
	 */
	protected function _before_save() {
		//属性没有值返回
		if(is_null($this->_postfile)) return ;
		if(!$this->_postfile->isValid()){
			throw new QDB_ActiveRecord_ValidateFailedException(array('postfile' => 'postfile is invalid.'),$this);
		}
		// 添加图片
        $dir = rtrim(Q::ini('appini/teapics/upload_dir'), '/\\') . DS;
        $date = date('Y-m');
        $dest_dir = $dir . $date;
		Helper_Filesys::mkdirs($dest_dir);
	
		$md5 =md5(rand().'-'.microtime(true));
		//上传图片

		$img_url =$md5.'.'.$this->_postfile->extname();
		$this->_postfile->move($dest_dir.DS.$img_url);
		$img_url ="{$date}/{$img_url}";
		//生成缩略图
		$thumb_name=$md5.'-thumb.'.'.jpg';
		$img=Helper_Image::createFromFile($this->_postfile->filePath(),$this->_postfile->extname());
		$width=intval( Q::ini('appini/teapics/thumb_pic_width'));
		$height=intval(Q::ini('appini/teapics/thumb_pic_width'));
		$img->crop($width,$height);
		$fileName=$dest_dir.DS.$thumb_name;
		$img->saveAsJpeg($fileName);
		$thumb_name ="{$date}/$thumb_name";
		//是否数据库有图片
		if($this->thumb_filename && $this->thumb_filename !=$thumb_name){
			//待删除的图片为数据库的图片
			$this->_pending_delete_files['thumb'][] =$this->thumb_filename;
		}

		$this->thumb_filename=$thumb_name;
		
		if($this->img_url && $this->img_url !=$img_url){
			$this->_pending_delete_files['img'][] =$this->img_url;
		}
		//赋值到img_url
		$this->img_url =$img_url;
		
	}
	protected function _after_save(){
		
		if(!empty($this->_pending_delete_files)){
			
			$dir =rtrim(Q::ini('appini/teapics/upload_dir'),'/\\'). DS;
			
			foreach($this->_pending_delete_files as $files){
				foreach ($files as $file ){
						@unlink($dir.$file);
				}
			}
		}
		
	}
	protected function _after_destroy(){
			$dir =rtrim(Q::ini('appini/teapics/upload_dir'),'/\\'). DS;
			@unlink($dir.$this->thumb_filename);
			@unlink($dir.$this->img_url);
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
            'table_name' => 'teas',

            // 指定数据表记录字段与对象属性之间的映射关系
            // 没有在此处指定的属性，QeePHP 会自动设置将属性映射为对象的可读写属性
            'props' => array
            (
                // 主键应该是只读，确保领域对象的“不变量”
                'id' => array('readonly' => true),

                // 对象创建时间应该是只读
                'created' => array('readonly' => true),


                /**
                 *  可以在此添加其他属性的设置
                 */
                # 'other_prop' => array('readonly' => true),
                'postfile'=>array('setter'=>'setPostfile','getter'=>'getPostfile'),
               

                /**
                 * 添加对象间的关联
                 */
                # 'other' => array('has_one' => 'Class'),
                'teatype'=>array(
                	QDB::BELONGS_TO =>'TeaType',
                	'source_key'=>'type_id',
                ),

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
            'attr_protected' => 'id,thumb_filename',

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
                'created' => self::AUTOFILL_TIMESTAMP ,
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
                    array('not_empty', '名称不能为空'),
                    array('max_length', 128, '名称不能超过 128 个字符'),

                ),

                'price' => array
                (
                    array('is_float', '价格必须是一个浮点数'),

                ),

                'update' => array
                (
                    array('is_int', 'update必须是一个整数'),

                ),

                'tea_locality' => array
                (
                    array('max_length', 50, '茶叶产地不能超过 50 个字符'),

                ),

                'thumb_filename' => array
                (
                    array('max_length', 255, '缩略图不能超过 255 个字符'),

                ),

                'fake_code' => array
                (
                    array('not_empty', '防伪码不能为空'),
                    array('max_length', 255, '防伪码不能超过 255 个字符'),

                ),

                'introduce' => array
                (
                    array('not_empty', '介绍不能为空'),

                ),

                'rate' => array
                (
                    array('max_length', 20, '产品等级不能超过 20 个字符'),

                ),

                'pack_type' => array
                (
                    array('max_length', 30, '包装类型不能超过 30 个字符'),

                ),

                'is_recommend' => array
                (
                    array('is_int', '推荐必须是一个整数'),

                ),

//                'is_hot' => array
//                (
//                    array('is_int', '是否热门必须是一个整数'),
//
//                ),

                'type_id' => array
                (
                    array('is_int', '类别ID必须是一个整数'),

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

