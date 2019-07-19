<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.php">CMS Front</a>
        </div>
        
        
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                
                <?php include "db.php";
                
                $query = "SELECT * FROM categories;";
                $categories_query = mysqli_query($connection, $query);
                
                while($row = mysqli_fetch_assoc($categories_query))
                {
                    $category_title = $row["category_title"];
                    $category_id = $row["category_id"];
                    echo "<li><a href='category.php?category={$category_id}&category_title={$category_title}'>{$category_title}</a></li>";
                }
            
                ?>  
                <li>
                    <a href="admin">Admin</a>
                </li>
                <li>
                    <a href="registration.php">Registration</a>
                </li>
                
                <li>
                    <a href="contact.php">Contact</a>
                </li>
                <?php session_start();
                if(isset($_SESSION["username"]))
                {
                    $username = $_SESSION["username"];
                 ?>
                    <li class="dropdown">
                    
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i>
                            <?php echo $username; ?>    
                             <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li>
                                <a href="admin/profile.php"><i class="fa fa-fw fa-user"></i> Profile</a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a href="./includes/logout.php"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
                            </li>
                        </ul>
                    </li>
            
                <?php 
                    
                    if(isset($_SESSION["user_role"]))
                    {
                        if(isset($_GET["p_id"]))
                        {
                           $post_id = $_GET["p_id"];
                           echo "<li><a href='admin/posts.php?source=edit_post&p_id={$post_id}'>Edit post</a></li>";
                        }
                    }
                }
                ?>
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container -->
</nav>