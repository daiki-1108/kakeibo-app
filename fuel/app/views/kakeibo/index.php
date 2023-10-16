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
    
      <table class="top_detail">
        <tr>
          <th class="category">カテゴリ</th>
          <th class="total">合計額</th>
        </tr> 
<!-- 各カテゴリの合計額を表示 -->
<!-- 合計額はデータベースから取得する -->
            <?php $pre_id = 0 ?>
            <?php foreach ($posts as $post): ?>
              <?php if($post->category_id != $pre_id): ?>
                  <tr> 
                      <td><a href="/kb/kakeibo/detail/<?php echo $post->category_id; ?>"><?php echo $post->category_name->name; ?></a></td>
                      <?php for($i = 0; $i < $Max_kinds; $i++): ?>
                        <?php if($post->category_id == $i): ?>
                          <td><?php  echo $category_totals[$i]; ?>円</td>
                        <?php endif; ?>
                      <?php endfor; ?>
                    
                  </tr>
                <?php $pre_id = $post->category_id ?> 
              <?php endif; ?>
            <?php endforeach; ?>
        </table>
        
        <div id="like_button_container"></div>
</div>   
  
  <script src="https://unpkg.com/react@18/umd/react.development.js" crossorigin></script>
  <script src="https://unpkg.com/react-dom@18/umd/react-dom.development.js" crossorigin></script>
  <?php echo Asset::js('like_button.js'); ?>

</body>
</html>