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