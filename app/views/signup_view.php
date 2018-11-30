<form action="/signup/registration" method="POST">
    <p>
    <p> <strong>Ваш логин</strong>:</p>
    <input type="text" name="login" value="<?php echo $data['login']; ?>">
    </p>
    <p>
    <p> <strong>Ваш e-mail</strong>:</p>
    <input type="email" name="email" value="<?php echo $data['email']; ?>">
    </p>
    <p>
    <p>
    <p> <strong>Ваша роль</strong>:</p>
    <select name="role">
        <?php
        $roles = R::findAll('roles');
        foreach ($roles as $role) {
            echo '<option value="' . $role->role_name . '">' . $role->role_name . '</option>';
        }
        ?>
    </select>
</p>
<p>
<p>  <strong>Ваш пароль</strong>:</p>
<input type="password" name="password">
</p>
<p>
<p>  <strong>Введите пароль повторно</strong>:</p>
<input type="password" name="password_сonfirm">
</p>
<p>
    <button type="submit" name="do_signup">Зарегистрироваться</button>
</p>
</form>
