<?php

use \Model\Record;
use \Model\Cateogry;
use \Model\User;

class Controller_Kb_Kakeibo extends Controller
{
    public function before(){
        parent::before();
        $userid = Session::get('userid');
        // キャッシュを無効化
        Response::set_cache(false);
        
        //未ログイン時、ログインページリダイレクト
        // if(!Auth::check()){
        //    Response::redirect('/kb/login/login');
        // }
    }
    
    //トップ画面
    public function action_index()
    {
        $All_Total = Model_Record::getTotalAmount($userid);
        $posts = Model_Record::find('all', array(
			'related' => array(
			'category_name',
			'login',
		),
			'order_by' => array('category_id' => 'asc'),
			'where' => array('user_id' => $userid),
		));

        $category_totals = array();
        Config::load('define');
        $Max_kinds = Config::get('kinds');
        for($i = 0; $i < $Max_kinds; $i++){
            $categorys = Model_Record::find('all', array(
                'related' => array(
                    'category_name',
                    'login',
                ),
                'where' => array(
                    'category_id' => $i,
                    'user_id' => $userid,
                )
            ));
            $total = Arr::sum($categorys, 'amount');
            $category_totals[$i] = $total;
        }
        //DB側でwhere=userid, groupby(category), select category sum(amount)で配列取得。
        Config::load('define',true);
        $category_name = Config::get('category_name');
        $data = array(
            'posts' => $posts,
            'All_Total' => $All_Total,
            'Max_kinds' => $Max_kinds,
            'category_totals' => $category_totals,
            'category_name' => $category_name,
        );
        return Response::forge(View::forge('kakeibo/index', $data));
    }

    //新規入力画面
    public function action_createForm()
    {
        return View::forge('kakeibo/createForm', );
    }
    public function post_createForm()
    {
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
        }
        else{    #失敗の場合の処理
            Response::redirect('/kb/kakeibo/createForm'); 
        }
    }


    //編集画面
    public function action_editForm($id)
    {

        $posts = Model_Record::find('all', array(
            'related' => array(
                'category_name', 
                'login',
            ),
            'order_by' => array('category_id' => 'asc'),
            'where' => array(
                'id' => $id, 
                'user_id' => $userid,
            ),
        ));
        $data = array(
            'edit_posts' => $posts,
        );
        return View::forge('kakeibo/editForm', $data);
    }

    public function post_editForm($id)
    {
        $val = Validation::forge();
        $val->add_field('date', '日付', 'required');#1=フィールド名、２＝日本語名、３＝ルール
        $val->add_field('amount', '金額', 'required');
                if($val->run()){
                #echo '成功';  #成功したとき
                //値設定
                $edit_data = Model_Record::find('all', array(    
                    'related' => array(
                        'category_name', 
                        'login',
                    ),
                    'order_by' => array('category_id' => 'asc'),
                    'where' => array(
                        'id' => $id, 
                        'user_id' => $userid,
                    ),
                ));
                $edit_data->set(array(
                    'date' => Input::post('date'),
                    'amount' => Input::post('amount'),
                ));
                //保存
                $edit_data->save();

                return View::forge('kakeibo/editForm', $data);
            }
            else{    #失敗の場合の処理
                foreach($val->error() as $key => $value){
                    echo $value->get_message();
                }
                Response::redirect('/kb/kakeibo/editForm');
            }
    }
      
    //詳細画面
    public function action_detail($category_id)
    {
        $posts = Model_Record::find('all', array(
            'related' => array(
                'category_name',
                'login',
            ),
            'order_by' => array('date' => 'desc'),
            'where' => array(
                'category_id' => $category_id,
                'user_id' => $userid,
            ),
            
        ));
        $total = Arr::sum($posts, 'amount');
        $data = array(
            'posts' => $posts,
            'total' => $total,
        );
            return View::forge('kakeibo/detail', $data);
    } 

    //削除画面
    public function action_delete($id)
    {
        $posts = Model_Record::find('all', array(    // 対象のレコードを取得
            'related' => array(
                'category_name', 
                'login',
            ),
            'order_by' => array('category_id' => 'asc'),
            'where' => array(
                'id' => $id, 
                'user_id' => $userid,
            ),
        ));
        if($posts){
            if ($posts->user_id == $userid) {
                // レコードが見つかった場合の処理
                // 削除
                $posts->delete();
                Session::set_flash('success', 'Deleted');
            } 
        }else {
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