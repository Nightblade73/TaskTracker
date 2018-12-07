<link rel="stylesheet/less" type="text/css" href="../../css/tasklist-styles.less" />
<script src="//cdnjs.cloudflare.com/ajax/libs/less.js/3.9.0/less.min.js"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="../../js/script.js"></script>


<nav class="navbar navbar-light" style="background-color: #e3f2fd;">
    <a class="navbar-brand" href="#">
        <img src="/assets/brand/bootstrap-solid.svg" width="30" height="30" class="d-inline-block align-top" alt="">
        "Авторизован <?php echo $_SESSION['logged_user']->login; ?>"
    </a>
    <?php if ($_SESSION['logged_user']->role == 2): ?>
        <button id="add-task-but" type="button" class="btn btn-primary" data-toggle="modal" 
                data-target="#add-Task" data-backdrop="static" data-keyboard="false">
            Добавить задачу
        </button>
    <?php else : ?>

    <?php endif; ?>

    <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
        <div class="btn-group mr-2" role="group" aria-label="First group">
            <!--            <button type="button" class="btn btn-secondary">От А-Я</button>
                        <button type="button" class="btn btn-secondary">От Я-А</button>-->
            <button id="btnGroupDrop1" type="button" class="btn dropdown-toggle  text-white bg-primary" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Сортировка по приоритету
            </button>
            <ul class="dropdown-menu">
                <a href="#" class="dropdown-item priority-filter" data-value="" tabIndex="-1">Все</a>
                <a href="#" class="dropdown-item priority-filter" data-value="btn-primary" tabIndex="-1">Без приоритета</a>
                <a href="#" class="dropdown-item priority-filter" data-value="btn-success" tabIndex="-1">Маленький</a>
                <a href="#" class="dropdown-item priority-filter" data-value="btn-warning" tabIndex="-1">Средний</a>
                <a href="#" class="dropdown-item priority-filter" data-value="btn-danger" tabIndex="-1">Высокий</a>
            </ul>
        </div>
    </div>
    <form class="form-inline float-right">
        <input class="form-control mr-sm-2 input-search" type="search" placeholder="Поиск" aria-label="Search">
        <button class="btn btn-outline-success my-2 my-sm-0 btn-search" type="submit">Поиск</button>
    </form>
    <a class="nav-item nav-link disabled" href="tasklist/logout">Выйти</a>
</nav>


