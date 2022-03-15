<?php
    session_start();
    include 'connect.php';
    $sql = "SELECT * FROM Role where role!='admin'";
    $result = mysqli_query($conn,$sql);
    if(isset($_SESSION['role'])=='admin'){ 
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
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
      <?php if(isset($_SESSION['role'])==false){?>
      <li class="nav-item ">
        <a class="nav-link" href="login.php">LOGIN <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="register.php">REGISTER</a>
      </li>
      <?php } else if($_SESSION['role']=='admin'){ ?>
        <li class="nav-item ">
        <a class="nav-link" href="edituser.php">Edit User<span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="editblog.php">Edit Blog</a>
      </li>
      <li class="nav-item float-right">
      <a class="nav-link" href="logout.php">LOGOUT <span class="sr-only">(current)</span></a>
      </li>
      <?php } else if($_SESSION['role']=='author'){ ?>
        <li class="nav-item ">
        <a class="nav-link" href="createpost.php">Create POST <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="updatepost.php">Update POST</a>
      </li>
      <li class="nav-item float-right">
      <a class="nav-link" href="logout.php">LOGOUT <span class="sr-only">(current)</span></a>
      </li>
      <?php }else if ($_SESSION['role']){ ?>
      <li class="nav-item float-right">
      <a class="nav-link" href="logout.php">LOGOUT <span class="sr-only">(current)</span></a>
      </li>
      <?php } ?>
    </ul>
  </div>
</nav>
    <table border=1>
        <th>Email</th>
        <th>Role</th>
        <th>Permission</th>
    <?php
        if(mysqli_num_rows($result)>0){
            while($data = mysqli_fetch_assoc($result)){
                echo "<tr>";
                $r = $data['role'];
                $rol = "'$r'";
                echo "<td>{$data['email']}</td>";
                echo "<td >{$data['role']}</td>";
                echo "<td><select id='{$data['id']}' name='permission' onclick=myfun({$data['id']})>";
                echo "<option value='user'>User</option>";
                echo "<option value='author'>Author</option>";
                echo "</select>";
                echo "</td>"; 
                echo "</tr>";           
            }
        }
     ?>
     </table>
    </div>
    <script src="index.js"></script>
</body>
</html>
<?php } 
  else {
    header('Location: index.php');
  }
?>