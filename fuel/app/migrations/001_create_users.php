<?php

namespace Fuel\Migrations;

class Create_users
{
	public function up()
	{
		\DBUtil::create_table('users', array(
			'id' => array('type' => 'int', 'unsigned' => true, 'null' => false, 'auto_increment' => true, 'constraint' => 11),
			'name' => array('constraint' => 20, 'null' => false, 'type' => 'varchar'),
			'age' => array('constraint' => 11, 'null' => false, 'type' => 'int'),
			'remark' => array('null' => false, 'type' => 'text'),
			'created_at' => array('null' => true, 'type' => 'timestamp', 'unsigned' => true),
			'updated_at' => array('null' => true, 'type' => 'timestamp', 'unsigned' => true),
		), array('id'));
	}

	public function down()
	{
		\DBUtil::drop_table('users');
	}
}