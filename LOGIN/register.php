<?php
    @include 'database/db.php';



    if (isset($_POST['submit'])) {
        $name = mysqli_real_escape_string($db, $_POST['name']);
        $email = mysqli_real_escape_string($db, $_POST['email']);
        $pass = md5($_POST['password']);
        $cpass = md5($_POST['cpassword']);
     

        $select = " SELECT * FROM user_form WHERE email = '$email' && password = '$pass' ";

        $result = mysqli_query($db, $select);

        if (mysqli_num_rows($result) > 0) {
            $error = 'user already exists';
        }else{
            if ($pass != $cpass) {
                $error[] = 'Passwords do not match'; 
            }else {
                $insert = "INSERT INTO user_form(name, email, password, user_type) values('$name', '$email', '$pass', '0')";
                mysqli_query($db, $insert);
                header('location: login.php');
            }
        }
    };

?>


<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Form</title>
    <link href="images/CAS Logo Main_PNG.png" rel="icon">
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
                    <br>
                    <br>
                    <h3>Registration Page</h3>

                    <?php
                        if (isset($error)) {
                            foreach ($error as $error) {
                                echo '<span class="error-msg">'.$error.'</span>';
                            };              
                        };
                    ?>
                    <input type="text" name="name" required placeholder="Enter your name">
                    <input type="email" name="email" required placeholder="Enter your valid email" >
                    <input type="password" name="password" required placeholder="Enter your password">
                    <input type="password" name="cpassword" required placeholder="Confirm your Password">
                    <input type="submit" name="submit" value="Register now" class="form-btn">
                    <p>Need a strong password? <a href="generate.html">Generate Now</a></p>
                    <p>Already have an account? <a href="login.php">Login Now</a></p>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
     <script src="js/countdown.js"></script>
     <script src="js/init.js"></script>
</body>
</html>
