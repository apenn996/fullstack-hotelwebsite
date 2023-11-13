<div class="sidebar">
		<h2 class="fas">Administrator</br>Dashboard</h2>
        <ul>
			
            <li><a href="testm.php"><i class="fas fa-home"></i>Home</a></li>
            <li><a href="accountM.php"><i class="fas fa-user"></i>Account</a></li>
            
            <li><a href="viewReservationsM.php"><i class="fas fa-eye"></i>View Reservations</a></li>
            <li><a href="editReservationsM.php"><i class="fas fa-user-edit"></i>Edit and Delete Reservations</a></li>
			<?php
			if($_SESSION['ACCESS'] == "f"){
			echo '<li><a href="createRoles.php"><i class="fas fa-address-card"></i>Manage Roles</a></li>
            <li><a href="editHP.php"><i class="fas fa-concierge-bell"></i>Edit Hotel Page</a></li>
			<li><a href="notificationsM.php"><i class="fas fa-thumbtack"></i>Post Notifications</a></li>';
			}
			if($_SESSION['ACCESS'] == "p"){
			echo "<li><a href=\"notificationsEM.php\"><i class=\"fas fa-bell\"></i> View Notifications</a></li>";				
			
			}
			?>
			<!-- <li><a href="emailPageM.php"><i class="fas fa-envelope"></i>Inbox</a></li>-->
			<li><a href="#"><i class="fas fa-comments"></i>Communication Channel</a></li>
       		<li><a href="managementLogoutM.php"><i class="fas fa-sign-out-alt"></i>Logout</a></li>
			<!--<p><a href="#">Quick Logout</a></p>-->
        </ul> 
        <!--<div class="social_media">
          <a href="#"><i class="fab fa-facebook-f"></i></a>
          <a href="#"><i class="fab fa-twitter"></i></a>
          <a href="#"><i class="fab fa-instagram"></i></a>
      </div>-->
    </div>