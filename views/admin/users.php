<?php
/** @var string|null $error */
/** @var array $users */

core\Core::getInstance()->pageParams['title'] = 'Admin page';
?>

<div class="container">
    <div class="row">
        <div class="col">
            <div class="list-group list-group-flush border-bottom scrollarea">
                <a href="/admin" class="list-group-item list-group-item-action py-3 lh-sm" id="list-group-item"
                   aria-current="true">
                    <div class="d-flex w-100 align-items-center justify-content-between">
                        <strong class="mb-1">Information</strong>
                    </div>
                    <div class="col-10 mb-1 small">Info about its acc</div>
                </a>
                <a href="#" class="list-group-item list-group-item-action active py-3 lh-sm" id="list-group-item"
                   aria-current="false">
                    <div class="d-flex w-100 align-items-center justify-content-between">
                        <strong class="mb-1">Users</strong>
                    </div>
                    <div class="col-10 mb-1 small">List of all users</div>
                </a>
                <a href="/admin/orders" class="list-group-item list-group-item-action py-3 lh-sm" id="list-group-item"
                   aria-current="false">
                    <div class="d-flex w-100 align-items-center justify-content-between">
                        <strong class="mb-1">Orders</strong>
                    </div>
                    <div class="col-10 mb-1 small">List of all orders</div>
                </a>
            </div>
        </div>

        <div class="col-9 mt-5">
            <?php if (empty($users)) : ?>
                <div class="text-center">
                    <h5 class="text-center">No users were found.</h5>
                </div>
            <?php else : ?>
                <div class="row">
                    <div class="col">
                        <h5>Users</h5>
                    </div>
                    <div class="col-12">
                        <table class="table">
                            <thead>
                            <tr>q
                                <th>#</th>
                                <th>Email</th>
                                <th>Name</th>
                                <th>Surname</th>
                                <th>Access</th>
                                <th></th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $index = 1; ?>
                            <?php foreach ($users as $user) : ?>
                                <tr>
                                    <td><?= $index ?></td>
                                    <td><?= $user['login'] ?></td>
                                    <td><?= $user['firstname'] ?></td>
                                    <td><?= $user['lastname'] ?></td>
                                    <td>
                                        <form action="" method="post">
                                            <?php if ($user['access_level'] == '10') : ?>
                                                <button class="btn btn-outline-danger">Disable rights</button>
                                            <?php elseif ($user['access_level'] == '1'): ?>
                                                <button class="btn btn-outline-danger">Make admin</button>
                                            <?php endif; ?>
                                        </form>
                                    </td>
                                    <td>
                                        <a href="/user/delete/<?= $user['id'] ?>" class="btn btn-danger">Delete</a>
                                    </td>
                                    <td>
                                        <?php if ($user['id'] == $_SESSION['user']['id']) : ?>
                                            <span class="text-secondary"><i>#current-session</i></span>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                                <?php $index++; ?>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
