<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Thread List</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <!-- bootstrap icon cdn  -->
  <link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.11.3/font/bootstrap-icons.min.css"
    integrity="sha512-dPXYcDub/aeb08c63jRq/k6GaKccl256JQy/AnOq7CAnEZ9FzSL9wSbcZkMp4R26vBsMLFYH4kQ67/bbV8XaCQ=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
  <style>
  .empty-state {
    width: 750px;
    margin: 40px auto;
    background: #ffffff;
    box-shadow: 1px 2px 10px #e1e3ec;
    border-radius: 4px;
  }

  .empty-state__content {
    padding: 48px;
    display: flex;
    align-items: center;
    flex-direction: column;
  }

  .empty-state__content .empty-state__icon {
    width: 200px;
    height: 200px;
    display: flex;
    align-items: center;
    border-radius: 200px;
    justify-content: center;
    background-color: #f7fafc;
    box-shadow: 0px 2px 1px #e1e3ec;
  }

  .empty-state__content .empty-state__icon img {
    width: 170px;
  }

  .empty-state__content .empty-state__message {
    color: #38a169;
    font-size: 1.5rem;
    font-weight: 500;
    margin-top: 0.85rem;
  }

  .empty-state__content .empty-state__help {
    color: #a2a5b9;
    font-size: 0.875rem;
  }

  .credit {
    color: #A2A5B9;
    font-size: 0.75rem;
    text-align: center;
  }

  .credit a {
    color: #444;
  }
  </style>
</head>

