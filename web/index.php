<?php

require_once ('autoloader.php');

$router = new router();
$router->getHeader();
$router->getContent();
$router->getFooter();