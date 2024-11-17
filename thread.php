<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Thread</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.11.3/font/bootstrap-icons.min.css"
    integrity="sha512-dPXYcDub/aeb08c63jRq/k6GaKccl256JQy/AnOq7CAnEZ9FzSL9wSbcZkMp4R26vBsMLFYH4kQ67/bbV8XaCQ=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
  <style>
    .empty-state {
      margin: 40px auto;
      background: #ffffff;
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

<body style="background-color: #eee;">
  <?php
  include './partials/_dbconnect.php';
  include './partials/_navbar.php';
  ?>

  <?php
  $id = $_GET['threadid'];
  $sql = "SELECT * FROM `threads` WHERE `thread_id` = $id";
  $result = mysqli_query($mysql, $sql);
  while ($row = mysqli_fetch_assoc($result)) {
    $thread_userid = $row['thread_user_id'];
    $thread_title = $row['thread_title'];
    $thread_desc = $row['thread_desc'];
    $thread_time = $row['timestamp'];
  }
  ?>

  <?php
  $showAlert = false;
  $method = $_SERVER["REQUEST_METHOD"];
  if ($method == 'POST') {
    $comment = $_POST['comment'];
    $comment = str_replace("<", "&lt;", $comment);
    $comment = str_replace(">", "&gt;", $comment);
    $comment = str_replace("(", "&#40;", $comment);
    $comment = str_replace(")", "&#41;", $comment);
    $comment = str_replace('"', "&quot;", $comment);
    $comment = str_replace("'", "&#39;", $comment);

    $author = $_SESSION['username'];
    $sql = "INSERT INTO `comments` (`comment_content`, `comment_by`, `thread_id`, `comment_time`) VALUES ( '$comment', '$author', '$id', CURRENT_TIMESTAMP);";
    $result = mysqli_query($mysql, $sql);
    if ($result) {
      $showAlert = true;
      if ($showAlert) {
        echo '<div class="alert alert-success alert-dismissible fade show mb-0" role="alert">
                          <strong>Success!</strong> Your Comment has been added! Please wait for community to respond
                          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>';
      }
    }
  }
  ?>

  <section id="hero">
    <div id="carouselExampleIndicators" class="carousel slide">
      <div class="carousel-inner">
        <div class="carousel-item active">
          <img src="./images/slider-1.jpg" height="400px" style="object-fit: cover;" class="d-block w-100" alt="...">
        </div>
      </div>
    </div>
  </section>

  <section id="threads" class="mb-5">
    <div class="container">
      <div class="my-4">
        <h3 class="text-center d-flex flex-column gap-2"> Forumify Community<small class="text-body-secondary">Where
            Coders Unite, Share Ideas, and Solve Problems Together! Join the Fun!</small></h3>
      </div>

      <div class="mt-5 py-5">
        <div class="row d-flex justify-content-center">
          <div class="col-md-12 col-lg-10 col-xl-8">
            <div class="card">
              <div class="card-body">
                <div class="d-flex flex-start align-items-center">
                  <img class="rounded-circle shadow-1-strong me-3"
                    src="https://static.vecteezy.com/system/resources/previews/009/292/244/non_2x/default-avatar-icon-of-social-media-user-vector.jpg"
                    alt="avatar" width="60" height="60" />
                  <div>
                    <h6 class="fw-bold text-success mb-1">
                      <?php
                      $sql = "SELECT * FROM `users` WHERE `user_id` ='$thread_userid' ";
                      $result = mysqli_query($mysql, $sql);
                      $num = mysqli_num_rows($result);
                      if ($num == 1) {
                        $row = mysqli_fetch_assoc($result);
                        echo $row['user_name'];
                      }

                      ?>
                    </h6>
                    <p class="text-muted small mb-0">
                      Shared publicly - <?php echo $thread_time; ?>
                    </p>
                  </div>
                </div>

                <h6 class="fw-bold mb-1 mt-3"><?php echo $thread_title; ?></h6>
                <p class="mt-2 mb-4 pb-2">
                  <?php echo $thread_desc; ?>
                </p>

                <div class="small d-flex justify-content-start">
                  <a href="#!" class="d-flex align-items-center me-3 text-success text-decoration-none">
                    <i class="bi bi-hand-thumbs-up me-2"></i>
                    <p class="mb-0">Like</p>
                  </a>
                  <a href="#!" class="d-flex align-items-center me-3 text-success text-decoration-none">
                    <i class="bi bi-chat-dots me-2"></i>
                    <p class="mb-0">Comment</p>
                  </a>
                  <a href="#!" class="d-flex align-items-center me-3 text-success text-decoration-none">
                    <i class="bi bi-share-fill me-2"></i>
                    <p class="mb-0">Share</p>
                  </a>
                </div>
              </div>
              <form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" class="card-footer py-3 border-0">
                <div class="d-flex flex-start w-100">
                  <img class="rounded-circle shadow-1-strong me-3"
                    src="https://static.vecteezy.com/system/resources/previews/009/292/244/non_2x/default-avatar-icon-of-social-media-user-vector.jpg"
                    alt="avatar" width="40" height="40" />
                  <div data-mdb-input-init class="form-outline w-100">
                    <textarea class="form-control" placeholder="type your comment..." id="comment" name="comment" rows="4"
                      style="background: #fff;"></textarea>
                  </div>
                </div>

                <div class="float-end mt-2 pt-1">
                  <?php
                  if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
                    echo '<button type="submit" data-mdb-button-init data-mdb-ripple-init class="btn btn-success btn-sm">Post comment</button>';
                  } else {
                    echo '<button type="button" data-bs-toggle="modal" data-bs-target="#signupModal" class="btn btn-success">Post comment</button>';
                  }
                  ?>

                  <button type="button" data-mdb-button-init data-mdb-ripple-init
                    class="btn btn-outline-success btn-sm">Cancel</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>

      <div class="my-0">
        <div class="row d-flex justify-content-center">
          <div class="col-md-12 col-lg-10 col-xl-8">
            <div class="card text-body">

              <?php
              $noResult = false;
              if ($noResult != false) {
                echo '<div class="card-body px-4 pb-0">
                    <h4 class="mb-0">Recent comments</h4>
                    <p class="fw-light">Latest Comments section by users</p>
                  </div>';
              }
              ?>


              <?php
              $id = $_GET['threadid'];
              $sql = "SELECT * FROM `comments` WHERE `thread_id` = $id";
              $result = mysqli_query($mysql, $sql);
              $noResult = true;
              while ($row = mysqli_fetch_assoc($result)) {
                $noResult = false;
                $comment_id = $row['comment_id'];
                $comment_by = $row['comment_by'];
                $comment_content = $row['comment_content'];
                $comment_time = $row['comment_time'];
                echo '<div class="card-body p-4">
                      <div class="d-flex flex-start w-100">
                        <img class="rounded-circle shadow-1-strong me-3"
                          src="https://static.vecteezy.com/system/resources/previews/009/292/244/non_2x/default-avatar-icon-of-social-media-user-vector.jpg" alt="avatar" width="60"
                          height="60" />
                        <div class="w-100">
                          <div class="d-flex gap-2 align-items-baseline">
                            <h6 class="fw-bold mb-1">' . $comment_by . '</h6>
                            <div class="d-flex mb-3">
                              <p class="mb-0">
                                - ' . $comment_time . '
                              </p>
                            </div>
                             <div class="d-flex justify-content-end ms-auto">
                                <a href="#!" class="link-muted"><i class="bi bi-pencil ms-2"></i></a>
                                <a href="#!" class="text-success"><i class="bi bi-arrow-clockwise ms-2"></i></a>
                                <a href="#!" class="link-danger"><i class="bi bi-heart ms-2"></i></a>
                              </div>
                          </div>
                          <p class="mb-0">
                            ' . $comment_content . '
                          </p>
                        </div>
                      </div>
                    </div>

                    <hr class="my-0" />';
              }
              if ($noResult) {
                echo '<div class="empty-state">
                              <div class="empty-state__content">
                                <div class="empty-state__icon">
                                  <img src="./images/noresult.png" alt="no comment found">
                                </div>
                                <div class="empty-state__message">No Comment has been added yet.</div>
                                <div class="empty-state__help">
                                  Be the first Person to comment
                                </div>
                              </div>
                            </div>';
              }
              ?>



            </div>
          </div>
        </div>
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