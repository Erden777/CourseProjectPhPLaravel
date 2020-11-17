<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">


	<!-- CSS only -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
<link rel="stylesheet" type="text/css" href="assets/css/style.css">
<!-- JS, Popper.js, and jQuery -->
<script src="https://use.fontawesome.com/142431c6ed.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="/vender/js/bootstrap.min.js"></script>
	<title>Students and graduates</title>
</head>
    
<body>
	<?php 
	 session_start();
	 if(empty($_SESSION['user_id'])){
	 	header("Location:http://localhost/Midka/loginPage.php");
	 }
	 ?>
		<div class="header frontpage" style="margin-top: 30px">
			<div class="container">

            <nav class="navbar navbar-expand-lg navbar-light bg-#EFF3F8">
              <a class="navbar-brand" href="#">EMPLOYMENT.COM</a>
              <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
              </button>

              <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                  <li class="nav-item active">
                    <a class="nav-link" href="index.html">Home</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="Find%20Job.html">Find a job</a>
                  </li>
                  <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      Find an employee
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                      <a class="dropdown-item" href="#">Employment services</a>
                      <a class="dropdown-item" href="#">Career guidance</a>
                      <div class="dropdown-divider"></div>
                      <a class="dropdown-item" href="#">Analysis</a>
                    </div>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="#" tabindex="-1" aria-disabled="true">Help</a>
                  </li>
                </ul>
                <form class="form-inline my-2 my-lg-0">
                  <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                  <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                </form>
              </div>
            </nav>
          </div>
      </div>

		<br><br>
<div class="container well span6 offset-2">
	<?php
        	 
        	  $link = mysqli_connect("localhost", "root", "", "studentsgraduates");

        	  if(isset($_POST['user_name'])){
        	  	$id = $_POST['user_id'];
        	  	$name = $_POST['user_name'];
        	  	$email = $_POST['user_email'];
        	  	$password = $_POST['user_password'];
        	  	$tel = $_POST['user_tel'];
        	  	$url = $_POST['picture_Url'];
        	  	$query ="UPDATE job_seeker SET name='$name', email='$email', tel_number='$tel', password='$password' , picture_Url ='$url' WHERE id='$id'";
        	  	$result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link)); 

        	  }
        		$query = mysqli_query($link,"SELECT id,name , email, tel_number ,picture_Url, password FROM job_seeker WHERE id='".mysqli_real_escape_string($link,$_SESSION['user_id'])."' LIMIT 1");
           	 $data = mysqli_fetch_assoc($query);

        	 ?>
	<div class="row">
        <div class="col-md-2" >
		    <img width="160px" height="160px" src="<?php echo $data['picture_Url']; ?>" class="img-circle">
        </div>

        
        <div class="col-md-7">
        	
            <h3><?php echo $data['name']; ?></h3>
            <h6>Email: <?php echo $data['email']; ?> </h6>
            <h6>Tel-number: <?php echo $data['tel_number']; ?></h6>
            <h6>Old: 19 Year</h6>
           
        </div>
       
	</div>
	<div class="offset-2 col-md-3">
           <button onclick="updateUser(<?=$data['id']?>)" class='btn btn-info btn-sm' data-toggle='modal' data-target='#UpdateJobModal' type='button'>Update</button>
        </div>
</div>
<!-- Modal for Edit Companies -->
<div class="modal fade" id="UpdateJobModal" tabindex="-1" role="dialog" aria-labelledby="UpdateJobModalLable"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="UpdateModaljobLable">Edit profile</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form method="post"  id="update_form">
                <div class="form-group">
                  <input type="hidden" name="user_id" id="user_id">
                  <label for="update_name">Name</label>
                  <input type="text" class="form-control" name="user_name" id="user_name" value="<?php echo $data['name']; ?>">
                </div>
                <div class="form-group">
                  <label for="update_address">Telephone</label>
                    <input type="text" class="form-control" name="user_tel" id="user_tel" value="<?php echo $data['tel_number']; ?>">
                </div>
                <div class="form-group">
                <label for="update_password">Picture URL</label>
                <input type="text" class="form-control" name="picture_Url" id="picture_Url" value="<?php echo $data['picture_Url']; ?>">
              </div>
                
              <div class="form-group">
                <label for="update_email">Email</label>
                <input type="email" class="form-control" name="user_email" id="user_email" value="<?php echo $data['email']; ?>">
              </div>
              <div class="form-group">
                <label for="update_password">Password</label>
                <input type="password" class="form-control" name="user_password" id="user_password" value="<?php echo $data['password']; ?>">
              </div>
            <div class="modal-footer">
        <button class="btn btn-primary btn_update">Save</button>
        <button class="btn btn-danger">Close</button>
        </div>
      </form>
      </div>
    </div>
  </div>
