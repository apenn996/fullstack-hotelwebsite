<!DOCTYPE html>
<html>
<head>
<title>Group 12 Hotel Site</title>
<script src="https://code.jquery.com/jquery-latest.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script> 
<script  type ="text/javascript" src="popup.js" ></script>
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.8/css/all.css">
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Untitled</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
<link rel="stylesheet" href="assets/css/style.css">
<link rel="stylesheet" type="text/css" href="assets/css/custom.css"/>
</head>

<body>
<div class= "container-fluid">
  <nav class="navbar navbar-expand-lg">
    <ul class="navbar-nav ml-3 mr-auto">
      <li class="nav-item"><a class="navbar-brand" href="protoMain.php">Group 12 Hotel Site</a></li>
    </ul>
    <ul class="navbar-nav px-4">
      <li class="nav-item"><a class="nav-link" href="">About Us </a></li>
      <li class="nav-item"><a class="nav-link" href="">Hotel Buildings </a></li>
      <?php
      if ( isset( $_SESSION[ 'loginName' ] ) ) {
        echo "<li class='nav-item'><a class='nav-link' href='profile.php'>" . $_SESSION[ 'loginName' ] . " (profile)</a></li>";
        echo "<li class='nav-item'><a class='nav-link login' href='logout.php'>Log Out</a></li>";
      } else {
        echo "<li class='nav-item'><a class='nav-link' href='protoLogin.php'>Sign Up</a></li>";
        echo "<li class='nav-item'><a class='nav-link login' href='protoLogin.php'>Log In</a></li>";
      }
      ?>
      <!-- <li class="nav-item"><a class="nav-link" href="">Sign Up</a></li>
            <li class="nav-item"><a class="nav-link login" href="">Log In</a></li> -->
    </ul>
  </nav>
</div>
</br>
</br>
</br>
<div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
  <ol class="carousel-indicators">
    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
  </ol>
  <div class="carousel-inner">
    <div class="carousel-item active"> <img class="d-block w-100" src="img/hotel1.jpg" alt="First slide" width=500px height=500px>
      <div class="carousel-caption d-none d-md-block">
        <h5>Welcome to Group 12 Hotel Reservation System!</h5>
        <p>Greetings!</p>
      </div>
    </div>
    <div class="carousel-item"> <img class="d-block w-100" src="img/hotel2.jpg" alt="Second slide" width=500px height=500px>
      <div class="carousel-caption d-none d-md-block">
        <h5>Welcome to Group 12 Hotel Reservation System!</h5>
        <p>Greetings!</p>
      </div>
    </div>
    <div class="carousel-item"> <img class="d-block w-100" src="img/hotel3.jpg" alt="Third slide" width=500px height=500px>
      <div class="carousel-caption d-none d-md-block">
        <h5>Welcome to Group 12 Hotel Reservation System!</h5>
        <p>Greetings!</p>
      </div>
    </div>
  </div>
  <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev"> <span class="carousel-control-prev-icon" aria-hidden="true"></span> <span class="sr-only">Previous</span> </a> <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next"> <span class="carousel-control-next-icon" aria-hidden="true"></span> <span class="sr-only">Next</span> </a> </div>
<br>
<br>

<!--form start-->

