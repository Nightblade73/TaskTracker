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
        $task->sharedUsersList[] = $_SESSION['logged_user'];
        R::store($task);
        echo $data['name'];
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
        $users = $task->sharedUsersList;
        $comments = $task->ownCommentsList;
        foreach ($comments as $comment) {
            $user = $comment->users;
        }
        echo json_encode($task);
    }

    function action_changeenddate() {
        $data = $_POST;
        $task = R::findOne('tasks', "task_name = ?", array($data['name']));
        $task->date_end = $data['date'];
        R::store($task);
        echo $data;
    }

    function action_addcomment() {
        $data = $_POST;
        $task = R::findOne('tasks', "task_name = ?", array($data['name']));
        $comment = R::dispense('comments');
        $comment->comment = $data['comm'];
        $comment->time = time();
        $task->ownCommentsList[] = $comment;
        $_SESSION['logged_user']->ownCommentsList[] = $comment;
        R::store($task);
        R::store($_SESSION['logged_user']);
        $user = $comment->users;
        echo json_encode($comment);
    }

    function action_changepriority() {
        $data = $_POST;
        $task = R::findOne('tasks', "task_name = ?", array($data['name']));
        $task->priority = $data['prior'];
        R::store($task);
        echo $data['prior'];
    }

    function action_addnewmember() {
        $data = $_POST;
        $task = R::findOne('tasks', "task_name = ?", array($data['name']));
        $user = R::findOne('users', "login = ?", array($data['mem']));
        $task->sharedUsersList[] = $user;
        R::store($task);
        echo json_encode($data);
    }

    function action_getnonmembers() {
        $data = $_POST;
        $task = R::findOne('tasks', "task_name = ?", array($data['name']));
        $users = $task->sharedUsersList;
        $ids = [];
        foreach ($users as $user) {
            array_push($ids, $user->id);
        }
        $nonmembers = R::find('users', "id NOT IN ('".implode("','", $ids)."')");
        $nonmembers_logins = [];
        foreach ($nonmembers as $nonmember) {
            array_push($nonmembers_logins, $nonmember->login);
        }
        echo json_encode($nonmembers_logins);
    }
    
    function action_showinfomember() {
        $data = $_POST;
        $user = R::findOne('users', "login = ?", array($data['login']));
        echo json_encode($user);
    }
    
    function action_deletemember() {
        $data = $_POST;
        $user = R::findOne('users', "login = ?", array($data['login']));
        echo json_encode($user);
    }

}
