<?php include_once 'header.php' ?>
<?php require_once 'functions.php' ?>
<style>
body, html {
  height: 100%;
}

.parallax {
  /* The image used */
  background-image: url('img/beachR.jpg');

  /* Full height */
  height: 100%; 

  /* Create the parallax scrolling effect */
  background-attachment: fixed;
  background-position: center;
  background-repeat: no-repeat;
  background-size: cover;
}
</style>
<?php 
	$db = db_iconnect("******");
	$fetch = $db->query("SELECT * FROM hotels, amenities WHERE hotels.HID=amenities.HID ") or die($db->error());
	$fetch4 = $db->query("SELECT * FROM hotels, amenities WHERE hotels.HID=amenities.HID ") or die($db->error());
    $fetch2 = $db->query("SELECT * FROM roomTypes,hotels WHERE roomTypes.HID=hotels.HID") or die($db->error());
    $fetch3 = $db->query("SELECT * FROM roomTypes,hotels WHERE roomTypes.HID=hotels.HID") or die($db->error());
     $max_price = array("1"=>"1", "2"=>"1", "3"=>"1", "4"=>"1", "5"=>"1", "6"=>"1", "7"=>"1", "8"=>"1", "9"=>"1", "10"=>"1");
     $min_price = array("1"=>"1000", "2"=>"1000", "3"=>"1000", "4"=>"1000", "5"=>"1000", "6"=>"1000", "7"=>"1000", "8"=>"1000", "9"=>"1000", "10"=>"1000");
     
    // $max_price['$i'] = $rows2['PRICE'];
    while ($rows2 = $fetch2->fetch_assoc()):
        $i = $rows2['HID'];
            if($max_price[$i] < $rows2['PRICE']){
                $max_price[$i] = $rows2['PRICE'];
            }
    endwhile;
    while ($rows3 = $fetch3->fetch_assoc()):
       
        $i = $rows3['HID'];
            if($min_price[$i] > $rows3['PRICE']){
                $min_price[$i] = $rows3['PRICE'];
            }
    endwhile;

    // foreach($min_price as $print2){
    //     print_r($print2);
    //     echo "        ";
    //  }
?>

