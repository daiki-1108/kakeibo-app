<?php

class Model_Record extends Orm\Model
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
		"date" => array(
			"label" => "Date",
			"data_type" => "datetime",
			'validation' => array(
                'required',
                'valid_string' => array(array('numeric')),
            ),
			'form'      => array('type' => false),
		),
		"amount" => array(
			"label" => "Amount",
			"data_type" => "int",
			'validation' => array(
                'required',
                'valid_string' => array(array('numeric')),
            ),
			'form'      => array('type' => false),
		),
		//カテゴリーのid
		"category_id" => array(
			"label" => "Category_id",
			"data_type" => "int",
			'validation' => array(
                'required',
                'valid_string' => array(array('numeric')),
            ),
			'form'      => array('type' => false),
		),
		"user_id" => array(
			"label" => "User_id",
			"data_type" => "int",
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

	protected static $_table_name = 'record';

	protected static $_primary_key = array('id');

	protected static $_has_many = array(

		
	);

	protected static $_many_many = array(

	);

	protected static $_has_one = array(

		
	);

	protected static $_belongs_to = array(

		// リレーションの関係性を示す名前を指定
		'category_name' => array(
			// 紐づけるモデル 
				'model_to' => 'Model_Category',
			// このモデル（カテゴリー）のキー
			// 反対側のモデルとの結合条件となる項目を示す
				'key_from' => 'category_id', 
			// 関連するモデルでのキー
			// 反対側のモデルで結合条件となる項目を示す
				'key_to' => 'id',
	
				// 関係するテーブルが保存されるときに同時にアップデートするか
				'casecade_save' => true,
				 // 親テーブルの関連レコードが削除されるときに同時に削除するか
				'casecade_delete' => false
		),
			

			// リレーションの関係性を示す名前を指定
		'login' => array(

			// 紐付けられるモデル  :user
			'model_to' => 'Model_User',

			// このモデルのキー  :recordテーブルのid
			'key_from' => 'user_id', 

			// 関連するモデルでのキー  :userテーブルのid
			'key_to' => 'id',

			 // 関係するテーブルが保存されるときに同時にアップデートするか
			'casecade_save' => true,
			// 親テーブルの関連レコードが削除されるときに同時に削除するか
			'casecade_delete' => false
		)
	);

}



?>
