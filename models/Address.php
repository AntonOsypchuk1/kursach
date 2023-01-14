<?php

namespace models;

use core\Core;
use core\Utils;

class Address
{
    protected static $tableName = 'address';
    public static function addAddress($row, $user_id) {
        $fieldsList = ['firstname', 'lastname', 'country', 'city', 'address', 'zip'];
        $row = Utils::filterArray($row, $fieldsList);
        $row['user_id'] = $user_id;
        Core::getInstance()->db->insert(self::$tableName, $row);
    }
    public static function deleteAddress($id) {
        Core::getInstance()->db->delete(self::$tableName, [
            'id' => $id
        ]);
    }
    public static function updateAddress($id, $row) {
        $fieldsList = ['firstname', 'lastname', 'country', 'city', 'address'];
        $row = Utils::filterArray($row, $fieldsList);
        Core::getInstance()->db->update(self::$tableName, $row, [
            'id' => $id
        ]);
    }
    public static function getAddressByUserId($id) {
        $row = Core::getInstance()->db->select(self::$tableName, '*', [
            'user_id' => $id
        ]);
        if (!empty($row))
            return $row[0];
        else
            return null;
    }
    public static function getAddressById($id) {
        $row = Core::getInstance()->db->select(self::$tableName, '*', [
            'id' => $id
        ]);
        if (!empty($row))
            return $row[0];
        else
            return null;
    }
    public static function setAddress($row) {
        $fieldsList = ['firstname', 'lastname', 'country', 'city', 'address', 'zip'];
        $row = Utils::filterArray($row, $fieldsList);
        $_SESSION['address'] = $row;
    }
    public static function getAddress() {
        return $_SESSION['address'];
    }
}