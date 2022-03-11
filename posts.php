<?php
    session_start();
    if(isset($_GET['id'])){
    $_SESSION['id']= $_GET['id'];
    }
    include 'connect.php';
    $sql = "SELECT * FROM posts where id=".$_SESSION['id'];
    $result = mysqli_query($conn,$sql);
    $sql2 = "SELECT * from comment where post_id = ".$_SESSION['id']." ORDER BY comment_id DESC";
    $result1 = mysqli_query($conn,$sql2);
    if(isset($_POST['submit'])){
        $comment = $_POST['comment'];
        $email = $_POST['email'];
        $sql1= "INSERT into comment VALUES (0,".$_SESSION['id'].",'$comment','$email')";
        if(mysqli_query($conn,$sql1)){
            $sql2 = "SELECT * from comment where post_id = ".$_SESSION['id']." ORDER BY comment_id DESC";
            $result1 = mysqli_query($conn,$sql2);
        }
    }
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <div class="container">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#">BLOG</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="login.php">LOGIN <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="register.php">REGISTER</a>
      </li>
    </ul>
  </div>
</nav>
    <?php
        if(mysqli_num_rows($result)>0){
                $data = mysqli_fetch_assoc($result);
                echo "<div><h1>{$data['title']}</h1></div>";
                echo "<div><p>{$data['description']}</p></div>";  
                $timestamp = strtotime($data['time']); 
                echo "<div><p>".date('d-m-Y',$timestamp)."</p></div>";             
        }
     ?>
     
    <form method="post" action="posts.php">
     <textarea type="text" width="150px" height="100px" name="comment"></textarea><br/>
     <input type="email" name="email"><br/>
     <input type="submit" value="comment" name="submit">
    </form>
    <?php
     if(isset($result1)){
        if(mysqli_num_rows($result1)>0){
            while($data1 = mysqli_fetch_assoc($result1)){
                echo "<div><p>{$data1['comment']}</p></div>";
                echo "<div><p>{$data1['email']}</p></div>";
            }
        }
    }
     ?>
</div>

</body>
</html>