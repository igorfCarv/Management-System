<?php
require __DIR__.'/vendor/autoload.php';

use App\Http\Router;
use App\Utils\View;
use App\Common\Enviroment;

Enviroment::load(__DIR__);

define('URL',getenv('URL'));

View::init([
    'URL' => URL
]);

$orb = new Router(URL);

include __DIR__.'/Route/web.php';

$orb->run()->sendResponse();
