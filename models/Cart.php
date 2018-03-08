<?php

class Cart
{
    public static function addProduct($id)
    {
        $id = intval($id);

        // Пустой массив для товаров в корзине
        $productsInCart = array();

        // Если в корзине уже есть товары (они хранятся в сессии)
        if ((Session::get('products'))) {
            // То заполним наш массив товарами
            $productsInCart = Session::get('products');
        }

        // Если товар есть в корзине, но был добавлен еще раз, увеличим количество
        if (array_key_exists($id, $productsInCart)) {
            $productsInCart[$id]++;
        } else {
            // Добавляем нового товара в корзину
            $productsInCart[$id] = 1;
        }

        Session::set('products', $productsInCart);

        return self::countItems();
    }

    /**
     * Подсчет количество товаров в корзине (в сессии)
     * @return int
     */
    public static function countItems()
    {
        if (isset($_SESSION['products'])) {
            $count = 0;
            foreach ($_SESSION['products'] as $id => $quantity) {
                $count = $count + $quantity;
            }
            return $count;
        } else {
            return 0;
        }
    }

    public static function getProducts()
    {
        if (Session::get('products'))
        {
            return Session::get('products');
        }

        return false;
    }

    public static function getTotalPrice($products)
    {
        $productsInCart = self::getProducts();

        $total =0;
        if($productsInCart) {

            foreach ($products as $item) {
                $total += $item['price'] * $productsInCart[$item['id']];
            }
        }

        return $total;
    }

    public static function deleteFromCart($productId)
    {
        $productId = intval($productId);

        // Пустой массив для товаров в корзине
        $productsInCart = array();

        $productsInCart = Session::get('products');

        foreach ($productsInCart as $key => $value) {
            if ($key == $productId) {
                unset($productsInCart[$key]);
            }
        }

        Session::set('products', $productsInCart);

        return true;
    }

}