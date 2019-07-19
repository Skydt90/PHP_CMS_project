<?php 

    if(isset($_GET["u_id"]))
    {
        $user_id = escape($_GET["u_id"]);
        
        $query = "SELECT * FROM users WHERE user_id = $user_id";
        $user_query = mysqli_query($connection, $query);
        confirm_query($user_query);

        while($row = mysqli_fetch_assoc($user_query))
        {
            $user_id = $row["user_id"];
            $username = $row["username"];
            $db_user_password = $row["user_password"];
            $user_firstname = $row["user_firstname"];
            $user_lastname = $row["user_lastname"];                       
            $user_email = $row["user_email"];
            $user_image = $row["user_image"];
            $user_role = $row["user_role"];
        }
    }

    
    if(isset($_POST["edit_user"]))
    {
        $user_firstname = escape($_POST["user_firstname"]);
        $user_lastname = escape($_POST["user_lastname"]);
        $user_role = escape($_POST["user_role"]);
        $username = escape($_POST["username"]);
        $user_email = escape($_POST["user_email"]);
        $user_password = escape($_POST["user_password"]);
        
        if(!empty($username) && !empty($user_email) && !empty($user_password))
        {   
            $user_password = password_hash($user_password, PASSWORD_BCRYPT, array("cost" => 10));
            
            $query = "UPDATE users SET user_firstname = '$user_firstname', " ;
            $query .= "user_lastname = '$user_lastname', user_role = '$user_role', ";
            $query .= "username = '$username', user_email = '$user_email', user_password = '$user_password' ";
            $query .= "WHERE user_id = $user_id ";

            $edit_user_query = mysqli_query($connection, $query);
            confirm_query($edit_user_query);
            header("Location: users.php");
        }
    }

?>
   
<form action="" method="post" enctype="multipart/form-data">
   
    <div class="form-group">
        <label for="post_tags">Username</label>
        <input type="text" value="<?php echo $username; ?>" class="form-control" name="username">
    </div>
    
    <div class="form-group">
        <select name="user_role" id="">
           <option value="<?php echo $user_role; ?>"><?php echo $user_role; ?></option>
           <?php 
            
                if($user_role == "admin")
                {
                    echo "<option value='subscriber'>subscriber</option>";
                } 
                else 
                {
                    echo "<option value='admin'>admin</option>";
                }
            
            ?>
        </select>
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
        <input type="submit" class="btn btn-primary" name="edit_user" value="Edit User">
    </div>  
</form>