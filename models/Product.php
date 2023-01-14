<?php

namespace models;

use core\Core;
use core\Utils;

class Product
{
    public static $tableName = 'product';

    public static function addProduct($row, $photoPath = null)
    {
        $fileName = null;
        if (!empty($photoPath)) {
            do {
                $fileName = uniqid();
                $newPath = "files/product/{$fileName}.jpg";
            } while (file_exists($newPath));
            move_uploaded_file($photoPath, $newPath);
        }
        $fieldsList = ['name', 'category_id', 'price', 'count', 'short_description', 'description', 'visible'];
        $row = Utils::filterArray($row, $fieldsList);
        $row['photo'] = $fileName;
        Core::getInstance()->db->insert(self::$tableName, $row);
    }

    public static function deleteProduct($id)
    {
        self::deletePhotoFile($id);
        Core::getInstance()->db->delete(self::$tableName, [
            'id' => $id
        ]);
    }

    public static function updateProduct($id, $row, $photoPath = null)
    {
        if (!empty($photoPath))
            self::changePhoto($id, $photoPath);
        $fieldsList = ['name', 'category_id', 'price', 'count', 'short_description', 'description', 'visible'];
        $row = Utils::filterArray($row, $fieldsList);
        Core::getInstance()->db->update(self::$tableName, $row, [
            'id' => $id
        ]);
    }

    public static function getProductById($id)
    {
        $row = Core::getInstance()->db->select(self::$tableName, '*', [
            'id' => $id
        ]);
        if (!empty($row))
            return $row[0];
        else
            return null;
    }

    public static function getProductsInCategory($category_id)
    {
        $rows = Core::getInstance()->db->select(self::$tableName, '*', [
            'category_id' => $category_id
        ]);
        return $rows;
    }

    public static function getProducts()
    {
        $rows = Core::getInstance()->db->select(self::$tableName);
        return $rows;
    }

    public static function changePhoto($id, $newPhoto)
    {
        self::deletePhotoFile($id);
        do {
            $fileName = uniqid() . '.jpg';
            $newPath = "files/product/{$fileName}";
        } while (file_exists($newPath));
        move_uploaded_file($newPhoto, $newPath);
        Core::getInstance()->db->update(self::$tableName, [
            'photo' => $fileName
        ], [
            'id' => $id
        ]);
    }

    public static function deletePhotoFile($id)
    {
        $row = self::getProductById($id);
        $photoPath = 'files/product/' . $row['photo'];
        if (is_file($photoPath))
            unlink($photoPath);
    }
}