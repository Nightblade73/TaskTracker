<!--<form action="/signup/registration" method="POST">
    <p> <strong>Ваш логин</strong>:</p>
    <input type="text" name="login" value="<?php echo $data['login']; ?>">
    <p> <strong>Ваш e-mail</strong>:</p>
    <input type="email" name="email" value="<?php echo $data['email']; ?>">

    <p> <strong>Ваша роль</strong>:</p>
    <select name="role">
        <?php
//        $roles = R::findAll('roles');
//        foreach ($roles as $role) {
//            echo '<option value="' . $role->role_name . '">' . $role->role_name . '</option>';
//        }
        ?>
    </select>

    <p>  <strong>Ваш пароль</strong>:</p>
    <input type="password" name="password">

    <p>  <strong>Введите пароль повторно</strong>:</p>
    <input type="password" name="password_сonfirm">
    <p>
        <button type="submit" name="do_signup">Зарегистрироваться</button>
    </p>
</form>-->

<link rel="stylesheet/less" type="text/css" href="../../css/signup-styles.less" />
<script src="//cdnjs.cloudflare.com/ajax/libs/less.js/3.9.0/less.min.js"></script>
<script src="../../js/signup-script.js"></script>

<div class="container registration">
    <div class="sign-up top">
        <form id="form-sign-up"> 
            <div class="form-group">
                <label for="login">Ваш логин:</label>
                <input type="text" class="form-control" name="login"  placeholder="Логин" value="<?php echo $data['login']; ?>">
            </div>
            <div class="form-group">
                <label for="login">Ваш e-mail:</label>
                <input type="email" class="form-control" name="email"  placeholder="email" value="<?php echo $data['login']; ?>">
            </div>
            <div class="form-group">
                <label for="role">Ваша роль:</label>
                <select class="form-control" name="role">
                    <?php
                    $roles = R::findAll('roles');
                    foreach ($roles as $role) {
                        echo '<option value="' . $role->role_name . '">' . $role->role_name . '</option>';
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="password">Ваш пароль:</label>
                <input type="password"  name="password" class="form-control" placeholder="Пароль">
            </div>
             <div class="form-group">
                <label for="password">Введите пароль повторно:</label>
                <input type="password"  name="password_сonfirm" class="form-control" placeholder="Повторный  пароль">
            </div>
            <input id="btn-sign-up" type="submit" class="btn btn-primary float-right" name="do_signin" value="Зарегистрироваться"/>
        </form>
        <div class="alert alert-danger" id="alert" role="alert"></div>
    </div>
</div>
