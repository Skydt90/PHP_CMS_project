<?php include "includes/header.php"; ?>

<!-- Navigation -->
<?php include "includes/navigation.php"; ?>
<?php include "admin/includes/functions.php"; ?>

<!-- Page Content -->
<div class="container">

    <div class="row">

        <!-- Blog Entries Column -->
        <div class="col-md-8">
            
        <?php
            
            if(isset($_GET["category"]))
            {
                $post_category_id = escape($_GET["category"]);
                $category_title = escape($_GET["category_title"]);
            }
            
            $query = "SELECT * FROM posts WHERE post_category_id = $post_category_id AND post_status = 'published'";
            $posts = mysqli_query($connection, $query); 
            confirm_query($posts); 
            
            if(mysqli_num_rows($posts) == 0)
            { ?>
                <h1 class="page-header">
                    No posts related to 
                    <small><?php echo $category_title; ?></small>  
                </h1> 
     <?php  }
            else
            { ?>
                <h1 class="page-header">
                    All posts related to
                    <small><?php echo $category_title; ?></small> 
                </h1>
    <?php   }
            
            while($row = mysqli_fetch_assoc($posts))
            {
                $post_id = $row["post_id"];
                $post_title = $row["post_title"];
                $post_user = $row["post_user"];
                $post_date = $row["post_date"];
                $post_image = $row["post_image"];
                $post_content = substr($row["post_content"], 0, 100);
         ?>

                <!-- First Blog Post -->
                <h2>
                    <a href="post.php?p_id=<?php echo $post_id; ?>"> <?php echo $post_title ?></a>
                </h2>
                <p class="lead">
                    by <a href="index.php"> <?php echo $post_user ?> </a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> 
                    <?php echo $post_date ?>
                </p>
                <hr>
                    <img class="img-responsive" src="images/<?php echo $post_image ?>" alt="">
                <hr>
                <p> 
                    <?php echo $post_content ?> 
                </p>
                <a class="btn btn-primary" href="#">
                    Read More <span class="glyphicon glyphicon-chevron-right"></span>
                </a>
            <hr>     
        <?php } ?>
     </div>
    <!-- Blog Sidebar Widgets Column -->
    <?php include "includes/sidebar.php"; ?>
    </div>
    <!-- /.row -->
    <hr>
<?php include "includes/footer.php"; ?>
        