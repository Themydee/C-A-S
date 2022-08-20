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
                    <option value="Face Of CAS Male">Face Of CAS Male</option>
                    <option value="Face Of CAS Female">Face Of CAS Female</option>
                    <option value="Most Sociable Male">Most Sociable MALE</option>
                    <option value="Most Sociable Female">Most Sociable FEMALE</option>
                    <option value="Most Innovative Male">Most Innovative MALE</option>
                    <option value="Most Innovative Female">Most Innovative FEMALE</option>
                    <option value="Enterpreneur Of The Year Male">Enterpreneur Of the Year MALE</option>
                    <option value="Enterpreneur Of The Year Female">Enterpreneur Of the Year FEMALE</option>
                    <option value="Sport Person Of The Year Male">Sport Person Of the Year MALE</option>
                    <option value="Sport Person Of The Year Female">Sport Person Of the Year FEMALE</option>
                    <option value="Final Year Personality Male">Final Year Personality MALE</option>
                    <option value="Final Year Personality Female">Final Year Personality FEMALE</option>
                    <option value="Freshman Of The Year Male">Freshman of the Year MALE</option>
                    <option value="Freshman Of The Year Female">Freshman Of the Year FEMALE</option>
                    <option value="Class Rep Of The Year">Class Rep Of The  Year</option>
                    <option value="Face Of CAS Female">Student Of The Year</option>

                </select>
                <input type="text" name="cat_name"  placeholder="Enter the user name" class="box" required>
                <input type="text" name="cat_level" placeholder="Enter the user level" class="box" required>
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
                            echo "<div class='empty'>No Ctegory Added</div>";
                        }
                    ?>
                </tbody>
            </table>
        </section>

  
    </div>



    <script src="js/script.js"></script>
</body>
</html>