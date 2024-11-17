<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  include './_dbconnect.php';
  $showError = "false";
  $signup_email = $_POST['signupEmail'];
  $signup_username = $_POST['signupUsername'];
  $signup_pass = $_POST['signupPassword'];
  $signup_cpass = $_POST['signupCpassword'];

  // check wheather this email and username exist 
  $existSqlMail = "SELECT * FROM `users` WHERE `user_email` = '$signup_email'";
  $existSqlUsername = "SELECT * FROM `users` WHERE `user_name` = '$signup_username'";
  $mailCheck = mysqli_query($mysql, $existSqlMail);
  $usernameCheck = mysqli_query($mysql, $existSqlUsername);
  $mailNum = mysqli_num_rows($mailCheck);
  $usernameNum = mysqli_num_rows($usernameCheck);

  if($mailNum > 0){
    $showError = 'This email is already associated with an account.';
  }elseif($usernameNum > 0){
    $showError = 'This Username already exist!';
  }else{
    
    if($signup_pass == $signup_cpass){
      // password has 
      $hash = password_hash($signup_pass, PASSWORD_DEFAULT);
      // store user info in database 
      $sql = "INSERT INTO `users` (`user_name`,`user_email`, `user_pass`, `user_dt`) VALUES ('$signup_username','$signup_email', '$hash', CURRENT_TIMESTAMP)";
      $result = mysqli_query($mysql, $sql);

      if($result){
        $showAlert = true;
        header("location: /index.php?signupsuccess=true");
        exit();
      }
    }else{
      $showError = 'Password and Confirm Password do not match';
    }
  }
  
  header("location: /index.php?signupsuccess=false?error=$showError");


}