<div class="container" >
	<?php 
		if (isset($_GET['wrongrange'])) {
			echo "<p>Range of reservation dates is invalid. Please try again.</p>";
		}
	?>
	</br>
	<h1 class="mb-5"><center>Our Renowned Hotel Buildings</center></h1>
    <div class="row" >
    <?php 
    while($myrow = $fetch4->fetch_assoc()){
          
          if(!isset($_POST['hotelName']))
          break;

        if(($myrow['NAME']) == $_POST['hotelName']){
           
           
                echo '  <h2 class="mt-5 mb-2">Interested In This Hotel? Book Now.</h2>
                <div  class="col-12" style="padding-bottom: 45px;">
   
            
                <div class="card d-flex myflex shadow mx-auto" style="min-width: 250px"; >
                <img class="card-img-left left-rounded col-lg-3 col-md-12" src="img/'. $myrow["IMG"] .'" alt="Card image cap">
                <div class="card-body col-lg-6 col-md-12" >
                   
                    <h5 class="card-title " style="max-height: 80px; "><b>'. $myrow["NAME"] .' </b></h5>
                   
                    <p class="" >'. $myrow["HOTEL_TYPE"] .'</p>
                    <h6><strong> '. $myrow["rating"] .'   </strong></h6> 
               
                    <p><b>Description:</b> '. $myrow["DESCRIPTION"] .' </p> 
                   
                <ul  style=" max-height: 150px;">
                    <li class="" style=" max-height: 150px;"> <strong>Amenities:</strong>';
                    
                    echo ($myrow["POOL"] == "y") ? "Pool. " : "";
                    echo ($myrow["GYM"] == "y") ? "Gym. " : "";
                    echo ($myrow["SPA"] == "y") ? "Spa. " : "";
                    echo ($myrow["BUS_OFFICE"] == "y") ? "Business Office." : "";
                echo '
                    
                    </li>
                    <li class="" style=" max-height: 150px;">
                    </li>
                </ul>
                


                </div>
                <div class="col-lg-4 col-md-12 d-flex flex-column justify-content-between" style="padding: 15px; "  >
                    <div class="round"style="background-color: #ececec; border: solid 1px #c8c8c8;; height: 150px; min-height:65%; width: 100%; padding: 10px; position: relative;">
                        <div class="d-flex myflex2"style="position: relative; height: 55%; ">
                        <ul  style=" max-height: 150px; list-style: square;">';
                        
                            
                           
                                 echo ($myrow["beach"] == "y") ? "<li class=\" green\" style=\" max-height: 150px;\"> &check; Direct beach access </li> " : "";
                                 echo  ($myrow["smoking"] == "y") ? "<li class=\" green\" style=\" max-height: 150px;\"> &check; Designated smoking areas </li>" : "";
                                 echo    ($myrow["cancel"] == "y") ? "<li class=\" green\" style=\" max-height: 150px;\"> &check; Free cancellation </li>" : "";
                                 echo   ($myrow["breakfast"] == "y") ? "<li class=\" green\" style=\" max-height: 150px;\"> &check; Complimentary breakfast</li> " : "";
                                 echo   ($myrow["pets"] == "y") ? "<li class=\" green\" style=\" max-height: 150px;\"> &check; Pets Allowed </li> " : "";
                                 echo   ($myrow["dayuse"] == "y") ? "<li class=\" green\" style=\" max-height: 150px;\"> &check; Sameday checkin/out </li>" : "";
                                
                            
                            echo '
                            
                        </ul>
                    </div>
                        <form style=" width: 100%; height: 45%; position: relative;   " action="buildingpage2.php" method="POST">
                            <input  type="hidden" name="hotelName" value="'. $myrow["NAME"] .'">
                            <a style=" width: 100%; height: 100%;"href="buildingpage2.php"><button type="submit" style=" position: absolute;  bottom:0px; "class="col-12 btn btn-primary">Check Out!</button></a>
                        </form>
                    </div>
                    <small>Per Night Prices*</small>
                    <div class="center justify-content-between round" style=" padding: 0px; height: 25%; width: 100%; ">
                        <div class="round  alert alert-success" style="width: 47%;height: 100%; padding: 5px;margin: 10px 0px ;">
                            <ul  style=" margin-bottom: 0px;">
                            <li class="" style=" margin-bottom: 0px; max-height: 150px;"><strong>From:</strong> </li>
                            <li class="center" style=" margin-bottom: 0px; max-height: 150px;"><h5 style=" margin-bottom: 0px;" ><strong> $ ' .$min_price[$myrow["HID"]] .' </strong></h5> 
                            </li>
                            </ul>
                        </div>
                        <div class="round   alert alert-danger" style="width: 47%; height: 100%; padding: 5px;margin: 10px 0px; ">
                            <ul  style=" margin-bottom: 0px;">
                            <li class="  " style=" margin-bottom: 0px; max-height: 150px;"><strong>To:</strong> </li>
                            <li class="center" style=" margin-bottom: 0px; max-height: 150px;"><h5 style=" margin-bottom: 0px; height: 100%; width: 100%;"><strong> $ ' .$max_price[$myrow["HID"]] .'</strong></h5> 
                            </li>
                            </ul>
                        </div>
                    </div>
                    

                </div>
            </div>
        
    </div>  ';
    echo "<h2 class='mt-5 mb-2'>Some Other Destinations You Might Love.</h2>";
    
        }
   
    }
    
    while ($rows = $fetch->fetch_assoc()):  
        if(isset($_POST['hotelName']))
        if($rows['NAME'] == $_POST['hotelName']){
            continue;
        }
        ?>
        
    <div  class="col-12" style="padding-bottom: 45px;">
       
                
                <div class="card d-flex myflex shadow mx-auto" style="min-width: 250px"; >
                <img class="card-img-left left-rounded col-lg-3 col-md-12" src="img/<?php echo $rows['IMG']; ?> " alt="Card image cap">
                <div class="card-body col-lg-6 col-md-12" >
                   
                    <h5 class="card-title " style="max-height: 80px; "><b><?php echo $rows['NAME'] ?> </b></h5>
                  
                    <p class="" ><?php echo $rows['HOTEL_TYPE']; ?></p>
                    <h6><strong> <?php echo $rows['rating']; ?>   </strong></h6> 
               
                    <p><b>Description:</b> <?php echo $rows['DESCRIPTION']; ?> </p> 
                   
                <ul  style=" max-height: 150px;">
					<li class="" style=" max-height: 150px;"> <strong>Amenities:</strong> 
                    <?php
						echo ($rows['POOL'] == 'y') ? "Pool. " : "";
						echo ($rows['GYM'] == 'y') ? "Gym. " : "";
						echo ($rows['SPA'] == 'y') ? "Spa. " : "";
						echo ($rows['BUS_OFFICE'] == 'y') ? "Business Office." : "";
					?>
					</li>
					<li class="" style=" max-height: 150px;">
					</li>
                </ul>
                


                </div>
                <div class="col-lg-4 col-md-12 d-flex flex-column justify-content-between" style="padding: 15px; "  >
                    <div class="round"style="background-color: #ececec; border: solid 1px #c8c8c8;; height: 150px; min-height:65%; width: 100%; padding: 10px; position: relative;">
                        <div class="d-flex myflex2"style="position: relative; height: 55%; ">
                        <ul  style=" max-height: 150px; list-style: square;">
                        
                            
                            <?php
                                    echo ($rows['beach'] == 'y') ? "<li class=' green' style=' max-height: 150px;'> &check; Direct beach access </li> " : "";
                                    echo ($rows['smoking'] == 'y') ? "<li class=' green' style=' max-height: 150px;'> &check; Designated smoking areas </li>" : "";
                                    echo ($rows['cancel'] == 'y') ? "<li class=' green' style=' max-height: 150px;'> &check; Free cancellation </li>" : "";
                                    echo ($rows['breakfast'] == 'y') ? "<li class=' green' style=' max-height: 150px;'> &check; Complimentary breakfast</li> " : "";
                                    echo ($rows['pets'] == 'y') ? "<li class=' green' style=' max-height: 150px;'> &check; Pets Allowed </li> " : "";
                                    echo ($rows['dayuse'] == 'y') ? "<li class=' green' style=' max-height: 150px;'> &check; Sameday checkin/out </li>" : "";
                            ?>
                            
                            
                            
                        </ul>
                    </div>
                        <form style=" width: 100%; height: 45%; position: relative;   " action="buildingpage2.php" method="POST">
                            <input  type="hidden" name="hotelName" value="<?php echo $rows['NAME'] ?>">
                            <a style=" width: 100%; height: 100%;"href="buildingpage2.php"><button type="submit" style=" position: absolute;  bottom:0px; "class="col-12 btn btn-primary">Check Out!</button></a>
                        </form>
                    </div>
                    <small>Per Night Prices*</small>
                    <div class="center justify-content-between round" style=" padding: 0px; height: 25%; width: 100%; ">
                        <div class="round  alert alert-success" style="width: 47%;height: 100%; padding: 5px;margin: 10px 0px ;">
                            <ul  style=" margin-bottom: 0px;">
                            <li class="" style=" margin-bottom: 0px; max-height: 150px;"><strong>From:</strong> </li>
                            <li class="center" style=" margin-bottom: 0px; max-height: 150px;"><h5 style=" margin-bottom: 0px;" ><strong> <?php echo '$'.$min_price[$rows['HID']]; ?> </strong></h5> 
                            </li>
                            </ul>
                        </div>
                        <div class="round   alert alert-danger" style="width: 47%; height: 100%; padding: 5px;margin: 10px 0px; ">
                            <ul  style=" margin-bottom: 0px;">
                            <li class="  " style=" margin-bottom: 0px; max-height: 150px;"><strong>To:</strong> </li>
                            <li class="center" style=" margin-bottom: 0px; max-height: 150px;"><h5 style=" margin-bottom: 0px; height: 100%; width: 100%;"><strong> <?php echo '$'.$max_price[$rows['HID']]; ?></strong></h5> 
                            </li>
                            </ul>
                        </div>
                    </div>
                    

                </div>
            </div>
        
    </div> 
    <?php endwhile; ?>
        <!-- SEPARATION -->
       
        
       
        
    </div>
</div>

<?php include_once 'footer.php' ?>