<?php
    @include 'database/db.php';
    session_start();
    

    if(!empty($_POST['category']) && !empty($_POST['name']) && !empty($_POST['vote_id'])) {
        $category = $_POST['category'];
        $name = $_POST['name'];
        $vote_id = $_POST['vote_id'];
    

        $user_id = $_SESSION['user_id'];

        $check_sql = "SELECT * FROM vote WHERE category = '$category' AND user_id = '$user_id'";
        $check_result = mysqli_query($db, $check_sql);

        if(mysqli_num_rows($check_result) > 0) {
            echo 3;
        } else {
            $sql = "INSERT INTO vote (name, category, vote_id, user_id) VALUES ('$name', '$category', '$vote_id', '$user_id')";
            $result = mysqli_query($db, $sql);

            if($result) {
                echo 2; // Vote successful
            } else {
                echo 1; // Something went wrong
            }
        }
    } else {
        echo 0; // Missing required parameters
    }
?>
