<?php

namespace controllers;

use core\Controller;
use core\Core;
use models\Order;
use models\User;

class AdminController extends Controller
{
    public function indexAction() {
        if (!User::isAdmin())
            return $this->render(403);
        $user = User::getCurrentAuthenticatedUser();
        return $this->render(null, [
            'user' => $user
        ]);
    }
    public function usersAction() {
        if (!User::isAdmin())
            return $this->render(403);
        $users = User::getAllUsers();
        return $this->render(null, [
            'users' => $users
        ]);
    }
    public function ordersAction() {
        if (!User::isAdmin())
            return $this->render(403);
        $orders = Order::getAllOrders();
        return $this->render(null, [
            'orders' => $orders
        ]);
    }
    public function orderDeleteAction($params) {
        if (!User::isAdmin())
            return $this->render(403);
        $order_id = $params[0];
        $order = Order::getOrderById($order_id);
        if (Core::getInstance()->requestMethod === 'POST') {
            $boolDel = $params[1];
            if ($boolDel == 'yes') {
                Order::deleteOrder($order_id);
                return $this->redirect('/admin/orders');
            }
        }
        return $this->render(null, [
            'order' => $order
        ]);
    }
    public function orderEditAction($params) {
        if (!User::isAdmin())
            return $this->render(403);
        $order_id = $params[0];
        $order = Order::getOrderById($order_id);
        if (Core::getInstance()->requestMethod === 'POST') {
            $errors = [];

        }
        return $this->render(null, [
            'order' => $order
        ]);
    }
}