<?php
    session_start();
    // Composer autoloader
    require_once 'vendor/autoload.php';

    require_once 'services/GenerateTicket.php';

    $generateTicket = new GenerateTicket();

    $generateTicket->run();




