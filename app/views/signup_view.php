<form action="/signup/registration" method="POST">
    <p> <strong>Ваш логин</strong>:</p>
    <input type="text" name="login" value="<?php echo $data['login']; ?>">
    <p> <strong>Ваш e-mail</strong>:</p>
    <input type="email" name="email" value="<?php echo $data['email']; ?>">

    <p> <strong>Ваша роль</strong>:</p>
    <select name="role">
        <?php
        $roles = R::findAll('roles');
        foreach ($roles as $role) {
            echo '<option value="' . $role->role_name . '">' . $role->role_name . '</option>';
        }
        ?>
    </select>

    <p>  <strong>Ваш пароль</strong>:</p>
    <input type="password" name="password">

    <p>  <strong>Введите пароль повторно</strong>:</p>
    <input type="password" name="password_сonfirm">
    <p>
        <button type="submit" name="do_signup">Зарегистрироваться</button>
    </p>
</form>
