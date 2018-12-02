<?php

class Signup_Controller extends Controller {

    function action_index($data = null) {
        $this->view->generate('signup_view.php', 'template_view.php', $data);
    }

    function action_registration() {
        $data = $_POST;
        if (isset($data['do_signup'])) {
            $errors = array();
            if (trim($data['login']) == '') {
                $errors[] = 'Ввелите логин!';
            }
            if (trim($data['email']) == '') {
                $errors[] = 'Ввелите e-mail!';
            }
            if ($data['password'] == '') {
                $errors[] = 'Ввелите логин!';
            }
            if ($data['password_сonfirm'] != $data['password']) {
                $errors[] = 'Повторный пароль введён не верно!';
            }
            if (R::count('users', "login = ?", array($data['login'])) > 0) {
                $errors[] = 'Пользователь с таким логином уже существует!';
            }
            if (R::count('users', "email = ?", array($data['email'])) > 0) {
                $errors[] = 'Пользователь с такой почтой уже существует!';
            }
            if (empty($errors)) {
//                $role = R::dispense('roles');
//                $role->role_name = 'Менеджер проектов'; //
//                 R::store($role);
                $user = R::dispense('users');
                $user->login = $data['login'];
                $user->email = $data['email'];
                $role = R::findOne('roles', "role_name = ?", array($data['role']));
                $user->role = $role->id;
                $user->password = password_hash($data['password'], PASSWORD_DEFAULT);
                R::store($user);
                header('Location: /main');
            } else {
                echo '<div style="color: red;">' . array_shift($errors) .
                '</div><hr>';
            }
        }
        $this->action_index($data);
    }

}
