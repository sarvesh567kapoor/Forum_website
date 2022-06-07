<?php
 
 include './db_connect.php';
 $showError=false;
 if($_SERVER["REQUEST_METHOD"]== "POST")
 {
     $email = $_POST['loginEmail'];
     $pass = $_POST['loginPass'];

     $sql ="SELECT *  FROM `disuss_users` WHERE `user_email` = '$email'";
     $result = mysqli_query($conn,$sql);
     $numRows = mysqli_num_rows($result);
     $showError = false;
     if($numRows == 1 )
     {
        $row= mysqli_fetch_assoc($result);
        if(password_verify($pass,$row['user_pass']))
        {
          session_start();
          $_SESSION['loggedin'] = true;
          $_SESSION['useremail']= $email;
          $_SESSION['user_id']= $row['user_id'];
          $_SESSION['user_name']= $row['username'];
          echo "logged in".$email;
          header("Location: /forum_website/index.php");
          exit();
        }
        else 
        {
            $showError= true;
            header("Location: /forum_website/index.php?login=false");

        }
    }
    else {
        header("Location: /forum_website/index.php");
    }
}


 ?>