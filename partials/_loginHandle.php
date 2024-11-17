<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  include './_dbconnect.php';
  $showError = "false";
  $login_email = $_POST['loginEmail'];
  $login_pass = $_POST['loginPassword'];

  // check wheather this email and username exist 
  $existMail = "SELECT * FROM `users` WHERE `user_email` = '$login_email'";
  $result = mysqli_query($mysql, $existMail);
  $num = mysqli_num_rows($result);

  if($num == 1){
    $row = mysqli_fetch_assoc($result);
    if(password_verify($login_pass, $row['user_pass'])){
      session_start();
      $_SESSION['loggedin'] = true;
      $_SESSION['userid'] = $row['user_id'];
      $_SESSION['username'] = $row['user_name'];
      header("location: /index.php?loginsuccess=true");
      exit();
    }else{
      $showError = "Incorrect Password";
      header("location: /index.php?loginsuccess=false?error=$showError");
    }
    
  }else{
    $showError = "Invalid email address";
    header("location: /index.php?loginsuccess=false?error=$showError");
  }
  


}
