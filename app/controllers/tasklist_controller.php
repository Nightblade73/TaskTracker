<?php

class Tasklist_Controller extends Controller {

    function action_index($data = null) {
        $this->view->generate('tasklist_view.php', 'template_view.php', $data);
    }

    function action_logout() {
        unset($_SESSION['logged_user']);
        header('Location: /');
    }

    function action_addtask() {
        $data = $_POST;
        $task = R::dispense('tasks');
        $task->task_name = $data['name'];
        $task->date_begin = date("Y-m-d");
        $task->date_end = date("Y-m-d");
        R::store($task);
        echo $data['name'];
        //    return true;
    }

    function action_changetaskdescription() {
        $data = $_POST;
        $task = R::findOne('tasks', "task_name = ?", array($data['name']));
        $task->description = $data['desc'];
        R::store($task);
        echo true;
    }
    
    function action_gettaskinfo() {
        $data = $_POST;
        $task = R::findOne('tasks', "task_name = ?", array($data['name']));
        echo $task;
    }
}
