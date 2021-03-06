<?php

class SiteController
{
    public function actionIndex()
    {
        $categories = [];
        $categories = Category::getCategoriesList();

        $latestProducts = [];
        $latestProducts = Product::getLatestProducts(3);

        require_once(ROOT.'/views/site/index.php');
        return true;
    }

    public function actionContact()
    {
        $userEmail = '';
        $userText = '';
        $result = false;

        if (isset($_POST['submit'])) {
            $userEmail = $_POST['userEmail'];
            $userText = $_POST['userText'];

            $error = false;

            if (!User::checkEmail($userEmail)) {
                $error = true;
                Session::setFlashError("Email is not correct");
            }

            if ($error == false) {
                $adminEmail = 'si4ka@ukr.net';
                $message = "Text: '{$userText}'. From '{$userEmail}'";
                $subject = "Тема письма";
                $result = mail($adminEmail,$subject,$message);
                $result = true;
                Session::setFlash('Сообщение отправлено! Мы ответим Вам на указанный email.');
            }
        }

        require_once (ROOT.'/views/site/contact.php');

        return true;
    }
}