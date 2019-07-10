
<table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>post_id</th>
                    <th>Author</th>
                    <th>Title</th>
                    <th>Category</th>
                    <th>Status</th>
                    <th>Image</th>
                    <th>Tags</th>
                    <th>Comments</th>
                    <th>Date</th>
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
                        echo "<td>{$row["post_id"]}</td>";
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
                        echo "<td><a href='posts.php?source=edit_post&p_id={$row["post_id"]}'>Edit</a></td>";
                        echo "<td><a href='posts.php?delete={$row["post_id"]}'>Delete</a></td>";
                        echo "</tr>";            
                    } 
                ?>               
            </tbody>
        </table>
        
        <?php 

        if(isset($_GET["delete"]))
        {
            $post_id = $_GET["delete"];
            $query = "DELETE FROM posts WHERE post_id = {$post_id}";
            $result = mysqli_query($connection, $query);
            confirm_query($result);
            header("Location: posts.php");           
        }
?>
