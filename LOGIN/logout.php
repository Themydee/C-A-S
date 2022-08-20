<?php

@include "database/db.php";

if(isset($_SESSION['user_id'])){
    session_destroy();
    header('location:index.php');
}

// if(!isset($_SESSION['user_name'])){
//     header('location: login.php');
// }