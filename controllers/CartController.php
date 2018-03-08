<?php

class CartController
{
    public function actionAddAjax($id)
    {
        echo Cart::addProduct($id);
        return true;
    }

    public function actionIndex()
    {
        $categories = [];
        $categories = Category::getCategoriesList();

        $productsInCart = Cart::getProducts();

        if($productsInCart) {
            $productsIds = array_keys($productsInCart);

            $products = Product::getProductsByIds($productsIds);

            $totalPrice = Cart::getTotalPrice($products);
        }

        require_once (ROOT.'/views/cart/index.php');

        return true;

    }

    public function actionDelete($productId)
    {

        Cart::deleteFromCart($productId);

        Router::redirect('/cart/');
    }

}