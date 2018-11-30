<?php

class Tasklist_Controller extends Controller {

    function action_index($data = null) {
        $this->view->generate('tasklist_view.php', 'template_view.php', $data);
    }
    
    function action_logout() {
        unset($_SESSION['logged_user']);
        header('Location: /');
    }
}
