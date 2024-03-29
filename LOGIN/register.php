<?php
    @include 'database/db.php';
    
    if (isset($_POST['submit'])) {
        $name = mysqli_real_escape_string($db, $_POST['name']);
        $email = mysqli_real_escape_string($db, $_POST['email']);
        $college = ( $_POST['college']);
        $pass = md5($_POST['password']);
        $cpass = md5($_POST['cpassword']);
        
        $query = mysqli_query($db, " SELECT * FROM user_form WHERE email = '$email' && name = '$name' ");
    
        // Validate email format
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            $error[] = 'Invalid email format';
        }

        // Check if the email ends with @lmu.edu.ng
        $pattern = '/@lmu\.edu\.ng$/';
        if (!preg_match( $pattern, $email)) {
           echo 'Only @lmu.edu.ng email addresses are allowed';
            exit;
        }


        if (mysqli_num_rows($query) > 0) {
            $error[] = 'user already exists';
        }else{
            if ($pass != $cpass) {
                $error[] = 'Passwords do not match'; 
            }else {
                $insert = "INSERT INTO user_form(name, email, college, password, user_type) values('$name', '$email', '$college', '$pass', '0')";
                header('location: login.php');
                mysqli_query($db, $insert);
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
    <link href="images/CAS Logo Main_PNG.png" rel="icon" >
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
                    <img src="images/CAS Logo Main_PNG.png" width="100px" alt="">
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
                    <input type="email" name="email" required placeholder="Enter your Lmu mail" >
                    <select type="college" name="college" required placeholder="Enter your Lmu mail" >
                        <option value="SELECT">Select College</option>
                        <option value="CAS"> CAS </option>
                        <option value="CBS"> CBS </option>
                        <option value="CPAS"> COE </option>
                        <option value="CPAS"> CPAS </option>
                    </select>
                    <input type="password" name="password" required placeholder="Enter your password">
                    <input type="password" name="cpassword" required placeholder="Confirm your Password">
                    <input type="submit" name="submit" value="Register now" class="form-btn">
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
