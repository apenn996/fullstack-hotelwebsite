<?php include_once 'header.php' ?>

<?php
    if(!isset($_SESSION['loginName'])) {
        header("location: protoMain.php");
    }

	if (isset($_GET['deleted'])) {
		echo '<div class="alert alert-success" role="alert">
  		Reservation successfully deleted!
		</div>';
	}

	if (isset($_GET['modifyTrue'])) {
		echo '<div class="alert alert-success" role="alert">
  		Room successfully modified!
		</div>';
	}

	if (isset($_GET['wrongrange'])) {
			echo '<div class="alert alert-warning" role="alert">
  		Range of new reservation dates is invalid. Please try again.
		</div>';
	}
?>

<div class="container">


    <h1 class="mt-3 ">Welcome <?php echo $_SESSION['loginName'] .', '; ?></h1>
    <h1 class=" mb-5">Here Are Your Reservations</h1>


    <div class="row center" style="min-height: 700px;">
        <?php 
		$db = db_iconnect("userlog");
        
        $fetch = $db->query("SELECT * FROM reservation, roomTypes, amenities, hotels WHERE roomTypes.HID=amenities.HID AND reservation.RT_ID=roomTypes.RT_ID AND roomTypes.HID=hotels.HID AND reservation.CID=" . $_SESSION['id'] . ";") or die($db->error());
        $fetch2 = $db->query("SELECT * FROM reservation, roomTypes, amenities, hotels WHERE roomTypes.HID=amenities.HID AND reservation.RT_ID=roomTypes.RT_ID AND roomTypes.HID=hotels.HID AND reservation.CID=" . $_SESSION['id'] . ";") or die($db->error());
        $reservationRows2 = $fetch2->fetch_assoc();
        if($reservationRows2==""){
            echo '<p>You currently have no reservations</p>';
           }
        

        
        ?>
        <?php while ($reservationRows = $fetch->fetch_assoc()): ?>
       
            <div class="col-md-6" style="padding-bottom: 50px; ">
            <div class="card mx-auto " style="">
                <img class="card-img-top" src="img/<?php echo $reservationRows['RIMG']; ?>" alt="Card image cap">
                <div class="card-body">
                    <h5 class="card-title"><?php echo "" . $reservationRows['NAME'] . " - "?><?php 

                switch($reservationRows['TYPE']){
                    case 'k':
                        echo '(Deluxe Suite)';
                        break;
                    case 'q':
                        echo '(Studio Room)';
                        break;
                    case 's':
                        echo '(Standard Room)';
                        break;
                }?></h5>
                 
                </div>
                <ul class="list-group list-group-flush">
                <li class="list-group-item">
                    <?php  echo '<p>Room Perks: </p><ul class="showdisc" style="  height: 150px; margin-left: 20px; text-align:left;">';
        
                            switch($reservationRows['TYPE']){
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

                        echo '</li> </ul>';
                            ?> 
					<li class="list-group-item">Reservation Date: <?php echo $reservationRows['START_DT']; ?> to <?php echo $reservationRows['END_DT']; ?></li>
					<li class="list-group-item">Total Cost: <?php echo "$" . $reservationRows['TOTAL']; ?></li>
					<li class="list-group-item d-flex flex-row justify-content-around">
                    <button type='submit' class='btn btn-warning' name='modifyRoom' data-toggle='modal' data-target='#exampleModal' data-whatever="<?php echo "" . $reservationRows['NAME'] . " Room (" . $reservationRows['TYPE'] . ")"; ?>" data-prop="<?php echo $reservationRows['RT_ID']; ?>" data-id="<?php echo $reservationRows['RES_NUM']; ?>">Modify</button>
                    <button type='submit' class='btn btn-danger' name='deleteRoom' data-toggle='modal' data-target='#exampleModal2' data-whatever2="<?php echo "" . $reservationRows['NAME'] . " Room (" . $reservationRows['TYPE'] . ")"; ?>" data-prop2="<?php echo $reservationRows['RT_ID']; ?>" data-id2="<?php echo $reservationRows['RES_NUM']; ?>">Delete</button>

						
					</li>
                </ul>
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
                                <p>Please modify how long you want to reserve this room.</p>
                            </div>
                            <div class="form-group">
                                <label for="recipient-name" class="col-form-label">New start date:</label>
                                <input type="date" class="form-control" name="newStartDate" required>
                            </div>
                            <div class="form-group">
                                <label for="message-text" class="col-form-label">New end date:</label>
                                <input type="date" class="form-control" name="newEndDate" required>
                            </div>
                    </div>
                    <div class="modal-footer">
                            <input type="hidden" name="propId" value="0" id="propIdHere">
                            <input type='hidden' value='<?php echo $_SESSION['id']; ?>' name='loginName'>
							<input type="hidden" name="reserveId" value="0" id="reserveIdHere">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Exit</button>
                            <button type="submit" class="btn btn-primary" name="modify">Modify</button>
                    </div>
					</form>
                </div>
            </div>
        </div>

		<div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                        <div class="modal-body">
                                <div class="form-group">
                                    <p>Are you sure you want to cancel this reservation?</p>
                                </div>
                                
                        </div>
                        <div class="modal-footer">
                    
                            
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Exit</button>
                            
                                
                               
					<form action="protoProcess.php" method="POST">
                                 <input type="hidden" name="reserveId" value="0" id="reserveIdHere2">
                                    <input type="hidden" name="propId" value="0" id="propIdHere2">
                                    <input type='hidden' value='<?php echo $_SESSION['id']; ?>' name='loginName'>
                                    <button type="submit" class="btn btn-primary" name="delete">Confirm</button>
                                    </form>
                               
                        </div>
					
                </div>
            </div>
        </div>
		<!-- Internal JavaScript code for modals to work  -->
        <script>
        $('#exampleModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget);
            var roomName = button.data('whatever');
            var propId = button.data('prop');
			var reserveId = button.data("id");
            var modal = $(this);
            modal.find('.modal-title').text('Modify ' + roomName);
            $("#propIdHere").val(propId);
			$("#reserveIdHere").val(reserveId);
        })
        //modal for delete 
        $('#exampleModal2').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget);
            var roomName = button.data('whatever2');
            var propId = button.data('prop2');
			var reserveId = button.data("id2");
            var modal = $(this);
            modal.find('.modal-title').text('Delete ' + roomName);
            $("#propIdHere2").val(propId);
			$("#reserveIdHere2").val(reserveId);
        })
        </script>
		
        <?php endwhile; ?>
    </div>

</div>

<?php include_once 'footer.php' ?>