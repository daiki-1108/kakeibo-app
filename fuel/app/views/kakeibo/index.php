<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>家計簿</title>
    <?php echo Asset::css('indexstyle.css'); ?>
    <?php echo Asset::css('back.css'); ?>
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
      <div class="createform">
        <td>
          <a href="/kb/kakeibo/createForm">新規入力</a>
        </td> 
      </div>
<!-- 各カテゴリの合計額を表示 -->
<!-- 合計額はデータベースから取得する -->   
      <div id="category-totals-container"></div>

      <div id="like_button_container"></div>
  </div>   
  
      <script>
        let posts = JSON.parse('<?php echo json_encode($posts); ?>');
        let categoryTotals = JSON.parse(<?php echo json_encode($category_totals); ?>);
        console.log('posts');
      </script> 
      

  <script src="https://unpkg.com/react@18/umd/react.development.js" crossorigin></script>
  <script src="https://unpkg.com/react-dom@18/umd/react-dom.development.js" crossorigin></script>
  <?php echo Asset::js('/public/js/kakeibo.bundle.js'); ?>
  <?php echo Asset::js('/public/js/kakeibo_category.bundle.js'); ?>
  <?php echo Asset::js('like_button.jsx'); ?>
  

</body>
</html>