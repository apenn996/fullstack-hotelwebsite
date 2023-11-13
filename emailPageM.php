<?php include_once 'header.php' ?>
<script src="https://kit.fontawesome.com/b99e675b6e.js"></script>
<link rel="stylesheet" href="assets/css/email.css">

<div class="wrapper">

    <?php require_once 'sideNavbarM.php' ?>
	
	
    <div class="main_content">
		 <div id="blue-header"></div>
        <div class="header">You are currently logged in as an administrator with "[]" permissions. </div>  
        <div class="info">
          <h6>Welcome Admin </br>
			
			<?php require_once 'emailM.php' ?>
			
      </div>
<?php include_once 'footer.php' ?>
    </div>
</div>