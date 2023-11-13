<?php include_once 'header.php'; ?>
<?php require_once 'functions.php'; ?>

<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
        if (isset($_SESSION['loginName'])) {
            echo "<div class='popup alert alert-info alert-dismissible fade show' role='alert' >
			Welcome " . $_SESSION['loginName'] . "! View your profile <a href='profile.php'>here</a>.
			
            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
            <span aria-hidden='true'>&times;</span>
          </button>
          </div>";
        }

        if (isset($_GET['status'])) {
            echo "<div class='popup alert alert-success alert-dismissible fade show' role='alert' >
			You have successfully logged out. Thank you for using our service!
			
            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
            <span aria-hidden='true'>&times;</span>
          </button>
          </div>";
        }

        if (isset($_GET['reserved'])) {
            echo "<div style='margin: 0;'class=\"alert alert-success\" role=\"alert\">
            You have successfully reserved your room!
            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
            <span aria-hidden='true'>&times;</span>
          </div>";
        }

        

		$db = db_iconnect("userlog");
		$fetch = $db->query("SELECT * FROM hotels, amenities, roomTypes WHERE hotels.HID=amenities.HID AND hotels.HID=roomTypes.HID") or die($db->error());
        $finalResults = array();
		// check input (needs to be integer and range makes sense)
		if (isset($_GET['searchPrice'])) {
			// create empty array
			$searchResults = array();
			// populate array with every room
			while($row = $fetch->fetch_assoc()) {
				$searchResults[] = $row;
			}
			
			// create another array to hold modified results
			$finalResults = array();
			foreach($searchResults as $element) {
				if ($_GET['startPrice'] <= $element['PRICE'] && $element['PRICE'] <= $_GET['endPrice']) {
					$finalResults[] = $element;
				}
			}
			
			// totally not StackOverflow solution of sorting
			// multidimensional array by price
			usort($finalResults, function($a, $b) {
				return $a['PRICE'] <=> $b['PRICE'];
			});
		}

		if (isset($_GET['searchAmenities'])) {
			// create empty array
			$searchResults = array();
			// populate array with every room
			while($row = $fetch->fetch_assoc()) {
				$searchResults[] = $row;
			}
			
			// create another array to hold modified results
			$finalResults = array();
			foreach ($searchResults as $element) {
				$counter = 0;
				if (isset($_GET['pool']) && $element['POOL'] == 'y') {
					$counter ++;
					
					if ($counter == count($_GET) - 1) {
						$finalResults[] = $element;
					}
				}
				if (isset($_GET['gym']) && $element['GYM'] == 'y') {
					$counter ++;
					
					if ($counter == count($_GET) - 1) {
						$finalResults[] = $element;
					}
				}
				if (isset($_GET['spa']) && $element['SPA'] == 'y') {
					$counter ++;
					
					if ($counter == count($_GET) - 1) {
						$finalResults[] = $element;
					}
				}
				if (isset($_GET['businessOffice']) && $element['BUS_OFFICE'] == 'y') {
					$counter ++;
					
					if ($counter == count($_GET) - 1) {
						$finalResults[] = $element;
					}
				}
			}
		}

		if (isset($_GET['searchAvail'])) {
			// create empty array
			$searchResults = array();
			// populate array with every room
			while($row = $fetch->fetch_assoc()) {
				$searchResults[] = $row;
			}
			
			// create another array to hold modified results
			$finalResults = array();
			foreach($searchResults as $element) {
				if ($element['NUM_ROOMS'] >= $_GET['availNum']) {
					$finalResults[] = $element;
				}
			}
			
			// totally not StackOverflow solution of sorting
			// multidimensional array by price
			usort($finalResults, function($a, $b) {
				return $a['NUM_ROOMS'] <=> $b['NUM_ROOMS'];
			});
		}

		if (isset($_GET['searchDate'])) {
			$beginDt = $_GET['startDate'];
			$endDt = $_GET['endDate'];
			// SELECT *
//FROM roomTypes
//LEFT JOIN reservation ON roomTypes.RT_ID=reservation.RT_ID
//ORDER BY roomTypes.RT_ID
			
			//SELECT DISTINCT roomTypes.RT_ID
//FROM roomTypes
//LEFT JOIN reservation ON roomTypes.RT_ID=reservation.RT_ID
//ORDER BY roomTypes.RT_ID
			
			//  allow duplicates?
			
			$fetchDates = $db->query("SELECT * FROM reservation, roomTypes, hotels, amenities WHERE reservation.RT_ID=roomTypes.RT_ID AND hotels.HID=roomTypes.HID AND hotels.HID=amenities.HID") or die($db->error());
			
			// create empty array
			$searchResults = array();
			// populate array with every room
			while($row = $fetchDates->fetch_assoc()) {
				$searchResults[] = $row;
			}
			
			$finalResults = array();
			
			foreach ($searchResults as $element) {
				$begin = $element['START_DT'];
				$end = $element['END_DT'];
				
//				if (empty($begin) || empty($end)) {
					//$finalResults[] = $element;
//					continue;
//				}
				
				$begin = new DateTime($begin);
				$end = new DateTime($end);
	
				for($i = $begin; $i <= $end; $i->modify('+1 day')){
					$day = $i->format("Y-m-d");
    				if (check_in_range($beginDt, $endDt, $day)) {
						break;
					}
					
					if (!check_in_range($beginDt, $endDt, $day) && $i == $end) {
						$finalResults[] = $element;
					}
				}
			}
		}

