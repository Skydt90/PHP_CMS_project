<?php include "includes/admin_header.php"; ?>
<?php include "includes/admin_navigation.php"; ?>
<?php 
    if(isset($_SESSION["username"])) 
    { 
        $username = $_SESSION["username"]; 
    }
?>


<div id="wrapper">
    <div id="page-wrapper">
        <div class="container-fluid">
            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        Posts Panel
                        <small><?php echo $username ?></small>
                    </h1>

                    <?php 

                        if(isset($_GET["source"]))
                        {
                            $source = $_GET["source"];
                        }
                        else 
                        { 
                            $source = "";
                        }
                        switch($source)
                        {
                            case "add_post":
                                include "includes/add_post.php";
                                break;

                            case "edit_post":
                                include "includes/edit_post.php";
                                break;

                            default:
                                include "includes/view_all_posts.php";
                                break;             
                        }
                    ?>        
                </div>
            </div>
        </div>
    </div>
<!-- /#page-wrapper -->
<?php include "includes/admin_footer.php"; ?>