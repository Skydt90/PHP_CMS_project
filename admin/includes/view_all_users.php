
<table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Username</th>
                    <th>First name</th>
                    <th>Last name</th>
                    <th>E-mail</th>
                    <th>Role</th>
                    <th>Make Admin</th>
                    <th>Make Subscriber</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
                <?php

                    $query = "SELECT * FROM users ORDER BY user_id DESC";
                    $user_query = mysqli_query($connection, $query);

                    while($row = mysqli_fetch_assoc($user_query))
                    {
                        
                        $user_id = $row["user_id"];
                        $username = $row["username"];
                        $user_password = $row["user_password"];
                        $user_firstname = $row["user_firstname"];
                        $user_lastname = $row["user_lastname"];                       
                        $user_email = $row["user_email"];
                        $user_image = $row["user_image"];
                        $user_role = $row["user_role"];
                        
                        echo "<tr>";
                        echo "<td>{$user_id}</td>";
                        echo "<td>{$username}</td>";
                        echo "<td>{$user_firstname}</td>";                        
                        /*
                        $category_query = "SELECT * FROM categories WHERE category_id = {$row["post_category_id"]}";
                        $category_result = mysqli_query($connection, $category_query);
                        while($rows = mysqli_fetch_assoc($category_result))
                        {
                            $category_title = $rows["category_title"];       
                        }
                        echo "<td>{$category_title}</td>";*/
                        echo "<td>{$user_lastname}</td>";
                        echo "<td>{$user_email}</td>";
                        echo "<td>{$user_role}</td>";
                        echo "<td><a href='users.php?change_to_admin=$user_id'>Admin</a></td>";
                        echo "<td><a href='users.php?change_to_sub=$user_id'>Subscriber</a></td>";
                        echo "<td><a href='users.php?source=edit_user&u_id=$user_id'>Edit</a></td>";
                        echo "<td><a href='users.php?delete=$user_id'>Delete</a></td>";
                        echo "</tr>";            
                    } 
                ?>                
            </tbody>
        </table>
        
         
        
        <?php 

        if(isset($_GET["delete"]))
        {
            if(isset($_SESSION["user_role"]))
            {
                if($_SESSION["user_role"] == "admin")
                {
                    $user_id = mysqli_real_escape_string($connection, $_GET["delete"]);
                    $query = "DELETE FROM users WHERE user_id = {$user_id}";
                    $delete_query = mysqli_query($connection, $query);
                    confirm_query($delete_query);
                    header("Location: users.php");
                }
            } 
        }

        if(isset($_GET["change_to_admin"]))
        {
            $user_id = $_GET["change_to_admin"];
            $query = "UPDATE users SET user_role = 'admin' WHERE user_id = $user_id ";
            $admin_query = mysqli_query($connection, $query);
            confirm_query($admin_query);
            header("Location: users.php");     
        }

        if(isset($_GET["change_to_sub"]))
        {
            $user_id = $_GET["change_to_sub"];
            $query = "UPDATE users SET user_role = 'subscriber' WHERE user_id = $user_id ";
            $sub_query = mysqli_query($connection, $query);
            confirm_query($sub_query);
            header("Location: users.php");    
        }

        ?>
