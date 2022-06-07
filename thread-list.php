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

#ques 
{
    min-height: 433px;
}

p.p.text-center {
    margin-bottom: 0px !important;
}

a:hover {
      color: #0cb567;
}

a {
    color: #198754;
}
</style>

<body>
    <?php
  include 'partials/db_connect.php';
  include 'partials/_header.php';
 
  ?>
    <?php 
  $id= $_GET['catid'];
  $sql= "SELECT * FROM `categories` where category_id=$id";
  $result=mysqli_query($conn,$sql);
  while($row= mysqli_fetch_assoc($result)){
      $catname= $row['category_name'];
      $catdesc =$row['category_description'];
    //   var_dump($catname);
  }
   ?>

    <?php
   $method = $_SERVER['REQUEST_METHOD'];
   $show_alert_text= false;
   if($method=='POST'){
       //Insert into thread into db
       $th_title =$_POST['title'];
       $th_title = str_replace("<","&lt;",$th_title);
       $th_title = str_replace(">","&gt;",$th_title);
       $th_desc =$_POST['desc'];
       $th_desc = str_replace("<","&lt;",$th_desc);
       $th_desc = str_replace(">","&gt;",$th_desc);
       $user_id_ = $_POST['user_id'];
       $sql= "INSERT INTO `thread` (`thread_title`, `thread_desc`, `thread_user_id`, `thread_cat_id`, `timestamp`) VALUES ( '$th_title ', '$th_desc', '$user_id_', '$id', current_timestamp())";
       $result=mysqli_query($conn,$sql);
       $show_alert_text= true;
    

   };

   if($show_alert_text){
       echo'<div class="alert alert-success alert-dismissible fade show" role="alert">
       <strong>Success!</strong> Your thread has been added! please wait for community to respond
       <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
     </div>';
   }

   ?>

    <!-- category container starts here -->
    <div class="container text-light bg-dark my-4">
        <div class="jumbotron  bg-dark ">
            <h1 class="display-4">Welcome to <?php echo $catname; ?> Forum</h1>
            <p class="lead"> <?php echo $catdesc; ?></p>
            <hr class="my-4">
            <p>This is a peer to peer forum for sharing knowlege with each other</p>
            <ul>
                <li class="rule"> No Spam / Advertising / Self-promote in the forums</li>
                <small>These forums define spam as unsolicited advertisement for goods, services and/or other web sites,
                    or posts with little, or completely unrelated content. Do not spam the forums with links to your
                    site or product, or try to self-promote your website, business or forums etc.</small>
                <li class="rule"> Do not post copyright-infringing material</li>
                <small>Providing or asking for information on how to illegally obtain copyrighted materials is
                    forbidden.</small>
                <li class="rule"> Do not post “offensive” posts, links or images</li>
                <small>Any material which constitutes defamation, harassment, or abuse is strictly prohibited. Material
                    that is sexually or otherwise obscene, racist, or otherwise overly discriminatory is not permitted
                    on these forums. This includes user pictures. Use common sense while posting.</small>
                <li class="rule"> Remain respectful of other members at all times</li>
                <small>All posts should be professional and courteous. You have every right to disagree with your fellow
                    community members and explain your perspective.</small>
                <li class="rule"> Be DESCRIPTIVE and Don’t use “stupid” topic names</li>
                <small>PLEASE post a descriptive topic name! Give a short summary of your problem IN THE SUBJECT. (Don’t
                    use attention getting subjects, they don’t get attention and only annoy people).</small>
            </ul>
            <a class="btn btn-success btn-lg" href="#" role="button">Learn more</a>
        </div>

    </div>
    <div id="ques" class=" mb-5 container">
    <?php
    if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']= true)
    {
          echo '<h2>Start a Discussion</h2>';
          echo '<form action= "/forum_website/thread-list.php?catid='.$id.'" method= "post">
          <div class="mb-3">
              <label for="titleExample" class="form-label">Problem Title</label>
              <input name="title" type="text" class="form-control" id="title" aria-describedby="textHelp">
              <div id="textHelp" class="form-text">Keep your title as short and crisp as possible </div>
              <input type="hidden" name="user_id" value= "'.$_SESSION["user_id"].'">
          </div>
          <div class="mb-3">
              <label for="exampleFormControlTextarea1" class="form-label">Elaborate Your Problem </label>
              <textarea name="desc" class="form-control" id="desc" rows="3"></textarea>
          </div>
          <button type="submit" class="btn btn-success">Submit</button>
      </form>';
    }
    else {

        echo '<h2>Start a Discussion</h2>
        <p class="lead">You are not logged in. Please login to start a Discussion</p>';
    }
      ?> 
     
<?php
      echo' <h2 class="py-2">Browse Question</h2>';

  $sql= "SELECT * FROM `thread` where thread_cat_id=$id";
  $result=mysqli_query($conn,$sql);
  $noresult = true;
  
  while($row= mysqli_fetch_assoc($result)){
      $title= $row['thread_title'];
      $noresult= false;

      $desc =$row['thread_desc'];
      $id_thread= $row['thread_id'];
      $thread_user_id = $row['thread_user_id'];
      $thread_time = $row['timestamp'];
      $time = strtotime($thread_time);
      $newformat_thread = date('F j, Y',$time);
      $sql2= "SELECT user_email , username FROM `disuss_users` WHERE `user_id` = $thread_user_id";
      $result2=mysqli_query($conn,$sql2);
      $row2 = mysqli_fetch_assoc($result2);
      $user_email = $row2['user_email'];
      $user_name = $row2['username'];


    //   var_dump($catname);
    // echo var_dump($noresult);
    if(!$noresult)
    {
    echo '
           <div class="d-flex border my-2 p-3">
            <img src="https://cdn.pixabay.com/photo/2016/11/18/23/38/child-1837375_960_720.png" alt="John Doe"
                class="flex-shrink-0 me-3 mt-3 rounded-circle" style="width:60px;height:60px;">
            <div>
                <h4>'.$user_name.' <small>Posted on '.$newformat_thread.'</small></h4>
                <h3><a href="./thread.php?thread_id='.$id_thread.'">'.$title.'</a></h3>
                <p>'.$desc.'</p>
            </div>
        </div>';
    }
   
}


if($noresult)
{
   
    echo '
    <div class="container-fluid bg-light text-dark p-5">
    <div class="container bg-light p-5">
        <p class="display-5">No Threads Found</p>
        <hr>
        <p><strong>Be the first person to ask a question</strong></p>
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