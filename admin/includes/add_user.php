<?php 
    
    $message = "";

    if(isset($_POST["create_user"]))
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

            $query = "INSERT INTO users(user_firstname, user_lastname, user_role, username, ";
            $query .= "user_email, user_password, user_image) ";
            $query .= "VALUES ('{$user_firstname}', '{$user_lastname}', '{$user_role}', ";
            $query .= "'{$username}', '{$user_email}', '{$user_password}', '')";

            $create_user_query = mysqli_query($connection, $query);
            confirm_query($create_user_query);
            
            $message = "Registration Complete";
        }
        else
        {
            $message = "Fields cannot be empty";
        }
    }

?>
   
<form action="" method="post" enctype="multipart/form-data">
    <h6 class="text-center"><?php echo $message; ?></h6>    
    <div class="form-group">
        <label for="post_tags">Username</label>
        <input type="text" class="form-control" name="username">
    </div>
    
    <div class="form-group">
        <select name="user_role" id="">
            <option value="subscriber">Select Option</option>
            <option value="admin">admin</option>
            <option value="subscriber">subscriber</option>
        </select>
    </div>
    
    <div class="form-group">
        <label for="post_content">Email</label>
        <input type="email" class="form-control" name="user_email" >
    </div>
    
    <div class="form-group">
        <label for="post_content">Password</label>
        <input type="password" class="form-control" name="user_password">
    </div>
    <div class="form-group">
        <label for="post_author">First name</label>
        <input type="text" class="form-control" name="user_firstname">
    </div>
    
    <div class="form-group">
        <label for="post_status">Last name</label>
        <input type="text" class="form-control" name="user_lastname">
    </div> 
    <div class="form-group">
        <input type="submit" class="btn btn-primary" name="create_user" value="Create User">
    </div>  
</form>