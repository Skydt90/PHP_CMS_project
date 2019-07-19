<?php 
    
    if(isset($_GET["p_id"]))
    {
        $post_id = escape($_GET["p_id"]);
        $query = "SELECT * FROM posts WHERE post_id = {$post_id}";
        $result = mysqli_query($connection, $query);

        while($row = mysqli_fetch_assoc($result))
        {
            $post_user = $row["post_user"];
            $post_title = $row["post_title"];
            $post_category_id = $row["post_category_id"];
            $post_status = $row["post_status"];
            $post_image = $row["post_image"];
            $post_tags = $row["post_tags"];
            $post_comment_count = $row["post_comment_count"];
            $post_date = $row["post_date"];
            $post_content = $row["post_content"];
        }
    }
    

    if(isset($_POST["update_post"]))
    { 
        $post_user = escape($_POST["post_user"]);
        $post_title = escape($_POST["post_title"]);
        $post_category_id = escape($_POST["post_category"]);
        $post_status = escape($_POST["post_status"]);
        $post_image = $_FILES["post_image"]["name"];
        $post_image_tmp = $_FILES["post_image"]["tmp_name"];
        $post_content = escape($_POST["post_content"]);
        $post_tags = escape($_POST["post_tags"]);
        
        move_uploaded_file($post_image_tmp, "../images/$post_image");
        
        if(empty($post_image))
        {
            $query = "SELECT * FROM posts WHERE post_id = {$post_id} ";
            $image = mysqli_query($connection, $query);
            
            while($row = mysqli_fetch_assoc($image))
            {
                $post_image = $row["post_image"];
            }
        }
        
        $query = "UPDATE posts SET post_title = '{$post_title}', ";
        $query .= "post_category_id = '{$post_category_id}', ";
        $query .= "post_date = now(), post_user = '{$post_user}', ";
        $query .= "post_status = '{$post_status}', ";
        $query .= "post_tags = '{$post_tags}', ";
        $query .= "post_content = '{$post_content}', ";
        $query .= "post_image = '{$post_image}' ";
        $query .= "WHERE post_id = {$post_id}";
        
        $result = mysqli_query($connection, $query);
        confirm_query($result);
        echo "<p class='bg-success'>Post updated. <a href='../post.php?p_id=$post_id'> View Post</a> or <a href='./posts.php'> Edit another post</a>";
    }


?>
   

<form action="" method="post" enctype="multipart/form-data">
    
    <div class="form-group">
        <label for="title">Post Title</label>
        <input type="text" value="<?php echo $post_title; ?>" class="form-control" name="post_title">
    </div>
    
    <div class="form-group">
       <label for="category">Category</label>
       <select name="post_category" id="post_category">        
           <?php 
            $query = "SELECT * FROM categories";
            $result = mysqli_query($connection, $query);
            
            confirm_query($result);  
           
            while($row = mysqli_fetch_assoc($result))
            {
                $category_id = $row["category_id"];
                $category_title = $row["category_title"];
                echo "<option value='{$category_id}'>{$category_title}</option>";
            }  
           ?>
       </select>
    </div>
    
    <div class="form-group">
       <label for="users">Users</label>
       <select name="post_user" id="">        
           <?php 
           
            echo "<option value='$post_user'>$post_user</option>";
           
            $user_query = "SELECT * FROM users WHERE username != '$post_user'";  
            $user_result = mysqli_query($connection, $user_query);
            confirm_query($user_result);  
     
            while($row = mysqli_fetch_assoc($user_result))
            {
                $user_id = $row["user_id"];
                $username = $row["username"];
                echo "<option value='$username'>$username</option>";  
            }

           ?>
       </select>
    </div>
    
    <div class="form-group">
        <label for="post_status">Status</label>
        <select name="post_status" id="">
           <option value="<?php echo $post_status; ?>"><?php echo $post_status; ?></option>
           <?php 
                if($post_status == "draft")
                {
                    echo "<option value='published'>publish</option>";
                } 
                else 
                {
                    echo "<option value='draft'>draft</option>";
                }  
            ?>
        </select>
    </div>
    
    <div class="form-group">
        <label for="post_image">Post Image</label>
        <input type="file" name="post_image">
        <img width="100" src="../images/<?php echo $post_image; ?>" alt="">
    </div>
    
    <div class="form-group">
        <label for="post_tags">Post Tags</label>
        <input type="text" value="<?php echo $post_tags; ?>" class="form-control" name="post_tags">
    </div>
    
    <div class="form-group">
        <label for="post_content">Post Content</label>
        <textarea name="post_content" id="body" cols="30" rows="10" class="form-control"><?php echo $post_content; ?>
        </textarea>
    </div>
    
    <div class="form-group">
        <input type="submit" class="btn btn-primary" name="update_post" value="Update Post">
    </div>  
</form>