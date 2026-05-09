<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

// Admin Routes (SPA CMS)
$routes->group('admin', ['filter' => 'auth'], function($routes) {
    $routes->get('/', 'Admin::index');
    
    // Gallery
    $routes->post('gallery/add', 'Admin::addGallery');
    $routes->post('gallery/toggle/(:num)', 'Admin::toggleStatus/$1');
    $routes->post('gallery/update-order', 'Admin::updateOrder');
    $routes->post('gallery/delete/(:num)', 'Admin::deleteGallery/$1');

    // Hero & Settings
    $routes->post('hero/update', 'Admin::updateHero');
    $routes->post('settings/update', 'Admin::updateSettings');

    // Missions
    $routes->post('mission/add', 'Admin::addMission');
    $routes->post('mission/update/(:num)', 'Admin::editMission/$1');
    $routes->post('mission/delete/(:num)', 'Admin::deleteMission/$1');

    // Team
    $routes->post('team/add', 'Admin::addTeam');
    $routes->post('team/update/(:num)', 'Admin::editTeam/$1');
    $routes->post('team/delete/(:num)', 'Admin::deleteTeam/$1');

    // Clients
    $routes->post('client/add', 'Admin::addClient');
    $routes->post('client/update/(:num)', 'Admin::editClient/$1');
    $routes->post('client/delete/(:num)', 'Admin::deleteClient/$1');
    $routes->post('client/toggle/(:num)', 'Admin::toggleClientStatus/$1');
});

// Login Routes
$routes->get('login', 'Auth::index');
$routes->post('login/process', 'Auth::process');
$routes->get('logout', 'Auth::logout');

