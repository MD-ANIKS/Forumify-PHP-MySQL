<?php

session_start();


echo "
<nav class='navbar navbar-expand-lg bg-body-tertiary bg-dark border-bottom border-body'  data-bs-theme='dark'>
  <div class='container-fluid w-100'>
    <a class='navbar-brand text-success' href='./'>Forumify.</a>
    <button class='navbar-toggler' type='button' data-bs-toggle='collapse' data-bs-target='#navbarSupportedContent' aria-controls='navbarSupportedContent' aria-expanded='false' aria-label='Toggle navigation'>
      <span class='navbar-toggler-icon'></span>
    </button>
    <div class='collapse navbar-collapse' id='navbarSupportedContent'>
      <ul class='navbar-nav me-auto mb-2 mb-lg-0'>
        <li class='nav-item'>
          <a class='nav-link' aria-current='page' href='./'>Home</a>
        </li>
        <li class='nav-item dropdown'>
          <a class='nav-link dropdown-toggle' href='#' role='button' data-bs-toggle='dropdown' aria-expanded='false'>
            Top Category
          </a>
          <ul class='dropdown-menu'>";

          $sql = "SELECT * FROM `categories` LIMIT 3";
          $result = mysqli_query($mysql, $sql);
          while( $row = mysqli_fetch_assoc($result) ){
            echo "<li><a class='dropdown-item' href='./thread_list.php?catid=".$row['category_id']."'>". $row['category_name'] ."</a></li>"; 
          };
          
            echo "</ul>
        </li>
      </ul>
      <form class='d-flex' role='search' action='/search.php' method='get'>
        <input class='form-control me-2' type='search' placeholder='Search' id='search' name='search' aria-label='Search'>
        <button class='btn btn-success' type='submit'>Search</button>
      </form>";

      if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true){
        echo"<div class='mx-2 '>
              <ul class='navbar-nav me-auto mb-2 mb-lg-0'>
                <li class='nav-item dropdown'>
                  <a class='nav-link dropdown-toggle py-0 d-flex align-items-center' href='#' role='button' data-bs-toggle='dropdown' aria-expanded='false'>
                    <i class='bi bi-person-circle fs-2 me-2'></i>
                    <span>".$_SESSION['username']."</span>
                  </a>
                  <ul class='dropdown-menu' style='left: -60px;'>
                    <li><a class='dropdown-item' href='#'><i class='bi bi-list me-2'></i> Account</a></li>
                    <li><a class='dropdown-item' href='#'><i class='bi bi-gear-fill me-2'  ></i>Setting</a></li>
                    <li><hr class='dropdown-divider'></li>
                    <li><a class='dropdown-item' href='./partials/_logoutHandle.php'><i class='bi bi-box-arrow-right me-2'></i>Log Out</a></li>
                  </ul>
                </li>
              </ul>
            </div>"; 
      }else{
        $_SESSION['loggedin'] = false;
        echo "<div class='mx-2'>
                <button class='btn btn-outline-success' data-bs-toggle='modal' data-bs-target='#loginModal' >Login</button>
                <button class='btn btn-outline-success' data-bs-toggle='modal' data-bs-target='#signupModal' >SignUp</button>
              </div>";
      }




    echo "</div>
  </div>
</nav>";

include 'partials/_loginModal.php';
include 'partials/_signupModal.php';

if (isset($_GET['signupsuccess']) && $_GET['signupsuccess'] == 'true') {
  echo '<div class="alert alert-success alert-dismissible fade show mb-0" role="alert">
          <i class="bi bi-check-circle-fill"></i>
          Thanks for signing up. Your account has been created.
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
} elseif (isset($_GET['signupsuccess']) && $_GET['signupsuccess'] !== 'true') {
  echo '<div class="alert alert-danger alert-dismissible fade show mb-0" role="alert">
         <i class="bi bi-exclamation-triangle-fill"></i>
            ' . substr($_GET['signupsuccess'], 12) . '
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>';
} elseif (isset($_GET['loginsuccess']) && $_GET['loginsuccess'] == 'true') {
  echo '<div class="alert alert-success alert-dismissible fade show mb-0" role="alert">
        <i class="bi bi-check-circle-fill"></i>
        You are successfully logged in
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
} elseif (isset($_GET['loginsuccess']) && $_GET['loginsuccess'] !== 'true') {
  echo '<div class="alert alert-danger alert-dismissible fade show mb-0" role="alert">
  <i class="bi bi-exclamation-triangle-fill"></i>
     ' . substr($_GET['loginsuccess'], 12) . '
     <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
   </div>';
}elseif(isset($_GET['loggingout']) && $_GET['loggingout'] == 'true'){
  echo '<div class="alert alert-primary alert-dismissible fade show mb-0" role="alert">
        <i class="bi bi-info-circle-fill"></i>
        You have been successfully logged out!
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
}


?>
