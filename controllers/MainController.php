<?php

namespace controllers;

use core\Controller;
use models\Category;
use models\Product;

class MainController extends Controller
{
    public function indexAction() {
        $products = Product::getProducts();
        $categories = Category::getCategories();
        return $this->render(null, [
            'products' => $products,
            'categories' => $categories
        ]);
    }
    public function errorAction($code) {
        switch ($code) {
            case 404:
                return $this->render('views/main/error-404.php');
            case 403:
                return $this->render('views/main/error-403.php');
        }
    }
}