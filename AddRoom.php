<?php include_once 'header.php' ?>
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
                        <h4 class="heading">Add Hotel</h4>
                        <hr>
                    </div>
                    
                    <div class="card-body">
                        <form action="code.php" method="POST" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Hotel Name</label>
                                        <input type="text" required class="form-control" name="hotelName">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Bed Size</label>
                                        <input type="number" required class="form-control" name="roomType">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Price</label>
                                        <input type="number" required class="form-control" name="price">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Amenities </label>
                                        <input type="number" required class="form-control" name="amenities">
                                    </div>
								</div>
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label class="form-label">Add Room Image</label>
                                        <input type="file" required class="form-control" name="img/standardMagnolia.jpg">
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="mb-3">
                                        <label class="form-label">Show/Hide</label> <br>
                                        <label class="switch">
                                            <input type="checkbox" name="visibility">
                                            <span class="slider round"></span>
                                        </label>
                                        <small class="help-text">Green=Shown, Red=Hidden</small>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mt-4">
                                        <button type="submit" name="AddHotelM" class="btn btn-primary btn-block float-right">Add Hotel</button>
                                    </div>
                                </div>
                            </div>
                            
                        </form>
                    </div>
                </div>
            </div>
        </div>    
    </div>
</section>
<?php include_once 'footer.php' ?>
