<?php
/** @var string|null $error */
/** @var array $user */
/** @var array $address */

core\Core::getInstance()->pageParams['title'] = 'User page';
?>

<div class="container">
    <div class="row">
        <div class="col">
            <div class="list-group list-group-flush border-bottom scrollarea">
                <a href="/user/index" class="list-group-item list-group-item-action py-3 lh-sm" id="list-group-item"
                   aria-current="false">
                    <div class="d-flex w-100 align-items-center justify-content-between">
                        <strong class="mb-1">Information</strong>
                    </div>
                    <div class="col-10 mb-1 small">Here you can see and edit your acc</div>
                </a>
                <a href="#" class="list-group-item list-group-item-action active py-3 lh-sm" id="list-group-item"
                   aria-current="true">
                    <div class="d-flex w-100 align-items-center justify-content-between">
                        <strong class="mb-1">Address</strong>
                    </div>
                    <div class="col-10 mb-1 small">Here is your current address to make orders</div>
                </a>
                <a href="/user/order" class="list-group-item list-group-item-action py-3 lh-sm" id="list-group-item"
                   aria-current="false">
                    <div class="d-flex w-100 align-items-center justify-content-between">
                        <strong class="mb-1">Orders</strong>
                    </div>
                    <div class="col-10 mb-1 small">Here is a list of your orders</div>
                </a>
            </div>
        </div>

        <div class="data col-9">
            <div class="addresses mt-5">
                <div class="row w-100">
                    <div class="col">
                        <h5>Your addresses</h5>
                    </div>
                    <?php if (empty($address)) : ?>
                        <div class="col">
                            <p>You didn't have saved any addresses yet.</p>
                        </div>
                    <?php endif; ?>
                    <?php if (empty($address)) : ?>
                        <div class="col">
                            <a href="/address/add" class="btn btn-primary float-end">Add address</a>
                        </div>
                    <?php endif; ?>
                    <?php if (!empty($address)) : ?>
                        <div class="col-12">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Surname</th>
                                    <th>Address</th>
                                    <th>Zip</th>
                                    <th></th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tr>
                                    <td><?= $address['firstname'] ?></td>
                                    <td><?= $address['lastname'] ?></td>
                                    <td><?= $address['address'] ?>, <?= $address['city'] ?>
                                        , <?= $address['country'] ?></td>
                                    <td><?= $address['zip'] ?></td>
                                    <td><a href="/address/edit/<?= $address['id'] ?>">Edit</a></td>
                                    <td><a href="/address/delete/<?= $address['id'] ?>">Delete</a></td>
                                </tr>
                            </table>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>