<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

  <title>Discuss- Coding Forums</title>
</head>
<style>
    .imgcontainer img {height: 300px;width: 441px;}
    .container {
    min-height: 86.8vh;
}

.imgcontainer {
    display: flex;
    flex-direction: row;
    flex-wrap: wrap;
    justify-content: space-around;
}
</style>

<body>
<?php
  include 'partials/db_connect.php';
  include 'partials/_header.php';
  ?>
 
<div class=" my-4 container">
<h3>About Discuss Coding</h3>
<p>Welcome to Discusscoding. inc, your number one source for all things Knowledge. We're dedicated to providing you the very best of Question and answering platform , with an emphasis on User Demands, Question and Answers, Helping the Students and Programmer.
Founded in 2021 by Sarvesh Kapoor, Discusscoding. inc has come a long way from its beginnings in India. When Sarvesh Kapoor first started out, her passion for Sharing the Knowledge in Coding and helping each other drove them to start their own business.
We hope you enjoy our products as much as we enjoy offering them to you. If you have any questions or comments, please don't hesitate to contact us.
Sincerely,
Sarvesh Kapoor</p>
<div class="imgcontainer">
<img src="./partials/about1.jpg" alt="about.jpg">
<img src="./partials/about2.jpg" alt="about.jpg">
</div>

</div>
 


  <!-- Optional JavaScript; choose one of the two! -->

  <!-- Option 1: Bootstrap Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

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