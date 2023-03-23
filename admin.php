<?php
    @include 'database/db.php';

    if (isset($_POST['add_category'])) {
       $cat_name = $_POST['cat_name'];
       $cat_level = $_POST['cat_level'];
       $cat_image = $_FILES['cat_image']['name'];
       $cat_image_tmp_name = $_FILES['cat_image']['tmp_name'];
       $cat_image_folder = 'uploaded_img/' .$cat_image;
       $cat_type = $_POST['cat_type'];

       $insert_query = mysqli_query($db, "INSERT INTO `categories`(name, level, image, category) VALUES ('$cat_name', '$cat_level', '$cat_image', '$cat_type')") or die('query failed');

       if ($insert_query) {
           move_uploaded_file($cat_image_tmp_name, $cat_image_folder);
           $message[] = 'Category added successfully'; 
       }else {
           $message[] = 'Could not add the category';
       }
    };

    if (isset($_GET['delete'])) {
        $delete_id = $_GET['delete'];
        $delete_query = mysqli_query($db, "DELETE FROM `categories` WHERE id= $delete_id");
        if ($delete_query) {
            // header('location: admin.php');
            $message[] = 'Category succesfully deleted';
        }else{
            // header('location: admin.php');
            $message[] = 'Category could not be deleted';
        }
    }

?>





<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="images/CAS Logo Main_PNG.png" rel="icon">
    <title>Admin Page</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link rel="stylesheet" href="css/admin.css">
</head>
<body>



    <?php
        if (isset($message)) {
            foreach($message as $message){
                echo '<div class="message"><span>'.$message.'</span><i class="fas fa-times" onclick="this.parentElement.style.display=`none`;"></i></div>';
            }
        }
    ?>
    <?php
        @include 'header.php';

    ?>

    <div class="container">
        <section>
            <form action="" method="post" class="add-user-category-form" enctype="multipart/form-data">
                <h3>Add A Category</h3>
                <select name="cat_type" class="box" required>
                    <option value="SELECT">Select A category</option>
                    <option value="FACE OF CAS"> FACE OF CAS </option>
                    <option value="MOST SOCIABLE MALE"> MOST SOCIABLE MALE </option>
                    <option value="MOST SOCIABLE FEMALE"> MOST SOCIABLE FEMALE </option>
                    <option value="ENTERPRENEUR OF THE YEAR MALE"> ENTERPRENEUR OF THE YEAR MALE </option>
                    <option value="ENTERPRENEUR OF THE YEAR MALE"> ENTERPRENEUR OF THE YEAR FEMALE </option>
                    <option value="SPORTSMAN OF THE YEAR MALE"> SPORTMAN OF THE YEAR MALE </option>
                    <option value="SPORTSMAN OF THE YEAR MALE"> SPORTMAN OF THE YEAR FEMALE </option>
                    <option value="MOST INNOVATIVE MALE"> MOST INNOVATIVE FEMALE </option>
                    <option value="MOST INNOVATIVE FEMALE"> MOST INNOVATIVE FEMALE </option>
                    <option value="FINAL YEAR PERSONALITY MALE"> FINAL YEAR PERSONALITY MALE </option>
                    <option value="FINAL YEAR PERSONALITY FEMALE"> FINAL YEAR PERSONALITY FEMALE </option>
                    <option value="FRESHEST FRESHER MALE"> FRESHEST FRESHER MALE </option>
                    <option value="FRESHEST FRESHER FEMALE"> FRESHEST FRESHER FEMALE </option>
                   

                </select>
                <input type="text" name="cat_name"  placeholder="Enter the user name" class="box" required>
                <select name="cat_level" placeholder="Select the candidates level" class="box" required>
                    <option value="SELECT">Select A Level</option>
                    <option value="100"> 100 </option>
                    <option value="200"> 200 </option>
                    <option value="300"> 300 </option>
                    <option value="400"> 400 </option>
                    <option value="500"> 500 </option>
                   

                </select>
                <input type="file" name="cat_image" accept="image/png, image/jpg, image/jpeg" class="box" required>

                <input type="submit" value="add the category" name="add_category" class="btn">
            </form>
        </section>

        <section class="display-category-table">
            <table>
                <thead>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Level</th>
                    <th>Category</th>

                    <th>Action</th>
                </thead>

                <tbody>
                    <?php
                        $select_products = mysqli_query($db, "SELECT * FROM `categories`");
                        if(mysqli_num_rows($select_products) > 0){
                            while ($row = mysqli_fetch_assoc($select_products)) {
                    ?>

                    <tr>
                        <td><img src="uploaded_img/<?php echo $row['image'] ?>" height="100"></td>
                        <td><?php echo $row['name']?></td>
                        <td><?php echo $row['level']?></td>
                        <td><?php echo $row['category']?></td>

                        <td>
                            <a href="admin.php?delete=<?php echo $row['id']; ?>" class="delete-btn" onclick="return confirm('are you sure you want to delete this?')"><i class="fas fa-trash"></i>Delete</a>
                        </td>
                    </tr>

                    <?php
                            };
                        }else{
                            echo "<div class='empty'>No Category Added</div>";
                        }
                    ?>
                </tbody>
            </table>
        </section>

  
    </div>



    <script src="js/script.js"></script>
</body>
</html>