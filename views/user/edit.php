<?php
/** @var array $errors */
/** @var array $model */
/** @var array $user */

if (empty($model))
    $model = $user;

core\Core::getInstance()->pageParams['title'] = 'Edit page';
?>


<div class="col-5 mt-5 m-auto">
    <h1 class="h3 mb-3 fw-normal text-center">Edit form</h1>
    <form method="post" action="">
        <div class="mb-3">
            <label for="lastname" class="form-label">Lastname: </label>
            <input type="text" class="form-control" name="lastname" id="lastname" value="<?=$model['lastname']?>" aria-describedby="lastnameHelp">
            <?php if (!empty($errors['lastname'])): ?>
                <div id="lastnameHelp" class="form-text error"><?=$errors['login']; ?></div>
            <?php endif; ?>
        </div>
        <div class="mb-3">
            <label for="firstname" class="form-label">Firstname: </label>
            <input type="text" class="form-control" name="firstname" id="firstname" value="<?=$model['firstname']?>" aria-describedby="firstnameHelp">
            <?php if (!empty($errors['firstname'])): ?>
                <div id="firstnameHelp" class="form-text error"><?=$errors['login']; ?></div>
            <?php endif; ?>
        </div>
        <button class="w-100 btn btn-lg btn-primary" type="submit">Edit</button>
    </form>
</div>