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
require_once ('model/validate.php');


// Instantiate Fat-Free Framework (F3)
$f3 = Base::instance();

// Define a default route
$f3->route('GET /', function () {

    // display a view page
    $view = new Template();
    echo $view->render('views/home.html');
});

// Define a personal information route
$f3->route('GET|POST /info', function ($f3) {

    // If the form has been posted
    if($_SERVER['REQUEST_METHOD'] == 'POST') {

        //Initializing variables
        $first = "";
        $last = "";
        $email = "";
        $phone = "";

        // Validate the data
        $last = $_POST['last'];
        $email = $_POST['email'];
        $state = $_POST['state'];
        $phone = $_POST['phone'];

        if (validName($_POST['first'])) {
            $first = $_POST['first'];
        }
        else {
            $f3->set('errors["first"]', "Invalid first name");
        }

        // no errors
        if (empty($f3->get('errors'))){

            // put data in session array
            $f3->set('SESSION.food', $first);

            //redirect to experience route
            $f3->reroute('experience');
        }
        // Put the data in the session array
        $f3->set('SESSION.last', $last);
        $f3->set('SESSION.email', $email);
        $f3->set('SESSION.state', $state);
        $f3->set('SESSION.phone', $phone);

        // Redirect to experience route
        $f3->reroute('experience');
    }

    // display a view page
    $view = new Template();
    echo $view->render('views/personal_info.html');
});

// Define a experience route
$f3->route('GET|POST /experience', function ($f3) {

    // If the form has been posted
    if($_SERVER['REQUEST_METHOD'] == 'POST') {

        // Validate the data
        $bio = $_POST['bio'];
        $github = $_POST['github'];
        $years = $_POST['years'];
        $relocate = $_POST['relocate'];

        // Put the data in the session array
        $f3->set('SESSION.bio', $bio);
        $f3->set('SESSION.github', $github);
        $f3->set('SESSION.years', $years);
        $f3->set('SESSION.relocate', $relocate);

        // Redirect to job opening route
        $f3->reroute('opening');
    }

    // display a view page
    $view = new Template();
    echo $view->render('views/experience.html');
});

// Define a job openings route
$f3->route('GET|POST /opening', function ($f3) {

    //If the form has been posted
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        //Validate the data
        if (isset($_POST['jobs'])) {
            $jobs = implode(", ", $_POST['jobs']);
        }
        else {
            $jobs = "None selected";
        }

        //put the data in the session array
        $f3->set('SESSION.jobs', $jobs);

        //redirect to summary route
        $f3->reroute('summary');

    }


    // display a view page
    $view = new Template();
    echo $view->render('views/job_openings.html');
});

// Define a experience route
$f3->route('GET /summary', function () {

    // display a view page
    $view = new Template();
    echo $view->render('views/summary.html');
});

// Run Fat-Free
$f3->run();