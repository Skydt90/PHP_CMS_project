<?php 


function confirm_query($result)
{
    global $connection;
    
    if(!$result)
    {
        die("Post query failed: " . mysqli_error($connection));
    }
}

function insert_categories()
{
    global $connection;
    
    if(isset($_POST["submit"]))
    {
        $title = $_POST["category_title"];

        if($title == "" || empty($title))
        {
            echo "This field should not be empty";
        }
        
        else
        {
            $query = "INSERT INTO categories (category_title) ";
            $query .= "VALUE ('{$title}')";
            $result = mysqli_query($connection, $query);
            header("Location: categories.php");

            if(!$result)
            {
                die("Query failed: " . mysqli_error($connection));
            }
        }
    }
}

function find_all_categories()
{
    global $connection;
    
    $query = "SELECT * FROM categories;";
    $categories_result = mysqli_query($connection, $query);

    while($row = mysqli_fetch_assoc($categories_result))
    {
        $category_id = $row["category_id"];
        $category_title = $row["category_title"];

        echo "<tr>";
        echo "<td>{$category_id}</td>";
        echo "<td>{$category_title}</td>";
        echo "<td><a href='categories.php?edit={$category_id}'>Edit</a></td>";
        echo "<td><a href='categories.php?delete={$category_id}'>Delete</a></td>";
        echo "</tr>";
    }       
}

function delete_category()
{
    global $connection;
    
    if(isset($_GET["delete"]))
    {
        $category_id = $_GET["delete"];
        $query = "DELETE FROM categories WHERE category_id = {$category_id}";
        $result = mysqli_query($connection, $query);
        header("Location: categories.php"); // refresh the page
    }
}

function update_post_status($bulk_options, $checkBoxValueId)
{
    global $connection;
    $query = "UPDATE posts SET post_status = '{$bulk_options}' WHERE post_id = {$checkBoxValueId}";
    $draft_query = mysqli_query($connection, $query);
    confirm_query($draft_query);
}

function clone_post($checkBoxValueId)
{
    global $connection;
    $query = "SELECT * FROM posts WHERE post_id = {$checkBoxValueId} ";
    $post_query = mysqli_query($connection, $query);
    
    while($row = mysqli_fetch_assoc($post_query))
    {
        $post_title = $row["post_title"];
        $post_category_id = $row["post_category_id"];
        $post_date = $row["post_date"];
        $post_author = $row["post_author"];
        $post_status = $row["post_status"];
        $post_image = $row["post_image"];
        $post_tags = $row["post_tags"];
        $post_content = $row["post_content"];
        $post_comment_count = 0;
        
        $query = "INSERT INTO posts(post_category_id, post_title, post_author, post_date, post_image, ";
        $query .= "post_content, post_tags, post_comment_count, post_status) ";
        $query .= "VALUES ({$post_category_id}, '{$post_title}', '{$post_author}', now(), '{$post_image}', ";
        $query .= "'{$post_content}', '{$post_tags}', {$post_comment_count}, '{$post_status}')";
        
        $post = mysqli_query($connection, $query);
        confirm_query($post);
    }
}

function reset_post_view_count($checkBoxValueId)
{
    global $connection;
    $query = "UPDATE posts SET post_view_count = 0 WHERE post_id = {$checkBoxValueId}";
    $reset_query = mysqli_query($connection, $query);
    confirm_query($reset_query);          
}

function delete_post($checkBoxValueId) 
{
    global $connection;
    $query = "DELETE FROM posts WHERE post_id = {$checkBoxValueId}";
    $delete_query = mysqli_query($connection, $query);
    confirm_query($delete_query);
}

function users_online()
{
    if(isset($_GET["onlineusers"]))
    { 
        global $connection;
        
        if(!$connection)
        {
            session_start();
            include "admin_db.php";
            
            // start a new session
            $session = session_id();
            $time = time();
            $timeout_in_seconds = 60;
            $timeout = $time - $timeout_in_seconds;

            // check if the session is in DB, else its a new user
            $query = "SELECT * FROM users_online WHERE session = '{$session}'";
            $timeout_query = mysqli_query($connection, $query);
            confirm_query($timeout_query);
            $count = mysqli_num_rows($timeout_query);

            // if new user insert session info to db
            if($count == null)
            {
                $new_user_query = "INSERT INTO users_online(session, time) VALUES('$session', $time)";
                confirm_query(mysqli_query($connection, $new_user_query));
            }
            else 
            {
                $update_online_user_query = "UPDATE users_online SET time = {$time} WHERE session = '{$session}'";
                confirm_query(mysqli_query($connection, $update_online_user_query));
            }

            $online_users_query = "SELECT * FROM users_online WHERE time > $timeout"; 
            $result = mysqli_query($connection, $online_users_query);    
            confirm_query($result);
            $user_count = mysqli_num_rows($result);
            echo $user_count;
        }    
    } // get request AJAX
}

users_online();



















?>