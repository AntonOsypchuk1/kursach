<?php

namespace controllers;

use core\Controller;
use core\Core;
use models\Order;
use models\User;

class AdminController extends Controller
{
    public function indexAction()
    {
        if (!User::isAdmin())
            return $this->render(403);
        $user = User::getCurrentAuthenticatedUser();
        return $this->render(null, [
            'user' => $user
        ]);
    }

    public function usersAction()
    {
        if (!User::isAdmin())
            return $this->render(403);
        $users = User::getAllUsers();
        return $this->render(null, [
            'users' => $users
        ]);
    }

    public function ordersAction()
    {
        if (!User::isAdmin())
            return $this->render(403);
        $orders = Order::getAllOrders();
        return $this->render(null, [
            'orders' => $orders
        ]);
    }

    public function orderDeleteAction($params)
    {
        if (!User::isAdmin())
            return $this->render(403);
        $order_id = $params[0];
        $boolDel = $params[1];
        $order = Order::getOrderById($order_id);
        if ($boolDel == 'yes') {
            Order::deleteOrder($order_id);
            return $this->redirect('/admin/orders');
        }
        return $this->render(null, [
            'order' => $order
        ]);
    }

    public function orderEditAction($params)
    {
        if (!User::isAdmin())
            return $this->render(403);
        $order_id = $params[0];
        $order = Order::getOrderById($order_id);
        if (Core::getInstance()->requestMethod === 'POST') {
            $errors = [];
            $_POST['firstname'] = trim($_POST['firstname']);
            $_POST['lastname'] = trim($_POST['lastname']);
            if (empty($_POST['firstname']))
                $errors['firstname'] = 'This field cannot be empty';
            if (empty($_POST['lastname']))
                $errors['lastname'] = 'This field cannot be empty';
            if (empty($_POST['user_email']))
                $errors['user_email'] = 'This field cannot be empty';
            if (!filter_var($_POST['user_email'], FILTER_VALIDATE_EMAIL))
                $errors['user_email'] = 'Error occurred while entering email';
            if (empty($_POST['address']))
                $errors['address'] = 'Please enter your shipping address';
            if (empty($_POST['country']))
                $errors['country'] = 'This field cannot be empty';
            if (empty($_POST['city']))
                $errors['city'] = 'This field cannot be empty';
            if (empty($_POST['zip']))
                $errors['zip'] = 'Postal code required';
            if (!empty($errors)) {
                $model = $_POST;

                return $this->render(null, [
                    'errors' => $errors,
                    'model' => $model,
                    'order' => $order
                ]);
            } else {
                $_POST['address'] = [
                    'firstname' => $_POST['firstname'],
                    'lastname' => $_POST['lastname'],
                    'address' => $_POST['address'],
                    'country' => $_POST['country'],
                    'city' => $_POST['city'],
                    'zip' => $_POST['zip']
                ];
                Order::updateOrder($_POST, $order_id);
                return $this->redirect('/admin/orders');
            }
        }
        return $this->render(null, [
            'order' => $order
        ]);
    }
}