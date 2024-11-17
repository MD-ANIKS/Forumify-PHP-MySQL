<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Welcome to Forumify | Search</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <!-- bootstrap icon cdn  -->
  <link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.11.3/font/bootstrap-icons.min.css"
    integrity="sha512-dPXYcDub/aeb08c63jRq/k6GaKccl256JQy/AnOq7CAnEZ9FzSL9wSbcZkMp4R26vBsMLFYH4kQ67/bbV8XaCQ=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
  <style>
  body {
    background-color: #fff;
    font-family: Arial, Helvetica, sans-serif;
    font-size: 13px;
    margin: 0px;
  }

  /* remove bullet points */
  ul {
    list-style-type: none;
  }

  /* hr styling */
  hr {
    border: 0;
    height: 0;
    border-top: 1px solid rgba(0, 0, 0, 0.1);
    border-bottom: 1px solid rgba(255, 255, 255, 0.3);
  }


  main {
    margin-left: 150px;
    width: 650px;
  }



  .results-returned {
    element.style {
      color: #777;
      padding-top: 10px;
      padding-bottom: 15px;
    }
  }

  main ul {
    padding-left: 0px;
    list-style: none;
  }

  main li a {
    text-decoration-line: none;
    margin-bottom: 7px;
    margin-top: 0px;
  }

  .result-link {
    color: #1a0dab;
    font-weight: normal;
    font-size: 18px;
    margin-bottom: 5px;
    margin-top: 2px;
  }

  .green-link {
    color: #006621;
    max-width: 650px;
    display: inline-block;
    margin-bottom: 5px;
    margin-top: 0px;
  }

  main li p {
    margin-bottom: 40px;
    margin-top: 0px;
  }

  .down-arrow {
    border-color: #006621 transparent;
    border-style: solid;
    border-width: 5px 4px 0;
    display: inline-block;
    vertical-align: middle;
  }

  h3 {
    display: block;
    font-size: 1.17em;
    margin-block-start: 1em;
    margin-block-end: 1em;
    margin-inline-start: 0px;
    margin-inline-end: 0px;
    font-weight: bold;
  }

  #related ul {
    list-style: none;
    padding: 5px 0;
    column-width: auto;
    column-count: 2;
    padding-bottom: 20px;
    width: 450px;
  }

  #related li {
    padding: 5px;
    font-size: 14px;
    font-weight: bold;
  }
  </style>
</head>

<body>
  <?php 
      include './partials/_dbconnect.php';
      include './partials/_navbar.php';
    ?>


  <main class="my-3" style="min-height: 80vh;">


    <?php 
             $query = $_GET['search'];
             $sql = "SELECT * FROM `threads` WHERE MATCH (thread_title, thread_desc) against ('$query')";
             $result = mysqli_query($mysql, $sql);
             $num = mysqli_num_rows($result);

             if($num > 0){
              echo '<p class="results-returned lead text-dark">Search results for <em class="text-muted">"'.$_GET['search'].'"</em> </p>';
               echo '<p class="results-returned">About '.$num.' results (0.46 seconds)</p>
                <ul>';

                while($row = mysqli_fetch_assoc($result)){
                  $url = $_SERVER['HTTP_HOST'];
                  echo '<li>
                        <h2 class="result-link"><a href="./thread.php?threadid='.$row['thread_id'].'">'.$row['thread_title'].'</a></h2>
                        <p class="green-link">'.$url.'</p>
                        <span class="down-arrow"></span>
                        <p>March 20, 2019, '. substr($row['thread_desc'], 0 ,158) .'...</p>
                      </li>';
                }

                  echo '</ul>' ;
                  echo '<div id="related">
                        <h3>Searches related to build this webpage</h3>
                        <ul>
                          <li>
                            <a href="#">new website everyday</a>
                          </li>
                          <li>
                            <a href="#">new everyday</a>
                          </li>
                          <li>
                            <a href="#">website everyday</a>
                          </li>
                          <li>
                            <a href="#">the more you know</a>
                          </li>
                          <li>
                            <a href="#">more you know</a>
                          </li>
                          <li>
                            <a href="#">the know</a>
                          </li>
                        </ul>
                      </div>';
             }else{
              echo '<div style="padding-top: 70px;">
                <p class="results-returned lead text-dark">Your search - <strong class="text-muted">'.$_GET['search'].'</strong> <br/> - did not match any documents.</p>
                <ul style="list-style-type: disc;">
                <p class="lead">Suggestions:</p>
                <li>Make sure that all words are spelled correctly.</li>
                <li>Try different keywords.</li>
                <li>Try more general keywords.</li>
              </ul>
              </div>';

             }

    ?>





    <!-- search suggestions-->

  </main>


  <?php 
      include './partials/_footer.php';
    ?>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
  </script>
</body>

</html>