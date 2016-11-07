<?php

session_start();

require_once 'conf/autoload.php';
require_once 'vendor/autoload.php';

use \wikiapp\utils\HttpRequest as HttpRequest;
use wikiapp\utils\Router as Router;

$router = new Router();

$router->addRoute('/wiki/add/', '\wikiapp\control\WikiController', 'addPage',  -100);
$router->addRoute('/wiki/update/', '\wikiapp\control\WikiController', 'updatePage',  -100);
$router->addRoute('/wiki/all/', '\wikiapp\control\WikiController', 'listAll',  -100);
$router->addRoute('/wiki/view/', '\wikiapp\control\WikiController', 'viewPage', -100);
$router->addRoute('default', '\wikiapp\control\WikiController', 'listAll',  -100);
$router->addRoute('/admin/login/', '\wikiapp\control\WikiAdminController', 'loginUser',  -100);
$router->addRoute('/admin/checkUser/', '\wikiapp\control\WikiAdminController', 'checkUser',  -100);
$router->addRoute('/admin/perso/', '\wikiapp\control\WikiAdminController', 'userSpace',  -100);
$router->addRoute('/admin/logout/', '\wikiapp\control\WikiAdminController', 'logoutUser',  -100);

$http_req = new HttpRequest();
$router->dispatch($http_req);

// var_dump(Router::$routes);
var_dump($_SESSION);
