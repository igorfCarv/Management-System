<?php

require __DIR__.'/includes/app.php';

use App\Http\Router;

$orb = new Router(URL);

include __DIR__.'/Route/web.php';

$orb->run()->sendResponse();

