<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Forum - Home</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <!-- bootstrap icon cdn  -->
  <link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.11.3/font/bootstrap-icons.min.css"
    integrity="sha512-dPXYcDub/aeb08c63jRq/k6GaKccl256JQy/AnOq7CAnEZ9FzSL9wSbcZkMp4R26vBsMLFYH4kQ67/bbV8XaCQ=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
  <?php 
      include './partials/_dbconnect.php';
      include './partials/_navbar.php';
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
          <img src="./images/slider-1.jpg" height="400px" style="object-fit: cover;" class="d-block w-100" alt="...">
        </div>
        <div class="carousel-item">
          <img src="./images/slider-2.jpg" height="400px" style="object-fit: cover;" class="d-block w-100" alt="...">
        </div>
        <div class="carousel-item">
          <img src="./images/slider-3.jpg" height="400px" style="object-fit: cover;" class="d-block w-100" alt="...">
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

  <section id="category" class="mb-5">
    <div class="container">
      <div class="my-4">
        <h3 class="text-center"> Forumify <small class="text-body-secondary">Join the Conversation Today!</small></h3>
      </div>
      <div class="category-items ">
        <div class="row gy-5">

          <!-- fetch all category  -->
          <?php 
          $sql = "SELECT * FROM `categories`";
          $result = mysqli_query($mysql, $sql);
          // loop thorough each category item 
          while( $row = mysqli_fetch_assoc($result) ){
            $id = $row['category_id'];
            $title = $row['category_name'];
            $desc = $row['category_desc'];
            echo "<div class='col-md-4'>
                  <div class='card' style='width: 22rem;'>
                    <img style='object-fit: cover;' src='./images/card-".$id.".jpeg' height='250px' class='card-img-top' alt='category'>
                    <div class='card-body'>
                      <h5 class='card-title'><a class='text-decoration-none text-success' href='./thread_list.php?catid=".$id."'>". $title ."</a></h5>
                      <p class='card-text'>". substr($desc, 0, 90) ."...</p>
                      <a href='./thread_list.php?catid=".$id."' class='btn btn-success'>View Thread</a>
                    </div>
                  </div>
                </div>";
          }
        ?>
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