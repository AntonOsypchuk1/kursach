<?php
/** @var string|null $error */
/** @var array $user */

core\Core::getInstance()->pageParams['title'] = 'Admin page';
?>

<div class="container">
    <div class="row">
        <div class="col">
            <div class="list-group list-group-flush border-bottom scrollarea">
                <a href="#" class="list-group-item list-group-item-action active py-3 lh-sm" id="list-group-item" aria-current="true">
                    <div class="d-flex w-100 align-items-center justify-content-between">
                        <strong class="mb-1">Information</strong>
                    </div>
                    <div class="col-10 mb-1 small">Info about its acc</div>
                </a>
                <a href="/admin/users" class="list-group-item list-group-item-action py-3 lh-sm" id="list-group-item" aria-current="false">
                    <div class="d-flex w-100 align-items-center justify-content-between">
                        <strong class="mb-1">Users</strong>
                    </div>
                    <div class="col-10 mb-1 small">List of all users</div>
                </a>
                <a href="/admin/orders" class="list-group-item list-group-item-action py-3 lh-sm" id="list-group-item" aria-current="false">
                    <div class="d-flex w-100 align-items-center justify-content-between">
                        <strong class="mb-1">Orders</strong>
                    </div>
                    <div class="col-10 mb-1 small">List of all orders</div>
                </a>
            </div>
        </div>

        <div class="data col-9">
            <div class="information mt-5 col-6">
                <h5>Hello, <?= $user['firstname'] ?>!</h5>
                <table class="table mt-3">
                    <tbody>
                    <tr><th>Email: </th><td><?=$user['login']?></td></tr>
                    <tr><th>Firstname: </th><td><?=$user['firstname']?></td></tr>
                    <tr><th>Lastname: </th><td><?=$user['lastname']?></td></tr>
                    </tbody>
                </table>
                <a href="/user/logout" class="btn btn-primary">Logout</a>
                <a href="/user/edit/<?=$user['id']?>" class="btn btn-light ms-3">Edit</a>
            </div>
        </div>
    </div>
</div>
