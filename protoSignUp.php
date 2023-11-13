<?php include_once 'header.php' ?>

<?php require_once 'protoProcess.php'; ?>
 
<?php 
        if (isset($_GET['status'])) {
            echo "<p>Incorrect username or password. Please try again.</p>";
        }

        if (isset($_GET['please'])) {
            echo "<p>Please log in or register to reserve a room.</p>";
        }

		if (isset($_GET['registered'])) {
			echo "<div class='alert alert-success' role='alert'>User successfully registered!</div>";
		}
?>

    <div class="container" style="min-height: 700px;">
        <div class="row center">
            
            <div class="col-sm-6 mt-5 mb-5">
                <div class="card">
                    <article class="card-body">
                        <h4 class="card-title text-center mb-4 mt-1">Register</h4>
                        <hr>
                        <p class="text-success text-center">Register to book reservations.</p>
                        <form action="protoProcess.php" method="POST">
                            <!-- Enter user name -->
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"> <i class="fa fa-user"></i> </span>
                                    </div>
                                    <input name="enter_username" class="form-control" placeholder="Enter username"
                                        type="text" required>
                                </div>
                            </div>
                            <!-- Enter email -->
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"> <i class="fa fa-user"></i> </span>
                                    </div>
                                    <input name="enter_email" class="form-control" placeholder="Enter email"
                                        type="email" required>
                                </div>
                            </div>
                            <!-- Enter password -->
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"> <i class="fa fa-lock"></i> </span>
                                    </div>
                                    <input name="enter_password" class="form-control" placeholder="Enter password"
                                        type="password" required>
                                </div>
                            </div>
                            <!-- Submit button -->
                            <div class="form-group">
                                <button type="submit" name="register" class="btn btn-primary">Register</button>
                            </div>
                        </form>
                    </article>
                </div>
                <div class="row d-flex mt-2 col-12 justify-content-end">
            <h5 class=""><a href="protoLogin.php">Already have an account? Log In</a></h5>
        </div>
            </div>
           
        </div>
    </div>

<?php include_once 'footer.php' ?>