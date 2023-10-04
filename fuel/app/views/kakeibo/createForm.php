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
                <option value="1">食費</option>
                <option value="2">交通費</option>
                <option value="3">趣味</option>
                <option value="4">日用品</option>
                <option value="5">交際費</option>
                <option value="6">衣服・美容</option>
                <option value="7">その他</option>
            </select>
          <br>
        </div>
     
        <p class="submitbutton"><input type="submit" value="送信" name="send"></p><!-- 送信ボタン -->
        <div class="return">
          <td><a href="/kb/kakeibo/index">戻る</a></td>
        </div>
    </form>
    

              <?php
                  if (isset($_POST['send'])) {
                  // 保存ボタンが押された場合の処理を行う

                  // 保存処理が成功したら詳細画面にリダイレクト
                 header("Location: /kb/kakeibo/index/");
               exit;
                 }
              ?>
  </div>    

  <script type='text/javascript'  src="http://ajax.aspnetcdn.com/ajax/knockout/knockout-3.5.0.js"></script>
    <?php echo Asset::js('kakeibo.js'); ?>
    
</body>
</html>