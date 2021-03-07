<?php
    require('model/database.php');
    require('model/flights_db.php');

    $aircraft = filter_input(INPUT_POST, 'ItemNum', FILTER_SANITIZE_STRING);
    $flighttype = filter_input(INPUT_POST, 'Title', FILTER_SANITIZE_STRING);
    $pushbackTime = filter_input(INPUT_POST, 'Description', FILTER_SANITIZE_STRING);
    $shutdownTime = filter_input(INPUT_POST, 'categoryName', FILTER_SANITIZE_STRING);
    $fuel = filter_input(INPUT_POST, 'flightID', FILTER_VALIDATE_INT);
    $comments = filter_input(INPUT_POST, 'categoryName', FILTER_SANITIZE_STRING);

    $action = filter_input(INPUT_POST, 'action', FILTER_SANITIZE_STRING);
    if (!$action) {
        $action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING);
        if (!$action) {
            $action = 'list_flights';
        }
    }

    switch($action) {
        case "list_flights":
            $flights = get_flights();
            if ($flights) {
                include('view/list_flights.php');
                break; }
            break;
        case "add_flight":
            add_flight($aircraft, $flighttype, $pushbackTime, $shutdownTime, $fuel, $comments);
            include('view/interact.php');
            header("Location: .?index.php");
            break;
        default:
            $flights = get_flights();
            if ($flights) {
                include('view/list_flights.php');
                break;
            }
            break; }