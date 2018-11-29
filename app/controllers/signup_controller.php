<?php

/**
 * Description of signup_controller
 *
 * @author v-zar
 */
class Signup_Controller extends Controller {

    function action_index() {
        $this->view->generate('signup_view.php', 'template_view.php');
    }

}
