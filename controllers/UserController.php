<?php

class UserController
{
    public function actionRegister()
    {

        $name = '';
        $email = '';
        $password = '';
        $result = false;

        if (isset($_POST['submit'])) {
            $name = $_POST['name'];
            $email = $_POST['email'];
            $password = $_POST['password'];

            $error = false;

            if (!User::checkName($name)) {
                $error = true;
                Session::setFlashError("Name must contain more than 2 characters");
            }
            if (!User::checkEmail($email)) {
                $error = true;
                Session::setFlashError("Email is not correct");
            }
            if (!User::checkPassword($password)) {
                $error = true;
                Session::setFlashError("Password must be longer than 5 characters");
            }

            if (User::checkEmailExists($email)) {
                $error = true;
                Session::setFlashError("This email has already busy");
            }

            if ($error == false) {
                $result = User::register($name, $email, $password);
                Session::setFlash("Success");
            }

        }

        require_once (ROOT . '/views/user/register.php');
        return true;
    }

    public function actionLogin()
    {
        $email = '';
        $password = '';

        if (isset($_POST['submit'])) {
            $email = $_POST['email'];
            $password = $_POST['password'];

            $error = false;

            if (!User::checkEmail($email)) {
                $error = true;
                Session::setFlashError("Email is not correct");
            }
            if (!User::checkPassword($password)) {
                $error = true;
                Session::setFlashError("Password must be longer than 5 characters");
            }

            $userId = User::checkUserData($email, $password);

            if ($userId == false) {
                $error = true;
                Session::setFlashError("Email or password is not correct");
            }
            if ($error == false){
                User::user_login($userId);

            }
        }

        require_once (ROOT . '/views/user/login.php');
        return true;


    }
}