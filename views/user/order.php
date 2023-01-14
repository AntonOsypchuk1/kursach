<?php
/** @var string|null $error */
/** @var array $user */
/** @var array $orders */

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
                <a href="/user/address" class="list-group-item list-group-item-action py-3 lh-sm" id="list-group-item"
                   aria-current="false">
                    <div class="d-flex w-100 align-items-center justify-content-between">
                        <strong class="mb-1">Address</strong>
                    </div>
                    <div class="col-10 mb-1 small">Here is your current address to make orders</div>
                </a>
                <a href="#" class="list-group-item list-group-item-action active py-3 lh-sm" id="list-group-item"
                   aria-current="true">
                    <div class="d-flex w-100 align-items-center justify-content-between">
                        <strong class="mb-1">Orders</strong>
                    </div>
                    <div class="col-10 mb-1 small">Here is a list of your orders</div>
                </a>
            </div>
        </div>

        <div class="data col-9">
            <div class="orders mt-5">
                <?php if (empty($orders)) : ?>
                    <div class="text-center">
                        <h5 class="text-center">You have no orders yet.</h5>
                        <a href="/product/" class="btn btn-primary mt-3">Go shopping!</a>
                    </div>
                <?php else : ?>
                    <div class="row">
                        <div class="col">
                            <h5>Your orders</h5>
                        </div>
                        <div class="col-12">
                            <table class="table">
                                <caption>List of orders</caption>
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Order date</th>
                                    <th>Delivery date</th>
                                    <th>Address</th>
                                    <th>Status</th>
                                    <th>Total, USD</th>
                                    <th>Products</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $index = 1; ?>
                                <?php foreach ($orders as $order) : ?>
                                    <tr class="border-bottom-0">
                                        <td class="border-bottom-0"><?= $index ?></td>
                                        <td class="border-bottom-0"><?= date("Y-m-d", strtotime($order['date_order'])) ?></td>
                                        <td class="border-bottom-0">
                                            <?php
                                            if (empty($order['date_delivery']))
                                                echo 'In process';
                                            else
                                                echo date("Y-m-d", strtotime($order['date_delivery']));
                                            ?>
                                        </td>
                                        <td class="border-bottom-0">
                                            <?= $order['address']['country'] ?>,
                                            <?= $order['address']['city'] ?>,
                                            <?= $order['address']['address'] ?>
                                        </td>
                                        <td class="border-bottom-0"><?= $order['status'] ?></td>
                                        <td class="border-bottom-0">$<?= $order['total_price'] ?></td>
                                        <td class="button-collapse border-bottom-0">
                                            <button class="btn btn-light" type="button"
                                                    data-bs-toggle="collapse"
                                                    data-bs-target="#collapseProducts<?=$index?>"
                                                    aria-expanded="false"
                                                    aria-controls="collapseProducts<?=$index?>">
                                                See more
                                            </button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="7" class="border-top-0">
                                            <div class="collapse" id="collapseProducts<?=$index?>">
                                                <div class="card card-body">
                                                    <table class="table">
                                                        <caption>List of products</caption>
                                                        <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Image</th>
                                                            <th>Name</th>
                                                            <th>Price, USD</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <?php $index_product = 1; ?>
                                                        <?php foreach ($order['cart'] as $row) : ?>
                                                            <tr>
                                                                <td><?= $index_product ?></td>
                                                                <td class="img text-center">
                                                                    <div class="rounded-1 border-1 d-block p-1"
                                                                         style="border: 1px solid grey;">
                                                                        <?php if ($row['product']['photo']) : ?>
                                                                            <img src="/files/product/<?= $row['product']['photo'] ?>"
                                                                                 height="70"
                                                                                 style="background-clip: content-box;
                                                                        transform: rotate(-35deg);
                                                                        width: auto;"
                                                                                 class="text-end p-2 rounded-1" alt="">
                                                                        <?php else : ?>
                                                                            <svg xmlns="http://www.w3.org/2000/svg" width="50"
                                                                                 height="50"
                                                                                 fill="lightgrey"
                                                                                 class="icon-category" viewBox="0 0 16 16">
                                                                                <path d="M6.002 5.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z"/>
                                                                                <path d="M1.5 2A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-13zm13 1a.5.5 0 0 1 .5.5v6l-3.775-1.947a.5.5 0 0 0-.577.093l-3.71 3.71-2.66-1.772a.5.5 0 0 0-.63.062L1.002 12v.54A.505.505 0 0 1 1 12.5v-9a.5.5 0 0 1 .5-.5h13z"/>
                                                                            </svg>
                                                                        <?php endif; ?>
                                                                    </div>
                                                                </td>
                                                                <td class="info">
                                                                    <strong><?= $row['product']['name'] ?></strong>
                                                                </td>
                                                                <td class="price">
                                                                    <strong>$<?= $row['product']['price'] ?></strong>
                                                                </td>
                                                            </tr>
                                                            <?php $index_product++; ?>
                                                        <?php endforeach; ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
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
</div>