<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Discuss- Coding Forums</title>
</head>
<style>
.carousel-inner {
    height: 598px;
}

.jumbotron {
    padding: 4rem 2rem;
    margin-bottom: 2rem;
    background-color: var(--bs-light);
    border-radius: .3rem;
}

#ques {
    min-height: 433px;
}

p.p.text-center {
    margin-bottom: 0px !important;
}
</style>

<body>
    <?php
  include 'partials/db_connect.php';
  include 'partials/_header.php';
 
  ?>
    <?php 
  $id= $_GET['thread_id'];
  $sql= "SELECT * FROM `thread` where thread_id=$id";
  $result=mysqli_query($conn,$sql);
  while($row= mysqli_fetch_assoc($result)){
      $title= $row['thread_title'];
      $desc =$row['thread_desc'];
      $thread_user_id = $row['thread_user_id'];
      $sql3= "SELECT user_email , username FROM `disuss_users` WHERE `user_id` = $thread_user_id";
      $result3=mysqli_query($conn,$sql3);
      $row3 = mysqli_fetch_assoc($result3);
      $user_email2 = $row3['user_email'];
      $posted_by = $row3['username'];
    //   var_dump($catname);
  }
   ?>

    <?php
   $method = $_SERVER['REQUEST_METHOD'];
   $show_alert_text= false;
   if($method=='POST'){
       //Insert into Comment  db
       $comment =$_POST['comment'];
       $comment_sanitised1 = str_replace("<","&lt;",$comment);
       $comment_sanitised2 = str_replace(">","&gt;",$comment_sanitised1);

       $new_user_id=$_POST['user_id'];
       $sql= "INSERT INTO `comments` ( `comment_content`, `thread_rel_id`, `comment_time`, `user_id_comment`) VALUES ( '$comment_sanitised2', '$id', current_timestamp(), '$new_user_id')";
       $result=mysqli_query($conn,$sql);
       $show_alert_text= true;
    

   };

   if($show_alert_text){
    echo'<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Success!</strong> Your comment has been added!
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>';
}

   ?>

    <!-- category container starts here -->
    <div class="container my-4">
        <div class="jumbotron">
            <h1 class="display-4"> <?php echo $title; ?> </h1>
            <p class="lead"> <?php echo $desc; ?></p>
            <hr class="my-4">
            <p>This is a peer to peer forum for sharing knowlege with each other</p>
            <p class="text">Posted By :<strong> <?php echo $posted_by; ?></strong> on Date 12 March 2021 </p>

        </div>

    </div>
    

    <div id="ques" class="container">
        <?php
    if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']= true)
    {
          echo '<h2 class="py-2">Post a Comment</h2>
          <form action="'. $_SERVER['REQUEST_URI'] .'" method="post">
              <div class="mb-3">
                  <label for="exampleFormControlTextarea1" class="form-label">Type your Comment</label>
                  <textarea name="comment" class="form-control" id="comment" rows="3"></textarea>
                  <input type="hidden" name="user_id" value= "'.$_SESSION["user_id"].'">
              </div>
              <button type="submit" class="btn btn-success">Post Comment</button>
          </form>';
    }
    else {

        echo '<h2>Post a Comment</h2>
        <p class="lead">You are not logged in. Please login to post a comment</p>';
    }
      ?> 
        <?php

echo' <h2 class="py-2">Discussions</h2>';
  $sql= "SELECT * FROM `comments` where thread_rel_id=$id";
  $result=mysqli_query($conn,$sql);
  $noresult = true;
  
  while($row= mysqli_fetch_assoc($result)){
      $noresult= false;

      $content =$row['comment_content'];
      $comment_id= $row['comment_id'];
      $comment_time = $row['comment_time'];
      $user_id_comment = $row ['user_id_comment'];
    //   var_dump($comment_time);
      $time = strtotime($comment_time);
      $newformat = date('F j, Y',$time);
      $sql2= "SELECT user_email , username FROM `disuss_users` WHERE `user_id` = $user_id_comment";
      $result2=mysqli_query($conn,$sql2);
      $row2 = mysqli_fetch_assoc($result2);
      $user_email = $row2['user_email'];
      $user_name = $row2['username'];

    if(!$noresult)
    {
    echo '
           <div class="d-flex border my-2 p-3">
            <img src="https://cdn.pixabay.com/photo/2016/11/18/23/38/child-1837375_960_720.png" alt="John Doe"
                class="flex-shrink-0 me-3 mt-3 rounded-circle" style="width:60px;height:60px;">
            <div>
                <h4>'.$user_name.' <small>Posted on '.$newformat.'</small></h4>
                <p class= "comment_content">'.$content.'</p>
            </div>
        </div>';
    }
   
}


if($noresult)
{
   
    echo '
    <div class="container-fluid bg-light text-dark p-5">
    <div class="container bg-light p-5">
        <p class="display-5">No Comments Found</p>
        <hr>
        <p><strong>Be the first person to comment </strong></p>
    </div>
    
</div>';
}
?>


    </div>


    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
    <?php
  include 'partials/_footer.php';
  ?>
</body>

</html>