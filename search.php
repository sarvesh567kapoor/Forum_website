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

a:hover {
    color: #0cb567;
}

.jumbotron {
    padding: 4rem 2rem;
    margin-bottom: 2rem;
    background-color: var(--bs-light);
    border-radius: .3rem;
}

a {
    color: #198754;
}

#maincontainer 
{
    min-height: 82vh;

}
</style>

<body>
    <?php
  include 'partials/db_connect.php';
  include 'partials/_header.php';
 
  ?>


    <!-- search result starts here-->
    <div id="maincontainer" class="searchResults  my-3 container">
        <h2 class="py-2">Search Results for <em>"<?php echo $_GET['search'];  ?>"</em></h2>
        
            <?php
   $search_term= $_GET['search'];
   $noresult = true;
   $sql= "SELECT * FROM `thread` where match(thread_title, thread_desc) against('$search_term')";
   $result=mysqli_query($conn,$sql);
   while($row= mysqli_fetch_assoc($result))
   {
    $noresult = false;
       $title= $row['thread_title'];
       $desc =$row['thread_desc'];
       $thread_id = $row['thread_id'];
       $url= "thread.php?thread_id=".$thread_id;

       // Display the search Results
       echo '<div class="result">
                 <h3>
                 <a href="'.$url.'" class="text-dark">'.$title.'</a>
                 </h3>
                 <p>'.$desc.'
                 </p> 
            </div>';
     
   }
   if($noresult){
       echo '<div class="container-fluid bg-light text-dark p-5">
       <div class="container bg-light p-5">
           <p class="display-5">No Results Found</p>
           <hr>
           <div class="p-6 display-7">Suggestions:</div>
           <p>
               <ul>
               <li>Make sure that all words are spelled correctly.</li>
               <li>Try different keywords.</li>
               <li>Try more general keywords.</li>
               </ul>
            </p>
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