<?php
    @include 'database/db.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <link rel="shortcut icon" href="CAS Logo Main_PNG.png" type="image/x-icon">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="images/CAS Logo Main_PNG.png" rel="icon">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <title>CAS VOTING SITE</title>
</head>

<body>
  <nav
  class="d-flex py-4 bg-white shadow text-right text-dark px-2 px-md-3 px-lg-5"
>
<a class="mr-auto" href="#">CAS Vote</a>
  
<a style="text-align: right;" href="login.php">Login</a>



<!-- <?= $_SESSION['user_name'] ?> -->
</nav>


<div class="bg-white w-100">
  <div
    class="cat-head p-5 w-100 text-center"
    style="
      background-color: #f1f1f1;
      font-family: 'Nunito', sans-serif;
      color: #239540;
      border-left: solid 15px #0d5817;
    "
  >
    <span class="display-5 text-center"><img src="images/CAS Logo Main_PNG.png" width="70px">  CAS Categories </span>
  </div>
  <div class="text-center w-75 mx-auto py-5" style="max-width: 880px">
  <?php
    $sql = 'SELECT DISTINCT category FROM categories';
    $result = mysqli_query($db, $sql);  

    if(mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) { ?>
            <a
            href="<?= 'categories1.php?category=' . $row['category'] ?>"
            class="m-1 m-md-2 btn cat-link"
            ><?= $row['category'] ?></a
          >
       <?php }
    }
  ?>

  </div>
</div>

<div class="footer"></div>
<style>
  
  .cat-link {
    border: dashed 1px #999;
    color: #999;
  }
  .cat-link:hover {
    color: #0cc71b;
    border-color: #05a10d;
    box-shadow: none;
  }
  .cat-link:active {
    box-shadow: none;
  }
</style>

    <div
      class="w-100 text-right text-muted mt-n5 p-3 copyright"
      style="font-size: 0.75rem"
    >
      <hr class="d-inline-block w-50 mr-2" style="vertical-align: middle" />
      Developed by
      <a target="_blank" href="https://themydee.brimble.app/" class="my-name"
        >Coded Farmer</a
      >
    </div>
    
    <style>
      .display-5 {
        font-size: 3rem;
      }
      .my-name {
        border-bottom: 2px dotted;
        color: #1ab922;
      }
      .my-name:hover {
        color: rgb(12, 95, 70);
        text-decoration: none;
      }
    </style>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/8.11.8/sweetalert2.all.js"></script>
</body>
</html>
