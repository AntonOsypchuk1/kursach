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

    public static function updateOrder($row, $id)
    {
        $fieldsList = ['user_email', 'status', 'total_price', 'date_delivery', 'comment', 'address', 'shipment'];
        $row = Utils::filterArray($row, $fieldsList);
        $row['address'] = json_encode($row['address']);
        $row['total_price'] = floatval($row['total_price']);
        if (empty($row['date_delivery']))
            $row['date_delivery'] = null;

        Core::getInstance()->db->update(self::$tableName, $row, [
            'id' => $id
        ]);
    }

    public static function getOrderById($id)
    {
        $row = Core::getInstance()->db->select(self::$tableName, '*', [
            'id' => $id
        ]);
        if (!empty($row)) {
            $row[0]['cart'] = json_decode($row[0]['cart'], true);
            $row[0]['address'] = json_decode($row[0]['address'], true);
            return $row[0];
        } else
            return null;
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