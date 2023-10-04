<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <?php echo Asset::css('indexstyle.css'); ?>
    <?php echo Asset::css('back.css'); ?>
    <title>詳細</title>
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

    <div class="return">
        <td><a href="/kb/kakeibo/index">戻る</a></td>
    </div>
</div>

    <script type='text/javascript'  src="http://ajax.aspnetcdn.com/ajax/knockout/knockout-3.5.0.js"></script>
    <?php echo Asset::js('kakeibo.js'); ?>

</body>
</html>