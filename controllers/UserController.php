<?php

namespace controllers;

use core\Controller;
use core\Core;
use models\Address;
use models\Order;
use models\User;

class UserController extends Controller
{
    public function indexAction() {
        if (User::isUserAuthenticated()) {
            if (User::isAdmin())
                return $this->redirect('/admin');
            $user = User::getCurrentAuthenticatedUser();
            return $this->render(null, [
                'user' => $user
            ]);
        }
        return $this->redirect('/user/login');
    }
    public function addressAction() {
        if (User::isUserAuthenticated()) {
            $user = User::getCurrentAuthenticatedUser();
            $address = Address::getAddressByUserId($user['id']);
            if (!empty($address)) {
                return $this->render(null, [
                    'address' => $address
                ]);
            }
            else
                return $this->render();
        }
        return $this->render(404);
    }
    public function orderAction() {
        if (User::isUserAuthenticated()) {
            $user = User::getCurrentAuthenticatedUser();
            $orders = Order::getUserOrders($user['id']);
            return $this->render(null, [
                'orders' => $orders
            ]);
        }
        return $this->render(404);
    }
    public function registerAction() {
        if (User::isUserAuthenticated())
            $this->redirect('/');
        if (Core::getInstance()->requestMethod === 'POST') {
            $errors = [];
            if (!filter_var($_POST['login'], FILTER_VALIDATE_EMAIL))
                $errors['login'] = 'Error occurred while entering email.';
            if (User::isLoginExists($_POST['login']))
                $errors['login'] = 'This login is already taken.';
            if ($_POST['password'] != $_POST['password2'])
                $errors['password'] = 'Passwords do not match.';
            if (empty($_POST['firstname']))
                $errors['firstname'] = 'This field cannot be empty';
            if (empty($_POST['lastname']))
                $errors['lastname'] = 'This field cannot be empty';
            if (count($errors) > 0) {
                $model = $_POST;
                return $this->render(null, [
                    'errors' => $errors,
                    'model' => $model
                ]);
            }
            else {
                User::addUser($_POST['login'], $_POST['password'], $_POST['lastname'], $_POST['firstname']);
                return $this->renderView('register-success');
            }
        }
        else {
            return $this->render();
        }
    }
    public function deleteAction($params) {
        if (!User::isUserAuthenticated())
            $this->render(403);
        $user = User::getCurrentAuthenticatedUser();
        $user_id = $params[0];
        $bool_del = $params[1];
        if (!User::isAdmin())
            if ($user['id'] != $user_id)
                $this->render(403);
        if (Core::getInstance()->requestMethod === 'POST') {
            if ($bool_del === 'yes') {
                User::deleteUser($user_id);
                if (User::isAdmin())
                    return $this->redirect('/admin/users');
                return $this->redirect('/user');
            }
        }
        return $this->render();
    }
    public function editAction($params) {
        if (!User::isUserAuthenticated())
            $this->render(403);
        $user = User::getCurrentAuthenticatedUser();
        var_dump(User::getUserByLoginAndPassword($user['login'], $user['password']));
        if ($params[0] != $user['id'])
            $this->render(403);
        if (Core::getInstance()->requestMethod === 'POST') {
            $errors = [];
            if (empty($_POST['firstname']))
                $errors['firstname'] = 'This field cannot be empty';
            if (empty($_POST['lastname']))
                $errors['lastname'] = 'This field cannot be empty';
            if (count($errors) > 0) {
                $model = $_POST;
                return $this->render(null, [
                    'errors' => $errors,
                    'model' => $model
                ]);
            }
            else {
                User::updateUser($user['id'], $_POST);
                $user = User::getUserByLoginAndPassword($user['login'], $user['password']);
                User::authenticateUser($user);
                return $this->redirect('/user');
            }
        }
        else {
            return $this->render(null, [
                'user' => $user
            ]);
        }
    }
    public function loginAction() {
        if (User::isUserAuthenticated())
            $this->redirect('/');
        if (Core::getInstance()->requestMethod === 'POST') {
            $user = User::getUserByLoginAndPassword($_POST['login'], $_POST['password']);
            $error = null;
            if (empty($user)) {
                $error = 'False login or password.';
            }
            else {
                User::authenticateUser($user);
                $this->redirect('/');
            }
        }
        return $this->render(null, [
            'error' => $error
        ]);
    }
    public function logoutAction() {
        User::logoutUser();
        $this->redirect('/user/login');
    }
}