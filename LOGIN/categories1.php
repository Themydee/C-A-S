<?php
  @include "database/db.php";
  session_start();

  if(!isset($_SESSION['user_name'])){
    header('location:login.php');
  }

  if (isset($_GET['category'])) {
    $category = $_GET['category'];
    $sql = "SELECT * FROM categories WHERE category = '$category'";
    $result = mysqli_query($db, $sql);
  }

?>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <link
      rel="stylesheet"
      href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
      integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh"
      crossorigin="anonymous"
    />
    
    <link rel="stylesheet" href="css/style.css">
<link
  href="https://fonts.googleapis.com/css?family=Nunito:600&display=swap"
  rel="stylesheet"
/>

    <title> <?= $category ?> </title>
  </head>
  <body>
    
<!-- Nav -->
<nav
  class="d-flex py-4 bg-white shadow text-right text-dark px-2 px-md-3 px-lg-5"
>
  <a class="mr-auto" href="home.php" ><img src="images/CAS Logo Main_PNG.png" width="70px"></a>
  

</nav>

<div class="bg-light w-100">
  <div
    class="cat-head p-5 w-100 shadow-s"
    style="
      background-color: #f1f1f1;
      font-family: 'Nunito', sans-serif;
      color: #0e6e1b;
      border-left: solid 15px rgb(37, 149, 25);
    "
  >
    <span class="display-5 px-5"> <?= $category ?> </span>
  </div>
  <br>

  <section class="wrapper">
  
    <div class="category-pictures" > 
        <?php 
          if(mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) { ?>
              <div> 
                <div style="background-color: black; height: 400px; color: white; position: relative; margin-bottom: 1rem; ">
                    <span style="box-sizing: border-box; display: block; overflow: hidden; width: initial; height: initial; background: none; opacity: 1; border: 0px; margin: 0px; padding: 0px; position: absolute; inset: 0px;">
                        <img alt="" src="uploaded_img/<?= $row['image']?>" style="position: absolute; inset: 0px; box-sizing: border-box; padding: 0px; border: none; margin: auto; display: block; width: 0px; height: 0px; min-width: 100%; max-width: 100%; min-height: 100%; max-height: 100%; object-fit: cover;">
                        <noscript></noscript>
                    </span>
                    <div style="z-index: 100; position: absolute; bottom: 0px; left: 0px; width: 100%; padding: 1rem; box-sizing: border-box; background-color: rgba(0, 0, 0, 0.4); color: white; font-size: 1.2rem; font-weight: 600;"><?= $row['name'] ?> <br> <?= $row['level'] ?></div>
                </div>
                <div class="cat-nav">
                  <?php
                    $c_name = $row['name'];
                    $c_cat = $row['category'];
                    $user_id = $row['id'];
                  ?>
                  <!-- <input type="text" value="<?=$row['name']?>" style="border: 2px solid red" id='name'>
                  <input type="text" value="<?=$row['category']?>" style="border: 2px solid red" id='category'> -->
                  <!-- <input type="text" value="<?=$row['id']?>" style="border: 2px solid red" id='user_id'> -->
                  <button class="vote-btn" name="vote-btn" onclick="castVote('<?=$c_name?>','<?=$c_cat?>','<?=$user_id?>')">
                    Vote
                  </button>
                </div>
              </div>

        <?php
            }
          }
        ?>
    </div>

    <div class="cat-nav" style="text-align: center">
      <?php
       $nextCategory = mysqli_fetch_assoc(mysqli_query($db, "SELECT MIN(category) AS next_category FROM categories WHERE category > '$category'"))['next_category'];

      ?>
      <button><a href="<?= 'categories1.php?category=' . $nextCategory ?>" style="color: black; text-decoration: none; text-underline: none; text-align: center;">Next Category >></a></button>
      </div>
      
  </section>

  
    
 
</div>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['vote-btn'])) {
  // Process the vote
  echo "hello world";
}

?>





<style>
  .cat-nav-btn {
    padding: 10px;
    margin-left: 5px;
    margin-right: 5px;
    border: 1px solid rgb(16, 177, 35);
  }
</style>


    <div
      class="w-100 text-right text-muted mt-n5 p-3 copyright"
      style="font-size: 0.75rem"
    >
      <hr class="d-inline-block w-50 mr-2" style="vertical-align: middle" />
      Developed by
      <a target="_blank" href="http://themydeecodes.000webhostapp.com" class="my-name"
        >Coded Farmer</a
      >
    </div>
    
    <style>
      .display-5 {
        font-size: 3rem;
      }
      .my-name {
        border-bottom: 2px dotted;
        color: #108e29;
      }
      .my-name:hover {
        color: rgb(8, 101, 23);
        text-decoration: none;
      }
    </style>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/8.11.8/sweetalert2.all.js"></script>
          <!------Vote Count function-------->
    <script>
      function castVote(name, category, id, user_id) {
        $.ajax({
        url: 'vote.php',
        method: 'POST',
        data: {
          name,
          category,
          vote_id: id,
          user_id: user_id
        },
        success: (response) => {
          if (response == 2) {
            Swal.fire(
              'Good job!',
              'Vote successful',
              'success'
            )
          } else if (response == 3) {
            Swal.fire(
              'Not successful!',
              'You cannot vote again',
              'error'
            );
          } else {
        Swal.fire(
          'Not successful!',
          'Something went wrong',
          'error'
        );
      }
    },
    error: (e) => {
      Swal.fire(
        'Not successful!',
        `${e}`,
        'error'
      );
    }
  });
}

    </script>
  </body>
</html>
