<?php include_once 'header.php' ?>

<?php $mysqli = new mysqli('******', '*****', '********' ,'*****') or die(mysqli_error($mysqli)); 
$fetch = $mysqli->query("SELECT * FROM buildings") or die($mysqli->error());
?>

<div class="container">
    <h1>Hotel Buildings</h1>
    <div class="row">
    <?php while ($rows = $fetch->fetch_assoc()): ?>
        <div class="col-md-4" style="padding-bottom: 50px;">
            <div class="card mx-auto" style="width: 18rem;">
                <img class="card-img-top" src="img/standardMagnolia.jpg" alt="Card image cap">
                <div class="card-body">
                    <h5 class="card-title"><?php echo $rows['hotelName'] ?></h5>
                    <p class="card-text"><?php echo $rows['description'] ?></p>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item"><strong>Includes: </strong><?php echo $rows['amenities'] ?></li>
                </ul>
                    <div class="card-body">
                    <input type="hidden">
                    <a href="protoMain.php"><button type="button" class="btn btn-primary">Check Out!</button></a>
                    </div>
            </div>
        </div>
    <?php endwhile; ?>
    </div>
</div>

<?php include_once 'footer.php' ?>