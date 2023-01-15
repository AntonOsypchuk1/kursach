<?php

namespace controllers;

use core\Controller;
use core\Core;
use models\Address;
use models\Cart;
use models\Order;
use models\User;

class CartController extends Controller
{
    public function indexAction($params)
    {
//        $input = '';
//        foreach ($_COOKIE as $cookie) {
//            $input .= $cookie;
//        }
//        preg_match_all('/cookie[0-9]]/', strval($_COOKIE), $matches);


        if ($params[0] === 'remove') {
            $id = intval($params[1]);
            Cart::deleteProduct($id);
        }
        $cart = Cart::getProductsInCart();
        if (Core::getInstance()->requestMethod === 'POST') {
            Cart::changeProductsCount();
            return $this->redirect('/cart/information');
        }

        if (!empty($cart)) {
            return $this->render(null, [
                'cart' => $cart
            ]);
        }
        return $this->render();
    }

    public function informationAction()
    {
        $cart = Cart::getProductsInCart();
        if (empty($cart))
            return $this->redirect('/cart');
        $address = Address::getAddress();
        if (User::isUserAuthenticated()) {
            $user = User::getCurrentAuthenticatedUser();
            $id = $user['id'];
            if (empty($address))
                $address = Address::getAddressByUserId($id);
            if (Core::getInstance()->requestMethod === 'POST') {
                $errors = [];
                $_POST['firstname'] = trim($_POST['firstname']);
                $_POST['lastname'] = trim($_POST['lastname']);
                if (empty($_POST['firstname']))
                    $errors['firstname'] = 'This field cannot be empty';
                if (empty($_POST['lastname']))
                    $errors['lastname'] = 'This field cannot be empty';
                if (empty($_POST['login']))
                    $errors['login'] = 'This field cannot be empty';
                if (!filter_var($_POST['login'], FILTER_VALIDATE_EMAIL))
                    $errors['login'] = 'Error occurred while entering email';
                if (empty($_POST['address']))
                    $errors['address'] = 'Please enter your shipping address';
                if (empty($_POST['country']))
                    $errors['country'] = 'This field cannot be empty';
                if (empty($_POST['city']))
                    $errors['city'] = 'This field cannot be empty';
                if (empty($_POST['zip']))
                    $errors['zip'] = 'Postal code required';
                if ($_COOKIE['shipment'] != '15' && $_COOKIE['shipment'] != '25')
                    $errors['shipment'] = 'Shipping value does not match';
                if (!empty($errors)) {
                    $model = $_POST;
                    return $this->render(null, [
                        'errors' => $errors,
                        'user' => $user,
                        'model' => $model,
                        'cart' => $cart,
                        'address' => $address
                    ]);
                } else {
                    Address::setAddress($_POST);
                    if ($_POST['save_info'] == 'on') {
                        if (count(Address::getAddressByUserId($id)) > 0)
                            Address::updateAddress($user['id'], $_POST);
                        else
                            Address::addAddress($_POST, $user['id']);
                    }
                    $email = $user['login'];
                    $address = Address::getAddress();
                    $totalPrice = $cart['total_price'] + $_COOKIE['shipment'];
                    $shipment = $_COOKIE['shipment'];
                    $products = $cart['products'];
                    if (empty($_COOKIE['comment']))
                        $comment = null;
                    else
                        $comment = $_COOKIE['comment'];
                    $_SESSION['order_id'] = Order::makeOrder($email, $totalPrice, $products, $address, $shipment, $comment, $id);
                    return $this->redirect('/cart/success');
                }
            }
            return $this->render(null, [
                'user' => $user,
                'address' => $address,
                'cart' => $cart
            ]);
        }
        return $this->render(null, [
            'cart' => $cart
        ]);
    }

    public function successAction()
    {
        $orderId = $_SESSION['order_id'];
        Cart::unsetSession();
        return $this->render(null, [
            'order_id' => $orderId
        ]);
    }
}