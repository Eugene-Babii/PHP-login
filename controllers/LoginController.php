<?php

include_once ROOT . '/models/UsersBase.php';

class LoginController {

    public function actionLoginForm() {
        session_start();
        //если пользователь уже вошел, перекидываем на сраницу пользователя
        if (isset($_SESSION['username'])) {
            $userName = $_SESSION['username'];
            require_once (ROOT . '/views/userPage.php');
        } else {
            require_once (ROOT . '/views/login.php');
        }
        return true;
    }

    public function actionOpenUserPage() {
        session_start();
        //проверяем введены ли данные
        if (isset($_POST['username']) and isset($_POST['password'])) {
            $userName = htmlentities($_POST['username']);
            $password = htmlentities($_POST['password']);
            //сверяем данные с базой
            if (UsersBase::checkUser($userName, $password)) {
                $_SESSION['username'] = $userName;
                require_once (ROOT . '/views/userPage.php');
            } else {
                if ($this->limitWrongInputs()) {
                    require_once (ROOT . '/views/login.php');
                    echo '<script type="text/javascript">blockSystem();</script>';
                } else {
                    require_once (ROOT . '/views/loginError.php');
                }
            }
        } else if (!isset($_SESSION['username'])) {
            require_once (ROOT . '/views/login.php');
        } else {
            if ($this->limitWrongInputs()) {
                require_once (ROOT . '/views/protect.php');
            } else {
                require_once (ROOT . '/views/loginError.php');
            }
        }
        return true;
    }

    //удаление сессии при выходе пользователя
    public function actionLogout() {
        session_start();
        session_unset();
        session_destroy();
        header('Location: ../index.php');
        exit;
        return true;
    }

    //проверка на количество неверных входов
    public static function limitWrongInputs() {
        if ($_REQUEST['submit']) {
            if (empty($_SESSION['count'])) {
                $_SESSION['count'] = 1;
                return false;
            } else {
                $_SESSION['count']++;
                if (($_SESSION['count'] > 2)) {
                    $_SESSION['count'] = null;
                    return true;
                }
            }
        }
    }

}
