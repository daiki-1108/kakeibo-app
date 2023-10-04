<?php

class Model_User extends Orm\Model
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

		"username" => array(
			"label" => "Username",
			"data_type" => "text",
			'validation' => array(
                'required',
                'valid_string' => array('alpha_numeric'),
            ),
			'form'      => array('type' => false),
		),

        "password" => array(
			"label" => "Password",
			"data_type" => "text",
			'validation' => array(
                'required',
                'valid_string' => array(array('numeric')),
            ),
			'form'      => array('type' => false),
		),

		"email" => array(
			"label" => "Email",
			"data_type" => "text",
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

	protected static $_table_name = 'users';

	protected static $_primary_key = array('id');

	protected static $_has_many = array(
        // リレーションの関係性を示す名前を指定
        'login' => array(

            // 紐付けられるモデル  :users
            'model_to' => 'Model_Record',

            // このモデルのキー  :usersテーブルのid
            'key_from' => 'id', 

            // 関連するモデルでのキー  :recordテーブルのid
            'key_to' => 'user_id',

             // 関係するテーブルが保存されるときに同時にアップデートするか
            'casecade_save' => true,
            // 親テーブルの関連レコードが削除されるときに同時に削除するか
            'casecade_delete' => false
        )
	);

	protected static $_many_many = array(

        		
	);

	protected static $_has_one = array(
	);

	protected static $_belongs_to = array(

        
	);
	
	
}



?>