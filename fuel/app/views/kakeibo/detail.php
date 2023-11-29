<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php echo Asset::css('indexstyle.css'); ?>
    <?php echo Asset::css('back.css'); ?>
    <title>詳細</title>
    <?php echo \Security::js_fetch_token();?>
</head>
<body>
<div class="colorchangeanime_bg">
    <!-- タイトル -->
    <div>
        <?php $pre_id = 0 ?>
            <?php foreach ($posts as $post): ?>
                <?php if($post->category_id != $pre_id): ?>
                    <h1 class="categoryname"><?php echo $post->category_name->name; ?></h1>
                <?php $pre_id = $post->category_id ?>
            <?php endif; ?>
        <?php endforeach; ?>
    </div>
    <!-- ここにカテゴリごとの合計額を表示する -->
    <div class="alltotal">
        <td>合計額 : <?php echo $total ?>円</td>
    </div>
    <p></p>
    <!-- データ（日付と金額）を表示し、編集・削除ボタンを追加する -->
    <div>
        <table class="detail">
            <tr>
                <td>日付</td>
                <td>金額</td>
                <td>編集</td>
                <td>削除</td>
            </tr>
            <?php foreach ($posts as $post): ?>
            <tr>
                <td><?php echo date('Y/m/d', strtotime($post->date)); ?>   </td>
                <td><?php echo $post->amount; ?>円   </td>
                <td><a href="/kb/kakeibo/editForm/<?php echo $post->id ?>">編集  </a></td>
                <td><a href="/kb/kakeibo/delete/<?php echo $post->id ?>">削除  </a></td>
            </tr>
            <?php endforeach; ?>
        </table>
    </div>

    <div class="detail">
        <div data-bind="foreach: household_accounts">
            <div>
                <span data-bind="text: date"> </span>
                <span data-bind="text: amount"> 円</span>
                <span data-bind="text: memo"> </span>
                <a href="#" data-bind="click: $parent.editData">編集</a>
                <a href="#" data-bind="click: $parent.removeData">削除</a>
            </div>
        </div>
    </div>


        <!-- 新しく追加されたモーダルウィンドウ （初期は隠れている）-->
    <div id="editModal" class="modal" style="display: none;">
        <div class="modal-content">
            <form data-bind="submit: updateData">
                <label>
                    日付:
                    <input type="date" data-bind="value: dateFieldToEdit">
                </label>
                <label>
                    金額:
                    <input type="number" data-bind="value: amountFieldToEdit">
                </label>
                <label>
                    メモ：
                    <input type="text"  required data-bind="value: ">
                </label>
                <button type="submit">保存</button>
            </form>
        </div>
    </div>

    <div class="return">
        <td><a href="/kb/kakeibo/index">戻る</a></td>
    </div>
</div>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/knockout/3.5.1/knockout-latest.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


<script type="text/javascript">
    var current_token = fuel_csrf_token();
    console.log(current_token);

function AppViewModel() {
    var self = this;

    self.household_accounts = ko.observableArray(<?php echo json_encode($data); ?>);
    // 編集対象のフィールド
    self.dateFieldToEdit = ko.observable();
    self.amountFieldToEdit = ko.observable();
    self.memoFieldEdit = ko.observable();

    self.editData = function(data) {
            // 編集対象のデータをセット
            self.dateFieldToEdit(data.date);
            self.amountFieldToEdit(data.amount);
            self.memoFieldEdit(data.memo);

            // モーダルウィンドウを表示
            $('#editModal').show();

            
        };
    self.updateData = function(account) {
        $.ajax({
            url: 'http://localhost:8080/kb/api/kakeibo/update_account.json',  // 送信先URL
            type: 'POST',
            dataType: 'json',
            data: {
                'id': account.id
                'date': self.dateFieldToEdit(),
                'amount': self.amountFieldToEdit(),
                'memo': self.memoFieldEdit(),
                'fuel_csrf_token':fuel_csrf_token()
            },
        }).done(function(res){
            if(!res){ 
                $('#editModal').hide();  
            }else{
                
            }
        })
    };

    self.removeData = function(account) {
        const data = {
            'id':account.id,
            'fuel_csrf_token':fuel_csrf_token()
        };
        $.ajax({
            url:'http://localhost:8080/kb/api/kakeibo/delete_account.json',
            type:'POST',
            dataType: 'json',
            data : data,
        }).done(function(res){
            if(!res){  //res=true => false返す
                alert("削除失敗しました。")
            }else{
                self.household_accounts.remove(account); //成功時、画面から消す
            }
            console.log(res);
        })
    }
}
 
ko.applyBindings(new AppViewModel());

</script>


</body>
</html>