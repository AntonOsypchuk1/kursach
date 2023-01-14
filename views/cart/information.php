<?php
/** @var array $cart */
/** @var array $errors */
/** @var array $user */
/** @var array $model */
/** @var array $address */

if (empty($model))
    $model = $user;

use core\Core;
use models\User;

Core::getInstance()->pageParams['title'] = 'Information';
?>

<div class="row">
    <div class="col-md-7 col-lg-8 contact-information p-5">
        <h4 class="mb-4">Contact information</h4>
        <?php if (empty($user)) : ?>
            <div class="float-end col">
                        <span>Already have an account? <a href="/user/login/checkout"
                                                          class="text-dark">Log in</a></span>
            </div>
        <?php endif; ?>
        <form class="needs-validation" novalidate="" method="post" action="">
            <div class="row g-3">
                <div class="col-sm-6">
                    <div class="form-floating">
                        <input type="text" class="form-control" id="firstName" name="firstname" placeholder=""
                               value="<?= $model['firstname'] ?>" required="">
                        <label for="firstName" class="form-label">First name</label>
                    </div>
                    <?php if (!empty($errors['firstname'])): ?>
                        <div id="nameHelp" class="form-text error"><?= $errors['firstname']; ?></div>
                    <?php endif; ?>
                </div>
                <div class="col-sm-6">
                    <div class="form-floating">
                        <input type="text" class="form-control" id="lastname" name="lastname" placeholder=""
                               value="<?= $model['lastname'] ?> ">
                        <label for="lastname" class="form-label">Last name</label>
                    </div>
                    <?php if (!empty($errors['lastname'])): ?>
                        <div id="nameHelp" class="form-text error"><?= $errors['lastname']; ?></div>
                    <?php endif; ?>
                </div>

                <div class="col-12">
                    <div class="form-floating">
                        <input type="email" class="form-control" id="email" name="login" value="<?= $model['login'] ?>"
                               placeholder="you@example.com">
                        <label for="email" class="form-label">Email <span
                                    class="text-muted">(Optional)</span></label>
                    </div>
                    <?php if (!empty($errors['login'])): ?>
                        <div id="nameHelp" class="form-text error"><?= $errors['login']; ?></div>
                    <?php endif; ?>
                </div>

                <div class="col-12">
                    <div class="form-floating">
                        <input type="text" class="form-control" id="address" name="address"
                               value="<?php if (empty($model['address'])) echo $address['address']; else echo $model['address']; ?>"
                               placeholder="1234 Main St" required="">
                        <label for="address" class="form-label">Address</label>
                    </div>
                    <?php if (!empty($errors['address'])): ?>
                        <div id="nameHelp" class="form-text error"><?= $errors['address']; ?></div>
                    <?php endif; ?>
                </div>

                <div class="col-md-5">
                    <div class="form-floating">
                        <input class="form-control" id="country" name="country"
                               value="<?php if (empty($model['country'])) echo $address['country']; else echo $model['country']; ?>"
                               required="">
                        <label for="country" class="form-label">Country</label>
                    </div>
                    <?php if (!empty($errors['country'])): ?>
                        <div id="nameHelp" class="form-text error"><?= $errors['country']; ?></div>
                    <?php endif; ?>
                </div>

                <div class="col-md-4">
                    <div class="form-floating">
                        <input class="form-control" id="city" name="city" required=""
                               value="<?php if (empty($model['city'])) echo $address['city']; else echo $model['city']; ?>">
                        <label for="state" class="form-label">City</label>
                    </div>
                    <?php if (!empty($errors['address'])): ?>
                        <div id="nameHelp" class="form-text error"><?= $errors['address']; ?></div>
                    <?php endif; ?>
                </div>

                <div class="col-md-3">
                    <div class="form-floating">
                        <input type="text" class="form-control" id="zip" name="zip"
                               value="<?php if (empty($model['zip'])) echo $address['zip']; else echo $model['zip']; ?>"
                               placeholder="" required="">
                        <label for="zip" class="form-label">Zip</label>
                    </div>
                    <?php if (!empty($errors['zip'])): ?>
                        <div id="nameHelp" class="form-text error"><?= $errors['zip']; ?></div>
                    <?php endif; ?>
                </div>
            </div>

            <?php if (!empty($user)) : ?>
                <div class="mt-3 mb-4">
                    <div class="form-check">
                        <input type="checkbox" name="save_info" class="form-check-input" id="save_info">
                        <label class="form-check-label" for="save_info">Save this information for next time</label>
                    </div>
                </div>
            <?php endif; ?>

            <hr>
            <div class="col-12 mt-4">
                <h5>Shipping method</h5>
                <div class="form-control mt-4 p-3">
                    <div class="form-check">
                        <input type="radio" class="form-check-input" name="shipping" id="shipping-type-1" checked placeholder="15">
                        <label for="shipping-type-1" class="form-check-label">Standard (8-25 business day)</label>
                        <strong class="float-end">$15</strong>
                    </div>
                    <hr>
                    <div class="form-check">
                        <input type="radio" class="form-check-input" name="shipping" id="shipping-type-2" placeholder="25">
                        <label for="shipping-type-2" class="form-check-label">Expedited (3-10 business day)</label>
                        <strong class="float-end">$25</strong>
                    </div>
                </div>
                <?php if (!empty($errors['shipment'])): ?>
                    <div id="nameHelp" class="form-text error"><?= $errors['shipment']; ?></div>
                <?php endif; ?>
            </div>

            <div class="mt-5">
                <a href="/cart" class="btn border-0" style="background: white"><i class="bi bi-arrow-left"></i> Return to
                    cart</a>
                <button class="btn btn-primary float-end p-3" type="submit">Order now</button>
            </div>
        </form>
    </div>

    <div class="col-md-5 col-lg-4 order-md-last border-start p-5">
        <h4 class="d-flex justify-content-between align-items-center mb-3">
            <span class="text-dark">Your cart</span>
            <span class="badge bg-secondary rounded-pill"><?= count($cart['products']) ?></span>
        </h4>
        <table>
            <?php foreach ($cart['products'] as $row) : ?>
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
                            <span class="badge bg-secondary rounded-pill position-absolute" style="top: -10px; right: -10px;">
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
                    <strong class="float-end">$<?= $cart['total_price'] ?></strong>
                </p>
            </div>
            <div>
                <p>
                    Shipping
                    <strong class="float-end" id="shipping-value">$15</strong>
                </p>
            </div>
        </div>
        <hr>
        <div class="total mt-3 h5">
            <strong class="text-lg-end float-end" id="total-price">$<?= $cart['total_price'] + 15 ?></strong>
            <strong>Total</strong>
        </div>
    </div>
</div>

<script>
let shippingArr = document.getElementsByName('shipping')
let shippingValue = document.getElementById('shipping-value')
let totalPrice = document.getElementById('total-price')
document.cookie = `shipment=15`
console.log(document.cookie)

shippingArr.forEach(shipping => {
    shipping.addEventListener('click', () => {
        if (shipping.checked) {
            shippingValue.textContent = '$' + shipping.placeholder;
            totalPrice.textContent = '$' + `${parseFloat(<?= $cart['total_price'] ?>) + parseFloat(shipping.placeholder)}`;
            document.cookie = `shipment=${shipping.placeholder}`
            console.log(document.cookie)
        }
    })
})
</script>
