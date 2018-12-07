<?php

class Main_Controller extends Controller {

    function action_index($data = null) {
        $this->view->generate('main_view.php', 'template_view.php', $data);
    }

    function action_login() {
        $data = $_POST;
        $errors = array();

        $user = R::findOne('users', "login = ?", array($data['login']));
        if ($user) {
            if (password_verify($data['password'], $user->password)) {
                $_SESSION['logged_user'] = $user;
                echo json_encode('/tasklist');
            } else {
                $errors[] = 'Неверный пароль';
            }
        } else {
            $errors[] = 'Пользователь с таким логином не найден!';
        }
        if (!empty($errors)) {
            $data['error'] = array_shift($errors);
            echo json_encode($data);
        }
    }
}
