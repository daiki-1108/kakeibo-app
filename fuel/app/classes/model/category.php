<?php

class Model_Category extends Orm\Model
{
	protected static $_properties = array(
		"id" => array(
			"label" => "Id",
			"data_type" => "int",
			'validation' => array(
                'required',
                'valid_string' => array(array('numeric')),
            ),
			'form'      => array('type' => false),
		),
        //カテゴリーの名前
		"name" => array(
			"label" => "Name",
			"data_type" => "varchar",
			'validation' => array(
                'required',
                'valid_string' => array(array('numeric')),
            ),
			'form'      => array('type' => false),
		),
		
		
	);

	protected static $_observers = array(
		'Orm\Observer_CreatedAt' => array(
			'events' => array('before_insert'),
			'property' => 'created_at',
			'mysql_timestamp' => true,
		),
		'Orm\Observer_UpdatedAt' => array(
			'events' => array('before_update'),
			'property' => 'updated_at',
			'mysql_timestamp' => true,
		),
	);

	protected static $_table_name = 'category';

	protected static $_primary_key = array('id');

	protected static $_has_many = array(

		// リレーションの関係性を示す名前を指定
        'category_name' => array(

            // 紐付けられるモデル  :カテゴリー
			'model_to' => 'Model_Record',

            // このモデルのキー  :カテゴリーのid
			'key_from' => 'id', 

            // 関連するモデルでのキー  :recordテーブルのid
			'key_to' => 'category_id',

             // 関係するテーブルが保存されるときに同時にアップデートするか
			'casecade_save' => true,
            // 親テーブルの関連レコードが削除されるときに同時に削除するか
			'casecade_delete' => false
		)

	);
	//record側からは取り扱いカテゴリーモデルcategoryを紐付けしますよという指定を $_has_one で行い
	//カテゴリーモデルcategory側からはrecordが紐付けられてますよという指定を $_has_many で行っているわけです。
	//categoryが１、recordが多。
	

	protected static $_many_many = array(
	);

	protected static $_has_one = array(
	);

	protected static $_belongs_to = array(

        
	);
	
	
}



?>