<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Default Route
$routes->get('/', 'Home::index');

// Admin Routes (SPA CMS)
$routes->group('admin', ['filter' => 'auth'], function($routes) {
    $routes->get('/', 'Admin::index');
    $routes->post('gallery/add', 'Admin::addGallery');
    $routes->post('gallery/toggle/(:num)', 'Admin::toggleStatus/$1');
    $routes->post('gallery/update-order', 'Admin::updateOrder');
});

// Login Routes
$routes->get('login', 'Auth::index');
$routes->post('login/process', 'Auth::process');
$routes->get('logout', 'Auth::logout');
