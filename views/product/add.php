<?php
/** @var array $categories */
/** @var int|null $category_id */
/** @var array $model */
/** @var array $errors */

use core\Core;

Core::getInstance()->pageParams['title'] = 'Add product page'

?>

<h2>Adding new product</h2>
<form method="post" action="" enctype="multipart/form-data">
    <div class="mb-3">
        <label for="name" class="form-label">Product name</label>
        <input type="text" class="form-control" id="name" name="name" placeholder="">
        <?php if (!empty($errors['name'])): ?>
            <div id="nameHelp" class="form-text error"><?=$errors['name']; ?></div>
        <?php endif; ?>
    </div>
    <div class="mb-3">
        <label for="category_id" class="form-label">Choose category</label>
        <select class="form-select" name="category_id" id="category_id">
            <?php foreach($categories as $category) : ?>
                <option
                    <?php if($category_id == $category['id']) echo 'selected' ?>
                        value="<?=$category['id']?>"><?=$category['name'] ?>
                </option>
            <?php endforeach; ?>
        </select>
        <?php if (!empty($errors['category_id'])): ?>
            <div id="categoryHelp" class="form-text error"><?=$errors['category_id']; ?></div>
        <?php endif; ?>
    </div>
    <div class="mb-3">
        <label for="price" class="form-label">Price</label>
        <input type="number" class="form-control" id="price" name="price" placeholder="">
        <?php if (!empty($errors['price'])): ?>
            <div id="nameHelp" class="form-text error"><?=$errors['price']; ?></div>
        <?php endif; ?>
    </div>
    <div class="mb-3">
        <label for="count" class="form-label">Count</label>
        <input type="number" class="form-control" id="count" name="count" placeholder="">
        <?php if (!empty($errors['count'])): ?>
            <div id="nameHelp" class="form-text error"><?=$errors['count']; ?></div>
        <?php endif; ?>
    </div>
    <div class="mb-3">
        <label for="short_description" class="form-label">Short description</label>
        <textarea class="form-control" id="short_description" name="short_description"></textarea>
    </div>
    <div class="mb-3">
        <label for="description" class="form-label">Write more about the product</label>
        <textarea class="ckeditor form-control" id="description" name="description"></textarea>
    </div>
    <div class="mb-3">
        <label for="visible" class="form-label">Is product visible?</label>
        <select class="form-select" name="visible" id="visible">
            <option value="1">yes</option>
            <option value="0">no</option>
        </select>
    </div>
    <div class="mb-3">
        <label for="formFile" class="form-label">Choose images</label>
        <input multiple class="form-control" type="file" name="file" id="formFile" accept="image/jpeg">
    </div>
    <div>
        <button class="btn btn-primary">Submit</button>
        <a href="/product" class="btn btn-light">Cancel</a>
    </div>
</form>
<script src="https://cdn.ckeditor.com/ckeditor5/35.4.0/classic/ckeditor.js"></script>
<script>
    ClassicEditor
        .create( document.querySelector( '.ckeditor' ) )
        .catch( error => {
            console.error( error );
        } );
</script>