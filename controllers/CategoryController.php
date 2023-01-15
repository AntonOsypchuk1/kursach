<?php

namespace controllers;

use core\Controller;
use core\Core;
use models\Category;
use models\Product;
use models\User;

class CategoryController extends Controller
{
    public function indexAction()
    {
        $rows = Category::getCategories();
        $viewPath = null;
        return $this->render($viewPath, [
            'rows' => $rows
        ]);
    }

    public function addAction()
    {
        if (!User::isAdmin())
            return $this->error(403);
        if (Core::getInstance()->requestMethod === 'POST') {
            $errors = [];
            $_POST['name'] = trim($_POST['name']);
            if (empty($_POST['name']))
                $errors['name'] = 'This field cannot be empty.';
            if (empty($errors)) {
                Category::addCategory($_POST['name'], $_FILES['file']['tmp_name'], $_POST['description']);
                return $this->redirect('/category/index');
            } else {
                $model = $_POST;
                return $this->render(null, [
                    'errors' => $errors,
                    'model' => $model
                ]);
            }
        }
        return $this->render();
    }

    public function deleteAction($params)
    {
        $id = intval($params[0]);
        $flag = boolval($params[1] === 'yes');
        if (!User::isAdmin())
            return $this->error(403);
        if ($id > 0) {
            $category = Category::getCategoryById($id);
            if ($flag) {
                Category::deleteCategory($id);
                return $this->redirect('/category');
            }
            return $this->render(null, [
                'category' => $category
            ]);
        } else {
            return $this->render(404);
        }
    }

    public function editAction($params)
    {
        $id = intval($params[0]);
        if (!User::isAdmin())
            return $this->error(403);
        if ($id > 0) {
            $category = Category::getCategoryById($id);
            if (Core::getInstance()->requestMethod === 'POST') {
                $errors = [];
                $_POST['name'] = trim($_POST['name']);
                if (empty($_POST['name']))
                    $errors['name'] = 'This field cannot be empty.';
                if (empty($errors)) {
                    Category::updateCategory($id, $_POST['name'], $_POST['description']);
                    if (!empty($_FILES['file']['tmp_name']))
                        Category::changePhoto($id, $_FILES['file']['tmp_name']);
                    return $this->redirect('/category/index');
                } else {
                    $model = $_POST;
                    return $this->render(null, [
                        'errors' => $errors,
                        'model' => $model,
                        'category' => $category
                    ]);
                }
            }
            return $this->render(null, [
                'category' => $category
            ]);
        } else {
            return $this->render(404);
        }
    }

    public function viewAction($params)
    {
        $id = intval($params[0]);
        $category = Category::getCategoryById($id);
        $products = Product::getProductsInCategory($id);
        return $this->render(null, [
            'category' => $category,
            'products' => $products
        ]);
    }
}