<?php
/** @var array $product */

use models\User;

?>

<div class="mt-5">
    <h2><?= $product['name'] ?></h2>
    <div class="mt-5">
        <div class="row">
            <div class="col-4 text-center">
                <?php if ($product['photo']) : ?>
                    <img src="/files/product/<?= $product['photo'] ?>" class=""
                         height="500"
                         style=" background-clip: content-box; width: auto;"
                         alt="">
                <?php else : ?>
                    <img src="/files/product/no-image.jpg" class="img-thumbnail" alt="">
                <?php endif; ?>
            </div>
            <div class="col-4">
                <div class="mb-3">
                    PRICE: <strong><?= $product['price'] ?>$</strong>
                </div>
                <div class="mb-3">
                <span>
                    IN STOCK:
                    <?php if ($product['count'] > 0) : ?>
                        <span class="text-secondary">IN STOCK</span>
                    <?php else : ?>
                        <span class="text-secondary">PRE-ORDER</span>
                    <?php endif; ?>
                </span>
                </div>
                <?php if (User::isAdmin()) : ?>
                    <div class="mb-3">
                        AMOUNT: <strong><?= $product['count'] ?></strong>
                    </div>
                <?php endif; ?>
                <div class="mb-3">
                    DESCRIPTION: <?= $product['description'] ?>
                </div>
                <form action="" method="post">
                    <div class="row">
                        <div class="col-6">
                            <div class="input-group w-100">
                                <label for="count" class="input-group-text  rounded-0">QUANTITY</label>
                                <input type="number" class="form-control rounded-0" id="count" name="count"
                                       placeholder=""
                                       value="1" min="1" max="<?= $product['count'] ?>">
                            </div>
                        </div>
                        <div class="col-6">
                            <button class="btn btn-dark buy rounded-0 w-100" type="submit" id="buy">ADD TO CART</button>
                        </div>
                        <div class="col-12 mt-2">
                            <input class="btn btn-light buy rounded-0 w-100" name="buy" type="submit" id="buy" value="BUY NOW">
                        </div>
                    </div>
                </form>

                <?php if (User::isAdmin()) : ?>
                    <div class="mt-5 text-end">
                        <hr>
                        <a href="/product/edit/<?= $product['id'] ?>" class="card-link text-dark">Edit</a>
                        <a href="/product/delete/<?= $product['id'] ?>" class="ms-3 card-link text-dark">Delete</a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<script>
    let tables = document.querySelectorAll('table');
    tables.forEach(table => {
        table.classList.add('table');
    })

    // let button = document.getElementById('buy');
    // button.addEventListener('click', () => {
    //     let input = document.getElementById('count')
    //     sessionStorage.setItem('count', input.value)
    //     console.log();
    // });
    // var httpRequest;

    //    let inputCount = document.getElementById('count')
    //    // localStorage.setItem('product')
    //
    //    if (window.XMLHttpRequest) { // Mozilla, Safari, ...
    //        httpRequest = new XMLHttpRequest();
    //    } else if (window.ActiveXObject) { // IE
    //        httpRequest = new ActiveXObject('Microsoft.XMLHTTP');
    //    }
    //    httpRequest.overrideMimeType('text/xml');
    //
    //    httpRequest.onreadystatechange = function() {
    //        return 'asdc'
    //    }
    //    httpRequest.open('POST', '/product/view/', true)
    //    httpRequest.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    //    httpRequest.send("product_id=<?php //=$product['id']?>//&count=" + inputCount.value);
    //});
</script>
