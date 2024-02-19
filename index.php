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
require_once ('model/data-layer.php');
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
        $state = $_POST['state'];

        if (validName($_POST['first'])) {
            $first = $_POST['first'];
        }
        else {
            $f3->set('errors["first"]', "Invalid First Name");
        }

        if (validName($_POST['last'])) {
            $last = $_POST['last'];
        }
        else {
            $f3->set('errors["last"]', "Invalid last Name");
        }

        if (validEmail($_POST['email'])) {
            $email = $_POST['email'];
        }
        else {
            $f3->set('errors["email"]', "Invalid Email");
        }

        if (validPhone($_POST['phone'])) {
            $phone = $_POST['phone'];
        }
        else {
            $f3->set('errors["phone"]', "Invalid Phone Number");
        }



        // no errors
        if (empty($f3->get('errors'))){

            // put data in session array
            $f3->set('SESSION.first', $first);
            $f3->set('SESSION.last', $last);
            $f3->set('SESSION.email', $email);
            $f3->set('SESSION.state', $state);
            $f3->set('SESSION.phone', $phone);

            //redirect to experience route
            $f3->reroute('experience');
        }

    }

    // display a view page
    $view = new Template();
    echo $view->render('views/personal_info.html');
});

// Define a experience route
$f3->route('GET|POST /experience', function ($f3) {

    // If the form has been posted
    if($_SERVER['REQUEST_METHOD'] == 'POST') {

        // initialize data
        $github = "";
        $bio = "";
        $years = "";
        $relocate = "";

        // Validate the data
        if (isset($_POST['years'])){
            $years = $_POST['years'];;
        }

        if (isset($_POST['relocate'])){
            $relocate = $_POST['relocate'];;
        }

        if (validGithub($_POST['github'])) {
            $github = $_POST['github'];
        }

        if (validExperience($_POST['bio'])) {
            $bio = $_POST['bio'];
        }
        else {
            $f3->set('errors["bio"]', "Invalid Biography");
        }



        // no errors
        if (empty($f3->get('errors'))){

            // Put the data in the session array
            $f3->set('SESSION.bio', $bio);
            $f3->set('SESSION.github', $github);
            $f3->set('SESSION.years', $years);
            $f3->set('SESSION.relocate', $relocate);

            // Redirect to job opening route
            $f3->reroute('opening');
        }

    }

    $f3->set('years', yearsExperience());
    $f3->set('relocate', relocate());

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

        if (isset($_POST['vertical'])) {
            $vertical = implode(", ", $_POST['vertical']);
        }
        else {
            $vertical = "None selected";
        }

        //put the data in the session array
        $f3->set('SESSION.jobs', $jobs);
        $f3->set('SESSION.vertical', $vertical);

        //redirect to summary route
        $f3->reroute('summary');

    }

    $f3->set('jobs', getSoftware());
    $f3->set('vertical', getVertical());


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