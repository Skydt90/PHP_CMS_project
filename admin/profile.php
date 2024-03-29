<?php include "includes/admin_header.php"; ?>

<?php
    
    if(isset($_SESSION["username"]))
    {
        $username = $_SESSION["username"];
        $query = "SELECT * FROM users WHERE username = '$username'";
        $user_query = mysqli_query($connection, $query);
        confirm_query($user_query);
        
        while($row = mysqli_fetch_assoc($user_query))
        {
            $user_id = $row["user_id"];
            $username = $row["username"];
            $user_password = $row["user_password"];
            $user_firstname = $row["user_firstname"];
            $user_lastname = $row["user_lastname"];                       
            $user_email = $row["user_email"];
            $user_image = $row["user_image"];
        }
    }

    if(isset($_POST["edit_user"]))
    {
        $user_firstname = $_POST["user_firstname"];
        $user_lastname = $_POST["user_lastname"];
        $username = $_POST["username"];
        $user_email = $_POST["user_email"];
        $user_password = $_POST["user_password"];
        
        if(!empty($user_password) && !empty($user_firstname) && !empty($username) && !empty($user_email))
        {
            $user_password = mysqli_real_escape_string($connection, $user_password);
            $user_firstname = mysqli_real_escape_string($connection, $user_firstname);
            $user_lastname = mysqli_real_escape_string($connection, $user_lastname);
            $user_email = mysqli_real_escape_string($connection, $user_email);
            $username = mysqli_real_escape_string($connection, $username);
            $user_password = password_hash($user_password, PASSWORD_BCRYPT, ["cost" => 10]);                                               
            
            $query = "UPDATE users SET user_firstname = '$user_firstname', " ;
            $query .= "user_lastname = '$user_lastname', ";
            $query .= "username = '$username', user_email = '$user_email', user_password = '$user_password' ";
            $query .= "WHERE user_id = $user_id ";

            $edit_user_query = mysqli_query($connection, $query);
            confirm_query($edit_user_query); 
            header("Location: index.php");
        }
    }


?>


<div id="wrapper">
<!-- Navigation -->
<?php include "includes/admin_navigation.php"; ?>
    <div id="page-wrapper">

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        Update Profile
                        <small><?php echo $_SESSION["username"]; ?></small>
                    </h1>
                    
                    <form action="" method="post" enctype="multipart/form-data">
   
                        <div class="form-group">
                            <label for="post_tags">Username</label>
                            <input type="text" value="<?php echo $username; ?>" class="form-control" name="username">
                        </div>
                        
                        <div class="form-group">
                            <label for="post_content">Email</label>
                            <input type="email" value="<?php echo $user_email; ?>" class="form-control" name="user_email" >
                        </div>

                        <div class="form-group">
                            <label for="post_content">Password</label>
                            <input type="password" autocomplete="off" class="form-control" name="user_password">
                        </div>
                        <div class="form-group">
                            <label for="post_author">First name</label>
                            <input type="text" value="<?php echo $user_firstname; ?>" class="form-control" name="user_firstname">
                        </div>

                        <div class="form-group">
                            <label for="post_status">Last name</label>
                            <input type="text" value="<?php echo $user_lastname; ?>" class="form-control" name="user_lastname">
                        </div> 
                        <!--
                        <div class="form-group">
                            <label for="post_image">Post Image</label>
                            <input type="file" name="post_image">
                        </div> 
                        -->
                        <div class="form-group">
                            <input type="submit" class="btn btn-primary" name="edit_user" value="Update Profile">
                        </div>  
                    </form>
                </div>
            </div>
        </div>

    </div>
<!-- /#page-wrapper -->
<?php include "includes/admin_footer.php"; ?>