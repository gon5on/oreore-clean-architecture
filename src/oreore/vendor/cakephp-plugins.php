<?php
$baseDir = dirname(dirname(__FILE__));

return [
    'plugins' => [
        'Bake' => $baseDir . '/vendor/cakephp/bake/',
        'DebugKit' => $baseDir . '/vendor/cakephp/debug_kit/',
        'Migrations' => $baseDir . '/vendor/cakephp/migrations/',
        'RochaMarcelo/CakePimpleDi' => $baseDir . '/vendor/rochamarcelo/cake-pimple-di/',
        'WyriHaximus/TwigView' => $baseDir . '/vendor/wyrihaximus/twig-view/',
    ],
];
