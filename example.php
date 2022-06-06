<?php

require 'vendor/autoload.php';

use Basic\Jwt\Algorithms\Sha512;
use Basic\Jwt\Decode;
use Basic\Jwt\Encode;
use Basic\Jwt\Key;

$alg = new Sha512();
$key = new Key('c7761238-2dfc-404f-8bf0-5193bf926288');
// $key = new Key('');

$encode = new Encode($alg, $key, 3600);

$jwt = ($encode->get(["user" => uniqid()]));

print_r($jwt);

// $jwt = $jwt['jwt'];
$jwt = "eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzUxMiJ9.eyJpYXQiOjE2NTQ1MzM1MTAsImV4cCI6MTY1NDUzMzUxMSwidXNlciI6IjYyOWUyZDg2OWFhMmIifQ.aNJssuz9O5izip0CYFD7r4HSOFEz7IE-XvUl_W86XqC-rgJvNvF7tQME5_VMKj3rqtYk3M7R
cWQFg-UQsjdlchgZV2-iEg04m1-s2p0fyGHOMFkqhtpoNNShZSbWwTbLXVQO7lr-4l88gI-QZbuycuDf_hjb1aeDoItrtoHpSMQRo_T9Emn-RtCn8t0K2FaLpQh3vLJZc-8oNToe2OEkcr1LCKwmPkACCAgEImvYysXSPTruPU03pVJ8AxZyXwLVkJ7x752gFGkTAHqx3
H-qKJMDJXYA_lVumgM2_Cco0qB74kXN0BIED0NNxUuXauFmL7pW0S-GlqWgrzrW5gNuM3VWeoHtLAxt_A6yCoSYSyC4vYcOkwja9spd_mfNH5L_pYXcewztuttWoEgG1pmtt2g7Dq-kMO4j48o-aSqg89FNYrIgyXMha5ddclkrti6X-82vQaVKW_5AnqZ7085cvmtztR
ejEZDvRMuhjTZ6Lp44aYQZsrF2skmEiC-S-r0aQLis5nDpxH7BINXFSKvju8MVeawFrQi2_v9mScQsitMcrw3DrlFqxqbbZDgK_EigB2zkrTQapMCawLB7TqQL3r_dZOSVtncs0Xng_CEp2beh1B9WWT_k9t-_nKI0_mZ-FJd-ac1s5b_juEeMdXcXCDLxaC_dia1vqHG
ya5WyQgQ";

$decode = new Decode(
    $jwt,
    $alg,
    $key
);

var_dump($decode->get(), $decode->isValid());
