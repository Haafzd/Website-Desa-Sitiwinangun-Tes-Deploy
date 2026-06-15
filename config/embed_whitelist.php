<?php

/**
 * Whitelist domain untuk validasi URL src iframe Virtual Tour.
 * Hanya domain yang terdaftar di sini yang diizinkan di embed code.
 */
return [
    'allowed_domains' => [
        'pannellum.org',
        'cdn.pannellum.org',
        'www.google.com',
        'maps.google.com',
        'www.youtube.com',
        'youtube.com',
        'youtu.be',
        'player.vimeo.com',
        'vimeo.com',
        'momento360.com',
        'kuula.co',
    ],

    'allowed_iframe_attributes' => [
        'src', 'width', 'height', 'frameborder',
        'allow', 'allowfullscreen', 'title', 'loading',
        'style', 'class', 'id',
    ],
];