function check_in_range($start_date, $end_date, $date_from_user) {
  // Convert to timestamp
  $start_ts = strtotime($start_date);
  $end_ts = strtotime($end_date);
  $user_ts = strtotime($date_from_user);

  // Check that user date is between start & end
  return (($user_ts >= $start_ts) && ($user_ts <= $end_ts));
}
    ?>

   

<div  style="position: relative" class="hero d-flex o-h justify-content-center align-items-center">

    <div class="container" style="z-index: 2">
        <div class="row d-flex ">
            <div class="jumbotron">
                <h1 class="display-4">Start Your Adventure, </h1>
                <p class="lead">Explore our selection of world class hotels and find what you've been waiting for. 
                                </p>
                <hr class="my-4">
                <p>Sign up now to book, view, and adjust your reservations.</p>
                <a class="btn btn-primary btn-lg" href="protoSignUp.php" role="button">Sign Up</a>
            </div>
        </div>
    </div>
    <img src="assets/img/hero.JPG" style="z-index: 0; opacity: .2; position: absolute;  width: 100%; ">
</div>
<div class="container mt-5">
    <h2 >View Our Locations</h2>
    <div class="row  mb-5">
    
        <div class="col-lg-4 col-md-6 col-sm-12 hover-bounce" style="padding-bottom: 12px;">
        <form action="hotelbuildings2.php" method="POST" >
                        <input type="hidden" name="hotelName" value="The Magnolia All Suites">
                        <a href="hotelbuildings2.php"><button type="submit" class="btn btn-primary hiddenbutton ">Check Out!</button></a>
                    </form>
            
            <div class="card  shadow mx-auto" style="min-width: 250px" >
                <img class="card-img-top top-rounded" src="img/magnolia2.jpg" alt="Card image cap">
                <div class="card-body" >
                
                    <h5 class="card-title" style="max-height: 80px;">The Magnolia All Suites</h5>
                    
                    
                <ul  style=" max-height: 150px;">
					<li class="" style=" max-height: 150px;"><strong>Includes:</strong> 
					Pool
					</li>
                </ul>
                
                    <div class="" style="max-height: 70px;">
                        
                      


                    </div>
                </div>
            </div>

        </div>
        <div  class="col-lg-4 col-md-6 col-sm-12 hover-bounce" style="padding-bottom: 12px;">
        <form action="hotelbuildings2.php" method="POST">
                        <input type="hidden" name="hotelName" value="The Regency Rooms">
                        <a href="hotelbuildings2.php"><button type="submit" class="btn btn-primary hiddenbutton ">Check Out!</button></a>
                    </form>
        
            <div class="card  shadow mx-auto" style="min-width: 250px"; >
                <img class="card-img-top top-rounded" src="img/regency2.jpg" alt="Card image cap">
                <div class="card-body" >
                    <h5 class="card-title" style="max-height: 80px;">The Regency Rooms</h5>
                    
                <ul  style=" max-height: 150px;">
					<li class="" style=" max-height: 150px;"><strong>Includes:</strong> 
					Pool, Gym, Spa, Business Office
					</li>
                </ul>
                
                    <div class="" style="max-height: 70px;">
                        
                       


                    </div>
                </div>
            </div>
        
        </div> 
       
        <div  class="col-lg-4 col-md-6 col-sm-12 hover-bounce">
        <form action="hotelbuildings2.php" method="POST">
                        <input type="hidden" name="hotelName" value="Sun Palace Inn">
                        <a href="hotelbuildings2.php"><button type="submit" class="btn btn-primary hiddenbutton ">Check Out!</button></a>
                    </form>
            <div class=" card shadow mx-auto" style="min-width: 250px"; >
            
                <img class="card-img-top top-rounded" src="img/SPI.jpeg" alt="Card image cap">
                <div class="card-body" >
                    <h5 class="card-title" style="max-height: 80px;">Sun Palace Inn</h5>
                    
                <ul  style=" max-height: 150px;">
					<li class="" style=" max-height: 150px;"><strong>Includes:</strong> 
					Pool, Gym
					</li>
                </ul>
                
                    <div class="" style="max-height: 70px;">
                        
                       


                    </div>
                </div>
            </div>
        </div>

        <div class="row d-flex col-12 justify-content-end">
            <h5 class=""><a href="hotelbuildings2.php">View All Locations -></a></h5>
        </div>
    </div>
