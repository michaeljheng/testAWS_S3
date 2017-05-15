<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
header('Content-Type: text/plain; charset=utf-8');
require '/var/www/vendor/aws-sdk/aws-autoloader.php';

use Aws\Sts\StsClient;
use Aws\S3\S3Client;
// In real applications, the following code is part of your trusted code.
// It has your security credentials that you use to obtain temporary
// security credentials.
$sts = StsClient::factory();
$result = $sts->getSessionToken();
// The following will be part of your less trusted code. You provide temporary
// security credentials so it can send authenticated requests to Amazon S3.
// Create an Amazon S3 client using temporary security credentials.
$credentials = $result->get('Credentials');
$s3 = S3Client::factory(array(
'key' => $credentials['AccessKeyId'],
'secret' => $credentials['SecretAccessKey'],
'token' => $credentials['SessionToken']
));
$res = $s3->listBuckets();
