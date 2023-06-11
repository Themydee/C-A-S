<?php
    @include 'database/db.php';
    
    session_start();

    if(isset($_SESSION['user_name'])){
        session_destroy();
        header('location: home.php');
    }

    if (isset($_POST['submit'])) {

        $email = mysqli_real_escape_string($db, $_POST['email']);
        $pass = md5($_POST['password']);
        $select = " SELECT * FROM user_form WHERE email = '$email' && password = '$pass' ";

        $result = mysqli_query($db, $select);

        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_array($result);

            if ($row['user_type'] == 'admin') {

                $_SESSION['admin_name'] = $row['name'];
                header('location: admin.php');

            }elseif ($row['user_type'] == 0) {

                $_SESSION['user_name'] = $row['name'];
                $_SESSION['user_id'] = $row['id'];
                header('location: home.php');
                
            }elseif ($row['user_type'] == 1) {

                $_SESSION['user_name'] = $row['name'];
                header('location: admin.php');
            }
        }else{
            $error[] = 'Incorrect Email or Password';
        }

        //when CAS ASSOCIATION VOTING HAPPENS
        // if (mysqli_num_rows($result) > 0) {
        //     $row = mysqli_fetch_array($result);

        //     if ($row['user_college'] == 'CAS')  {
        //         $_SESSION['user_name'] = $row['name'];
        //         $_SESSION['user_id'] = $row['id'];
        //         header('location: home.php');

        //     }elseif ($row['user_college'] !== 'CAS' ) {
        //         $_SESSION['user_name'] = $row['name'];
        //         $_SESSION['user_id'] = $row['id'];
        //         header('location: login.php');
        //     }
        // }else{
        //     $error[] = 'Incorrect Email or Password';
        // }
    };

?>  

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
   

    <div class="login-page">
        <div class="display">
            <div class="home-info">
                
            </div>
        </div>

        <div class="login-spot">

            <div class="form-container">
                <form action="" method="post">

                <img src="images/CAS Logo Main_PNG.png" width="150px" alt="">
                    <h3>Login Page</h3>
                    
                    <?php
                        if (isset($error)) {
                            foreach ($error as $error) {
                                echo '<span class="error-msg">'.$error.'</span>';
                            };                
                        };
                    ?>
                    <input type="email" name="email" required placeholder="Enter your email">
                    <input type="password" name="password" required placeholder="Enter your password">


                    <input type="submit" name="submit" value="Login now" class="form-btn">
                    <p>Don't have an account? <a href="register.php">Register Now</a></p>
                </form>
            </div>
        </div>
    </div>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
     <script src="js/countdown.js"></script>
     <script src="js/init.js"></script>
</body>
</html>
