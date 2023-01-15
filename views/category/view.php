<?php
/** @var array $category */
/** @var array $products */

use core\Core;
use models\User;

Core::getInstance()->pageParams['title'] = $category['name'];
?>

<div class="row mb-5 mt-5">
    <h1 class="col">
        <?=$category['name']?>
    </h1>
    <?php if (User::isAdmin()) : ?>
        <div class="col text-end">
            <a href="/product/add/<?=$category['id']?>" class="btn btn-primary">Add product</a>
        </div>
    <?php endif;?>
</div>
<div class="row ">
    <div class="col-2">
        <h4>Filter</h4>
    </div>

    <div class="col">
        <div class="row row-cols-2 row-cols-lg-3 row-cols-md-2">
            <?php foreach ($products as $product) : ?>
                <div class="card rounded-0 border-0" style="width: 22rem;">
                    <div class="card-img-top text-center">
                        <a href="/product/view/<?= $product['id'] ?>" class="row">
                            <div class="col product-card">
                                <?php if ($product['photo']) : ?>
                                    <img src="/files/product/<?= $product['photo'] ?>"
                                         height="400"
                                         style=" background-clip: content-box; width: auto;"
                                         alt="">
                                <?php else : ?>
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="lightgrey"
                                         class="img-fluid card-img-top" width="50" height="70" viewBox="-4 -4 25 25">
                                        <path d="M6.002 5.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z"/>
                                        <path d="M1.5 2A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-13zm13 1a.5.5 0 0 1 .5.5v6l-3.775-1.947a.5.5 0 0 0-.577.093l-3.71 3.71-2.66-1.772a.5.5 0 0 0-.63.062L1.002 12v.54A.505.505 0 0 1 1 12.5v-9a.5.5 0 0 1 .5-.5h13z"/>
                                    </svg>
                                <?php endif; ?>
                                <!--                                <div class="card-img-overlay">-->
                                <!--                                    <a href=""></a>-->
                                <!--                                </div>-->
                            </div>
                        </a>
                    </div>
                    <div class="card-body">
                        <div class="name">
                            <a href="/product/view/<?= $product['id'] ?>"
                               class="card-link text-dark text-decoration-none product-hover"><?= $product['name'] ?></a>

                        </div>
                        <div class="">
                            <div class="price row">
                                <div class="col">
                                    <p class="col"><strong>$<?= $product['price'] ?></strong></p>
                                </div>
                                <div class="col">
                                    <a href="/category/view/<?= $product['category_id'] ?>"
                                       class="float-end text-secondary text-decoration-none category-hover">
                                        <?= \models\Category::getCategoryById($product['category_id'])['name'] ?>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <?php if (User::isAdmin()) : ?>
                            <div class="">
                                <hr>
                                <a href="/product/edit/<?= $product['id'] ?>" class="card-link text-dark">Edit</a>
                                <a href="/product/delete/<?= $product['id'] ?>" class="card-link text-dark">Delete</a>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>
