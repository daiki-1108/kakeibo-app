<?php

use \Model\Record;

class Controller_Kb_Kakeibo extends Controller
{
    public function before(){
        parent::before();
        
        //未ログイン時、ログインページリダイレクト
        if(!Auth::check()){
           Response::redirect('/kb/login/login');
        }
        $userid = Session::get('userid');
    }
    
    //トップ画面
    public function action_index()
    {
        $userid = Session::get('userid');
        $All_Total = Model_Record::getTotalAmount($userid);
        $posts = Model_Record::find('all', array(
			'order_by' => array('category_id' => 'asc'),
			'where' => array(
                'user_id' => $userid,
                'deleted_at' => null,
            ),
		));
        $category_totals = array();
        $All_Total = 0;
        Config::load('define',true);
        $Max_kinds = Config::get('define.kinds');
        for($i = 0; $i < $Max_kinds; $i++){
            $categorys = Model_Record::find('all', array(
                'where' => array(
                    'category_id' => $i,
                    'user_id' => $userid,
                    'deleted_at' => null,
                )
            ));
            $total = Arr::sum($categorys, 'amount');
            $category_totals[$i] = $total;
            $All_Total += $total;
        }
       
        $category_name = Config::get('define.category_name');
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
        Config::load('define',true);
        $Max_kinds = Config::get('define.kinds');
        $category_name = Config::get('define.category_name');
        $data = array(
            'Max_kinds' => $Max_kinds,
            'category_name' => $category_name,
        );
        return View::forge('kakeibo/createForm', $data);
    }
    public function post_createForm()
    {
        $userid = Session::get('userid');
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

            return View::forge('kakeibo/createForm');
            Response::redirect('/kb/kakeibo/index');
        }
        else{    #失敗の場合の処理
            Response::redirect('/kb/kakeibo/createForm'); 
        }
    }


    //編集画面
    public function action_editForm($id)
    {
        $userid = Session::get('userid');
        $posts = Model_Record::find('all', array(
            'order_by' => array('category_id' => 'asc'),
            'where' => array(
                'id' => $id, 
                'user_id' => $userid,
            ),
        ));
        $data = array(
            'category_name' => $category_name,
        );
        return View::forge('kakeibo/editForm', $data);
    }

    public function post_editForm($id)
    {
        $userid = Session::get('userid');
        $val = Validation::forge();
        $val->add_field('date', '日付', 'required');#1=フィールド名、２＝日本語名、３＝ルール
        $val->add_field('amount', '金額', 'required');
                if($val->run()){
                #echo '成功';  #成功したとき
                //値設定
                $edit_data = Model_Record::find('all', array(    
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
                Response::redirect('/kb/kakeibo/index/' . $post->category_id);
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
        $userid = Session::get('userid');
        $posts = Model_Record::find('all', array(
            'order_by' => array('date' => 'desc'),
            'where' => array(
                'category_id' => $category_id,
                'user_id' => $userid,
                'deleted_at' => null,
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
        $userid = Session::get('userid');
        $post = Model_Record::find($id);
        if($post){
            $post->delete();
        }
        Response::redirect('/kb/kakeibo/index'); // 削除後に一覧画面にリダイレクト
    }

    public function action_logout(){
        //ログイン用のオブジェクト生成
        $userid = Session::get('userid');
        $auth = Auth::instance();
        if(Auth::check()){
            Auth::logout();
            Session::delete('userid');
            Response::redirect('/kb/login/login');
        }else{
            Response::redirect('/kb/login/login');
        }
    }


}
    

?>