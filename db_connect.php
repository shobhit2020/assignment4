<?php
    
    $connect = mysqli_connect('localhost','id14463570_assignment4','Shobhit78950@','id14463570_assignment');

    if(!$connect){
        echo 'Connection error: ' . mysqli_connect_error();
    }
?>