</div>
<div class="altsection">

<div class="container pt-5 pb-5 d-flex justify-content-center">

    <div class=" mb-5 mt-5 ">
    <h2 style="" >Who We Are</h2>
  <div class="row d-flex justify-content-center align-items-center" style="max-width: 100%;">
  
    <div class="col-md-6 col-sm-11 d-flex justify-content-center align-items-center" style="    overflow: hidden;">
      <img style="width: 100%; object-fit: cover;" class="" src="assets/img/team.jpg" alt="Corporate Team Picture">
    </div>
    <div class="col-md-6 col-sm-11">
      <div class="card-body">
        <h5 class="card-title">Our Mission for Excellence</h5>
        <p class="card-text">At Travelonics we strive to connect you to your ultimate vacation. Staying at one of our luxury hotels
            will elevate the experience of any trip. We offer superior service for competitive prices. Come find your home away from home, 
            and book with us today. 
        </p>
        <form class ="review-name" action="about.php" method="POST">
                            <input type="hidden" name="hotelName" value="Mag">
                            <a href="about.php"><button type="submit" class="btn btn-primary ">Learn More</button></a>
                        </form>
      </div>
    </div>
  </div>
</div>
</div>
</div>
<div class="container pt-5 pb-5">
    <div class="row mb-5 mt-5 o-h">
    <h2 style="" >What Our Critics Are Saying</h2>
        <div id="rotating-words-id" style=" width: 100%" class="">
               
               
               <div class="front-end scroller">
                   <ul class="tag-list scroller-inner">
                    <div class="" style="padding-bottom: 12px;">
            
                        <div class="card center mx-auto ws noborder" style=" min-width: 250px" >
                        <img class="circle" src="assets/img/r1.JPG" alt="Card image cap">
                            <div class=" card-body" >
                    
                                
                                <p class="min100"> "One of the best vacations I've ever had!"</p>      
                                <h5 class="card-title review-name" style="max-height: 80px;">- Jason</h5>                         
                            </div>
                        </div>

                    </div>
                    <div class="" style="padding-bottom: 12px;">
            
            <div class="card center mx-auto ws noborder" style="min-width: 250px" >
            <img class="circle " src="assets/img/r2.JPG" alt="Card image cap">
                <div class=" card-body" >
        
                    
                    <p class="min100"> "I've booked with Travelonics three times and I couldn't be happier. Their
                        locations are amazing!"</p>                     
                        <h5 class="card-title review-name" style="max-height: 80px;">- Amanda</h5>          
                </div>
            </div>

        </div>
        <div class="" style="padding-bottom: 12px;">
            
            <div class="card center mx-auto ws noborder" style="min-width: 250px" >
            <img class="circle" src="assets/img/r3.JPG" alt="Card image cap">
                <div class=" card-body" >
        
                  
                    <p class="min100"> "The Travelonics experience is fast, easy, and enjoyable. It takes all the hassle
                        out of regular hotel reservations."</p>       
                        <h5 class="card-title review-name" style="max-height: 80px;">- Harold</h5>                        
                </div>
            </div>

        </div>
        <div class="" style="padding-bottom: 12px;">
            
            <div class="card center mx-auto ws noborder" style="min-width: 250px" >
            <img class="circle" src="assets/img/r4.JPG" alt="Card image cap">
                <div class=" card-body" >
        
                    
                    <p class="min100"> "I couldn't believe how beatiful my hotel was! 
                        I will definitely be using Travelonics in the future!"</p> 
                        
                        <h5 class="card-title review-name review-name" style="max-height: 80px;">- Jennifer</h5>     
                    
                                                     
                </div>
            </div>

        </div>
        <div class="" style="padding-bottom: 12px;">
            
            <div class="card center mx-auto ws noborder" style="min-width: 250px" >
            <img class="circle" src="assets/img/r5.JPG" alt="Card image cap">
                <div class=" card-body" >
        
                   
                    <p class="min100"> "Definitely the best hotel reservations system I've ever used."</p>    
                    <h5 class="card-title review-name" style="max-height: 80px;">- Robin</h5>                           
                </div>
            </div>

        </div>
        <div class="" style="padding-bottom: 12px;">
            
            <div class="card center mx-auto ws noborder" style="min-width: 250px" >
            <img class="circle" src="assets/img/r6.JPG" alt="Card image cap">
                <div class=" card-body" >
        
                   
                    <p class="min100"> "Who else provides such great service at such a low cost? Travelonics is
                        definitely unmatched."</p>          
                        <h5 class="card-title review-name" style="max-height: 80px;">- Alyssa</h5>                     
                </div>
            </div>

        </div>
        <div class="" style="padding-bottom: 12px;">
            
            <div class="card center mx-auto ws noborder" style="min-width: 250px" >
            <img class="circle" src="assets/img/r7.JPG" alt="Card image cap">
                <div class=" card-body" >
        
                   
                    <p class="min100"> "I found a roach in my breakfast! EW!"</p>                  
                    <h5 class="card-title review-name" style="max-height: 80px;">- David</h5>             
                </div>
            </div>

        </div>
                   </ul>
               </div>
               
              
       
        </div>
    </div>
