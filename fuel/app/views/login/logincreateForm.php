<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php echo Asset::css('loginstyle.css'); ?>
    <?php echo Asset::css('back.css'); ?>
    <title>ログイン</title>
</head>
<body>
<div class="colorchangeanime_bg">
    <h1>新規登録</h1>
    <div class="row alert alert-danger">
        <p><?php echo Session::get_flash('message') ?></p>
    </div>
    
    <?php echo Form::open(['action' => '/kb/login/logincreateForm', 'method' => 'post']); ?>
        <div class="logincreateform">
            <label for="username">ユーザー名</label>
                <?php echo Form::input('username', null, ['id' => 'username', 'class' => 'form-controll']); ?>
        </div>
        
        <div class="logincreateform">
            <label for="password">パスワード</label>
                <?php echo Form::password('password', null, ['id' => 'password', 'class' => 'form-controll']); ?>
        </div>
        <div class="logincreateform">
            <label for="confirmation_password">確認用パスワード</label>
                <?php echo Form::password('confirmation_password', null, ['id' => 'password', 'class' => 'form-controll']); ?>
        </div>
        <div class="logincreateform">
            <?php echo form::button('submit', '送信', ['class' => 'submitbtn']); ?>
        </div>
    <?php echo Form::close(); ?>
        
    <div class="return">
        <a href='/kb/login/login'>戻る</a>
    </div>
</div>
<?php
    if (isset($_POST['submit'])) {
    // 保存ボタンが押された場合の処理を行う

    // 保存処理が成功したら詳細画面にリダイレクト
    header("Location: /kb/login/login");
    exit;
    }
?>


</body>
</html>