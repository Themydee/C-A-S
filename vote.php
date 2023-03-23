<?php
    @include 'database/db.php';

    if(!empty($_POST['category']) && !empty($_POST['name']) && !empty($_POST['vote_id'])) {
        $category = $_POST['category'];
        $name = $_POST['name'];
        $vote_id = $_POST['vote_id'];

        $check_sql = "SELECT * FROM vote WHERE vote_id = $vote_id AND category = '$category'";
        $check_result = mysqli_query($db, $check_sql);

        if(mysqli_num_rows($check_result) > 0) {
            echo 3;
        } else {
            $sql = "INSERT INTO vote (name, category, vote_id) VALUES('$name', '$category', $vote_id)";
            $result = mysqli_query($db, $sql);

            if($result) {
                echo 2;
            } else {
                echo 1;
            }
        }
    } else {
        echo 0;
    }