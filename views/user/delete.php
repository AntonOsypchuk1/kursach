<?php
/** @var int $user_id */

use core\Core;
use models\User;

Core::getInstance()->pageParams['title'] = 'Delete address';
?>

<div class="w-100">
    <div class="col-4 alert alert-warning mt-5 m-auto" role="alert">
        <h4 class="alert-heading">Are you sure you want to delete this account?</h4>
        <p><i>Warning: this action cannot be undone</i></p>
        <hr>
        <div>
            <a href="/user/delete/<?= $user_id ?>/yes" class="btn btn-danger">Delete</a>
            <?php if(User::isAdmin()) : ?>
                <a href="/admin/users" class="btn btn-light">Cancel</a>
            <?php else : ?>
                <a href="/user/address" class="btn btn-light">Cancel</a>
            <?php endif; ?>
        </div>
    </div>
</div>
