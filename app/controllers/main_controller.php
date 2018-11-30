<?php

class Main_Controller extends Controller {

    function action_index($data = null) {
        $this->view->generate('main_view.php', 'template_view.php',$data);
    }

    function action_login() {
        $data = $_POST;
        $errors = array();
        if (isset($data['do_signin'])) {
            $user = R::findOne('users', "login = ?", array($data['login']));
            if ($user) {
                if (password_verify($data['password'], $user->password)) {
                    $_SESSION['logged_user'] = $user;
                    header('Location: /tasklist');
                } else {
                    $errors[] = 'Неверный пароль';
                }
            } else {
                $errors[] = 'Пользователь с таким логином не найден!';
            }
        }

        if (!empty($errors)) {
            echo '<div style="color: red;">' . array_shift($errors) .
            '</div><hr>';
        }

        $this->action_index($data);
    }

}

?>