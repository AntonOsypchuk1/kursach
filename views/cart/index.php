<?php
/** @var array $cart */

use core\Core;
use models\User;

Core::getInstance()->pageParams['title'] = 'Cart';
?>

<div class="container-fluid mt-5">
    <h1 class="mb-5 text-center">Cart</h1>
    <?php if (empty($cart)) : ?>
        <div class="text-center col-12">
            <p class="mb-3">Your cart is empty</p>
            <a href="/product/" class="btn btn-dark rounded-0">Start shopping</a>
        </div>
    <?php else : ?>
        <form action="" method="post" class="p-0">
            <div class="row">
                <div class="col-8">
                    <table class="cart table">
                        <thead>
                        <tr class="text-secondary">
                            <th class="col">
                                <span>PRODUCT</span>
                            </th>
                            <th class="col text-center">
                            <span>QUANTITY<span>
                            </th>
                            <th class="col text-end">
                                <span>TOTAL</span>
                            </th>
                        </tr>
                        </thead>
                        <?php $index = 0; ?>
                        <?php foreach ($cart['products'] as $row) : ?>
                            <tr class="product">
                                <td class="about row">
                                    <div class="col-3 text-center">
                                        <?php if ($row['product']['photo']) : ?>
                                            <img src="/files/product/<?= $row['product']['photo'] ?>" height="100"
                                                 class="text-end" style=" background-clip: content-box; width: auto;"
                                                 alt="">
                                        <?php else : ?>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50"
                                                 fill="lightgrey"
                                                 class="icon-category" viewBox="0 0 16 16">
                                                <path d="M6.002 5.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z"/>
                                                <path d="M1.5 2A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-13zm13 1a.5.5 0 0 1 .5.5v6l-3.775-1.947a.5.5 0 0 0-.577.093l-3.71 3.71-2.66-1.772a.5.5 0 0 0-.63.062L1.002 12v.54A.505.505 0 0 1 1 12.5v-9a.5.5 0 0 1 .5-.5h13z"/>
                                            </svg>
                                        <?php endif; ?>
                                    </div>
                                    <div class="col">
                                        <p class="text-lg-start"><?= $row['product']['name'] ?></p>
                                        <p class="text-secondary"><?= $row['product']['short_description'] ?></p>
                                        <div class="price">
                                            <strong><?= $row['product']['price'] ?> USD</strong>
                                        </div>
                                    </div>
                                </td>
                                <td class="quantity text-center">
                                    <input type="number"
                                           class="form-control"
                                           min="1" max="<?= $row['product']['count'] ?>"
                                           name="count"
                                           id="count<?= $index ?>"
                                           value="<?= $row['count'] ?>">
                                </td>
                                <td class="total text-end">
                                <span>
                                    <strong>$<?= $row['product']['price'] * $row['count'] ?></strong>
                                </span>
                                    <div class="text-end">
                                        <a href="/cart/index/remove/<?= $row['product']['id'] ?>" type="submit"
                                           class="btn link-dark border-0 text-decoration-underline p-0 mt-3">Remove</a>
                                    </div>
                                </td>
                            </tr>
                            <?php $index += 1; ?>
                        <?php endforeach; ?>
                    </table>
                </div>
                <div class="col-4">
                    <div class="total card rounded-0 p-4">
                        <div class="card-header border-0">
                            <div>
                                <span class="mb-5 border-0"><strong>TOTAL</strong></span>
                                <span class="float-end"><strong
                                            class="text-uppercase">$<?= $cart['total_price'] ?> USD</strong></span>
                            </div>
                            <p class="text-secondary mt-3">Shipping & taxes calculated at checkout</p>
                            <a href="#" class="text-secondary">Edit order note</a>
                        </div>
                        <button type="submit" class="btn border-0 text-white rounded-0" id="checkout"
                                style="background: lightsteelblue"><strong>CHECKOUT</strong></button>
                    </div>
                </div>
        </form>
    <?php endif; ?>
</div>

<script>
let arrayInput = document.getElementsByName('count');
let button = document.getElementById('checkout');

button.addEventListener('click', () => {
    for (let i = 0; i < arrayInput.length; i++) {
        document.cookie = `count${i}=${arrayInput[i].value}`;
    }
})
</script>