<?php

namespace controllers;

use core\Controller;
use core\Core;
use models\Address;
use models\User;

class AddressController extends Controller
{
    public function addAction() {
        if (!User::isUserAuthenticated())
            $this->redirect(404);
        $user = User::getCurrentAuthenticatedUser();
        if (Core::getInstance()->requestMethod === 'POST') {
            $errors = [];
            $_POST['firstname'] = trim($_POST['firstname']);
            $_POST['lastname'] = trim($_POST['lastname']);
            if (empty($_POST['firstname']))
                $errors['firstname'] = 'This field cannot be empty';
            if (empty($_POST['lastname']))
                $errors['lastname'] = 'This field cannot be empty';
            if (empty($_POST['country']))
                $errors['country'] = 'This field cannot be empty';
            if (empty($_POST['city']))
                $errors['city'] = 'This field cannot be empty';
            if (empty($_POST['address']))
                $errors['address'] = 'This field cannot be empty';
            if (empty($_POST['zip']))
                $errors['zip'] = 'This field cannot be empty';
            if (count($errors) > 0) {
                $model = $_POST;
                return $this->render(null, [
                    'errors' => $errors,
                    'model' => $model
                ]);
            }
            else {
                Address::addAddress($_POST, $user['id']);
                return $this->redirect('/user/address');
            }
        }
        return $this->render();
    }
    public function deleteAction($params) {
        if (!User::isUserAuthenticated())
            $this->redirect(404);
        $user = User::getCurrentAuthenticatedUser();
        $id = intval($params[0]);
        $flag = boolval($params[1] === 'yes');
        if ($id > 0) {
            $address = Address::getAddressById($id);
            if ($address['user_id'] != $user['id']) {
                $this->render(403);
            }
            if ($flag) {
                Address::deleteAddress($id);
                return $this->redirect('/user/address');
            }
            return $this->render(null, [
                'address' => $address
            ]);
        }
        else {
            return $this->render(404);
        }
    }
    public function editAction($params) {
        if (!User::isUserAuthenticated())
            $this->redirect(404);
        $user = User::getCurrentAuthenticatedUser();
        $address_id = $params[0];
        $address = Address::getAddressByUserId($user['id']);
        if ($user['id'] != $address['user_id'])
            $this->render(403);
        if (Core::getInstance()->requestMethod === 'POST') {
            $errors = [];
            $_POST['firstname'] = trim($_POST['firstname']);
            $_POST['lastname'] = trim($_POST['lastname']);
            if (empty($_POST['firstname']))
                $errors['firstname'] = 'This field cannot be empty';
            if (empty($_POST['lastname']))
                $errors['lastname'] = 'This field cannot be empty';
            if (empty($_POST['country']))
                $errors['country'] = 'This field cannot be empty';
            if (empty($_POST['city']))
                $errors['city'] = 'This field cannot be empty';
            if (empty($_POST['address']))
                $errors['address'] = 'This field cannot be empty';
            if (empty($_POST['zip']))
                $errors['zip'] = 'This field cannot be empty';
            if (count($errors) > 0) {
                $model = $_POST;
                return $this->render(null, [
                    'errors' => $errors,
                    'model' => $model,
                    'address' => $address
                ]);
            }
            else {
                Address::updateAddress($address_id, $_POST);
                return $this->redirect('/user/address');
            }
        }
        return $this->render(null, [
            'address' => $address
        ]);
    }
}