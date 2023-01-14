<?php

namespace controllers;

use core\Controller;
use core\Core;
use Couchbase\TempFailException;
use models\Cart;
use models\Category;
use models\Product;
use models\User;

class ProductController extends Controller
{
    public function indexAction() {
        $products = Product::getProducts();
        $categories = Category::getCategories();
        return $this->render(null, [
            'products' => $products,
            'categories' => $categories
        ]);
    }
    public function addAction($params) {
        $category_id = intval($params[0]);
        if (empty($category_id))
            $category_id = null;
        $categories = Category::getCategories();
        if (!User::isAdmin())
            return $this->error(403);
        if (Core::getInstance()->requestMethod === 'POST') {
            $errors = [];
            $_POST['name'] = trim($_POST['name']);
            if (empty($_POST['name']))
                $errors['name'] = 'This field cannot be empty!';
            if (empty($_POST['category_id']))
                $errors['category_id'] = 'Please choose category for the product.';
            if (empty($_POST['price']))
                $errors['price'] = 'This field cannot be empty!';
            if ($_POST['price'] <= 0)
                $errors['price'] = 'Incorrect value in price field.';
            if ($_POST['count'] <= 0)
                $errors['count'] = 'Incorrect value in count field.';
            if (empty($errors)) {
                Product::addProduct($_POST, $_FILES['file']['tmp_name']);
                return $this->redirect('/product');
            }
            else {
                $model = $_POST;
                return $this->render(null, [
                    'errors' => $errors,
                    'model' => $model,
                    'categories' => $categories,
                    'category_id' => $category_id
                ]);
            }
        }
        return $this->render(null, [
            'categories' => $categories,
            'category_id' => $category_id
        ]);
    }
    public function viewAction($params) {
        $id = intval($params[0]);
        $product = Product::getProductById($id);

        if (Core::getInstance()->requestMethod === 'POST') {
            $count = intval($_POST['count']);
            if (!empty($params)) {
                if (empty($_POST['buy'])) {
                    if (!empty(Product::getProductById($id))) {
                        Cart::addProduct($id, $count);
                        return $this->render(null,[
                            'product' => $product
                        ]);
                    }
                }
                else {
                    if (!empty(Product::getProductById($id))) {
                        Cart::addProduct($id, $count);
                        return $this->redirect('/cart');
                    }
                }
            }
        }

        return $this->render(null, [
            'product' => $product
        ]);
    }
    public function deleteAction($params) {
        $id = intval($params[0]);
        $flag = boolval($params[1] === 'yes');
        if (!User::isAdmin())
            return $this->error(403);
        if ($id > 0) {
            $product = Product::getProductById($id);
            if ($flag) {
                Product::deleteProduct($id);
                return $this->redirect('/product');
            }
            return $this->render(null, [
                'product' => $product
            ]);
        }
        else {
            return $this->render(404);
        }
    }
    public function editAction($params) {
        $id = intval($params[0]);
        if (!User::isAdmin())
            return $this->error(403);
        if ($id > 0) {
            $product = Product::getProductById($id);
            $categories = Category::getCategories();
            if (Core::getInstance()->requestMethod === 'POST') {
                $errors = [];
                $_POST['name'] = trim($_POST['name']);
                if (empty($_POST['name']))
                    $errors['name'] = 'This field cannot be empty!';
                if (empty($_POST['category_id']))
                    $errors['category_id'] = 'Please choose category for the product.';
                if (empty($_POST['price']))
                    $errors['price'] = 'This field cannot be empty!';
                if ($_POST['price'] <= 0)
                    $errors['price'] = 'Incorrect value in price field.';
                if ($_POST['count'] <= 0)
                    $errors['count'] = 'Incorrect value in count field.';
                if (empty($errors)) {
                    Product::updateProduct($id, $_POST);
                    if (!empty($_FILES['file']['tmp_name']))
                        Product::changePhoto($id, $_FILES['file']['tmp_name']);
                    return $this->redirect('/product');
                }
                else {
                    $model = $_POST;
                    return $this->render(null, [
                        'errors' => $errors,
                        'model' => $model,
                        'product' => $product,
                        'categories' => $categories
                    ]);
                }
            }
            return $this->render(null, [
                'product' => $product,
                'categories' => $categories
            ]);
        }
        else {
            return $this->render(404);
        }
    }
}