</div>

<br>
<br>


<script type="text/javascript">
    const updateUser = (id) => {
        
        document.getElementById("user_id").value = id;
        document.getElementById("user_name").value =  document.getElementById("name_"+id).value;
        document.getElementById("user_tel").value =  document.getElementById("tel_number_"+id).value;
        document.getElementById("user_email").value =  document.getElementById("email_"+id).value;
        document.getElementById("user_password").value =  document.getElementById("password_"+id).value;
        document.getElementById("picture_Url").value =  document.getElementById("picture_Url"+id).value;
    }

    const deleteJob = (id) => {
        document.getElementById("delete_id").value = id;

    }

		</script>

		<!-- Footer -->
<footer class="page-footer font-small mdb-color pt-4" style="background-color: #474747;">
  <div class="container text-center text-md-left">
    <div class="row text-center text-md-left mt-3 pb-3">
      <div class="col-md-3 col-lg-3 col-xl-3 mx-auto mt-3">
        <h6 class="text-uppercase mb-4 font-weight-bold" style="color: white;">Emloyment of Students</h6>
        <p style="color: white;">Info about Service 
          Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
      </div>
      <hr class="w-100 clearfix d-md-none">
      <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mt-3">
        <h6 class="text-uppercase mb-4 font-weight-bold" style="color: white;">Services</h6>
        <p>
          <a href="Find%20Job.html" style="text-decoration: none">Find Job</a>
        </p>
        <p>
          <a href="#!" style="text-decoration: none">Find Worker</a>
        </p>
        <p>
          <a href="#!" style="text-decoration: none">Employment Service</a>
        </p>
        <p>
          <a href="#!" style="text-decoration: none">Analytics</a>
        </p>
      </div>
      <hr class="w-100 clearfix d-md-none">
      <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mt-3">
        <h6 class="text-uppercase mb-4 font-weight-bold" style="color: white;">Useful links</h6>
        <p>
          <a href="exx.php" style="text-decoration: none">Your Account</a>
        </p>
        <p>
          <a href="#!" style="text-decoration: none">Private agency population</a>
        </p>
        <p>
          <a href="contact%20us.html" style="text-decoration: none">About US</a>
        </p>
        <p>
          <a href="#!" style="text-decoration: none">Help</a>
        </p>
      </div>
      <hr class="w-100 clearfix d-md-none">

      <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mt-3">
        <h6 class="text-uppercase mb-4 font-weight-bold" style="color: white;">Contact</h6>
        <p style="color: white;">
          <span class="fas fa-home mr-3" style="margin-left: 0"></span>Manasa 131</p>
        <p style="color: white;">
          <span class="fas fa-envelope mr-3" style="margin-left: 0"></span>info@gmail.com</p>
        <p style="color: white;">
          <span class="fas fa-phone mr-3" style="margin-left: 0"></span>+77777777777</p>
        <p style="color: white;">
          <span class="fas fa-print mr-3" style="margin-left: 0"></span>+77088888888</p>
      </div>
    </div>
    <hr>
    <div class="row d-flex align-items-center">
      <div class="col-md-7 col-lg-8">
        <p class="text-center text-md-left" style="color: white;">©️ 2020 Copyright:
          <a href="#">
            <strong>Employment.com</strong>
            <strong>Employment.com</strong>
              
          </a>
        </p>
      </div>
    </div>
  </div>
</footer>


</body>
<!-- JS, Popper.js, and jQuery -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
    <script></script>
</html>