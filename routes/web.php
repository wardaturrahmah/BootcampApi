<?php

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->get("/user","TestingController@main");
$router->get("/user/{filter}/{id}","TestingController@filter_user");
$router->post("/user","TestingController@create_user");
$router->put("/user/{id}","TestingController@update_user");
$router->delete("/user/{id}","TestingController@delete_user");

$router->post("/billing","TestingController@create_billing");
$router->post("/list","IndexController@main");

