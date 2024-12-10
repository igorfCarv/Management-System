<?php

use App\Controller\Pages\HomeController;
use App\Http\Request;

require __DIR__.'/vendor/autoload.php';

echo HomeController::getHome();