</div>
<div class="altsection">

<div class="container pt-5 pb-5 d-flex justify-content-center">

    <div class=" mb-5 mt-5 ">
    <h2 style="" >Frequently Asked Questions</h2>
  <div class="row d-flex justify-content-center align-items-center" style="max-width: 100%;">
  
    
    <div class=" min210 card col-md-6 col-sm-11">
      <div class="card-body ">
        <h5 class="card-title">What should I do if I need to cancel my reserevation?</h5>
        <p class="card-text">Simply login to your account and your reservations will be listed. 
            Click on the marked delete button and your reservation will be refunded and cleared from your account.  </p>        
       
      </div>
    </div>

    <div class=" min210 card col-md-6 col-sm-11">
      <div class="card-body">
        <h5 class="card-title">How do I get the best price on a hotel room?</h5>
        <p class="card-text">Travelonics is constantly creating new promotions and special deals to rewards our customers. 
            Check in regularly to find discounts on your favorites hotels. Prices may also vary depending on holidays and time of year.  </p>        
        
      </div>
    </div>

    <div class=" min210 card col-md-6 col-sm-11">
      <div class="card-body">
        <h5 class="card-title">Will there be another chance to get a free room from if I missed the March 5th free room giveaway? </h5>
        <p class="card-text">Unfortunately, this promotion has already passed and will not be brought back in the future.  </p>        
       
      </div>
    </div>

    <div class="min210  card col-md-6 col-sm-11">
      <div class="card-body">
        <h5 class="card-title">How can I contact customer support?</h5>
        <p class="card-text">Sorry you're on your own! </p>        
        
      </div>
    </div>
  </div>
  <div class="row d-flex col-12 justify-content-end">
            <h5 class=""><a href="help.php">Go to our help page for additional information.</a></h5>
        </div>
