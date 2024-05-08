.<!DOCTYPE html>
<html>

<head>
  <title>Local Business Hub</title>
  <link rel="stylesheet" href="style.css" type="text/css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
  <script src="authButton.js"></script>
</head>

<body>

  <div class="header">

    <video autoplay loop class="back-video" muted plays-inline>
      <source src="media/soko.mp4" type="video/mp4">
    </video>

    <nav>
      <img src="media/local.jpeg" class="logo">

      <ul class="nav-links">
        <!-- <li class="btn"><a href="registration/index.php"><i class="fa fa-sign-in"></i> Sign Up</a></li>
        <li><a href=""><i class="fa fa-sign-in"></i> Login</a></li> -->

        <li><a href=""><i class="fa fa-home"></i> Home</a></li>

        <li><a href="reviews"><i class="fa fa-star"></i> Reviews</a></li>

        <li><a href=""><i class="fa fa-phone"></i> Contact</a></li>

        <li id="auth-button">
          <a href="registration/index.php"><i class="fa fa-sign-in"></i></a>
        </li>
      </ul>
    </nav>

  </div>

  <div class="content">

    <h1>Find Business</h1>

    <form>

      <input class="" type="text" placeholder="&#x270e;Search..." id="search-input">

      <button type="submit" id="submit-button">Locate Business</button>
      <div class="jobs"></div>
     

    </form>

    <div class="category-list">

      <div class="category">

        <i class="fas fa-store"></i>

        <p>Retail</p>

      </div>

      <div class="category">

        <i class="fas fa-utensils"></i>

        <p>Restaurants</p>

      </div>

      <div class="category">

        <i class="fas fa-wrench"></i>

        <p>Services</p>

      </div>

      <div class="category">

        <i class="fas fa-hotel"></i>

        <p>Hotels</p>

      </div>

      <div class="category">

        <i class="fas fa-globe"></i>

        <p>Travel</p>

      </div>

    </div>

  </div>


</body>

</html>