<form action="" method="post">
    <div class="form-group">
       <label for="category_title">Edit Category</label>

       <?php // Prep update                      
        if(isset($_GET["edit"]))
        {
            $category_id = escape($_GET["edit"]);
            
            $query = "SELECT * FROM categories WHERE category_id = {$category_id}";
            $select_categories_id = mysqli_query($connection, $query);
            confirm_query($select_categories_id);
            
            while($row = mysqli_fetch_assoc($select_categories_id))
            {
                $category_id = $row["category_id"];
                $category_title = $row["category_title"];

            ?>
            <input class="form-control" value="<?php if(isset($category_title)) echo $category_title; ?>" type="text" name="category_title"> 
  <?php  }} ?>
       
  <?php
        // Update query
        
        if(isset($_POST["edit"])) 
        {
            $category_title = escape($_POST["category_title"]);
            $query = "UPDATE categories SET category_title = '{$category_title}' ";
            $query .= "WHERE category_id = {$category_id}";
            $update = mysqli_query($connection, $query);
            header("Location: categories.php"); // refresh the page
            confirm_query($update);
        }  
  ?>
    </div>
    <div class="form-group">
       <input class="btn btn-primary" type="submit" name="edit" value="Edit Category">
    </div>
</form>   