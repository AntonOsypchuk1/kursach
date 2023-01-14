<?php
/** @var array $category */

use core\Core;

Core::getInstance()->pageParams['title'] = 'Delete category page';
?>

<div class="w-100">
    <div class="col-4 alert alert-warning mt-5, m-auto" role="alert">
        <h4 class="alert-heading">Are you sure you want to delete that category?</h4>
        <p>Category name: <b><?=$category['name']?></b></p>
        <p> <i> Warning: if you delete a category, all related products will have "Not Set" in the category field.</i></p>
        <hr>
        <div>
            <a href="/category/delete/<?=$category['id'] ?>/yes" class="btn btn-danger">Delete</a>
            <a href="/category" class="btn btn-light">Cancel</a>
        </div>
    </div>
</div>
