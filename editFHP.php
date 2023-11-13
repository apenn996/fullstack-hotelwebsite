<?php include_once 'header.php' ?>
<?php
	
ini_set( 'display_errors', 1 );
ini_set( 'display_startup_errors', 1 );
error_reporting( E_ALL );

?>

<?php ?>
<script src="https://kit.fontawesome.com/b99e675b6e.js"></script>
<div class="wrapper">
<?php require_once 'sideNavbarM.php'; ?>

<div class="main_content">
<div id="blue-header"></div>
<section class="section">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="pl-3 pt-3">
                        <h4 class="heading">Edit Hotel Detail</h4>
                        <hr>
                    </div>
                    <div class="card-body">
                        <?php 
                        if(isset($_GET['propID']))
                        {
                            $editid = $_GET['propID'];
                            $editdata_query = "SELECT * FROM editHp WHERE propID='$editid'"; 
                            $editdata_run = mysqli_query($con, $editdata_query);
                            $data = mysqli_fetch_array($editdata_run);
                            if(mysqli_num_rows($editdata_run) > 0)
                            {
                        ?>
                                <form action="mgmtprotoProcess.php" method="POST" enctype="multipart/form-data">
                                    <input type="hidden" name="propID" value="<?= $data['propID']; ?>" />

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label">Hotel Name</label>
                                                <input type="text" class="form-control" value="<?= $data['hotelName']; ?>" name="hotelName">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label">Bed Size</label>
                                                <input type="number" class="form-control" value="<?= $data['roomType']; ?>" name="roomtype">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label">Price</label>
                                                <input type="number" class="form-control" value="<?= $data['price']; ?>" name="price">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label">Amenities </label>
                                                <input type="number" class="form-control" value="<?= $data['amenities']; ?>" name="amenities">
                                            </div>
											
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label class="form-label">Add Room Image</label>
                                                <input type="file" class="form-control" name="img/standardMagnolia.jpg">
                                                <input type="hidden" name="room_image_old" value="<?= $data['img/standardMagnolia.jpg']; ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="mb-3">
                                                <label class="form-label">Show/Hide</label> <br>
                                                <label class="switch">
                                                    <input type="checkbox" <?= $data['status'] == '0'? '':'checked'; ?> name="availability">
                                                    <span class="slider round"></span>
                                                </label>
                                                <small class="help-text">Green=Shown, Red=Hidden</small>

                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mt-4">
                                                <button type="submit" name="editHFP" class="btn btn-primary btn-block float-right">Edit Details</button>
                                            </div>
                                        </div>
                                    </div>
                                    
                                </form>
                        <?php 
                            }
                            else
                            {
                                ?>
                                    <h1>No Record Found</h1>
                                <?php
                            }
                        }
                        else
                        {
                            ?>
                                <h1>Error: 404 Not Found</h1>
                            <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>    
    </div>
</section>



<?php include_once 'footer.php' ?>