</div>
</div>
</div>
	<!--<div class="row">
		<div class="col-md-12">
			<h1>Search Rooms Here</h1>
		</div>
		
		<div class="col-md-12" style="text-align: center;">
		<div class="mb-3">
			<div class="row no-gutters">
    			<div class="col-md-3">
      				<button type='button' class='btn btn-primary' data-toggle='modal' data-target='#priceModal' data-whatever="Search by Price">Search by Price</button>
    			</div>
    			<div class="col-md-3">
					<button type='button' class='btn btn-primary' data-toggle='modal' data-target='#dateModal' data-whatever="Search by Date">Search by Date</button>
				</div>
				<div class="col-md-3">
					<button type='button' class='btn btn-primary' data-toggle='modal' data-target='#amenitiesModal' data-whatever="Search by Amenities">Search by Amenities</button>
				</div>
				<div class="col-md-3">
					<button type='button' class='btn btn-primary' data-toggle='modal' data-target='#availModal' data-whatever="Search by Room Availability">Search by Room Availability</button>
				</div>
			</div>
  		</div>
		</div>
	</div>-->

	<div class="row">
        <?php 
        
        foreach ($finalResults as $rows): ?>
        <div class="col-md-4" style="padding-bottom: 50px;">
            <div class="card mx-auto" style="width: 18rem;">
				<!--
				<img class="card-img-top" src="img/standardMagnolia.jpg" alt="Card image cap">
				-->
				<img class="card-img-top" src="img/<?php echo $rows['IMG']; ?>" alt="Card image cap">
                <div class="card-body">
                    <h5 class="card-title"><?php echo "" . $rows['NAME'] . " " . $rows['TYPE']; ?></h5>
                    <p class="card-text"><?php echo $rows['DESCRIPTION'] ?></p>
                </div>
				<ul class="list-group list-group-flush">
                    <li class="list-group-item">$<?php echo $rows['PRICE']?>/day</li>
                    <li class="list-group-item">Reservations Available: <?php echo $rows['NUM_ROOMS']?></li>
				</ul>
                <ul class="list-group list-group-flush">
					<li class="list-group-item"><strong>Includes:</strong> 
					<?php
						echo ($rows['POOL'] == 'y') ? "Pool. " : "";
						echo ($rows['GYM'] == 'y') ? "Gym. " : "";
						echo ($rows['SPA'] == 'y') ? "Spa. " : "";
						echo ($rows['BUS_OFFICE'] == 'y') ? "Business Office." : "";
					?>
					</li>
                </ul>
                <div class="card-body">
                    <form action="buildingpage2.php" method="POST">
                        <input type="hidden" name="hotelName" value="<?php echo $rows['NAME'] ?>">
                        <a href="buildingpage2.php"><button type="submit" class="btn btn-primary">Check Out!</button></a>
                    </form>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
        </div>
