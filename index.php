<!DOCTYPE html>
<html>
    <head>
        <title>PHP CRUD</title>
        <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    </head>

    <body>
    
        <?php 
        header("location: protoMain.php");
        require_once 'process.php'; ?>

        <!-- <?php
            if (isset($_SESSION['message'])): ?>

        <div class="alert alert-<?php echo $_SESSION['msg-type'] ?>">

                <?php
                echo $_SESSION['message'];
                unset($_SESSION['message']);
                ?>
        </div>

        <?php endif ?> -->
        
        <div class="container">
        <?php
            $mysqli = new mysqli('localhost', 'root', '', 'crud') or die(mysqli_error($mysqli));
            $result = $mysqli->query("SELECT * FROM data") or die(mysqli_error($mysqli));

            // pre_r($result->fetch_assoc());
        ?>

        <div class="row justify-content-center">

        <table class="table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Location</th>
                    <th colspan="2">Action</th>
                </tr>
            </thead>

        <?php
            while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?php echo $row['name']; ?></td>
                <td><?php echo $row['location']; ?></td>
                <td>
                    <a href="index.php?edit=<?php echo $row['id']; ?>" class="btn btn-info">Edit</a>
                    <a href="process.php?delete=<?php echo $row['id']; ?>" class="btn btn-danger">Delete</a>
                </td>
            </tr>
            <?php endwhile; ?>
        </table>
        </div>

        <?php
            function pre_r( $array ) {
                echo '<pre>';
                print_r($array);
                echo '</pre>';
            }
        ?>

        <div class="row justify-content-center">
        <form action="process.php" method="POST">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" class="form-control" value="<?php echo $name; ?>" placeholder="Enter your name">
            </div> 

            <div class="form-group">
                <label for="location">Location</label>
                <input type="text" name="location" class="form-control" 
                value="<?php echo $location; ?>" placeholder="Enter your location">
            </div>

            <div class="form-group">
                <?php if ($update == true): ?>
                <button type="submit" name="update" class="btn btn-info">Update</button>
                <?php else: ?>
                <button type="submit" name="save" class="btn btn-primary">Save</button>
                <?php endif; ?>
            </div>

        </form>
        </div>
        </div>
    </body>


</html>

