<?php 

define('BASEDIR', dirname(__FILE__, 2) . '/../');
define('VIEWS', dirname(__FILE__, 2) . '/View/');


$_ENV['db']['host'] = 'localhost:3306';
$_ENV['db']['user'] = 'root';
$_ENV['db']['password'] = 'root';
$_ENV['db']['database'] = 'management_system';