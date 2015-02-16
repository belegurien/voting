<?php

function set_new_vote($connection){
    $sql = "select * from voting.votes";
        
        $result = mysqli_query($connection,$sql);
        if (!$result){
            die("select failed: " . mysqli_error($connection));
        } else {
            die("select succesfull");
        }
        
}