<?php


@include 'database/db.php';


    if (isset($_POST["verify_email"]))
    {
        $email = $_POST["email"];
        $verification_code = $_POST["verification_code"];


        // mark email as verified
        $sql = "UPDATE users SET email_verified_at = NOW() WHERE email = '" . $email . "' AND verification_code = '" . $verification_code . "'";
        $result  = mysqli_query($db, $sql);

        if (mysqli_affected_rows($db) == 0)
        {
            die("Verification code failed.");
        }

        echo "<p>You can login now.</p>";
        exit();
    }

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
                    <input type="email" name="email" required placeholder="Enter your email" value="<?php echo $_GET['email']; ?>">
                    <input type="text" name="verification_code" placeholder="Enter verification code" required />


                    <input type="submit" name="verify_email" value="Verify Email">
                
                </form>
            </div>
        </div>
    </div>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
     <script src="js/countdown.js"></script>
     <script src="js/init.js"></script>
</body>
</html>