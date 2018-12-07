<link rel="stylesheet/less" type="text/css" href="../../css/main-styles.less" />
<script src="//cdnjs.cloudflare.com/ajax/libs/less.js/3.9.0/less.min.js"></script>
<script src="../../js/main-script.js"></script>

<div class="container site-login">
    <div class="sign-in top">
        <form id="form-login" action=""> 
            <div class="form-group">
                <label for="login">Логин:</label>
                <input type="text" class="form-control" name="login"  placeholder="Логин" value="<?php echo $data['login']; ?>">
            </div>
            <div class="form-group">
                <label for="password">Пароль:</label>
                <input type="password"  name="password" class="form-control" placeholder="Password">
            </div>
            <div class="col-lg-offset-1 registration" style="color:#999;">
                <a href="/signup">Регистрация</a> 
            </div>
            <input id="btn-login" type="submit" class="btn btn-primary float-right" name="do_signin" value="Войти"/>
        </form>
        <div class="alert alert-danger" id="alert" role="alert"></div>
        <?php
//        if (isset($data['error'])) {
//            echo '<div class="alert alert-danger" role="alert">' . $data['error'] . '</div>';
//        }
        ?>
    </div>
</div>