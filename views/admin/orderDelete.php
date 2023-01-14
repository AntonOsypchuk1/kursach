<?php
/** @var array $order */

use core\Core;

Core::getInstance()->pageParams['title'] = 'Delete product';
?>

<div class="w-100">
    <div class="col-4 alert alert-warning mt-5 m-auto" role="alert">
        <h4 class="alert-heading">Are you sure you want to delete that order?</h4>
        <p>Order id: <b><?= $order['id'] ?></b></p>
        <p>Customer: <b><?= $order['user_email'] ?></b></p>
        <p> <i> Warning: this action cannot be undone.</i></p>
        <hr>
        <div>
            <a href="/admin/orderDelete/<?= $order['id'] ?>/yes" class="btn btn-danger">Delete</a>
            <a href="/admin/orders" class="btn btn-light">Cancel</a>
        </div>
    </div>
</div>
