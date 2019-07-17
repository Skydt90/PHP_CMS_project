<?php 

if(isset($_POST["checkBoxArray"]))
{
    foreach($_POST["checkBoxArray"] as $checkBoxValueId)
    {
        $bulk_options = $_POST["bulk_options"];
        
        switch($bulk_options)
        {
            case "published":
                update_post_status($bulk_options, $checkBoxValueId);
                break;
            
            case "draft":
                update_post_status($bulk_options, $checkBoxValueId);
                break;
                
            case "delete":
                delete_post($checkBoxValueId);
                break;
                
            case "clone":
                clone_post($checkBoxValueId);
                break;
                
            case "reset_counter":
                reset_post_view_count($checkBoxValueId);
                break;
            
            default:
                break;
        }
    }
}
?>
   

<form action="" method="post">
    <table class="table table-bordered table-hover">
           
           <div id="bulkOptionContainer" style="padding: 0px" class="col-xs-4">
               <select class="form-control" name="bulk_options" id="">         
                   <option value="">Select Options</option>
                   <option value="published">Publish</option>
                   <option value="draft">Draft</option>
                   <option value="delete">Delete</option>
                   <option value="clone">Clone</option>
                   <option value="reset_counter">Reset View Count</option>
               </select>
           </div>
           <div class="col-xs-4">
               <input type="submit" name="submit" class="btn btn-success" value="Apply">
               <a href="posts.php?source=add_post" class="btn btn-primary">Add new</a>
           </div>

            <thead>
                <tr>
                    <th><input id="selectAllBoxes" type="checkbox"></th>
                    <th>Author</th>
                    <th>Title</th>
                    <th>Category</th>
                    <th>Status</th>
                    <th>Image</th>
                    <th>Tags</th>
                    <th>Comments</th>
                    <th>Date</th>
                    <th>View Count</th>
                    <th>Read</th> 
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
                <?php

                    $query = "SELECT * FROM posts ORDER BY post_id DESC";
                    $result = mysqli_query($connection, $query);

                    while($row = mysqli_fetch_assoc($result))
                    {
                        echo "<tr>";
                        ?>
                        <td><input class='checkBoxes' type='checkbox' name='checkBoxArray[]' value='<?php echo $row["post_id"]; ?>'></td>
                        <?php
                        echo "<td>{$row["post_author"]}</td>";
                        echo "<td>{$row["post_title"]}</td>";
                        
                        $category_query = "SELECT * FROM categories WHERE category_id = {$row["post_category_id"]}";
                        $category_result = mysqli_query($connection, $category_query);
                        while($rows = mysqli_fetch_assoc($category_result))
                        {
                            $category_title = $rows["category_title"];       
                        }
                        echo "<td>{$category_title}</td>";
                        echo "<td>{$row["post_status"]}</td>";
                        echo "<td><img width='100' src='../images/{$row["post_image"]}' alt='image'></td>";
                        echo "<td>{$row["post_tags"]}</td>";
                        echo "<td>{$row["post_comment_count"]}</td>";
                        echo "<td>{$row["post_date"]}</td>";
                        echo "<td>{$row["post_view_count"]}</td>";
                        
                        echo "<td><a href='../post.php?p_id={$row["post_id"]}'>Read</a></td>";
                        echo "<td><a href='posts.php?source=edit_post&p_id={$row["post_id"]}'>Edit</a></td>";
                        echo "<td><a href='posts.php?reset={$row["post_id"]}'>{$row["post_view_count"]}</a></td>";
                        echo "</tr>"; 
                    }  
                ?>               
            </tbody>
        </table>
    </form>
        
    <?php 

?>
