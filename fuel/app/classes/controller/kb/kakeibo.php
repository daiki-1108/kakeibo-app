<?php

use \Model\Record;
use \Model\Cateogry;
use \Model\User;

class Controller_Kb_Kakeibo extends Controller
{
    public function before(){
        //var_dump('aaaa');
        //exit;
        //parent::before();
        //未ログイン時、ログインページリダイレクト
        //if(!Auth::check()){
           //Response::redirect('/kb/login/login');
        //}
    }
    
    //トップ画面
    public function action_index()
    {
            $userid = Session::get('userid');
            $posts = Model_Record::find('all', array(
            'related' => array(
                'category_name',
                //リレーションの設定名
            ),
            'order_by' => array('category_id' => 'asc'),
            'where' => array('user_id' => $userid),
        ));
        $All_Total = Arr::sum($posts, 'amount');

        $sql_1 = DB::select()->from('record')->where_open()->where('category_id', '=', 1)->and_where('user_id', '=', $userid)->where_close()->execute();
        $total_1 = Arr::sum($sql_1, 'amount');
        $sql_2 = DB::select()->from('record')->where_open()->where('category_id', '=', 2)->and_where('user_id', '=', $userid)->where_close()->execute();
        $total_2 = Arr::sum($sql_2, 'amount');
        $sql_3 = DB::select()->from('record')->where_open()->where('category_id', '=', 3)->and_where('user_id', '=', $userid)->where_close()->execute();
        $total_3 = Arr::sum($sql_3, 'amount');
        $sql_4 = DB::select()->from('record')->where_open()->where('category_id', '=', 4)->and_where('user_id', '=', $userid)->where_close()->execute();
        $total_4 = Arr::sum($sql_4, 'amount');
        $sql_5 = DB::select()->from('record')->where_open()->where('category_id', '=', 5)->and_where('user_id', '=', $userid)->where_close()->execute();
        $total_5 = Arr::sum($sql_5, 'amount');
        $sql_6 = DB::select()->from('record')->where_open()->where('category_id', '=', 6)->and_where('user_id', '=', $userid)->where_close()->execute();
        $total_6 = Arr::sum($sql_6, 'amount');
        $sql_7 = DB::select()->from('record')->where_open()->where('category_id', '=', 7)->and_where('user_id', '=', $userid)->where_close()->execute();
        $total_7 = Arr::sum($sql_7, 'amount');
       
        $data = array(
            'posts' => $posts,
            'All_Total' => $All_Total,
            'total_1' => $total_1,
            'total_2' => $total_2,
            'total_3' => $total_3,
            'total_4' => $total_4,
            'total_5' => $total_5,
            'total_6' => $total_6,
            'total_7' => $total_7,
        );
        return Response::forge(View::forge('kakeibo/index', $data));
    }

    //新規入力画面
    public function action_createForm()
    {
        $userid = Session::get('userid');
        if(Input::post()){
        $val = Validation::forge();
        $val->add_field('date', '日付', 'required');#1=フィールド名、２＝日本語名、３＝ルール
        $val->add_field('amount', '金額', 'required');
        $val->add_field('category_id', 'カテゴリー', 'required');
        if($val->run()){
            #echo '成功';  #成功したとき
            DB::insert('record')->set(array(
                'date' => Input::post('date'),
                'amount' => Input::post('amount'),
                'category_id' => Input::post('category_id'),
                'user_id' => $userid,
            ))->execute();

            return View::forge('kakeibo/createForm', );
            exit;
        }
        else{    #失敗の場合の処理
            foreach($val->error() as $key => $value){
                echo $value->get_message();
            }
            exit;
        }
        }   
        return View::forge('kakeibo/createForm', );
    }


    //編集画面
    public function action_editForm($id)
    {
        $userid = Session::get('userid');
        $posts = Model_Record::find('all', array(
            'related' => array(
                'category_name', //リレーションの設定名
                'login',
            ),
            'order_by' => array('category_id' => 'asc'),
            'where' => array(
                array('id' , $id), 
                array('user_id' => $userid),
            ),
        )); 
        $data = array(
            'posts' => $posts,
        );

        if(Input::post()){
            $val = Validation::forge();
            $val->add_field('date', '日付', 'required');#1=フィールド名、２＝日本語名、３＝ルール
            $val->add_field('amount', '金額', 'required');
            if($val->run()){
                #echo '成功';  #成功したとき

                //値設定
                $edit_data = Model_Record::find($id);
                $edit_data->set(array(
                    'date' => Input::post('date'),
                    'amount' => Input::post('amount'),
                ));
                //保存
                $edit_data->save();
                
                return View::forge('kakeibo/editForm', $data);
                exit;
            }
            else{    #失敗の場合の処理
                foreach($val->error() as $key => $value){
                    echo $value->get_message();
                }
                exit;
            }
            }
        return View::forge('kakeibo/editForm', $data);
    }



    //詳細画面
    public function action_detail($category_id)
    {
        $userid = Session::get('userid');
        $posts = Model_Record::find('all', array(
            'related' => array(
                'category_name', //リレーションの設定名
                'login',
            ),
            'order_by' => array('date' => 'desc'),
            
            'where' => array(
                array('category_id' , $category_id),
                array('user_id' => $userid),
            ),
            
        ));
        $total = Arr::sum($posts, 'amount');
        $data = array(
            'posts' => $posts,
            'total' => $total,
        );
        //echo '<pre>';
        //print_r($posts);
        //echo '</pre>';
            return View::forge('kakeibo/detail', $data);
    } 

    //削除画面
    public function action_delete($id)
    {
        $post = Model_Record::find($id); // 対象のレコードを取得
        if ($post) {
            // レコードが見つかった場合の処理
            // 削除
            $post->delete();
            Session::set_flash('success', 'Deleted');
        } else {
            // レコードが見つからなかった場合の処理
            Session::set_flash('error', 'Record not found');
        }
        Response::redirect('/kb/kakeibo/index'); // 削除後に一覧画面にリダイレクト


    }
    public function action_logout(){
        //ログイン用のオブジェクト生成
        $auth = Auth::instance();
        Auth::logout();
        Session::delete('userid');
        Response::redirect('/kb/login/login');
    }


}
    

?>