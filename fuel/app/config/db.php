<?php
/**
 * Fuel is a fast, lightweight, community driven PHP 5.4+ framework.
 *
 * @package    Fuel
 * @version    1.8.2
 * @author     Fuel Development Team
 * @license    MIT License
 * @copyright  2010 - 2019 Fuel Development Team
 * @link       https://fuelphp.com
 */

/**
 * -----------------------------------------------------------------------------
 *  Global database settings
 * -----------------------------------------------------------------------------
 *
 *  Set database configurations here to override environment specific
 *  configurations
 *
 */



return array(
     'default' => array(
	 	'connection' => array(
			'dsn'      => 'mysql:host=localhost;dbname=kakeibo',
	 		'username' => 'root',
	 		'password' => '',
	 	),
	 ),
   
 	// 'kakeibo' => array(
    //      'type'           => 'pdo',
    //      'connection'     => array(
    //          'dsn'            => 'mysql:host=127.0.0.1;dbname=kakeibo',
    //          'username'       => 'root',
            //'password'       => '',
           //'persistent'     => false,
            //'compress'       => false,
         //),
        //  'identifier'   => '`',
        //  'table_prefix'   => '',
        //  'charset'        => 'utf8',
        //  'enable_cache'   => true,
        // 'profiling'      => false,
 	//)
);


?>