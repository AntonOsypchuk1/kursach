<?php
/** @var array $order */
/** @var array $model */
/** @var array $errors */

if (empty($model))
    $model = $order;

$selectOptions = ['In process', 'Accepted', 'Sent', 'Delivered'];

use core\Core;
use models\User;

Core::getInstance()->pageParams['title'] = 'Edit page';
?>

<div class="row">
    <div class="mt-5 col-5 m-auto">
        <form class="needs-validation" novalidate="" method="post" action="">
            <h5>Edit order(<?= $order['id'] ?>)</h5>
            <div class="order-form mb-3">
                <div class="col-12 form-floating mb-3">
                    <input type="email" class="form-control" id="user_email" name="user_email" value="<?= $model['user_email'] ?>"
                           placeholder="you@example.com">
                    <label for="user_email" class="form-label">Email</label>
                    <?php if (!empty($errors['user_email'])): ?>
                        <div id="nameHelp" class="form-text error"><?= $errors['user_email']; ?></div>
                    <?php endif; ?>
                </div>
                <div class="col-4 mb-3">
                    <select class="form-select" name="status" aria-label="Default select example">
                        <?php foreach ($selectOptions as $option) : ?>
                            <option value="<?= $option ?>" <?php if ($model['status'] == $option) echo 'selected'; ?>>
                                <?= $option ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-8 mb-3">
                    <select class="form-select" name="shipment" id="shipment" aria-label="Default select example">
                        <option value="Standard" <?php if ($model['shipment'] == 'Standard') echo 'selected'; ?>>
                            <span class="text-black">Standard (8-25 business day)</span>
                            <strong>$15</strong>
                        </option>
                        <option value="Expedited" <?php if ($model['shipment'] == 'Expedited') echo 'selected'; ?>>
                            <span class="text-black">Expedited (3-10 business day)</span>
                            <strong>$25</strong>
                        </option>
                    </select>
                </div>

                <div class="col-4 mb-3 form-floating">
                    <input type="date" class="form-control" id="date_delivery" name="date_delivery" value="<?= $model['date_delivery'] ?>"
                           placeholder="you@example.com">
                    <label for="date_delivery" class="form-label">Date</label>
                </div>

                <div class="col-12 form-floating mb-3">
                    <textarea class="form-control" id="description"
                              name="description"><?= $model['comment'] ?></textarea>
                    <label for="description" class="form-label">Edit order comment</label>
                    <?php if (!empty($errors['comment'])): ?>
                        <div id="nameHelp" class="form-text error"><?= $errors['comment']; ?></div>
                    <?php endif; ?>
                </div>
            </div>
            <div class="card mb-3 address-form">
                <div class="card-header">
                    <h5>Edit address</h5>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-sm-6">
                            <label for="firstName" class="form-label">First name</label>
                            <input type="text" class="form-control" id="firstName" name="firstname" placeholder=""
                                   value="<?php if (!empty($model['address']['firstname'])) echo $model['address']['firstname']; else echo $model['firstname']; ?>"
                                   required="">
                            <?php if (!empty($errors['firstname'])): ?>
                                <div id="nameHelp" class="form-text error"><?= $errors['firstname']; ?></div>
                            <?php endif; ?>
                        </div>

                        <div class="col-sm-6">
                            <label for="lastname" class="form-label">Last name</label>
                            <input type="text" class="form-control" id="lastname" name="lastname" placeholder=""
                                   value="<?php if (!empty($model['address']['lastname'])) echo $model['address']['lastname']; else echo $model['lastname']; ?>">
                            <?php if (!empty($errors['lastname'])): ?>
                                <div id="nameHelp" class="form-text error"><?= $errors['lastname']; ?></div>
                            <?php endif; ?>
                        </div>

                        <div class="col-12">
                            <label for="address" class="form-label">Address</label>
                            <input type="text" class="form-control" id="address" name="address"
                                   value="<?php
                                   if (!empty($model['address']['address']))
                                       echo $model['address']['address'];
                                   else
                                       echo $model['address'];
                                   ?>" placeholder="1234 Main St" required="">
                            <?php if (!empty($errors['address'])): ?>
                                <div id="nameHelp" class="form-text error"><?= $errors['address']; ?></div>
                            <?php endif; ?>
                        </div>

                        <div class="col-md-5">
                            <label for="country" class="form-label">Country</label>
                            <input class="form-control" id="country" name="country"
                                   value="<?php
                                   if (!empty($model['address']['country']))
                                       echo $model['address']['country'];
                                   else
                                       echo $model['country'];
                                   ?>"
                                   required="">
                            <?php if (!empty($errors['country'])): ?>
                                <div id="nameHelp" class="form-text error"><?= $errors['country']; ?></div>
                            <?php endif; ?>
                        </div>

                        <div class="col-md-4">
                            <label for="city" class="form-label">City</label>
                            <input class="form-control" id="city" name="city" required=""
                                   value="<?php
                                   if (!empty($model['address']['city']))
                                       echo $model['address']['city'];
                                   else
                                       echo $model['city'];
                                   ?>">
                            <?php if (!empty($errors['address'])): ?>
                                <div id="nameHelp" class="form-text error"><?= $errors['address']; ?></div>
                            <?php endif; ?>
                        </div>

                        <div class="col-md-3">
                            <label for="zip" class="form-label">Zip</label>
                            <input type="text" class="form-control" id="zip" name="zip"
                                   value="<?php
                                   if (!empty($model['address']['zip']))
                                       echo $model['address']['zip'];
                                   else
                                       echo $model['zip'];
                                   ?>"
                                   placeholder="" required="">
                            <?php if (!empty($errors['zip'])): ?>
                                <div id="nameHelp" class="form-text error"><?= $errors['zip']; ?></div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <input type="number" class="visually-hidden" id="total-price1" name="total_price" value="<?=$model['total_price']?>">
                <button class="btn btn-primary" type="submit">Submit</button>
                <a href="/admin/orders" class="btn btn-light" type="submit">Cancel</a>
            </div>
        </form>
    </div>
    <div class="col-md-5 col-lg-4 order-md-last border-start p-5 float-end">
        <h4 class="d-flex justify-content-between align-items-center mb-3">
            <span class="text-dark">Your cart</span>
            <span class="badge bg-secondary rounded-pill"><?= count($order['cart']) ?></span>
        </h4>
        <table>
            <?php foreach ($order['cart'] as $row) : ?>
                <tr class="row mt-3">
                    <td class="img col-3 text-center">
                        <div class="rounded-1 position-relative" style="border: 1px solid lightgray;">
                            <?php if ($row['product']['photo']) : ?>
                                <img src="/files/product/<?= $row['product']['photo'] ?>" height="70"
                                     style="background-clip: content-box; transform: rotate(-35deg);
                                 width: auto; "
                                     class="text-end" alt="">
                            <?php else : ?>
                                <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="lightgrey"
                                     class="icon-category" viewBox="0 0 16 16">
                                    <path d="M6.002 5.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z"/>
                                    <path d="M1.5 2A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-13zm13 1a.5.5 0 0 1 .5.5v6l-3.775-1.947a.5.5 0 0 0-.577.093l-3.71 3.71-2.66-1.772a.5.5 0 0 0-.63.062L1.002 12v.54A.505.505 0 0 1 1 12.5v-9a.5.5 0 0 1 .5-.5h13z"/>
                                </svg>
                            <?php endif; ?>
                            <span class="badge bg-secondary rounded-pill position-absolute"
                                  style="top: -10px; right: -10px;">
                                <?= $row['count'] ?>
                            </span>
                        </div>
                    </td>
                    <td class="info col-6">
                        <strong><?= $row['product']['name'] ?></strong>
                    </td>
                    <td class="price col-3 text-end">
                        <strong>$<?= $row['product']['price'] * $row['count'] ?></strong>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
        <div class="subtotal">
            <hr>
            <div>
                <p>
                    Subtotal
                    <?php
                    if ($order['shipment'] == 'Standard') $shipment = 15;
                    else $shipment = 25;
                    $totalPrice = intval($order['total_price']) - $shipment;
                    ?>
                    <strong class="float-end">$<?= $totalPrice ?></strong>
                </p>
            </div>
            <div>
                <p>
                    Shipping
                    <strong class="float-end" id="shipping-value">$<?= $shipment ?></strong>
                </p>
            </div>
        </div>
        <hr>
        <div class="total mt-3 h5">
            <strong class="text-lg-end float-end" id="total-price2">$<?= $totalPrice + $shipment ?></strong>
            <strong>Total</strong>
        </div>
    </div>
</div>

<script>
    let shipment = document.getElementById('shipment')
    let shippingValue = document.getElementById('shipping-value')
    let totalPrice1 = document.getElementById('total-price1')
    let totalPrice2 = document.getElementById('total-price2')

    shipment.addEventListener('change', () => {
        let price = 0
        if (shipment.value == 'Standard')
            price = 15
        else
            price = 25
        shippingValue.textContent = '$' + price;
        totalPrice2.textContent = '$' + `${parseFloat(<?= $totalPrice ?>) + price}`;
        totalPrice1.value = `${parseFloat(<?= $totalPrice ?>) + price}`;
    })
</script>