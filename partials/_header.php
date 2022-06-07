<?php
session_start();

echo '<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
<div class="container-fluid">
  <a class="navbar-brand" href="./index.php">Code-Discuss</a>
  <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
      <li class="nav-item">
        <a class="nav-link active" aria-current="page" href="./index.php">Home</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="./about.php">About</a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
          Top Categories
        </a>
        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
        ';
          $sql = 'SELECT * FROM `categories` LIMIT 4';
          $result = mysqli_query($conn,$sql);
          while($row= mysqli_fetch_assoc($result))
          {
            $category_name = $row['category_name'];
            $categor_id = $row['category_id'];
            echo'<li><a class="dropdown-item" href="thread-list.php?catid='.$categor_id.'">'.$category_name.'</a></li>';
             
          }
          echo '</ul>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="./contact.php" tabindex="-1" >Contact</a>
      </li>
    </ul>';
    if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']= true){
      $email= $_SESSION['useremail'];
      $user_name = $_SESSION['user_name'];
      echo'<div class="mx-2 my-1 text-center">
      <p class="text-light text-center my-0">Welcome '.$user_name.'</p>
      </div>
       <form class="d-flex mx-2 method="get" action="search.php">
      <input class="form-control me-2" name= "search" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-success" type="submit">Search</button>
    </form>
    <div class="mx-2 my-1 text-center">
    <a href= "partials/_logout.php" class="btn btn-outline-success mx-2">Logout</a>
    </div>';

    }
    else {

      echo'<form class="d-flex mx-2 method="get" action="search.php">
      <input class="form-control me-2" name= "search" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-success" type="submit">Search</button>
       </form>
      <div class="mx-2 my-3">
      <button class="btn btn-outline-success mx-2" data-bs-toggle="modal" data-bs-target="#signupModal" >Signup</button>
      <button class="btn btn-outline-success mx-2" data-bs-toggle="modal" data-bs-target="#loginModal">Login</button>
      </div>';
      
    }
 echo'</div>
</div>
</nav>';
include "partials/_loginModal.php";
include "partials/_SignupModal.php";

  if(isset($_GET['login']) && $_GET['login']=="false"){
    echo '<div class="alert my-0 alert-danger alert-dismissible fade show" role="alert">
    <strong>Sorry!</strong> You have entered a wrong password .
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>';
  }



if(isset($_GET['signupsuccess']) && $_GET['signupsuccess']=="true"){
  echo '<div class="alert my-0 alert-success alert-dismissible fade show" role="alert">
  <strong>Success!</strong> You can now login .
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
}

?>