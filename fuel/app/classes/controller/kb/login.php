<?php
use \Model\User;

class Controller_Kb_login extends Controller
{
    public function action_login(){
        Auth::check() and Response::redirect('/kb/kakeibo/index');
        $error = null;
        $view = View::forge('login/login');
        $view->set('error', $error);
        return $view;
    }
    public function post_login()
    {
        if (! \Security::check_token()) {  //csrf_tokenのチェック
            return false;
        }
        $val = Validation::forge();
        $val->add_field('username', 'ユーザネーム', 'required')->add_rule('min_length', 4)->add_rule('max_length', 15);
        $val->add_field('password', 'パスワード', 'required')->add_rule('min_length', 6)->add_rule('max_length', 20);
        if($val->run()){
            //ログイン用のオブジェクト生成
            $auth = Auth::instance();
            $username = Input::post('username');
            $password = Input::post('password');
            $user = Model_User::find('first', array(
                'where' => array(
                    'username' => $username
                )
            ));
            if (!Auth::check()){
                if($user){
                    if ($auth->login(Input::post('username'), Input::post('password')))
                    {
                        //ログイン成功時
                        Session::set('userid', $user->id);
                        Response::redirect('/kb/kakeibo/index'); 
                    }else{
                        // ログイン失敗時の処理
                        Response::redirect('/kb/login/login');
                    }
                }
            } 
        }       
    }

    public function action_logincreateForm(){
        if(Input::post()){
            if (! \Security::check_token()) {  //csrf_tokenのチェック
                return false;
            }
            $val = Validation::forge();
            $val->add_field('username', 'ユーザネーム', 'required')->add_rule('min_length', 4)->add_rule('max_length', 15);
            $val->add_field('password', 'パスワード', 'required')->add_rule('min_length', 6)->add_rule('max_length', 20);
            $val->add_field('confirmation_password', '確認用パスワード', 'required')->add_rule('min_length', 6)->add_rule('max_length', 20);
            if($val->run()){
                    //パスワードと確認用パスワードが一致したらデータを登録
                    Auth::instance();
                    if(Input::post('password') == Input::post('confirmation_password')){
                        Auth::create_user(
                            Input::post('username'),
                            Input::post('password'),
                            Input::post('email'),
                            1,
                       );
                        return View::forge('kb/login/logincreateForm');
                        Response::redirect('kb/login/login');
                    }
                }else{    #失敗の場合の処理
                    foreach($val->error() as $key => $value){
                        echo $value->get_message();
                        }
                }
        }   
                return View::forge('login/logincreateForm', );
    }
   

}
    