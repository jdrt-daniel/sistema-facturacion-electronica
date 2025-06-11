<?php
$router->get('/', 'HomeController@index');
$router->get('/usuarios', 'UsuarioController@index');
$router->get('/usuarios/nuevo', 'UsuarioController@nuevo');
$router->get('/usuarios/editar/{id}', 'UsuarioController@editar');
$router->get('/usuarios/ver/{id}', 'UsuarioController@ver');