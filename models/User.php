<?php

class User
{
    public static function register($name, $email, $password)
    {
        $db = Db::getConnection();

        $sql = 'INSERT INTO user (name, email, password) VALUES (:name, :email, :password)';
        $result = $db->prepare($sql);
        $result->bindParam(':name', $name, PDO::PARAM_STR);
        $result->bindParam(':email', $email, PDO::PARAM_STR);
        $result->bindParam(':password', $password, PDO::PARAM_STR);

        return $result->execute();
    }

    public static function checkName($name)
    {
        if(strlen($name)>2) return true;
        return false;
    }

    public static function checkEmail($email)
    {
        if(filter_var($email, FILTER_VALIDATE_EMAIL)) return true;
        return false;
    }

    public static function checkPassword($password)
    {
        if(strlen($password >=6)) return true;
        return false;
    }

    public static function checkEmailExists($email)
    {
        $db = Db::getConnection();

        $sql = 'SELECT COUNT(*) FROM user WHERE email = :email';

        $result = $db->prepare($sql);
        $result->bindParam(':email', $email, PDO::PARAM_STR );
        $result->execute();

        if ($result->fetchColumn()) return true;

        return false;
    }

    public static function checkUserData($email, $password)
    {
        $db = Db::getConnection();

        $sql = 'SELECT * FROM user WHERE email = :email AND password = :password';

        $result = $db->prepare($sql);
        $result->bindParam(':email', $email, PDO::PARAM_INT);
        $result->bindParam(':password', $password, PDO::PARAM_INT);

        $result->execute();

        $user = $result->fetch();
        if ($user) return $user['id'];

        return false;

    }

    public static function user_login($userId)
    {
        $userId = intval($userId);
        $db = Db::getConnection();
        $result = $db->query('SELECT name FROM user WHERE id='.$userId);
        $result->setFetchMode(PDO::FETCH_ASSOC);

        $name = $result->fetch();

        Session::set('userId', $userId);
        Session::set('login', $name);
        Router::redirect('/catalog/');
    }

    public static function user_logout()
    {
        Session::destroy();
        Router::redirect('/user/login/');
    }
}