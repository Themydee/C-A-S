<?php

@include "database/db.php";

if(!isset($_SESSION['user_name'])){
    session_destroy();
    header('location: index.php');
}
