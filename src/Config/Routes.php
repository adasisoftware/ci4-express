<?php
/**
 * Adasi Express
 * Utilities package used in Adasi Software's CodeIgniter 4 projects
 * 
 * Routes
 * 
 * @author Adasi Software <ricardo@adasi.com.br>
 * @link https://www.adasi.com.br
 */

$routes->group('',['namespace' => 'Adasi\Express\Controllers'], function($routes) {
    $routes->get('', 'AuthController::index');
    $routes->post('login', 'AuthController::attemptLogin');
});