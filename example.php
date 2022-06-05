<?php

require 'vendor/autoload.php';

use Basic\Jwt\Algorithms\Sha512;
use Basic\Jwt\Decode;
use Basic\Jwt\Encode;

$alg = new Sha512();
$key = 'c7761238-2dfc-404f-8bf0-5193bf926288';

$encode = new Encode($alg, $key, 3600);

$jwt = ($encode->get([
    "user" => "da828af5-ce2f-4cdb-8828-6b321ec50230"
]));

$jwt = $jwt['jwt'];

$decode = new Decode(
    $jwt,
    $alg,
    $key
);

var_dump($decode->get(), $decode->isValid());
