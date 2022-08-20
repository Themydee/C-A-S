<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/style.css">
  <title>Document</title>
</head>
<body>
      <div class="login-page">
        <div class="login-spot">
          <div class="form-container">
            <img src="images/CAS Logo Main_PNG.png" width="450px">
          </div>
        </div>

        <div class="display">
          <div class="home-info">
            <h1 style="color: #fff">VOTING BEGINS IN</h1>
              <!-- You can change the date time in init.js file -->
            <ul class="countdown">
              <li>
                  <span class="days">14</span>
                  <h3>Days</h3>
              </li>
              <li>
                  <span class="hours">10</span>
                  <h3>hours</h3>
              </li>
              <li>
                  <span class="minutes">15</span>
                  <h3>minutes</h3>
              </li>
              <li>
                  <span class="seconds">34</span>
                  <h3>seconds</h3>
              </li>    
            </ul>
            <button class="vote-btn" style="width: 200px; margin-bottom: 1rem; " name="vote-btn"><a href="login.php">Vote Now</a></button>
          </div>
        </div>
      </div>
  
      <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
     <script src="js/countdown.js"></script>
     <script src="js/init.js"></script>
</body>
</html>
