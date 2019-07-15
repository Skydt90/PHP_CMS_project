<?php 


    function confirm_query($result)
    {
        global $connection;
        if(!$result)
        {
            die("Post query failed: " . mysqli_error($connection));
        }
    } 

?>