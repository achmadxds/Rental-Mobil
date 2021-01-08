<?php
session_start();
include 'admin/auth.php';

$sql = query("SELECT * FROM mobil_data limit 3");
?>


<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <link href="https://fonts.googleapis.com/css?family=Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&display=swap" rel="stylesheet">

  <title>Car Rental Website</title>

  <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">

  <link rel="stylesheet" type="text/css" href="assets/css/font-awesome.css">

  <link rel="stylesheet" href="assets/css/style.css">

</head>

<body>

  <!-- ***** Header Area Start ***** -->
  <header class="header-area header-sticky">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <nav class="main-nav">
            <!-- ***** Logo Start ***** -->
            <a href="index.php" class="logo">Car Rent</a>
            <!-- ***** Logo End ***** -->
            <!-- ***** Menu Start ***** -->
            <ul class="nav">
              <li><a href="index.php" class="active">Home</a></li>
              <li><a href="offers.php">Offers</a></li>
              <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">About</a>

                <div class="dropdown-menu">
                  <a class="dropdown-item" href="about.php">About Us</a>
                  <a class="dropdown-item" href="testimonials.php">Testimonials</a>
                </div>
              </li>
              <li><a href="contact.php">Contact</a></li>
            </ul>
            <a class='menu-trigger'>
              <span>Menu</span>
            </a>
            <!-- ***** Menu End ***** -->
          </nav>
        </div>
      </div>
    </div>
  </header>
  <!-- ***** Header Area End ***** -->

  <!-- ***** Main Banner Area Start ***** -->
  <div class="main-banner" id="top">
    <video autoplay muted loop id="bg-video">
      <source src="assets/images/video.mp4" type="video/mp4" />
    </video>

    <div class="video-overlay header-text">
      <div class="caption">
        <h6>Rental Mobil Terpercata</h6>
        <h2><em>Sewa Mobil</em> Dengan Harga Murah</h2>
        <div class="main-button">
          <a href="contact.php">Hubungi Kami</a>
        </div>
      </div>
    </div>
  </div>
  <!-- ***** Main Banner Area End ***** -->

  <!-- ***** Offers Starts ***** -->
  <section class="section" id="trainers">
    <div class="container">
      <div class="row">
        <div class="col-lg-6 offset-lg-3">
          <div class="section-heading">
            <h2>Cek Penawaran<em> Kami</em></h2>
            <img src="assets/images/line-dec.png" alt="">
            <p>Mobil yang dirawat sepenuh hati, seperti anak sendiri</p>
          </div>
        </div>
      </div>

      <div class="row">
        <?php
          foreach ($sql as $data) {
          ?>
            <div class="col-lg-4">
              <div class="trainer-item">
                <div class="image-thumb">
                  <img src="admin/images/<?php echo $data['car_img']; ?>" alt="">
                </div>
                <div class="down-content">
                  <h4 class="pt-3"> <?php echo $data['car_name']; ?> </h4>
                  <p> <?php echo $data['description']; ?> </p>
                </div>
              </div>
            </div>
          <?php
          }
        ?>
      </div>

      <br>

      <div class="main-button text-center">
        <a href="offers.php">View Offers</a>
      </div>
    </div>
  </section>
  <!-- ***** Offers Ends ***** -->

  <section class="section section-bg" id="schedule" style="background-image: url(assets/images/about-fullscreen-1-1920x700.jpg)">
    <div class="container">
      <div class="row">
        <div class="col-lg-6 offset-lg-3">
          <div class="section-heading dark-bg">
            <h2>Read <em>About Us</em></h2>
            <img src="assets/images/line-dec.png" alt="">
            <p>Nunc urna sem, laoreet ut metus id, aliquet consequat magna. Sed viverra ipsum dolor, ultricies fermentum massa consequat eu.</p>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-12">
          <div class="cta-content text-center">
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Labore deleniti voluptas enim! Provident consectetur id earum ducimus facilis, aspernatur hic, alias, harum rerum velit voluptas, voluptate enim! Eos, sunt, quidem.</p>

            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iusto nulla quo cum officia laboriosam. Amet tempore, aliquid quia eius commodi, doloremque omnis delectus laudantium dolor reiciendis non nulla! Doloremque maxime quo eum in culpa mollitia similique eius doloribus voluptatem facilis! Voluptatibus, eligendi, illum. Distinctio, non!</p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- ***** Call to Action Start ***** -->
  <section class="section section-bg" id="call-to-action" style="background-image: url(assets/images/banner-image-1-1920x500.jpg)">
    <div class="container">
      <div class="row">
        <div class="col-lg-10 offset-lg-1">
          <div class="cta-content">
            <h2>Send us a <em>message</em></h2>
            <p>Ut consectetur, metus sit amet aliquet placerat, enim est ultricies ligula, sit amet dapibus odio augue eget libero. Morbi tempus mauris a nisi luctus imperdiet.</p>
            <div class="main-button">
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- ***** Call to Action End ***** -->

  <!-- ***** Testimonials Item Start ***** -->
  <section class="section" id="features">
    <div class="container">
      <div class="row">
        <div class="col-lg-6 offset-lg-3">
          <div class="section-heading">
            <h2>Read our <em>Testimonials</em></h2>
            <img src="assets/images/line-dec.png" alt="waves">
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptatem incidunt alias minima tenetur nemo necessitatibus?</p>
          </div>
        </div>
        <div class="col-lg-6">
          <ul class="features-items">
            <li class="feature-item">
              <div class="left-icon">
                <img src="assets/images/features-first-icon.png" alt="First One">
              </div>
              <div class="right-content">
                <h4>John Doe</h4>
                <p><em>"Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dicta numquam maxime voluptatibus, impedit sed! Necessitatibus repellendus sed deleniti id et!"</em></p>
              </div>
            </li>
            <li class="feature-item">
              <div class="left-icon">
                <img src="assets/images/features-first-icon.png" alt="second one">
              </div>
              <div class="right-content">
                <h4>John Doe</h4>
                <p><em>"Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dicta numquam maxime voluptatibus, impedit sed! Necessitatibus repellendus sed deleniti id et!"</em></p>
              </div>
            </li>
          </ul>
        </div>
        <div class="col-lg-6">
          <ul class="features-items">
            <li class="feature-item">
              <div class="left-icon">
                <img src="assets/images/features-first-icon.png" alt="fourth muscle">
              </div>
              <div class="right-content">
                <h4>John Doe</h4>
                <p><em>"Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dicta numquam maxime voluptatibus, impedit sed! Necessitatibus repellendus sed deleniti id et!"</em></p>
              </div>
            </li>
            <li class="feature-item">
              <div class="left-icon">
                <img src="assets/images/features-first-icon.png" alt="training fifth">
              </div>
              <div class="right-content">
                <h4>John Doe</h4>
                <p><em>"Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dicta numquam maxime voluptatibus, impedit sed! Necessitatibus repellendus sed deleniti id et!"</em></p>
              </div>
            </li>
          </ul>
        </div>
      </div>

      <br>

      <div class="main-button text-center">
        <a href="testimonials.php">Read More</a>
      </div>
    </div>
  </section>
  <!-- ***** Testimonials Item End ***** -->

  <!-- ***** Footer Start ***** -->
  <footer>
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <p>
            Copyright © 2020 Company Name
            - Template by: <a href="https://www.phpjabbers.com/">PHPJabbers.com</a>
          </p>
        </div>
      </div>
    </div>
  </footer>

  <!-- jQuery -->
  <script src="assets/js/jquery-2.1.0.min.js"></script>

  <!-- Bootstrap -->
  <script src="assets/js/popper.js"></script>
  <script src="assets/js/bootstrap.min.js"></script>

  <!-- Plugins -->
  <script src="assets/js/scrollreveal.min.js"></script>
  <script src="assets/js/waypoints.min.js"></script>
  <script src="assets/js/jquery.counterup.min.js"></script>
  <script src="assets/js/imgfix.min.js"></script>
  <script src="assets/js/mixitup.js"></script>
  <script src="assets/js/accordions.js"></script>

  <!-- Global Init -->
  <script src="assets/js/custom.js"></script>

</body>

</html>