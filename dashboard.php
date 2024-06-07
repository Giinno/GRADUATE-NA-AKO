<?php
session_start();

// Check if the user is logged in, if not then redirect them to the login page
if (!isset($_SESSION['user_id']) || !isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

// Include your database connection file if you need to query user-specific information
include 'db-connect.php';

// Example of querying user-specific information if needed
$user_id = $_SESSION['user_id'];
$stmt = $conn->prepare("SELECT firstname, lastname, email FROM users WHERE id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$stmt->bind_result($firstname, $lastname, $email);
$stmt->fetch();
$stmt->close();

$conn->close();
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ballers Hub</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="/css/land.css">
  </head>
<style>
  body{
    background-color: #0275d8;
    border: 0px;
}
.container {
    display: flex;
    align-items: flex-start;
    margin-top: 10px; /* Space from the top */
  }
  .carousel-inner img {
    margin-top: 25px;
    width: 80%;
    height: 350px;
  }
  .carousel-item {
    width: 100%;
  }
  .card {
    margin-top: 25px;
    padding: 10px;
    margin-bottom: 20px;
  }
  /* Additional styles to move carousel left and add top space */
  .col-md-6:first-child {
    margin-right: -5px; /* Move carousel to the left */
  }
  @media (min-width: 40%) {
    .carousel-item img {
      width: auto;
      height: 200px; /* Adjust the height as needed */
    }
  }
  .new-card {
    border: none;
  }
  .new-card .card-title {
    font-weight: bold;
  }
  .new-card .card-text {
    font-style: italic;
  }
  .card-body {
    margin-left: 30px; /* Adjust the pixel value for desired leftward movement */
  }
</style>

  <body>
    <header>
    <nav class="navbar navbar-expand-lg bg-dark navbar-dark">
        <div class="container">
            <a href="#" class="navbar-brand">Ballers Hub</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
              </button>

              <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
                <ul class="navbar-nav ml-auto mb-2 mb-lg-0">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-expanded="false">
                            Menu
                        </a>
                        <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="statistics.php">Player Statistics</a></li>
                            <li><a class="dropdown-item" href="/schedule/schedule.php">Reserve a Court</a></li>
                            <li><a class="dropdown-item" href="#">Contact us</a></li>
                        </ul>
                    </li>
                </ul>
            </div>

            <div class="collaps -navbar-collaps" id="navmenu">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a href="logout.php" class="nav-link">LOGOUT</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    </header>
    
    <div class="container">
        <div class="row">
          <div class="col-md-6">
            <div id="carouselExample" class="carousel slide">
              <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
              </div>
              <div class="carousel-inner">
                <div class="carousel-item active">
                  <img src="images/gboys.jpg" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                  <img src="images/gboys1.jpg" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                  <img src="images/gboys2.jpg" class="d-block w-100" alt="...">
                </div>
              </div>
              <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
              </button>
              <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
              </button>
            </div>
          </div>
          <div class="col-md-6">
            <div class="card" style="background-color:#5bc0de;">
              <div class="card-body">
                <h3 class="card-title" style="font-weight: bolder;">Golden Boys Basketball Gym</h3>
                <p class="card-text" style="font-style: italic; font-weight: 500;">Golden Boys Basketball Gym is a premier, private reservable basketball court designed for enthusiasts and professionals alike. 
                  Whether you're looking to shoot some hoops with your friends, engage in a competitive match, or host a full-scale tournament, 
                  our state-of-the-art facility provides the perfect environment. With top-notch amenities and a commitment to excellence, 
                  Golden Boys Basketball Gym ensures an unmatched experience for all basketball lovers.</p> <br>
                <a href="schedule.php" class="btn btn-primary">Reserve now</a>
              </div>
            </div>
          </div>
        </div>
    </div>
        
    <div class="row mt-4">
        <div class="col-md-8">
          <div class="card new-card" style="background-color:#0275d8">
            <div class="card-body" style="background-color:#5bc0de;">
              <h1 class="card-title"><strong>Jandrix Despalo <br></strong> of Sto Niño All-Starts</h1>
              <p class="newcard-text" style="font-weight: 500;">Jandrix Despalo exploded on the court with a performance for the ages! He put on an offensive masterclass, dropping a staggering <strong>70 points.</strong> 
                Despalo wasn't just a scoring machine; he dominated the boards with an impressive <strong>21 rebounds. </strong>
                with <strong>0 Assist</strong>, his focus on scoring and securing rebounds powered his team's offense.  
                To cap off this incredible night, imagine Despa shooting an exceptional percentage, like a scorching 75% from the field, 
                making his scoring outburst even more impressive. 
                This performance solidified Despa's place as a true offensive force to be reckoned with.</p> <br> 
              <a href="statistics.php" class="btn btn-primary">View more</a>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <img src="images/jandrix.png" class="img-fluid rounded-start" alt="New Image">
        </div>
      </div>

      <div id="scrollable-content" style="overflow-y: auto; height: 100px;">
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>
