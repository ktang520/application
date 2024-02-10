<?php
/*
 * Kasyn Tang
 * January 2024
 * http://ktang.greenriverdev.com/328/application/
 * This is my Controller for the application website
 */

// Turn on error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Require the autoload file
require_once ('vendor/autoload.php');

// Instantiate Fat-Free Framework (F3)
$f3 = Base::instance();

// Define a default route
$f3->route('GET /', function () {

    // display a view page
    $view = new Template();
    echo $view->render('views/home.html');
});

// Define a personal information route
$f3->route('GET /info', function () {

    // display a view page
    $view = new Template();
    echo $view->render('views/personal_info.html');
});

// Define a experience route
$f3->route('GET /experience', function () {

    // display a view page
    $view = new Template();
    echo $view->render('views/experience.html');
});

// Define a job openings route
$f3->route('GET /opening', function () {

    // display a view page
    $view = new Template();
    echo $view->render('views/job_openings.html');
});

// Run Fat-Free
$f3->run();