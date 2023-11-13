<?php include_once 'header.php' ?>

<?php 
	
	if (!isset($_POST['hotelName'])) {
		header("location: protoMain.php");
	}
	if (isset($_GET['reserveFail'])) {
        echo "<p>Sorry, there are no more reservations available for that room. Please select another room.</p>";
    }
$db = db_iconnect("****");
$hotelName = $_POST['hotelName'];
$fetch = $db->query("SELECT * FROM hotels, amenities, roomTypes WHERE hotels.HID=amenities.HID AND hotels.HID=roomTypes.HID AND hotels.NAME = '$hotelName'") or die($db->error());
?>

<div class="container">
    <h1 class="mt-3 ">Welcome to <?php echo $_POST['hotelName']?></h1>



    <div class="row d-flex justify-content-center">
        <?php while ($row = $fetch->fetch_assoc()): ?>
        <div class="col-8 mb-5 mt-5 " >
        <h3 class="card-title" style="max-height: 80px; "><?php echo $row['NAME'];?> - <?php 

            switch($row['TYPE']){
                case 'k':
                    echo '(Deluxe Suite)';
                    break;
                case 'q':
                    echo '(Studio Room)';
                    break;
                case 's':
                    echo '(Standard Room)';
                    break;
            }?></h3> 

        <img class="" style="width: 100%; max-height: 400px; object-fit: fit;" src="img/<?php echo $row['RIMG']; ?>" alt="Card image cap">
        <div class="d-flex justify-content-between flex-row altsection"style="width: 100%; padding: 15px;  ">
            <div style=" width: 40%; ">
            <h5>Exclusive room specific perks:</h5>
                <?php  echo '<ul class="showdisc" style=" margin-left: 20px; height: 150px;  ">';
        
                            switch($row['TYPE']){
                                case 'k':
                                    echo '<li>  King sized bed </li>';
                                    echo '<li > Full kitchen </li>';
                                    echo '<li >  Complimentary food & drinks </li>';
                                    echo '<li > Media Center </li>';
                                    break;
                                case 'q':
                                    echo '<li> Queen sized bed </li>';
                                    echo '<li >  Coffee maker </li>';
                                    echo '<li > Refrigerator </li>';
                                    break;
                                case 's':
                                    echo '<li> Full sized bed </li>';
                                    echo '<li >   Television </li>';
                                    break;
                            }

                        echo ' </ul>';
                            ?> 
            </div>    
            <div class=" d-flex flex-column  justify-content-between "style=" width: 50%; background-color: white; border-radius: 15px; padding: 15px; ">
                    <h5><b>Available rooms: </b><?php echo $row['NUM_ROOMS']; ?></h5>
                    <h5> <b>Price:</b> <span class="green"> $<?php echo $row['PRICE']; ?> </span><small> (per night)</small></h5>
                    <?php if (isset($_SESSION['loginName'])):?>
                        <button type='submit' class='btn btn-primary' data-toggle='modal' data-target='#exampleModal'
                            name='reserve'
                            data-whatever="<?php echo "" . $row['NAME'] . " Room (" . $row['TYPE'] . ")"; ?>"
                            data-prop="<?php echo $row['RT_ID']; ?>">Reserve</button>
                    </div>
                    <?php else: ?>
                    <form action="protoProcess.php" method="POST">
                            <div class='card-body'><button type='submit' class=' col-12 btn btn-primary'
                                name='reserveNotLoggedIn'>Reserve</button></div>
                        </form>
            </div>
           <?php endif; ?>

        </div>
        
    </div>
		
		<!-- Modal Content -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
					<form action="protoProcess.php" method="POST">
                    <div class="modal-body">
                            <div class="form-group">
                                <p>Please select how long you would like to reserve this room.</p>
                            </div>
                            <div class="form-group">
                                <label for="recipient-name" class="col-form-label">Start date:</label>
                                <input type="date" class="form-control" name="startDate" required>
                            </div>
                            <div class="form-group">
                                <label for="message-text" class="col-form-label">End date:</label>
                                <input type="date" class="form-control" name="endDate" required>
                            </div>
                            <div class="form-group">
                                <p><strong>NOTE:</strong> This room will appear in your user profile. You may
                                    cancel the reservation any time.</p>
                            </div>
                    </div>
                    <div class="modal-footer">
                            <input type="hidden" name="propId" value="0" id="propIdHere">
                            <input type='hidden' value='<?php echo $_SESSION['loginName']; ?>' name='loginName'>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Exit</button>
                            <button type="submit" class="btn btn-primary" name="reserve">Reserve</button>
                        
                    </div>
					</form>
                </div>
            </div>
        </div>
		
		
		<!-- Internal JavaScript code for modals to work  -->
        <script>
		var datesForDisable = ["2021-11-14", "2021-11-15","2021-11-16", "2021-11-13"];
        $('.datepicker').datepicker({
            format: 'yyyy-mm-dd',
            weekStart: 1,
            todayHighlight: true,
            autoclose: true,
            datesDisabled: datesForDisable,
        });
		</script>
			
		<script>
        $('#exampleModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget);
            var roomName = button.data('whatever');
            var propId = button.data('prop');
            var modal = $(this);
            modal.find('.modal-title').text('Reserve ' + roomName);
            modal.find("#propIdHere").val(propId);
        });
        </script>
        <?php endwhile; ?>
    </div>
    
</div>

<?php include_once 'footer.php' ?>