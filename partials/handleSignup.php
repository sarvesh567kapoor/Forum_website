<?php
 
 $showError=false;
 if($_SERVER["REQUEST_METHOD"]== "POST")
 {
     include './db_connect.php';
     $user_name= $_POST['username'];
     $user_email =  $_POST['signupEmail'];
     $user_password = $_POST['signuppassword'];
     $user_c_password = $_POST['signupcpassword'];
     
     //checking wheather this email is already exist 

     $existSql= "SELECT * FROM `disuss_users` where user_email = '$user_email'";
     $result = mysqli_query($conn, $existSql);
     $numRows = mysqli_num_rows($result);
     $showError = false;
     if($numRows > 0 ){
         $showError = true;
         $showString= "The  Email Address is already associated with another Account!";
     }
     else{
         if($user_password == $user_c_password)
         {
             $hash_pass= password_hash($user_password, PASSWORD_DEFAULT);
             $SQL = "INSERT INTO `disuss_users` ( `user_email`, `user_pass`, `user_created_time`,`username`) VALUES ( '$user_email', '$hash_pass', current_timestamp(),'$user_name')";
             $result = mysqli_query($conn,$SQL);
             if($result) {
                 $showAlert = true;
                 header("Location: /forum_website/index.php?signupsuccess=true");
                 exit();

             }

         }
         else 
         {
            $showError = true;
            $showString= "Password do not match please check again !";
           

         }
     }

    //  header("Location: /forum_website/index.php?signupsuccess=false&error=$showError");




 }

?>