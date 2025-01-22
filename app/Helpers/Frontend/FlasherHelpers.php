<?php

use Flasher\Laravel\Facade\Flasher;
use Spatie\FlareClient\Flare;

function display_success_message($message){
     return Flasher::addSuccess($message) ; 
}

function display_error_message($message){
     return Flasher::addError($message) ; 
}

function display_warning_message($message){
    return Flasher::addWarning($message) ; 
}

function display_info_message($message){
    return Flasher::addInfo($message) ; 
}