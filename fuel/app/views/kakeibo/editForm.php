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
      <?php endforeach; ?>
      
      <?php $pre_id = 0 ?>
      <?php foreach ($posts as $post): ?>
        <?php if($post->category_id != $pre_id): ?>
          <div class="return">
            <td ><a href="/kb/kakeibo/detail/<?php echo $post->category_id; ?>">戻る</a></td>
          </div>
            <?php $pre_id = $post->category_id ?>
        <?php endif; ?>
      <?php endforeach; ?>
  <?php
    if (isset($_POST['send'])) {
    // 保存ボタンが押された場合の処理を行う

    // 保存処理が成功したら詳細画面にリダイレクト
    Response::redirect('/kb/kakeibo/index/' . $post->category_id);
    exit;
    }
  ?>
</div>

    <script type='text/javascript'  src="http://ajax.aspnetcdn.com/ajax/knockout/knockout-3.5.0.js"></script>
    <?php echo Asset::js('kakeibo.js'); ?>

</body>
</html>

