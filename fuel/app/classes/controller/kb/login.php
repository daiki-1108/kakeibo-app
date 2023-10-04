<?php

use \Model\Record;
use \Model\Cateogry;
use \Model\User;

class Controller_Kb_login extends Controller
{
    public function action_login(){
        //すでにログイン済であればログイン後のページへリダイレクト
        Auth::check() and Response::redirect('/kb/kakeibo/index');
        //エラーメッセージ用変数初期化
        //$error = null;
          // ビューテンプレートを呼び出し
        $view = View::forge('login/login');

        
        //ログインボタンが押されたら、ユーザ名、パスワードをチェックする
        
        //エラーメッセージをビューのセット
        //$view->set('error', $error);
        return $view;
    }

    public function action_logincreateForm(){
        if(Input::post()){
            $val = Validation::forge();
            $val->add_field('username', 'ユーザネーム', 'required')->add_rule('min_length', 4)->add_rule('max_length', 15);
             $val->add_field('password', 'パスワード', 'required')->add_rule('min_length', 6)->add_rule('max_length', 20);
            $val->add_field('confirmation_password', '確認用パスワード', 'required')->add_rule('min_length', 6)->add_rule('max_length', 20);
            if($val->run()){
                    #echo '成功';  #成功したとき
                    //パスワードと確認用パスワードが一致したらデータを登録
                    if(Input::post('password') == Input::post('confirmation_password')){
                        DB::insert('users')->set(array(
                            'username' => Input::post('username'),
                            'password' => Input::post('password'),
                        ))->execute();
                        return View::forge('login/logincreateForm', );
                        exit;
                    }else{
                        echo 'パスワードが一致していません';
                        exit;
                    }
                }
                else{    #失敗の場合の処理
                    foreach($val->error() as $key => $value){
                        echo $value->get_message();
                        }
                        exit;
                    }
        }   
                return View::forge('login/logincreateForm', );
    }
    public function post_login(){
        
        $user = Model_User::find('first', array(
            'where' => array(
                'username' => Input::post('username'),
                'password' => Input::post('password'),
            )
        ));

            $val = Validation::forge();
            $val->add_field('username', 'ユーザネーム', 'required')->add_rule('min_length', 4)->add_rule('max_length', 15);
            $val->add_field('password', 'パスワード', 'required')->add_rule('min_length', 6)->add_rule('max_length', 20);
            if($val->run()){
                //ログイン用のオブジェクト生成
                //$auth = Auth::instance();
                if ($user && $user->username == Input::post('username') && $user->password == Input::post('password')) {
                   //var_dump(Input::post());
                   //exit;
                    //ログイン成功時
                   $error = 'ログインに成功しました';
                   Session::set('userid', $user->id);
                   Response::redirect('/kb/kakeibo/index');
                   
                }
            }
                     // ログイン失敗時の処理
                   // $error = 'ログインに失敗しました';:
            
    }

}
    