<body>
  <?php
  include './partials/_dbconnect.php';
  include './partials/_navbar.php';
  ?>



  <?php
  $id = $_GET['catid'];
  $sql = "SELECT * FROM `categories` WHERE `category_id` = $id";
  $result = mysqli_query($mysql, $sql);
  while ($row = mysqli_fetch_assoc($result)) {
    $cat_title = $row['category_name'];
    $cat_desc = $row['category_desc'];
  }
  ?>


  <?php
  $showAlert = false;

  $method = $_SERVER["REQUEST_METHOD"];
  if ($method == 'POST') {

    $th_user_id = $_SESSION['userid'];
    $th_title = $_POST['title'];
    $th_desc = $_POST['desc'];

    $th_title = str_replace("<", "&lt;", $th_title);
    $th_title = str_replace(">", "&gt;", $th_title);
    $th_title = str_replace("(", "&#40;", $th_title);
    $th_title = str_replace(")", "&#41;", $th_title);
    $th_title = str_replace('"', "&quot;", $th_title);
    $th_title = str_replace("'", "&#39;", $th_title);

    $th_desc = str_replace("<", "&lt;", $th_desc);
    $th_desc = str_replace(">", "	&gt;", $th_desc);
    $th_desc = str_replace("(", "&#40;", $th_desc);
    $th_desc = str_replace(")", "&#41;", $th_desc);
    $th_desc = str_replace('"', "&quot;", $th_desc);
    $th_desc = str_replace("'", "&#39;", $th_desc);

    $sql = "INSERT INTO `threads` ( `thread_title`, `thread_desc`, `thread_cat_id`, `thread_user_id`, `timestamp`) VALUES ('$th_title', '$th_desc', '$id', '$th_user_id', CURRENT_TIMESTAMP)";
    $result = mysqli_query($mysql, $sql);

    if ($result) {
      $showAlert = true;
      if ($showAlert) {
        echo '<div class="alert alert-success alert-dismissible fade show mb-0" role="alert">
                          <strong>Success!</strong> Your thread has been added! Please wait for community to respond
                          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>';
      }
    }


  }
  ?>


  <section id="hero">
    <div id="carouselExampleIndicators" class="carousel slide">
      <div class="carousel-indicators">
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"
          aria-current="true" aria-label="Slide 1"></button>
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"
          aria-label="Slide 2"></button>
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"
          aria-label="Slide 3"></button>
      </div>
      <div class="carousel-inner">
        <div class="carousel-item active">
          <img src="./images/slider-3.jpg" height="400px" style="object-fit: cover;" class="d-block w-100" alt="...">
        </div>
        <div class="carousel-item">
          <img src="./images/slider-2.jpg" height="400px" style="object-fit: cover;" class="d-block w-100" alt="...">
        </div>
        <div class="carousel-item">
          <img src="./images/slider-1.jpg" height="400px" style="object-fit: cover;" class="d-block w-100" alt="...">
        </div>
      </div>
      <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
        data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
        data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
      </button>
    </div>
  </section>

  <section id="threads" class="mb-5">
    <div class="container">
      <div class="my-4">
        <h3 class="text-center"> Forumify Community<small class="text-body-secondary"> we're happy to have you
            here.</small></h3>
      </div>

      <div class="jumbotron border p-4" style="background-color: #E8ECEF;">
        <h1 class="display-4">Welcome to the <?php echo $cat_title; ?> Forum</h1>
        <p class="lead">Where Coders Unite, Share Ideas, and Solve Problems Together! Join the Fun!</p>
        <hr class="my-4">
        <p>Welcome to the ultimate <?php echo $cat_title . ' forum! ' . $cat_desc; ?> </p>
        <p class="lead">
          <a class="btn btn-success btn-lg" href="#" role="button">Learn more</a>
        </p>
      </div>

      <?php 
        if( isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == false){
          $showError = "By registering with us, you'll be able to discuss, share and private message with other members of our community.";
          echo '<div class="alert alert-primary alert-dismissible fade show mb-0" role="alert">
                    '.$showError.'
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
        }
      ?>

      <div class="my-4">
        <h2 class="pb-2">Start a Discussion</h2>
        <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post" class="d-flex flex-column gap-3">
          <div class="form-group">
            <label class="pb-2" for="exampleInputEmail1">Thread Title</label>
            <input type="text" class="form-control" id="title" name="title">
            <small id="emailHelp" class="form-text text-muted">Keep your title as short & crisp as possible</small>
          </div>

          <div class="form-group">
            <label class="pb-2" for="desc">Ellaborate Your Concern</label>
            <textarea class="form-control" id="desc" name="desc" rows="3"></textarea>
          </div>

          <?php 
            if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true){
              echo '<button type="submit" class="btn btn-success w-25">Submit</button>';
            }else{
              echo '<button type="button" data-bs-toggle="modal" data-bs-target="#signupModal" class="btn btn-success w-25">Submit</button>';
            }
          ?>
        </form>
      </div>


      <div class="media_objects_area mt-5 ">
        <div class="my-4">
          <h3> Forumify Community<small class="text-body-secondary"> Browse Question & Answer.</small></h3>
        </div>
        <ul class="list-unstyled d-flex flex-column gap-3">

          <?php
          $id = $_GET['catid'];
          $sql = "SELECT * FROM `threads` WHERE `thread_cat_id` = $id";
          $result = mysqli_query($mysql, $sql);
          $noResult = true;
          while ($row = mysqli_fetch_assoc($result)) {
            $noResult = false;
            $thread_user_id = $row['thread_user_id'];

                        
            $thread_id = $row['thread_id'];
            $thread_title = $row['thread_title'];
            $thread_desc = $row['thread_desc'];
            $thread_time = $row['timestamp'];
            echo '          <li class="media d-flex gap-3">
            <img class="mr-3 rounded-circle" src="https://static.vecteezy.com/system/resources/previews/009/292/244/non_2x/default-avatar-icon-of-social-media-user-vector.jpg" height="44px" width="44px" alt="Generic placeholder image">
            <div class="media-body">
                      <div class="d-flex gap-2 align-items-baseline">
                            <h6 class=" mb-1">';

                         
                              // selecting thread user 
                              $userSql = "SELECT * FROM `users` WHERE `user_id` ='$thread_user_id'";
                              $userResult = mysqli_query($mysql, $userSql);
                              $userRow = mysqli_fetch_assoc($userResult);
                              echo "Asked By " . '<span class="fw-bold">'.$userRow['user_name'].'</span>';
                            
                            echo '</h6>
                            <div class="d-flex">
                              <p class="mb-0">
                                at '.$thread_time.'
                              </p>
                            </div>
                          </div>
              <h5 class="mt-0 mb-1"><a class="text-decoration-none text-success" href="./thread.php?threadid=' . $thread_id . '" >' . $thread_title . '</a></h5>
              <p>' . $thread_desc . '</p>
            </div>
          </li>';
          }
          if ($noResult) {
            echo '<div class="empty-state">
                      <div class="empty-state__content">
                        <div class="empty-state__icon">
                          <img src="./images/noresult.png" alt="no thread found">
                        </div>
                        <div class="empty-state__message">No thread has been added yet.</div>
                        <div class="empty-state__help">
                          Be the first Person to ask a question
                        </div>
                      </div>
                    </div>';
          }
          ?>

        </ul>
      </div>

    </div>
  </section>


  <?php
  include './partials/_footer.php';
  ?>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
  </script>
</body>

</html>