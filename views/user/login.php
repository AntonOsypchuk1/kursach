<?php
/** @var string|null $error */
core\Core::getInstance()->pageParams['title'] = 'Login page';
?>

<div class="col-4 mt-5 m-auto form-signin">
    <h1 class="h3 mb-3 fw-normal text-center">Please sign in</h1>
    <form method="post" action="">
        <?php if (!empty($error)): ?>
            <div class="message error mb-2">
                <?=$error?>
            </div>
        <?php endif; ?>
        <div class="form-floating mb-3">
            <input type="email" class="form-control" name="login" id="login" placeholder="name@example.com">
            <label for="login">Email address</label>
        </div>
        <div class="form-floating mb-3">
            <input type="password" class="form-control" name="password" id="password" placeholder="Password">
            <label for="password">Password</label>
        </div>

        <!--    <div class="checkbox mb-3">
                <label>
                    <input type="checkbox" value="remember-me"> Remember me
                </label>
            </div>-->
        <button class="w-100 btn btn-lg btn-primary" type="submit">Sign in</button>
    </form>
</div>
