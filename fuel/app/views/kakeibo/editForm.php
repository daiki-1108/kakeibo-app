<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php echo Asset::css('indexstyle.css'); ?>
    <?php echo Asset::css('back.css'); ?>
    <title>編集</title>
</head>
<body>
<div class="colorchangeanime_bg">
      <h1>編集</h1>
      <?php $pre_id = 0 ?>
      <?php foreach ($posts as $post): ?>
      <form method="POST" action="/kb/kakeibo/editForm/<?php echo $post->id ?>"> <!--送信先-->
     
      <!-- 日付、金額、カテゴリの入力フォームを作成 -->
      <div class="t">
          <tr class="date">日付   </tr>
          <tr class="date"><input type="date" name="date" required data-bind="value: date"><br></tr>

          <p></p>

          <tr class="amount">金額   </tr>
          <tr class="amount"><input type="text" name="amount" required data-bind="value: amount"><br></tr> 
      </div>

        <!-- 送信ボタン -->
        <div class="submitbutton">
          <p><input type="submit" name='send' value="保存" ></p>
        </div>
        
      </form>

        <?php if($post->category_id != $pre_id): ?>
          <div class="return">
            <td ><a href="/kb/kakeibo/detail/<?php echo $post->category_id; ?>">戻る</a></td>
          </div>
          <?php $pre_id = $post->category_id ?>
        <?php endif; ?>
      <?php endforeach; ?>

</div>

<script src="https://unpkg.com/react@18/umd/react.development.js" crossorigin></script>
<script src="https://unpkg.com/react-dom@18/umd/react-dom.development.js" crossorigin></script>
 
  
  <script>
    function KakeiboViewModel() {
    var self = this;

    self.date = ko.observable('');
    self.amount = ko.observable('');
    self.category_id = ko.observable('');

    self.saveForm = function () {
        var formData = {
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

