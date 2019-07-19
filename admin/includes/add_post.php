<?php 

    if(isset($_POST["create_post"]))
    {
        $post_title = escape($_POST["post_title"]);
        $post_user = escape($_POST["post_user"]);
        $post_category_id = escape($_POST["post_category"]);
        $post_status = escape($_POST["post_status"]);
        
        $post_image = $_FILES["post_image"]["name"];
        $post_image_tmp = $_FILES["post_image"]["tmp_name"];
        
        $post_tags = escape($_POST["post_tags"]);
        $post_content = escape($_POST["post_content"]);
        $post_date = date("d-m-y");
        $post_comment_count = 0;
        
        move_uploaded_file($post_image_tmp, "../images/$post_image");
        
        $query = "INSERT INTO posts(post_category_id, post_title, post_user, post_date, post_image, ";
        $query .= "post_content, post_tags, post_comment_count, post_status) ";
        $query .= "VALUES ({$post_category_id}, '{$post_title}', '{$post_user}', now(), '{$post_image}', ";
        $query .= "'{$post_content}', '{$post_tags}', {$post_comment_count}, '{$post_status}')";
        
        $post = mysqli_query($connection, $query);
        confirm_query($post);
        header("Location: posts.php");
    }

?>
   
<form action="" method="post" enctype="multipart/form-data">

    <div class="form-group">
        <label for="title">Post Title</label>
        <input type="text" class="form-control" name="post_title">
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
            $user_query = "SELECT * FROM users";
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
        <select name="post_status" id="">
            <option value="draft">Post Status</option>
            <option value="published">Publish</option>
            <option value="draft">Draft</option> 
        </select>
    </div>
    
    <div class="form-group">
        <label for="post_image">Post Image</label>
        <input type="file" name="post_image">
    </div>
    
    <div class="form-group">
        <label for="post_tags">Post Tags</label>
        <input type="text" class="form-control" name="post_tags">
    </div>
    
    <div class="form-group">
        <label for="post_content">Post Content</label>
        <textarea name="post_content" id="body" cols="30" rows="10" class="form-control">
        </textarea>    
    </div>
    
    <div class="form-group">
        <input type="submit" class="btn btn-primary" name="create_post" value="Publish Post">
    </div>  
</form>