<div class="container-fluid">
    <div class="card-deck">
        <?php

        function getRandomColor($i) {
            switch ($i) {
                case 0:
                    return ['text-white bg-primary', 'btn-primary'];
                case 1:
                    return ['text-white bg-secondary', 'btn-secondary'];
                case 2:
                    return ['text-white bg-success', 'btn-success'];
                case 3:
                    return ['text-white bg-danger', 'btn-danger'];
                case 4:
                    return ['text-white bg-warning', 'btn-warning'];
                case 5:
                    return ['text-white bg-info', 'btn-info'];
                case 6:
                    return ['bg-light', 'btn-light'];
                case 7:
                    return ['text-white bg-dark', 'btn-dark'];
            }
        }

        foreach ($_SESSION['logged_user']->sharedTasksList as $task) {
            $randColor = getRandomColor(rand(0, 7));
            echo '<div class="card ' . $randColor[0] . ' mb-3 " style="max-width: 18rem;">
                <input type="button" class="card-header btn ' . $randColor[1] . ' task" data-toggle="modal"
                data-target="#edit-Task" data-backdrop="static" data-keyboard="false" value="'
            . $task->task_name . '""/>'
            . '</div>';
        }
        ?>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="add-Task" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" action="">
                <div class="modal-body">
                    <label for="text">Имя задачи:</label>
                    <input id="task-name" type="text" class="form-control">
                </div>

                <div class="modal-footer">
                    <input id="add" class="btn btn-primary" type="button" data-dismiss="modal" value="Добавить" aria-hidden="true">
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="edit-Task" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title task-title" id="exampleModalLongTitle">Modal title</h5>

                <?php if ($_SESSION['logged_user']->role == 2): ?>
                    <button type="button" id="delete-confirm" class="btn btn-danger float-righ" data-dismiss="modal" aria-label="Close" >
                        Удалить задание?
                    </button>
                    <a id="task-del-but" class="float-right">
                        <img class="icon-delete-task" src="../../img/ic/baseline_delete_outline_black_48dp.png" aria-hidden="true"/>
                    </a> 
                <?php else : ?>

                <?php endif; ?> 
                <button type="button" id="task-close-but" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="right-form" action="">
                    <div class="form-group">
                        <label for="text">Описание задачи:</label>
                        <a id="change-desc" href="#" class="float-right">Редактировать</a>
                        <a id="cancel-desc" href="#" class="float-right" hidden>Отмена</a>
                        <textarea type="text" class="form-control" id="description" disabled="true" >

                        </textarea>
                        <input id="change-desc-submit" class="btn btn-primary float-right my-sm-0" type="reset" value="Сохранить" hidden>
                    </div>
                    <div class="form-group date">
                        <div class="form-group">
                            <label for="date">Начало:</label>
                            <input type="date" class="form-control" name="begin" disabled="true"/>
                        </div>
                        <div class="form-group">
                            <label for="date">Конец:</label>
                            <input type="date" class="form-control" name="end"/>
                        </div>
                    </div>
                    <div class="form-group priority">
                        <p>Приоритет:</p>
                        <select class="btn btn-primary priority-select" name="priority">
                            <option class="btn-primary priority-item" value="btn-primary">Нет приоритета</a>
                            <option class="btn-success priority-item" value="btn-success">Маленький</a>
                            <option class="btn-warning priority-item" value="btn-warning">Средний</a>
                            <option class="btn-danger priority-item" value="btn-danger">Высокий</a>
                        </select>
                    </div>
                    <div class="form-group members dropdown">
                        <p>Участники:</p>
                        <div class="" id="list"> 
                            <div class="dropdown-menu p-2 member-info" aria-labelledby="dropShowMemberInfo">
                                <div class="form-group">
                                    <label for="p">Имя участника:</label>
                                    <p name="login"></p>
                                    <label for="p">Почта:</label>
                                    <p name="email"></p>
                                </div>
                                <?php if ($_SESSION['logged_user']->role == 2): ?>
                                    <button type="submit" class="btn btn-danger btn-del-member">Удалить</button>  
                                <?php else : ?>

                                <?php endif; ?>
                            </div> 
                        </div>
                        <?php if ($_SESSION['logged_user']->role == 2): ?>
                            <div class="dropdown">
                                <a class="new-member" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                                   data-backdrop="static" data-keyboard="false">
                                    <img class="icon-add"src="../../img/ic/baseline_add_black_48dp.png"/>
                                </a>
                                <div class="dropdown-menu p-2" aria-labelledby="dropDownNewMember">
                                    <div class="form-group">
                                        <label for="input-name">Имя участника</label>
                                        <input id="input-name" type="text" class="form-control"  placeholder="login">
                                        <script>
                                            $("#input-name").autocomplete();
                                        </script>
                                    </div>
                                    <button type="submit" class="btn btn-primary add-new-member">Добавить</button>            
                                </div> 
                            </div>
                        <?php else : ?>

                        <?php endif; ?>
                    </div>

                </form>

                <form class="comments" action="">
                    <label for="text">Комментарии:</label>

                </form>
                <form class="bottom-form" action="">
                    <div class="form-group">
                        <textarea type="text" class="form-control" id="comment"></textarea>
                        <input id="add-comment-submit" class="btn btn-primary float-right my-sm-0" type="reset" value="Отправить" >
                    </div>
                </form>

            </div>
            <!--            <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
                            <button id="" type="button" class="btn btn-primary">Добавить задачу</button>
                        </div>-->
        </div>
    </div>
</div>

