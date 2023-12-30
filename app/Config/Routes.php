<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
// $routes->get('/', 'Home::index');
$routes->get('/', 'UserController::home');
$routes->get('/login', 'UserController::login');
$routes->get('/signup', 'UserController::register');
$routes->post('/createPost', 'UserController::createPost');
$routes->post('/createKomen', 'UserController::createKomen');
$routes->get('/profile', 'UserController::profile');
$routes->get('/detail/(:any)', 'UserController::showDetail/$1');
$routes->delete('/deletePost/(:any)', 'UserController::deletePost/$1');
