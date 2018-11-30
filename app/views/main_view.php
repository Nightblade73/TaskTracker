<!DOCTYPE html>
<div class="site-login">
    <h1>Авторизация</h1>

    <p>Please fill out the following fields to login:</p>

    <form action="/main/login" method="POST">
        <p>
        <p> <strong>Логин</strong>:</p>
        <input type="text" name="login" value="<?php echo $data['login']; ?>">
        </p>
        <p>
        <p>
        <p>  <strong>Пароль</strong>:</p>
        <input type="password" name="password">
        </p>
        <p>
        <p>
            <button type="submit" name="do_signin">Войти</button>
        </p>
    </form>




    <div class="col-lg-offset-1" style="color:#999;">
        <a href="/signup">Регистрация</a> 
    </div>
</div>