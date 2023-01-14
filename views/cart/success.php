<?php
/** @var int $order_id */

use core\Core;

Core::getInstance()->pageParams['title'] = 'Success';
?>

<div class="mt-5">
    <div class="row">
        <div class="col-4 rounded-4 shadow m-auto">
            <div class="modal-body p-5">
                <h2 class="fw-bold mb-0">Thank you for your order!</h2>
                <ul class="d-grid gap-4 my-5 list-unstyled">
                    <li class="d-flex gap-4">
                        <svg xmlns="http://www.w3.org/2000/svg" width="100" height="100" fill="red"
                             class="bi bi-bag-heart-fill" viewBox="0 0 16 16">
                            <path d="M11.5 4v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4h-3.5ZM8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1Zm0 6.993c1.664-1.711 5.825 1.283 0 5.132-5.825-3.85-1.664-6.843 0-5.132Z"/>
                        </svg>
                        <div>
                            <h5 class="mb-0">Order №<?= $order_id ?></h5>
                            Your order is being processed. The answer will come to your email within a few minutes!
                        </div>
                    </li>
                </ul>
                <a href="/product/" class="btn btn-lg btn-primary mt-5 w-100">Great, thanks!</a>
            </div>
        </div>
    </div>
</div>
