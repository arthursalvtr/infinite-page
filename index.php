<?php
declare(strict_types=1);
/**
 * User: ERIC
 * Date: 2/20/2020
 * Time: 2:36 PM
 */

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

define('__ROOT__', __DIR__);

require __DIR__.'/vendor/autoload.php';

$request = Request::createFromGlobals();

$response = new Response(
    'Content',
    Response::HTTP_OK,
    ['content-type' => 'text/html']
);
$generator = new \App\Support\Generator($request, $response);

$generator->generate();
