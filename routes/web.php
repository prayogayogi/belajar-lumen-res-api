<?php

/** @var \Laravel\Lumen\Routing\Router $router */


$router->post('/produk', 'ProdukController@create');
$router->get('/produk', 'ProdukController@index');
$router->get('/produk/{id}', 'ProdukController@show');
$router->put('/produk/{id}', 'ProdukController@update');
$router->delete('/produk/{id}', 'ProdukController@destroy');

$router->post('/register', 'UserController@register');
$router->post('/login', 'UserController@login');
$router->get('/user', 'UserController@index');
$router->get('/user/{id}', 'UserController@show');


$router->get('/post', 'PostController@index');
$router->post('/post', 'PostController@store');
$router->get('/post/{id}', 'PostController@show');
$router->delete('/post/{id}', 'PostController@destroy');
