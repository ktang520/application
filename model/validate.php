<?php

function validName($first) {
    if (trim($first) == "")
        return false;
    if (!ctype_alpha($first))
        return false;
    return true;
}

function validGithub($github) {
    if (!filter_var($github, FILTER_VALIDATE_URL))
        return false;
    return true;
}

function validExperience() {
    return array('0-2', '2-4', '4+');
}

function validPhone($phone) {
    if (trim($phone) == "")
        return false;
    if (!is_numeric($phone))
        return false;
    return true;
}

function validEmail($email) {
    if (trim($email) == "")
        return false;
    if (!filter_var($email, FILTER_VALIDATE_EMAIL))
        return false;
    return true;
}
