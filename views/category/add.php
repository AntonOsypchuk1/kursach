<?php
/** @var array $model */
/** @var array $errors */

use core\Core;

Core::getInstance()->pageParams['title'] = 'Add category page'

?>

<div class="mt-5 col-6 m-auto">
    <h2>Adding new category</h2>
    <form method="post" action="" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="name" class="form-label">Category name</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="">
            <?php if (!empty($errors['name'])): ?>
                <div id="nameHelp" class="form-text error"><?=$errors['name']; ?></div>
            <?php endif; ?>
        </div>
        <div class="mb-3">
            <label for="formFile" class="form-label">Choose image</label>
            <input class="form-control" type="file" name="file" id="formFile" accept="image/jpeg">
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Write about this category</label>
            <textarea class="ckeditor form-control" id="description" name="description"></textarea>
        </div>
        <div>
            <button class="btn btn-primary">Submit</button>
            <a href="/category" class="btn btn-light">Cancel</a>
        </div>
    </form>
</div>
<script src="https://cdn.ckeditor.com/ckeditor5/35.4.0/classic/ckeditor.js"></script>
<script>
    ClassicEditor
        .create( document.querySelector( '.ckeditor' ) )
        .catch( error => {
            console.error( error );
        } );
</script>