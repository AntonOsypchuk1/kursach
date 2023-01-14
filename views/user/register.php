<?php
/** @var array $errors */
/** @var array $model */
core\Core::getInstance()->pageParams['title'] = 'Register page';
?>


<div class="col-5 mt-5 m-auto form-register">
    <h1 class="h3 mb-3 fw-normal text-center">Registration form</h1>
    <form method="post" action="">
        <div class="mb-3">
            <label for="login" class="form-label">Login: </label>
            <input type="text" class="form-control" name="login" id="login" value="<?=$model['login']?>" aria-describedby="emailHelp">
            <?php if (!empty($errors['login'])): ?>
                <div id="emailHelp" class="form-text error"><?=$errors['login']; ?></div>
            <?php endif; ?>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password: </label>
            <input type="password" class="form-control" name="password" id="password" value="<?=$model['password']?>" aria-describedby="passwordHelp">
            <?php if (!empty($errors['password'])): ?>
                <div id="passwordHelp" class="form-text error"><?=$errors['login']; ?></div
            <?php endif; ?>
        </div>
        <div class="mb-3">
            <label for="password2" class="form-label">Password once more: </label>
            <input type="password" class="form-control" name="password2" id="password2" value="<?=$model['password2']?>" aria-describedby="password2Help">
            <?php if (!empty($errors['password2'])): ?>
                <div id="password2Help" class="form-text error"><?=$errors['login']; ?></div>
            <?php endif; ?>
        </div>
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
        <div class="mb-3">
            <span class="form-text">
                Already have an account?
                <a href="/user/login">Login</a>
            </span>
        </div>
        <button class="w-100 btn btn-lg btn-primary" type="submit">Register</button>
    </form>
</div>