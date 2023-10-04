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
 * NOTICE:
 *
 * If you need to make modifications to the default configuration, copy
 * this file to your app/config folder, and make them in there.
 *
 * This will allow you to upgrade fuel without losing your custom config.
 */

return array(
    'driver'                 => 'Simpleauth',
    'verify_multiple_logins' => false,
    'salt'                   => 'tonton',
    'iterations'             => 10000,

    'username_post_key' => 'username', // POSTデータ内のユーザー名フィールドの名前
    'password_post_key' => 'password', // POSTデータ内のパスワードフィールドの名前
    'remember_me_post_key' => 'remember_me', // POSTデータ内の「ログインを保持する」フィールドの名前
    'login_hash_salt' => 'your_login_hash_salt', // ログインハッシュに使用されるソルト

    // ユーザーモデルの設定
    'user_model' => 'Model_User', // ユーザーモデルのクラス名
    'additional_fields' => array('full_name'), // 追加のユーザー情報カラム

    // セッションの設定
    'session_driver' => 'cookie', // セッションドライバ
    'session_key' => 'fuel_session', // セッションキー名

    // ログイン後のリダイレクト先
    'login_redirect' => '/kb/kakeibo/index', // ログイン後のリダイレクト先
    'logout_redirect' => '/kb/login/index', // ログアウト後のリダイレクト先
);
