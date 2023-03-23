<?php


@include 'database/db.php';


    if (isset($_POST["verify_email"]))
    {
        $email = mysqli_real_escape_string($db, $_POST['email']);
        $verification_code = mysqli_real_escape_string($db, $_POST['verification_code']);


        // mark email as verified
        $sql = "UPDATE user_form SET email_verified_at = NOW() WHERE  email = '$email' AND verification_code = '$verification_code'";
        $result  = mysqli_query($db, $sql);

        // if (mysqli_affected_rows($db) == 0)
        // {
        //     die("Verification code failed.");
        // }


        echo "<p>You can login now.</p>";
        exit();
    }
    
    if (isset($_POST['submit'])) {

        $email = mysqli_real_escape_string($db, $_POST['email']);
        $verification_code = mysqli_real_escape_string($db, $_POST['verification_code']);
        $select = " SELECT * FROM user_form WHERE email = '$email' && verification_code = '$verification_code' ";

        $result = mysqli_query($db, $select);

        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_array($result);

            if ($row['user_type'] == 'admin') {

                $_SESSION['admin_name'] = $row['name'];
                header('location: admin.php');

            }elseif ($row['user_type'] == 0) {

                $_SESSION['user_name'] = $row['name'];
                header('location: home.php');
                
            }elseif ($row['user_type'] == 1) {

                $_SESSION['user_name'] = $row['name'];
                header('location: admin.php');
            }
        }else{
            $error[] = 'Incorrect Verification code';
        }
    };

?>




<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verification Page</title>
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
                    <h3>Verification Form</h3>
                    
                    <?php
                        if (isset($error)) {
                            foreach ($error as $error) {
                                echo '<span class="error-msg">'.$error.'</span>';
                            };                
                        };
                    ?>
                    <input type="email" name="email" required placeholder="Enter your email">
                    <input type="text" name="verification_code" placeholder="Enter verification code" required />


                    <input type="submit" name="submit" value="Verify Email" class="form-btn">
                
                </form>
            </div>
        </div>
    </div>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
     <script src="js/countdown.js"></script>
     <script src="js/init.js"></script>
</body>
</html>
