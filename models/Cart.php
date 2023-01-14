<?php

namespace models;

class Cart
{
    public static function addProduct($product_id, $count = 1) {
        if (!is_array($_SESSION['cart']))
            $_SESSION['cart'] = [];
        $_SESSION['cart'][$product_id] += $count;
    }
    public static function getProductsInCart() {
        if (is_array($_SESSION['cart'])) {
            $result = [];
            $products = [];
            $totalPrice = 0;
            foreach ($_SESSION['cart'] as $product_id => $count) {
                $product = Product::getProductById($product_id);
                $totalPrice += $product['price'] * $count;
                $products [] = ['product' => $product, 'count' => $count];
            }
            $result['products'] = $products;
            $result['total_price'] = $totalPrice;
            return $result;
        }
        return null;
    }
    public static function changeProductsCount() {
        if (is_array($_SESSION['cart'])) {
            $i = 0;
            foreach ($_SESSION['cart'] as $product_id => $count) {
                $_SESSION['cart'][$product_id] = $_COOKIE['count'.$i];
                $i++;
            }
        }
    }
    public static function deleteProduct($id) {
        if (is_array($_SESSION['cart'])) {
            foreach ($_SESSION['cart'] as $row => $count) {
                if ($row == $id)
                    unset($_SESSION['cart'][$id]);
            }
            if (count($_SESSION['cart']) == 0) {
                unset($_SESSION['cart']);
            }
        }
    }
    public static function unsetSession() {
        unset($_SESSION['cart']);
        unset($_COOKIE['comment']);
        unset($_SESSION['address']);
        unset($_COOKIE['shipment']);
        unset($_SESSION['order_id']);
        unset($_COOKIE['count']);
    }
}