<div class= "container-fluid-form ">
	
  <div class="row">
	  
    <div class = "col align-self-start ml-auto ">
		<h1 class="ml-3">Room Filter</h1></br>
      <form class =" room-filter rcorners2">
        <label for="min-max-price">Enter your minimum and maximum spending values:</label>
        <div class="row price-range">
          <div class="col">
            <div class="form-group ml-3" id="min-max-price"> <small id="b" class="form-text text-muted">Minimum</small>
              <input type="number" class="form-control" id="minimum price" placeholder = "$0.00">
            </div>
          </div>
          <div class="col">
            <div class="form-group ml-3"> <small id="b" class="form-text text-muted">Maximum</small>
              <input type="number" class="form-control" id="maximum price" placeholder="$0.00">
			  </div>
          </div>
          
          <!--<label for="exampleInputEmail1">Enter your minimum and maximum price range</label>--> 
          
        </div>
        <small id="a" class="form-text text-muted ml-3">Enter values in dollar and cent amounts (USD)</small> </br></br>
        <label for="date-range">Enter your desired check-in and check-out dates:</label>
        <div class="row date-range">
          <div class="col">
            <div class="form-group ml-3">
              <label for="ci">Check-In:</label>
              <input type="date" id="ci" name="ci">
            </div>
          </div>
          <div class="col">
            <div class="form-group ml-3">
              <label for="co">Check-Out:</label>
              <input type="date" id="co" name="co">
            </div>
          </div>
        </div>
		<small id="a" class="form-text text-muted ml-3">Select calender icons to pick dates</small> </br></br>
		<label for="amenities">Select which amenities you wish to have in your room:</label>
		 <div class="row amenities">
          <div class="col">
            <div class="form-group ml-5">
             <input type="checkbox" class="form-check-input" id="c1">
          <label class="form-check-label" for="exampleCheck1">Balcony</label>
            </div>
			  <div class="form-group ml-5">
             <input type="checkbox" class="form-check-input" id="c2">
          <label class="form-check-label" for="exampleCheck1">Kitchen</label>
            </div>
			  <div class="form-group ml-5">
             <input type="checkbox" class="form-check-input" id="c3">
          <label class="form-check-label" for="exampleCheck1">Washer/Drier</label>
            </div>
          </div>
          <div class="col">
            <div class="form-group ml-5">
             <input type="checkbox" class="form-check-input" id="c4">
          <label class="form-check-label" for="exampleCheck1">Smoking Free</label>
            </div>
			  <div class="form-group ml-5">
             <input type="checkbox" class="form-check-input" id="c5">
          <label class="form-check-label" for="exampleCheck1"> IDK</label>
            </div>
			  <div class="form-group ml-5">
             <input type="checkbox" class="form-check-input" id="c6">
          <label class="form-check-label" for="exampleCheck1">IDK</label>
            </div>
          </div>
        </div>
		
        
        <button type="submit" class="btn btn-primary btn-dark">Update Rooms</button>
      </form>
    </div>
    <div class = "col align-self-end" > 
      
      <!--THREE ROOM TYPEs GO HERE-->
      
      <div class="card mx-auto " style="width: 30rem;"> <img class="card-img-top" src="img/standard.jpg" alt="Card image cap">
        <div class="card-body ">
          <h5 class="card-title">Standard Room</h5>
          <p class="card-text">This is a filler for the standard room where the tesxt is really long to test wrapping and the width of the card ......................................................................... AEAWEAWE</p>
        </div>
        <ul class="list-group list-group-flush">
        </ul>
        <div class="card-body">
          <button type="button" class="btn btn-dark">Reserve!</button>
        </div>
      </div>
      <!-- HOTEL 1 END --> 
      <br>
      <br>
      <div class="card mx-auto" style="width: 30rem;"> <img class="card-img-top" src="img/queen.jpg" alt="Card image cap">
        <div class="card-body">
          <h5 class="card-title">Queen Room</h5>
          <p class="card-text">Flavor text</p>
        </div>
        <ul class="list-group list-group-flush">
        </ul>
        <div class="card-body">
          <button type="button" class="btn btn-primary">Reserve!</button>
        </div>
      </div>
      <!-- HOTEL 2 END --> 
      
      <br>
      <br>
      <div class="card mx-auto" style="width: 30rem;"> <img class="card-img-top" src="img/king.jpg" alt="Card image cap">
        <div class="card-body">
          <h5 class="card-title">King Room</h5>
          <p class="card-text">Flavor text</p>
        </div>
        <ul class="list-group list-group-flush">
        </ul>
        <div class="card-body">
          <button type="button" class="btn btn-primary" onclick="window.location.href='TMAS.php';">Reserve!</button>
        </div>
      </div>
      
      <!-- HOTEL 3 END --> 
      <br>
      <br>
    </div>
  </div>
</div>
</div>
</body>
<br>
<br>
<footer class="page-footer font-small blue pt-4">
  <div class="footer-dark">
    <footer>
      <div class="container">
        <div class="row">
          <div class="col-sm-6 col-md-3 item">
            <h3>Services</h3>
            <ul>
              <li><a href="#">Web design</a></li>
              <li><a href="#">Development</a></li>
              <li><a href="#">Hosting</a></li>
            </ul>
          </div>
          <div class="col-sm-6 col-md-3 item">
            <h3>About</h3>
            <ul>
              <li><a href="#">Company</a></li>
              <li><a href="#">Team</a></li>
              <li><a href="#">Careers</a></li>
            </ul>
          </div>
          <div class="col-md-6 item text">
            <h3>Company Name</h3>
            <p>Praesent sed lobortis mi. Suspendisse vel placerat ligula. Vivamus ac sem lacus. Ut vehicula rhoncus elementum. Etiam quis tristique lectus. Aliquam in arcu eget velit pulvinar dictum vel in justo.</p>
          </div>
          <div class="col item social"><a href="#"><i class="icon ion-social-facebook"></i></a><a href="#"><i class="icon ion-social-twitter"></i></a><a href="#"><i class="icon ion-social-snapchat"></i></a><a href="#"><i class="icon ion-social-instagram"></i></a></div>
        </div>
        <p class="copyright">Company Name © 2018</p>
      </div>
    </footer>
  </div>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/js/bootstrap.bundle.min.js"></script>
</footer>
</html>
