<?php include "includes/admin_header.php" ?>

    <div id="wrapper">
    
    <!-- Navigation -->
    <?php include "includes/admin_navigation.php"; ?>
    <div id="page-wrapper">

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        Admin Panel
                        <small><?php echo $_SESSION["username"]; ?></small>
                    </h1>
                </div>
            </div>
            <!-- widgets -->
            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-file-text fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                <?php 
                                    $query = "SELECT * FROM posts";
                                    $post_query = mysqli_query($connection, $query);
                                    $post_count = mysqli_num_rows($post_query);
                                    echo "<div class='huge'>$post_count</div>"
                                ?>
                                    <div> Total Posts</div>
                                </div>
                            </div>
                        </div>
                        <a href="./posts.php">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-green">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-comments fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                <?php 
                                    $query = "SELECT * FROM comments";
                                    $comment_query = mysqli_query($connection, $query);
                                    $comment_count = mysqli_num_rows($comment_query);
                                    echo "<div class='huge'>$comment_count</div>"
                                ?>
                                  <div> Total Comments</div>
                                </div>
                            </div>
                        </div>
                        <a href="./comments.php">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-yellow">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-user fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                <?php 
                                    $query = "SELECT * FROM users";
                                    $user_query = mysqli_query($connection, $query);
                                    $user_count = mysqli_num_rows($user_query);
                                    echo "<div class='huge'>$user_count</div>"
                                ?>
                                    <div> Total Users</div>
                                </div>
                            </div>
                        </div>
                        <a href="./users.php">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-red">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-list fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                <?php 
                                    $query = "SELECT * FROM categories";
                                    $category_query = mysqli_query($connection, $query);
                                    $category_count = mysqli_num_rows($category_query); 
                                    echo "<div class='huge'>$category_count</div>"
                                ?>
                                     <div> Total Categories</div>
                                </div>
                            </div>
                        </div>
                        <a href="./categories.php">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            
            
            <?php
            
            $query = "SELECT * FROM posts WHERE post_status = 'draft'";
            $post_query = mysqli_query($connection, $query);
            $draft_post_count = mysqli_num_rows($post_query);
                                    
            $published_post_count = $post_count - $draft_post_count;
                                    
            $query = "SELECT * FROM comments WHERE comment_status = 'unapproved'";
            $comment_query = mysqli_query($connection, $query);
            $unapproved_comments = mysqli_num_rows($comment_query);
                                    
            $approved_comments = $comment_count - $unapproved_comments;
                                    
            $query = "SELECT * FROM users WHERE user_role = 'subscriber'";
            $user_query = mysqli_query($connection, $query);
            $subscriber_count = mysqli_num_rows($user_query);
                                    
            $admin_count = $user_count - $subscriber_count; 
                                        
            ?>
            
            <div class="row">
                <script type="text/javascript">
                  google.charts.load('current', {'packages':['bar']});
                  google.charts.setOnLoadCallback(drawChart);

                  function drawChart() 
                  {
                    var data = google.visualization.arrayToDataTable([
                        ["Data", "Count"],
                          
                        <?php 
                        
                        $chart_data = 
                            ["Active Posts" => $published_post_count, "Pending Posts" => $draft_post_count, 
                             "Active Comments" => $approved_comments, "Pending Comments" => $unapproved_comments, 
                             "Admins" => $admin_count, "Subscribers" => $subscriber_count, 
                             "Categories" => $category_count];
                        
                        foreach($chart_data as $key => $value) 
                        {
                            echo "['{$key}', " . "{$value}],";
                        }             
                                                   
                        ?>                 
                        ]);

                    var options = 
                    {
                      chart: 
                        {
                            title: "",
                            subtitle: "",
                        }
                    };

                    var chart = new google.charts.Bar(document.getElementById('columnchart_material'));
                    chart.draw(data, google.charts.Bar.convertOptions(options));
                  }
                </script>
                <div id="columnchart_material" style="width: 'auto'; height: 500px;"></div>
            </div>
          </div>
    </div>
    
    <!-- /#page-wrapper -->

<?php include "includes/admin_footer.php"; ?>