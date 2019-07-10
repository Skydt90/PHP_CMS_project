
<table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Username</th>
                    <th>First name</th>
                    <th>Last name</th>
                    <th>E-mail</th>
                    <th>Role</th>
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
    
                        echo "<td><a href='comments.php?approve='>Approve</a></td>";
                        echo "<td><a href='comments.php?unapprove='>Unapprove</a></td>";
                        echo "<td><a href='comments.php?delete='>Delete</a></td>";
                        echo "</tr>";            
                    } 
                ?>               
            </tbody>
        </table>
        
        <?php 

        if(isset($_GET["delete"]))
        {
            $comment_id = $_GET["delete"];
            $query = "DELETE FROM comments WHERE comment_id = {$comment_id}";
            $delete_query = mysqli_query($connection, $query);
            confirm_query($delete_query);
            header("Location: comments.php");
            
        }

        if(isset($_GET["unapprove"]))
        {
            $comment_id = $_GET["unapprove"];
            $query = "UPDATE comments SET comment_status = 'unapproved' WHERE comment_id = $comment_id ";
            $unapprove_query = mysqli_query($connection, $query);
            confirm_query($unapprove_query);
            header("Location: comments.php");     
        }

        if(isset($_GET["approve"]))
        {
            $comment_id = $_GET["approve"];
            $query = "UPDATE comments SET comment_status = 'approved' WHERE comment_id = $comment_id ";
            $approve_query = mysqli_query($connection, $query);
            confirm_query($approve_query);
            header("Location: comments.php");     
        }

        ?>
