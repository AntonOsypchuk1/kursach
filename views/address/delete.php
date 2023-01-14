<?php
/** @var array $address */

use core\Core;

Core::getInstance()->pageParams['title'] = 'Delete address';
?>

<div class="w-100">
    <div class="col-4 alert alert-warning mt-5 m-auto" role="alert">
        <h4 class="alert-heading">Are you sure you want to delete that address?</h4>
        <p> <i> Warning: if you delete that address, it would be done forever.</i></p>
        <hr>
        <div>
            <a href="/address/delete/<?= $address['id'] ?>/yes" class="btn btn-danger">Delete</a>
            <a href="/user/address" class="btn btn-light">Cancel</a>
        </div>
    </div>
</div>

