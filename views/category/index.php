<?php
/** @var array $rows */

use core\Core;
use models\User;

Core::getInstance()->pageParams['title'] = 'Categories';
?>

<div class="row header m-5">
    <h2 class="col">Category list</h2>
    <?php if (User::isAdmin()) : ?>
        <div class="col text-end">
            <a href="/category/add" class="btn btn-primary">Add category</a>
        </div>
    <?php endif; ?>
</div>
<div class="row row-cols-lg-2 row-cols-md-1">
    <?php foreach ($rows as $row) : ?>
        <div class="card fl mb-3 ms-5 rounded-0" style="max-width: 540px;">
            <div class="row g-0">
                <div class="col-md-4 text-center p-2">
                    <?php if ($row['photo']) : ?>
                        <img src="/files/category/<?= $row['photo'] ?>"
                             class="img-fluid rounded-start"
                             style="height: 250px;"
                             alt="">
                    <?php else : ?>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="lightgrey"
                             class="img-fluid rounded-start" viewBox="-1.5 -1.5 20 20">
                            <path d="M6.002 5.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z"/>
                            <path d="M1.5 2A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-13zm13 1a.5.5 0 0 1 .5.5v6l-3.775-1.947a.5.5 0 0 0-.577.093l-3.71 3.71-2.66-1.772a.5.5 0 0 0-.63.062L1.002 12v.54A.505.505 0 0 1 1 12.5v-9a.5.5 0 0 1 .5-.5h13z"/>
                        </svg>
                    <?php endif; ?>
                </div>
                <div class="col-md-8">
                    <div class="card-body">
                        <h5 class="card-title text-start"><?= $row['name'] ?></h5>
                        <p class="card-text"><?= $row['description'] ?></p>
                    </div>
                    <div class="card-body">
                        <a href="/category/view/<?= $row['id'] ?>" class="card-link btn btn-dark float-end rounded-0">Expand</a>
                    </div>
                    <?php if (User::isAdmin()) : ?>
                        <div class="card-body">
                            <hr>
                            <a href="/category/edit/<?= $row['id'] ?>" class="card-link text-dark">Edit</a>
                            <a href="/category/delete/<?= $row['id'] ?>" class="card-link text-dark">Delete</a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>