<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php if($_SESSION['logged_user']->role == 1): ?>
        Авторизован пользователь!!
        <?php else : ?>
        Авторизован менеджер!!
        <?php endif;?>
        <a href="tasklist/logout">Выйти</a>
    </body>
</html>
