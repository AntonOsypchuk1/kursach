<?php
/** @var array $product */

use core\Core;

Core::getInstance()->pageParams['title'] = 'Delete product';
?>

<div class="w-100">
    <div class="col-4 alert alert-warning mt-5 m-auto" role="alert">
        <h4 class="alert-heading">Are you sure you want to delete that product?</h4>
        <p>Product name: <b><?=$product['name']?></b></p>
        <p> <i> Warning: if you delete a product, it would be done forever.</i></p>
        <hr>
        <div>
            <a href="/product/delete/<?=$product['id'] ?>/yes" class="btn btn-danger">Delete</a>
            <a href="/product" class="btn btn-light">Cancel</a>
        </div>
    </div>
</div>

