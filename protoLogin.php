<?php include_once 'header.php' ?>

<?php require_once 'protoProcess.php'; ?>
 
<?php 

        if (isset($_GET['status'])) {
            echo "";
        }

        if (isset($_GET['please'])) {
            echo "<div class=\"alert alert-warning\" role=\"alert\">
            You must log in to reserve a room. 
          </div>";
        }

		if (isset($_GET['registered'])) {
			echo "<div class='alert alert-success' role='alert'>User successfully registered!</div>";
		}
?>

    <div class="container" style="min-height: 700px;">
        <div class="row center">
            <div class="mt-5 mb-5 col-sm-6">
                <div class="card">
                    <article class="card-body">
                        <h4 class="card-title text-center mb-4 mt-1">Log In</h4>
                        <hr>
                        
                        <?php
                            if (isset($_GET['status'])) {
                                echo "<p><span style='color: red;'>The username or password you entered was not correct.  <span></p>";
                            }
                            if (!isset($_GET['status'])) {
                                echo "<p class=\"text-success text-center\">Log in to view and modify your reservations.</p>";
                            }

                        ?>
                        <form action="protoProcess" method="POST">
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"> <i class="fa fa-user"></i> </span>
                                    </div>
                                    <input name="username" class="form-control" placeholder="Enter username" type="text">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"> <i class="fa fa-lock"></i> </span>
                                    </div>
                                    <input class="form-control" placeholder="Enter password" type="password" name="password">
                                </div>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary" name="login"> Login </button>
                            </div>
                        </form>
                    </article>
                </div>
                <div class="row mt-2 d-flex col-12 justify-content-end">
            <h5 class=""><a href="protoSignUp.php">Dont have an account? Sign Up</a></h5>
        </div>
            </div>
            
           
        </div>
    </div>

<?php include_once 'footer.php' ?>