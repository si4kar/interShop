<?php

Config::set('routes', array(
    'product/([0-9]+)' => 'product/view/$1',

    'catalog/page-([0-9]+)' => 'catalog/index/$1',
    'catalog' => 'catalog/index',

    'category/([0-9]+)/page-([0-9]+)' => 'catalog/category/$1/$2',
    'category/([0-9]+)' => 'catalog/category/$1',

    'cart/addAjax/([0-9]+)' => 'cart/addAjax/$1',
    'cart/delete/([0-9]+)' => 'cart/delete/$1',
    'cart' => 'cart/index',

    'user/login' => 'user/login',
    'user/register' => 'user/register',

    'cabinet/exit' => 'cabinet/exit',
    'cabinet' => 'cabinet/index',

    'contact' => 'site/contact',
    '' => 'site/index',
));


Config::set('db.host', 'localhost');
Config::set('db.user', 'root');
Config::set('db.password', '');
Config::set('db.db_name', 'phpshop');

