<?php
/** @var array $model */
/** @var array $errors */

use core\Core;
use models\User;

Core::getInstance()->pageParams['title'] = 'Edit page';
?>

<div class="card mt-5 col-4 m-auto">
    <form class="needs-validation" novalidate="" method="post" action="">
        <div class="card-header">
            <h5>Add address</h5>
        </div>
        <div class="card-body">
            <div class="row g-3">
                <div class="col-sm-6">
                    <label for="firstName" class="form-label">First name</label>
                    <input type="text" class="form-control" id="firstName" name="firstname" placeholder=""
                           value="<?= $model['firstname'] ?>" required="">
                    <?php if (!empty($errors['firstname'])): ?>
                        <div id="nameHelp" class="form-text error"><?= $errors['firstname']; ?></div>
                    <?php endif; ?>
                </div>
                <div class="col-sm-6">
                    <label for="lastname" class="form-label">Last name</label>
                    <input type="text" class="form-control" id="lastname" name="lastname" placeholder=""
                           value="<?= $model['lastname'] ?> ">
                    <?php if (!empty($errors['lastname'])): ?>
                        <div id="nameHelp" class="form-text error"><?= $errors['lastname']; ?></div>
                    <?php endif; ?>
                </div>

                <div class="col-12">
                    <label for="address" class="form-label">Address</label>
                    <input type="text" class="form-control" id="address" name="address"
                           value="<?= $model['address'] ?>" placeholder="1234 Main St" required="">
                    <?php if (!empty($errors['address'])): ?>
                        <div id="nameHelp" class="form-text error"><?= $errors['address']; ?></div>
                    <?php endif; ?>
                </div>

                <div class="col-md-5">
                    <label for="country" class="form-label">Country</label>
                    <input class="form-control" id="country" name="country" value="<?= $model['country'] ?>"
                           required="">
                    <?php if (!empty($errors['country'])): ?>
                        <div id="nameHelp" class="form-text error"><?= $errors['country']; ?></div>
                    <?php endif; ?>
                </div>

                <div class="col-md-4">
                    <label for="state" class="form-label">City</label>
                    <input class="form-control" id="city" name="city" required="" value="<?= $model['city'] ?>">
                    <?php if (!empty($errors['address'])): ?>
                        <div id="nameHelp" class="form-text error"><?= $errors['address']; ?></div>
                    <?php endif; ?>
                </div>

                <div class="col-md-3">
                    <label for="zip" class="form-label">Zip</label>
                    <input type="text" class="form-control" id="zip" name="zip" value="<?= $model['zip'] ?>"
                           placeholder="" required="">
                    <?php if (!empty($errors['zip'])): ?>
                        <div id="nameHelp" class="form-text error"><?= $errors['zip']; ?></div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <div class="card-body">
            <button class="btn btn-primary" type="submit">Submit</button>
            <a href="/user/address" class="btn btn-light" type="submit">Cancel</a>
        </div>
    </form>
</div>