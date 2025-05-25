<?php

/*
 * This file is part of the PHPFlasher package.
 * (c) Younes KHOUBZA <younes.khoubza@gmail.com>
 */

return array(
    'scripts' => array(
        'cdn' => array(
            'https://cdn.jsdelivr.net/npm/@flasher/flasher-toastr@1.3.2/dist/flasher-toastr.min.js',
        ),
        'local' => array(
            '/vendor/flasher/jquery.min.js',
            '/vendor/flasher/flasher-toastr.min.js',
        ),
    ),
    'styles' => array(
        'cdn' => array(
            'https://cdn.jsdelivr.net/npm/@flasher/flasher-toastr@1.3.2/dist/flasher-toastr.min.css',
        ),
        'local' => array(
            '/vendor/flasher/flasher-toastr.min.css',
        ),
    ),
    'options' => array(
        'positionClass' => 'toast-bottom-right', // 👈 Default position here
        'closeButton' => true,
        'progressBar' => true,
        'timeOut' => 5000,
        'extendedTimeOut' => 1000,
        'showMethod' => 'fadeIn',
        'hideMethod' => 'fadeOut',
    ),
);
