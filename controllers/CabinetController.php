<?php

class CabinetController
{
    public function actionIndex()
    {
        require_once (ROOT . '/views/cabinet/index.php');

        return true;
    }

    public function actionExit()
    {
        Session::destroy();
        Router::redirect('/');
    }
}