<?php
    $id = $_POST['id'];
    $role = $_POST['role'];
    echo $role;
    include 'connect.php';
    $sql = "UPDATE Role set role='$role' where id=$id";
    if($res=mysqli_query($conn,$sql)){
        echo "Role updated";
        // header('location:index.php');
    }    
?>