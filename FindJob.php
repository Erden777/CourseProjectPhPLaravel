<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="assets/css/style.css">
	<title>Find job</title>
	<!-- CSS only -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
<link rel="stylesheet" type="text/css" href="assets/css/style.css">

<!-- JS, Popper.js, and jQuery -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
</head>
<body>
		<div class="header frontpage" style="margin-top: 30px">
			<div class="container">

            <nav class="navbar navbar-expand-lg navbar-light bg-#EFF3F8">
              <a class="navbar-brand" href="#">EMPLOYMENT.COM</a>
              <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
              </button>

              <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                  <li class="nav-item">
                    <a class="nav-link" href="index.html">Home</a>
                  </li>
                  <li class="nav-item active">
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
        <br>
		<div class="container-fluid" style="background-color:#474747; ">
			<div class="container">
				
				<ul class="nav nav-pills lighten-2 mx-0 mb-0 mt-0 nav-fill">

				  <li class="nav-item">
				    <a class="nav-link py-4 " href="#">Students and graduates</a>
				  </li>
				  <li class="nav-item">
				    <a class="nav-link py-4	" href="#">Industry Metoring Program</a>
				  </li>
				  <li class="nav-item">
				    <a class="nav-link py-4" href="#">Employers and recuriters</a>
				  </li>
				  <li class="nav-item">
				    <a class="nav-link py-4 " href="#">Unitempts</a>
				  </li>
				   <li class="nav-item">
				    <a class="nav-link py-4 " href="#">Academic staff</a>
				  </li>
				   <li class="nav-item">
				    <a class="nav-link py-4 " href="contact%20us.html">Contact us</a>
				  </li>

				</ul>
			</div>
		</div>
	</div>
    <br>
	<div class="container" style="margin-bottom: 70px">
		<div class="resoult-filter clearfix">
			<?php 
				require_once 'connection.php'; //
				$isSearch = false;
				$link = mysqli_connect($host, $user, $password, $database);
				if(isset($_GET['choose'])){
				
					$company_id = $_GET['choose'];
					$query_search = mysqli_query($link,
						"SELECT vacancy.id, vacancy.name, vacancy.requirement ,vacancy.salary, company.city , company.name 'companyName' , company.address FROM vacancy JOIN company ON vacancy.company_id = company.id WHERE company.id='$company_id'");
					$arr = mysqli_fetch_array($query_search);
					$isSearch = true;
				}else{
					$query_allVacancy = mysqli_query($link,"SELECT vacancy.id, vacancy.name, vacancy.requirement ,vacancy.salary, company.city , company.name 'companyName', company.address FROM vacancy JOIN company ON vacancy.company_id = company.id");
			        $brr = mysqli_fetch_array($query_allVacancy);
			        $size =mysqli_num_rows($query_allVacancy);
				}
			?>

			<?php 
				
				$query_jobs = mysqli_query($link,"SELECT * FROM company");
		        $companies = mysqli_fetch_array($query_jobs);
		        $rows = mysqli_num_rows($query_jobs);
		        #$row = mysqli_fetch_array($query_jobs)
		        

			?>

				<div class="row-line">
					<form class="form-inline" method="get">
						<div class="col-lg-2 text-right">Find</div>
						<div class="col-lg-3">							
							<div class="form-group">
								<input type="text" name="specialty" class="form-control" maxlength="100" placeholder="Specialty">
							</div>
						</div>

							<div class="form-group">
						
								<select name="choose">
									<?php do{?>
									<option value="<?php echo $companies['id'] ?>"><?php echo $companies['name'] ?></option>
								<?php  }while($companies = mysqli_fetch_array($query_jobs)) ?>
								</select>						
							</div>
							<div class="col-lg-2">
							<button class="btn btn-primary" type="submit">Search</button>
						</div>
						</form>
				</div>			
		</div>
        <br>
        <?php if($isSearch==true){ ?>
		<h4 class="dark mb15" style="text-align: center"><?php echo $arr['companyName']; ?>, <?php echo $arr['city']; ?>, <?php echo mysqli_num_rows($query_search); ?> Vacancy</h4>
        <br>
		<div class="result-list clearfix">
			<div class="result-list-heading">
				<div class="row">
					<div class="col-xs-4 col-sm-6">
						<span class="hidden-xs"><strong>Filter</strong></span>
						<div class="btn-group" style="padding: 10px 0 10px 0">
							
							<button class="btn btn-sm btn-default dropdown-toggle"
									data-toggle="dropdown" aria-haspopup="true" aria-expended="false">
										By conformity
							</button>

							<ul class="dropdown-menu dropdown-menu-left">
								<li class="active"><a href="#" style="color: #007bff"> By conformity </a></li>
								<li><a href="#" style="color: #007bff"> By date </a></li>	
								<li><a href="#" style="color: #007bff"> By salary </a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
			<div class="result-list-rows">
				<div class="result-list-row">
					
					<div class="row">
						<?php do{
						 ?>
						<div class="col-lg-2 col-md-2 col-sm-2 hidden-xs img-center">
							<img src="images/vacnoavatar.png">
						</div>
						<div class="col-lg-6 col-md-7 col-sm-6">
							<div class="row-heading">
								<a href="#" class="bold orange" style="text-decoration: none;"><?php echo $arr["name"]; ?></a>
							</div>
							<div class="row-info">
								<p><?php echo $arr["requirement"]; ?></p>
								<p>
									<a href="#" class="bold dark" style="text-decoration: ">
										<?php echo "Company: ",$arr["companyName"],"<br>City: ";
										 echo $arr["city"],"<br>Address: "; 
										 echo $arr["address"],"<br>Salary: ";
										 echo $arr["salary"]; ?> KZT
									</a>
								</p>
							</div>
							<div class="row-text">
								<p class="grey" style="color: darkgrey">14.09.2020</p>
							</div>

						</div>
						
						<div class="col-lg-4 col-md-3 col-sm-3">
							<ul>
								<li>
									<i class="fa fa-money"></i>
									from 80000 tg.
								</li>
								<li>
									<i class="fa fa-briefcase"></i>
									With out work experience
								</li>
								<li>
									<i class="fa fa-graduation-cap"></i>
									Higher
								</li>
								<li>
									<i class="fa fa-map-marker"></i>
									Almaty region / Ili district
								</li>
								<li>
									<i class="fa fa-clock-o"></i>
									Full time work
								</li>
							</ul>
						</div>
						<?php } while($arr =mysqli_fetch_array($query_search) ) ?>
					</div>
			</div>
			</div>
            
			<nav aria-label="...">
  				<ul class="pagination">
    				<li class="page-item disabled"><a class="page-link">Previous</a></li>
    				<li class="page-item active"><a class="page-link" href="#">1</a></li>
    				<li class="page-item"><a class="page-link" href="#">2</a></li>
    				<li class="page-item"><a class="page-link" href="#">3</a></li>
    				<li class="page-item"><a class="page-link" href="#">4</a></li>
    				<li class="page-item"><a class="page-link" href="#">5</a></li>
    				<li class="page-item"><a class="page-link" href="#">Next</a>
    				</li>
  				</ul>
			</nav>
			</div>
		<?php } else{?>

			<h4 class="dark mb15" style="text-align: center"><?php echo $size; ?> Vacancy</h4>
        <br>
		<div class="result-list clearfix">
			<div class="result-list-heading">
				<div class="row">
					<div class="col-xs-4 col-sm-6">
						<span class="hidden-xs"><strong>Filter</strong></span>
						<div class="btn-group" style="padding: 10px 0 10px 0">
							
							<button class="btn btn-sm btn-default dropdown-toggle"
									data-toggle="dropdown" aria-haspopup="true" aria-expended="false">
										By conformity
							</button>

							<ul class="dropdown-menu dropdown-menu-left">
								<li class="active"><a href="#" style="color: #007bff"> By conformity </a></li>
								<li><a href="#" style="color: #007bff"> By date </a></li>	
								<li><a href="#" style="color: #007bff"> By salary </a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
			<div class="result-list-rows">
				<div class="result-list-row">
					
					<div class="row">
						<?php do{
						 ?>
						<div class="col-lg-2 col-md-2 col-sm-2 hidden-xs img-center">
							<img src="images/vacnoavatar.png">
						</div>
						<div class="col-lg-6 col-md-7 col-sm-6">
							<div class="row-heading">
								<a href="#" class="bold orange" style="text-decoration: none;"><?php echo $brr["name"]; ?></a>
							</div>
							<div class="row-info">
								<p><?php echo $brr["requirement"]; ?></p>
								<p>
									<a href="#" class="bold dark" style="text-decoration: ">
										<?php echo "Company: ",$brr["companyName"],"<br>City: ";
										 echo $brr["city"],"<br>Address: "; 
										 echo $brr["address"],"<br>Salary: ";
										 echo $brr["salary"]; ?>
									</a>
								</p>
							</div>
							<div class="row-text">
								<p class="grey" style="color: darkgrey">14.09.2020</p>
							</div>

						</div>
						
						<div class="col-lg-4 col-md-3 col-sm-3">
							<ul>
								<li>
									<i class="fa fa-money"></i>
									from 80000 tg.
								</li>
								<li>
									<i class="fa fa-briefcase"></i>
									With out work experience
								</li>
								<li>
									<i class="fa fa-graduation-cap"></i>
									Higher
								</li>
								<li>
									<i class="fa fa-map-marker"></i>
									Almaty region / Ili district
								</li>
								<li>
									<i class="fa fa-clock-o"></i>
									Full time work
								</li>
							</ul>
						</div>
						<?php } while($brr =mysqli_fetch_array($query_allVacancy) ) ?>
					</div>
			</div>
			</div>
            
			<nav aria-label="...">
  				<ul class="pagination">
    				<li class="page-item disabled"><a class="page-link">Previous</a></li>
    				<li class="page-item active"><a class="page-link" href="#">1</a></li>
    				<li class="page-item"><a class="page-link" href="#">2</a></li>
    				<li class="page-item"><a class="page-link" href="#">3</a></li>
    				<li class="page-item"><a class="page-link" href="#">4</a></li>
    				<li class="page-item"><a class="page-link" href="#">5</a></li>
    				<li class="page-item"><a class="page-link" href="#">Next</a>
    				</li>
  				</ul>
			</nav>
			</div>
		<?php }?>


		</div>
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
            <strong> Employment.com</strong>
          </a>
        </p>
      </div>
    </div>
  </div>
</footer>