<?php
require __DIR__.'/vendor/autoload.php';

use App\Http\Router;
use App\Utils\View;

define('URL','http://localhost:8000');

View::init([
    'URL' => URL
]);

$orb = new Router(URL);

include __DIR__.'/Route/web.php';

$orb->run()->sendResponse();