</div>

<div class="modal fade" id="priceModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
					<form action="protoMain.php" method="GET">
                    <div class="modal-body">
                            <div class="form-group">
                                <label for="recipient-name" class="col-form-label">Please input price range (lowest to high, inclusive): </label>
                                <input type="text" class="form-control" name="startPrice" required>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" name="endPrice" required>
                            </div>
                    </div>
                    <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Exit</button>
                            <button type="submit" class="btn btn-primary" name="searchPrice">Apply</button>   
                    </div>
					</form>
                </div>
            </div>
        </div>

<div class="modal fade" id="amenitiesModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
					<form action="protoMain.php" method="GET">
                    <div class="modal-body">
							<div class="form-group">
                                <p>Please select which amenities you would like to see in a room.</p>
                            </div>
                            <div class="form-group">
                                <label for="recipient-name" class="col-form-label">Pool</label>
                                <input type="checkbox" name="pool" value="Yes">
                            </div>
                            <div class="form-group">
                                <label for="recipient-name" class="col-form-label">Gym</label>
                                <input type="checkbox" name="gym" value="Yes">
                            </div>
							<div class="form-group">
                                <label for="recipient-name" class="col-form-label">Spa</label>
                                <input type="checkbox" name="spa" value="Yes">
                            </div>
							<div class="form-group">
                                <label for="recipient-name" class="col-form-label">Business Office</label>
                                <input type="checkbox" name="businessOffice" value="Yes">
                            </div>
                    </div>
                    <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Exit</button>
                            <button type="submit" class="btn btn-primary" name="searchAmenities">Apply</button>   
                    </div>
					</form>
                </div>
            </div>
        </div>

<div class="modal fade" id="availModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
					<form action="protoMain.php" method="GET">
                    <div class="modal-body">
                            <div class="form-group">
                                <label for="recipient-name" class="col-form-label">Please input the minimum number of reservations you would like to have in a room (inclusive). </label>
                                <input type="text" class="form-control" name="availNum" required>
                            </div>
                    </div>
                    <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Exit</button>
                            <button type="submit" class="btn btn-primary" name="searchAvail">Apply</button>   
                    </div>
					</form>
                </div>
            </div>
        </div>

<div class="modal fade" id="dateModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
					<form action="protoMain.php" method="GET">
                    <div class="modal-body">
							<div class="form-group">
                                <p>Please input a range of dates that you would like to reserve a room for.</p>
                            </div>
                            <div class="form-group">
                                <label for="recipient-name" class="col-form-label">Start date:</label>
                                <input type="date" class="form-control" name="startDate" required>
                            </div>
                            <div class="form-group">
								<label for="recipient-name" class="col-form-label">End date:</label>
                                <input type="date" class="form-control" name="endDate" required>
                            </div>
                    </div>
                    <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Exit</button>
                            <button type="submit" class="btn btn-primary" name="searchDate">Apply</button>   
                    </div>
					</form>
                </div>
            </div>
        </div>

<script>
        $('#priceModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget);
            var roomName = button.data('whatever');
            var modal = $(this);
            modal.find('.modal-title').text(roomName);
        });
	
		$('#amenitiesModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget);
            var roomName = button.data('whatever');
            var modal = $(this);
            modal.find('.modal-title').text(roomName);
        });
	
		$('#availModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget);
            var roomName = button.data('whatever');
            var modal = $(this);
            modal.find('.modal-title').text(roomName);
        });
	
		$('#dateModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget);
            var roomName = button.data('whatever');
            var modal = $(this);
            modal.find('.modal-title').text(roomName);
        });
</script>

<?php include_once 'footer.php' ?>