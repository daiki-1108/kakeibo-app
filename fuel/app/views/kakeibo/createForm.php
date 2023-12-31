<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>新規入力</title>
    <?php echo Asset::css('indexstyle.css'); ?>
    <?php echo Asset::css('back.css'); ?>
</head>
<body>
  <div class="colorchangeanime_bg">
    <h1>新規入力</h1>
    <form method="POST" action="/kb/kakeibo/createForm"> <!--送信先-->

            <!-- 日付、金額、カテゴリの入力フォームを作成 -->  
        <div class="t">
          <tr class="date">日付   </tr>
          <tr class="date"><input type="date" name="date" required data-bind="value: date"><br></tr>

          <p></p>

          <tr class="amount">金額   </tr>
          <tr class="amount"><input type="text" name="amount" required data-bind="value: amount"><br></tr> 
        </div>

        <p></p>

        <div class="t">
          <label for="category_id">カテゴリ：</label>
            <select name="category_id" required data-bind="value: category_id"> 
              <option value="0">選択してください</option>
                <?php for($i = 1; $i < $Max_kinds; $i++): ?>
                  <option value="<?php echo $i; ?>"><?php  echo $category_name[$i]; ?></option>
                <?php endfor; ?>
            </select>
          <br>
        </div>
     
        <p class="submitbutton"><input type="submit" value="送信" name="send"></p>
        <div class="return">
          <td><a href="/kb/kakeibo/index">戻る</a></td>
        </div>
    </form>
  </div>    

  <script src="https://unpkg.com/react@18/umd/react.development.js" crossorigin></script>
  <script src="https://unpkg.com/react-dom@18/umd/react-dom.development.js" crossorigin></script>

  <script>
    function KakeiboViewModel() {
    let self = this;

    self.date = ko.observable('2023/11/10');
    self.amount = ko.observable('');
    self.category_id = ko.observable('');

    self.saveForm = function () {
        let formData = {
            date: self.date(),
            amount: self.amount(),
            category_id: self.category_id()
        };
    
        $.ajax({
            type: 'POST',
            url: '/kb/kakeibo/createForm', // サーバーのエンドポイント
            data: formData,
            success: function(response) {
                // サーバーからの成功応答を処理
                console.log('保存が成功しました。', response);
                // 成功時のリダイレクトなどの処理を行う
            },
            error: function(error) {
                // エラー処理
                console.error('保存中にエラーが発生しました。', error);
            }
        });
    };
}
// ViewModel をバインド
var viewModel = new KakeiboViewModel();
ko.applyBindings(viewModel);
  </script>
</body>
</html>