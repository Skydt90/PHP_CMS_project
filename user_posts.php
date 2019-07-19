<?php include "includes/header.php"; ?>
<?php include "includes/navigation.php"; ?>

<!-- Page Content -->
<div class="container">
    <div class="row">
        <!-- Blog Entries Column -->
        <div class="col-md-8">
            
        <?php
            
            if(isset($_GET["p_id"]))
            {
                $post_id = $_GET["p_id"];
                $post_user = $_GET["user"];
            } ?>
            
            <h1 class="page-header">
                All posts by <small><?php echo $post_user; ?></small>
            </h1>
            
        <?php 
            
            $query = "SELECT * FROM posts where post_user = '{$post_user}' ";
            $posts = mysqli_query($connection, $query);

            while($row = mysqli_fetch_assoc($posts))
            {
                $post_title = $row["post_title"];
                $post_user = $row["post_user"];
                $post_date = $row["post_date"];
                $post_image = $row["post_image"];
                $post_content = $row["post_content"];
                
         ?>
                <h2>
                    <a href="post.php?p_id=<?php echo $post_id; ?>"> <?php echo $post_title ?></a>
                </h2>
                <p><span class="glyphicon glyphicon-time"></span> 
                    <?php echo $post_date ?>
                </p>
                <hr>
                    <img class="img-responsive" src="images/<?php echo $post_image ?>" alt="">
                <hr>
                <p> 
                    <?php echo $post_content ?> 
                </p>
            <hr>     
        <?php } ?>
        </div>
        <?php include "includes/sidebar.php"; ?>
    </div>
        <hr>
    <?php include "includes/footer.php"; ?>       