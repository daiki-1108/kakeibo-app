<?php

class Controller_Kb_Api_Kakeibo extends Controller_Rest //api専用
{
    public function action_get_category_totals()
    {
        $userid = Session::get('userid');
        Config::load('define',true);
        $category_name = Config::get('define.category_name');
        $category_totals = array();
        $Max_kinds = Config::get('define.kinds');
        for($i = 1; $i < $Max_kinds; $i++){
            $categorys = Model_Record::find('all', array(
                'where' => array(
                    'category_id' => $i,
                    'user_id' => $userid,
                    'deleted_at' => null,
                )
            ));
            $total = Arr::sum($categorys, 'amount');
            $category_totals[] = array(
                'category_id' => $i,
                'category_name' => $category_name[$i],
                'total' => $total,
            );
        }

        $json = \Format::forge([
            'category_totals' => $category_totals,
        ])->to_json();


        return \Response::forge($json, 200, ['Content-Type' => 'application/json']);
    }


    public function action_get_category_names()
    {
        Config::load('define',true);
        $category_name_list = Config::get('define.category_name');
        
        $category_names = array();
        foreach ($category_name_list as $id => $name) {
            $category_names[] = array(
                'category_id' => $id,
                'category_name' => $name,
            );
        }
        
        $json = \Format::forge([
            'category_names' => $category_names,
        ])->to_json();

        return \Response::forge($json, 200, ['Content-Type' => 'application/json']);
    }


    public function post_insert_record_data()
    {
        if (! Security::check_token()) {
            return false;
        }
        $userid = Session::get('userid');
        $post = Input::json();
        $insert = DB::insert('record')->set(array(
            'date' => $post['date'],
            'amount' => $post['amount'],
            'category_id' => $post['selectedCategory'],
            'memo' => $post['memo'],
            'user_id' => $userid,
        ))->execute();
        
        $json = \Format::forge([
            'success' => $insert,
        ])->to_json();

        return \Response::forge($json, 200, ['Content-Type' => 'application/json']);
    }



    public function post_update_account() 
    {
        if (! Security::check_token()) {
            return false;
        }
        $post = Input::post();
        $id = $post['id'];
        $result = DB::update('record')      //updateの返り値が,削除成功したとき>１，失敗＝０、
            ->set(array(
                'date' => Input::post('date'),
                'amount' => Input::post('amount'),
                'memo' => Input::post('memo'),
            ))
            ->where('id', '=', $id)
            ->execute();
            
        $json = \Format::forge([
            'success' => $result,
        ])->to_json();

        return \Response::forge($json, 200, ['Content-Type' => 'application/json']); //apiで返す時jsonで
            
    }

    public function post_delete_account()
	{
        if (! Security::check_token()) {
            return false;
        }
        $post = Input::post();
        $id = $post['id'];
        $result = DB::update('record')      //updateの返り値が,削除成功したとき>１，失敗＝０、
            ->set(array(
                'deleted_at'  => date('Y-m-d H:i:s'),
            ))
            ->where('id', '=', $id)
            ->execute();
            
        $json = \Format::forge([
            'success' => $result,
        ])->to_json();


        return \Response::forge($json, 200, ['Content-Type' => 'application/json']); //apiで返す時jsonで
        
	}

    
}
?>