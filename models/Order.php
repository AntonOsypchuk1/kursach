<?php

namespace models;

use core\Core;
use core\Utils;

class Order
{
    public static $tableName = 'custom';

    public static function makeOrder($user_email, $total_price, $cart, $address, $shipment, $comment = null, $user_id = null)
    {
        $shipmentType = 'Not set';
        if ($shipment == '15')
            $shipmentType = 'Standard';
        else if ($shipment === '25')
            $shipmentType = 'Expedited';

        $ids = Core::getInstance()->db->select(self::$tableName, 'id');
        do {
            $generated_id = random_int(1111, 9999);
        } while (in_array($generated_id, $ids));
        Core::getInstance()->db->insert(self::$tableName, [
            'id' => $generated_id,
            'user_id' => $user_id,
            'user_email' => $user_email,
            'cart' => json_encode($cart),
            'total_price' => $total_price,
            'comment' => $comment,
            'address' => json_encode($address),
            'shipment' => $shipmentType
        ]);
        return $generated_id;
    }

    public static function getOrderById($id)
    {
        return Core::getInstance()->db->select(self::$tableName, '*', [
            'id' => $id
        ]);
    }

    public static function getAllOrders()
    {
        $rows = Core::getInstance()->db->select(self::$tableName);
        for ($i = 0; $i < count($rows); $i++) {
            $rows[$i]['cart'] = json_decode($rows[$i]['cart'], true);
            $rows[$i]['address'] = json_decode($rows[$i]['address'], true);
        }
        if (!empty($rows))
            return $rows;
        else
            return null;
    }

    public static function getUserOrders($user_id)
    {
        $rows = Core::getInstance()->db->select(self::$tableName, '*', [
            'user_id' => $user_id
        ]);
        for ($i = 0; $i < count($rows); $i++) {
            $rows[$i]['cart'] = json_decode($rows[$i]['cart'], true);
            $rows[$i]['address'] = json_decode($rows[$i]['address'], true);
        }
        if (!empty($rows))
            return $rows;
        else
            return null;
    }

    public static function deleteOrder($id)
    {
        Core::getInstance()->db->delete(self::$tableName, [
            'id' => $id
        ]);
    }
}