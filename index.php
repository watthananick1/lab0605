<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;

require __DIR__ . '/vendor/autoload.php';

$app = AppFactory::create();
$app->setBasePath('/lab0605');

require __DIR__ . '/api/dbconnect.php';
require __DIR__ . '/api/products.php';
require __DIR__ . '/api/customers.php';

$app->run();