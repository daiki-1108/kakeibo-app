<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>家計簿</title>
    <?php echo Asset::css('indexstyle.css'); ?>
    <?php echo Asset::css('back.css'); ?>
    <?php echo Asset::css('modal.css'); ?>
    <?php echo \Security::js_fetch_token();?>
</head>
<body>
  <div class="colorchangeanime_bg">
      <h1>家計簿</h1>
      <div>
        <td class="logout">
          <a href="/kb/kakeibo/logout/">ログアウト</a>
        </td>
      </div>
      <div class="alltotal">
        <td>合計額：<?php  echo $All_Total ?>円</td>
      </div>
  
      <div id="category-totals-container"></div>
  </div>   

  <script>
    var current_token = fuel_csrf_token();
  </script> 

  <script src="https://unpkg.com/react@18/umd/react.development.js" crossorigin></script>
  <script src="https://unpkg.com/react-dom@18/umd/react-dom.development.js" crossorigin></script>
  <?php echo Asset::js('kakeibo_category.bundle.js'); ?>

</body>
</html>