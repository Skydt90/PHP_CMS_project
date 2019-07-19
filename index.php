<?php include "includes/header.php"; ?>

<!-- Navigation -->
<?php include "includes/navigation.php"; ?>

<!-- Page Content -->
<div class="container">

    <div class="row">

        <!-- Blog Entries Column -->
        <div class="col-md-8">
            
        <?php
            $per_page = 3; 
            
            if(isset($_GET["page"]))
            {
                $page = $_GET["page"];
            }
            else 
            {
                $page = "";
            }
            
            if($page == "" || $page == 1)
            {
                $page1 = 0;
            } 
            else 
            {
                $page1 = ($page * $per_page) - $per_page;
            }
            
            $post_count_query = "SELECT * FROM posts"; 
            $result = mysqli_query($connection, $post_count_query);
            $count = mysqli_num_rows($result); 
            $count = ceil($count / $per_page); 
            
            $query = "SELECT * FROM posts WHERE post_status = 'published' ORDER BY post_id DESC LIMIT {$page1}, {$per_page}";
            $posts = mysqli_query($connection, $query);
            
            if($posts -> num_rows == 0)
            {
                echo "<h1 class='text-center'>No posts here at the moment</h1>";
            } 
            else
            { ?> 
                <h1 class="page-header text-center">
                    Blog posts
                </h1>
            <?php    
                while($row = mysqli_fetch_assoc($posts))
                {
                    $post_id = $row["post_id"];
                    $post_title = $row["post_title"];
                    $post_user = $row["post_user"];
                    $post_date = $row["post_date"];
                    $post_image = $row["post_image"];
                    $post_content = substr($row["post_content"], 0 , 100);
                    $post_status = $row["post_status"];
                   
                    if($post_status == "published")
                    {
             ?>
                        <!-- First Blog Post -->
                        <h2>
                            <a href="post.php?p_id=<?php echo $post_id; ?>"> <?php echo $post_title ?></a>
                        </h2>
                        <p class="lead">
                            by <a href="user_posts.php?user=<?php echo $post_user ?>&p_id=<?php echo $post_id ?>"> <?php echo $post_user?> </a>
                        </p>
                        <p><span class="glyphicon glyphicon-time"></span> 
                            <?php echo $post_date ?>
                        </p>
                        <hr>
                            <a href="post.php?p_id=<?php echo $post_id; ?>">
                            <img class="img-responsive" src="images/<?php echo $post_image ?>" alt="">
                            </a>
                        <hr>
                        <p> 
                            <?php echo $post_content ?> 
                        </p>
                        <a class="btn btn-primary" href="post.php?p_id=<?php echo $post_id; ?>">
                            Read More <span class="glyphicon glyphicon-chevron-right"></span>
                        </a>
                <hr>      
        <?php } } }?>
     </div>
    <!-- Blog Sidebar Widgets Column -->
    <?php include "includes/sidebar.php"; ?>
    </div>
    
    <!-- pager -->
    <ul class="pager">
        <?php
        
            for($i = 1; $i <= $count; $i++)
            {
                if($i == $page || $page == "" && $i == 1) 
                {
                    echo "<li><a class='active_link' href='index.php?page={$i}'>{$i}</a></li>";
                }
                else
                {
                    echo "<li><a href='index.php?page={$i}'>{$i}</a></li>";
                }
            }
        
        ?>   
    </ul>
    
    <hr>
<?php include "includes/footer.php"; ?>
        