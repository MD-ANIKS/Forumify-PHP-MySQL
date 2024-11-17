<?php 

  session_start();
  // session_unset();
  session_destroy();
  header("location: /index.php?loggingout=true");
  echo "you are about to be logging out...";

?>