<?php

class UsersBase {

    //метод для проверки пользователя в базе
    public static function checkUser($userName, $password) {
        //Путь к файлу
        $filePath = ROOT . '/usersDatabase/usersDb.txt';
        //Открываем файл с пользователями и паролями
        $myfile = fopen($filePath, 'r') or
                die('Unable to open file!');

        while (!feof($myfile)) {
            // Читаем по одной строке пока не достигнем конца файла
            $usersPass = fgets($myfile);
            //Разбиваем строку с помощью разделителя
            list($user, $pass) = explode("/", $usersPass);
            $pass = trim($pass);
            if (($userName == $user) and ($password == $pass)) {
                fclose($myfile);
                return true;
            }
        }
        fclose($myfile);
        return false;
    }

}
