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
<div class="container">
    <div class="row">
            <?php if (isset($error)): ?>
                <p class="alert alert-warning"><?php echo $error ?></p>
            <?php endif; ?>
            
            <?php if (Session::get_flash('message')): ?>
                <div class="row alert alert-danger">
                    <p><?php echo Session::get_flash('message') ?></p>
                </div>
            <?php endif; ?>

        <h3>ログイン画面</h3>
        <div class="new-submit">
            <a href='/kb/login/logincreateForm'>新規登録</a>
        </div>
            <?php echo Form::open(array('class' => 'form-horizontal', 'action' => '/kb/login/login', 'method' => 'post'));?>


        <div class="loginform">
            <label for="form_name" class="col-sm-4 ">ユーザ名</label>
                <div class="col-sm-8">
                    <?php echo Form::input('username');?>
                </div>
        </div>
        <div class="loginform">
            <label for="form_name" class="col-sm-4 ">パスワード</label>
                <div class="col-sm-8">
                    <?php echo Form::password('password');?>
                </div>
        </div>
        <div class="loginform">
            <div class="loginbutton">
                <?php echo Form::button('submit', 'ログイン', array('class' => 'btn btn-success'));?>
            </div>
        </div>
        <div>
            <?php echo Form::close();?>
        </div>
        
                
    </div>
</div>
</div>

</body>
</html>