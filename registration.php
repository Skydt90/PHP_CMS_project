<?php  include "admin/includes/functions.php"; ?>
<?php  include "includes/header.php"; ?>
<?php  include "includes/navigation.php"; ?>
<?php
    
    $message = "";
    
    if(isset($_POST["create_user"]))
    {
        $username = $_POST["username"];
        $email = $_POST["email"];
        $password = $_POST["password"];
        
        if(!empty($username) && !empty($email) && !empty($password))
        {
            $username = mysqli_real_escape_string($connection, $username);
            $email = mysqli_real_escape_string($connection, $email);
            $password = mysqli_real_escape_string($connection, $password);
            
            $password = password_hash($password, PASSWORD_BCRYPT, array("cost" => 12));

            $query = "INSERT INTO users (username, user_email, user_password, user_role) ";
            $query .= "VALUES ('$username', '$email', '$password', 'subscriber' )";
            $register_user_query = mysqli_query($connection, $query);
            confirm_query($register_user_query);
            
            $message = "Registration complete!";
        }
        else
        {
            $message = "Fields cannot be empty";
        }
        
    }

?>
 
    <!-- Page Content -->
    <div class="container">
    
        <section id="login">
            <div class="container">
                <div class="row">
                    <div class="col-xs-6 col-xs-offset-3">
                        <div class="form-wrap">
                        <h1>Register</h1>
                            <form role="form" action="registration.php" method="post" id="login-form" autocomplete="off">
                                
                               <h6 class="text-center"><?php echo $message; ?></h6>    
                               <div class="form-group">
                                    <label for="username" class="sr-only">username</label>
                                    <input type="text" name="username" id="username" class="form-control" placeholder="Enter Desired Username">
                                </div>
                                 
                                <div class="form-group">
                                    <label for="email" class="sr-only">Email</label>
                                    <input type="email" name="email" id="email" class="form-control" placeholder="somebody@example.com">
                                </div>
                                
                                <div class="form-group">
                                    <label for="password" class="sr-only">Password</label>
                                    <input type="password" name="password" id="key" class="form-control" placeholder="Password">
                                </div>

                                <input type="submit" name="create_user" id="btn-login" class="btn btn-custom btn-lg btn-block" value="Register">
                                
                            </form>      
                        </div>
                    </div> 
                </div> 
            </div>
        </section>
        <hr>
        
<?php include "includes/footer.php";?>