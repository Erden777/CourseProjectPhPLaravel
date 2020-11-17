<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">


	<!-- CSS only -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
<link rel="stylesheet" type="text/css" href="assets/css/style.css">

<!-- CSS only -->

<!-- Font Awesome -->
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css">
<!-- Google Fonts Roboto -->
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap">
<!-- JS, Popper.js, and jQuery -->
<script src="https://use.fontawesome.com/142431c6ed.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="/vender/js/bootstrap.min.js"></script>
<meta charset="UTF-8">
	<title>Admin</title>
</head>
<body>  
  <?php 
   session_start();
   if(empty($_SESSION['user_id'])){
    header("Location:http://localhost/Midka/loginPage.php");
   }
   ?>
    <?php
      require_once 'connection.php'; //
      // Переменные с формы
    if(isset($_POST['name'])){
          $name = $_POST['name'];
          $address = $_POST['address'];
          $salary = $_POST['salary'];
          $schedule = $_POST['schedule'];
    }

    $link = mysqli_connect($host, $user, $password, $database);

        $query_users = mysqli_query($link,"SELECT * FROM job_seeker");
    
        $query_jobs = mysqli_query($link,"SELECT * FROM company");
    
        $data_u = mysqli_fetch_assoc($query_users);
        $data_j = mysqli_fetch_assoc($query_jobs);
    
        if(isset($_POST['name'])){
            
        $query = mysqli_query($link, "SELECT name FROM job WHERE name='".mysqli_real_escape_string($link, $_POST['name'])."'");
        if(mysqli_num_rows($query) > 0)
            {
                $err[] = "Уже существует в базе данных";
            }
        }
        

        // Если нет ошибок, то добавляем в БД нового пользователя
        if(empty($err))
        {

              if(!empty($_POST["name"]) && !empty($_POST["address"]) && !empty($_POST["salary"]) && !empty($_POST["schedule"])){

                $query = mysqli_query($link,"INSERT INTO job (name, address, salary, schedule) VALUES ('$name','$address','$salary','$schedule')");
              }
        }
        if(isset($_POST['update_name_job']) && isset($_POST['update_id_job'])){

            $id = $_POST['update_id'];
            $name = $_POST['update_name'];
            $address = $_POST['update_address'];
            $salary = $_POST['update_salary'];
            $schedule = $_POST['update_schedule'];


            $query ="UPDATE job SET name='$name', address='$address', salary='$salary', schedule='$schedule'  WHERE id='$id'";
            $result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link)); 
            mysqli_close($link);
        }
        if(isset($_POST['delete_id'])){
            $id = $_POST['delete_id'];
            $query ="DELETE FROM company WHERE id='$id'";
            $result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link)); 
            mysqli_close($link);
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
                  <li class="nav-item">
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
<hr class="my-4">
  <div class="container  bg-light">
    <h2 style="padding: 30px 0 0 0">All Users</h2>
    <br>
    <table class="table">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">NAME</th>
          <th scope="col">TELEPHONE</th>
          <th scope="col">E-email</th>
          <th scope="col">Details</th>
        </tr>
      </thead>
            <?php
                do{ 
                    echo "<tr>";
                    echo "<td>".$data_u['id'].'</td>';
                    echo "<td>".$data_u['name']."</td>";
                    echo "<td>".$data_u['tel_number']."</td>";
                    echo "<td>".$data_u['email']."</td>";
                    echo "<td><button class='btn btn-info'>Details</button></td>";
                    echo "</tr>";
                }
                while ($data_u = mysqli_fetch_assoc($query_users));
            ?>
    </table>

  </div>

<hr class="my-4">  

<div class="container  bg-light">
   <!--- <h2 style="padding: 30px 0 0 0">Job List</h2>
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#basicExampleModal" style="margin: 15px 0">
  Add new
</button>-->


    <br>
</div>
<!-- Button trigger modal -->
    
<!-- Modal -->
<div class="modal fade" id="basicExampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add New job</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form method="post" action="">
                <div class="form-group">
                  <label>Name</label>
                  <input type="text" class="form-control" name="name">
                </div>
                <div class="form-group">
                  <label>Address</label>
                    <input type="text" class="form-control" name="address">
                </div>
              <div class="form-group">
                <label>Salary</label>
                <input type="number" class="form-control" name="salary">
              </div>
              <div class="form-group">
                <label>Working hours</label>
                    <select name="schedule" class="form-control">
                      <option>Full Day</option>
                      <option>Shift Schedule</option>
                      <option>Flexible schedule</option>
                      <option>Remote work</option>
                    </select>
              </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

        <button type="submit" class="btn btn-primary">Create job</button>
        </div>
      </form>
      </div>
    </div>
  </div>
</div>



<?php
require_once 'connection.php'; // подключаем скрипт
 
// подключаемся к серверу
$link = mysqli_connect($host, $user, $password, $database) 
    or die("Ошибка " . mysqli_error($link));
 
// выполняем операции с базой данных
if(!empty($_POST["company_name"]) && !empty($_POST["address_company"]) && !empty($_POST["city"]) && !empty($_POST["email"]) && !empty($_POST["password"])){
              $name_company = $_POST['company_name'];

                $address_company = $_POST['address_company'];
                $city = $_POST['city'];
                $email = $_POST['email'];
                $password = $_POST['password'];
    $query = mysqli_query($link,"INSERT INTO company (id,name, address, city, email, password) VALUES (null,'$name_company','$address_company','$city','$email','$password')");
  }


           

if(!empty($_POST["vc_name"]) && !empty($_POST["vc_req"])){
            $vc_name = $_POST['vc_name'];
            $vc_req = $_POST['vc_req'];
            $cp_id = $_POST['cp_id'];
            $vc_salary = $_POST['vc_salary'];
    $query_vacancy = mysqli_query($link,"INSERT INTO vacancy (name, requirement, company_id , salary) VALUES ('$vc_name','$vc_req', '$cp_id' , '$vc_salary')");
  }

$query_vacancies = mysqli_query($link,"SELECT * FROM vacancy");

$data_v = mysqli_fetch_all($query_vacancies);



if(isset($_POST['update_name']) && isset($_POST['update_id'])){
    
    $id = $_POST['update_id'];
     echo $id;
    $name = $_POST['update_name'];
       
    $address = $_POST['update_address'];
    $city = $_POST['update_city'];
    $email = $_POST['update_email'];
    $password = $_POST['update_password'];


    $query ="UPDATE company SET name='$name', address='$address', city='$city', email='$email', password='$password'  WHERE id='$id'";
    $result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link)); 
}
$query_companies = mysqli_query($link,"SELECT * FROM company");
$data_c = mysqli_fetch_all($query_companies);
//$result = mysqli_query($link, $query_users) or die("Ошибка " . mysqli_error($link)); 
//if($result)
//{
//    echo "Выполнение запроса прошло успешно";
//    echo $result;
//}
 
// закрываем подключение
mysqli_close($link);
?>
<div class="container  bg-light">
  <div class="col-md-12 align-items-center">
    <h2>Vacancy</h2>
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#basicExampleModal2">
  Add new
</button>
    </div>
    <br>
    <table class="table ">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Name</th>
      <th scope="col">Requirements</th>
      <th scope="col">Company ID</th>
    </tr>
  </thead>

  <tbody>
  <?php
        foreach ($data_v as $vacancy) {
                ?>
        <tr>
            <td id="id_<?=vacancy[0]?>"> <?=$vacancy[0]?></td>
            <td id="name_<?=vacancy[0]?>"> <?=$vacancy[2]?></td>
            <td id="req_<?=vacancy[0]?>"> <?=$vacancy[1]?></td>
            <td id="cp_id_<?=vacancy[0]?>"> <?=$vacancy[3]?></td>
            <td>
                <button onclick="updateJob(<?=$company[0]?>)" class='btn btn-info btn-sm' data-toggle='modal' data-target='#UpdateJobModal' type='button'>Update</button>
                <button onclick="deleteJob(<?=$company[0]?>)" class='btn btn-danger btn-sm' data-toggle='modal' data-target='#deleteJobModal' type='button'>Delete</button>
            </td>
            
        </tr>
            <?php } ?>
  </tbody>
</table>
</div>

<div class="container  bg-light">
  <div class="col-md-12 align-items-center">
    <h2>Companies</h2>
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#basicExampleModal1">
  Add new
</button>
    </div>
    <br>
    <table class="table ">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Name</th>
      <th scope="col">Address</th>
      <th scope="col">City</th>
      <th scope="col">Email</th>
      <th scope="col">Operations</th>
    </tr>
  </thead>

  

  <tbody>
  <?php
        foreach ($data_c as $company) {
                ?>
        <tr>
            <td id="id_<?=company[0]?>"> <?=$company[0]?></td>
            <td id="name_<?=company[0]?>"> <?=$company[1]?></td>
            <td id="address_<?=company[0]?>"> <?=$company[2]?></td>
            <td id="city_<?=company[0]?>"> <?=$company[3]?></td>
            <td id="email_<?=company[0]?>"> <?=$company[4]?></td>
            <td>
                <button onclick="updateJob(<?=$company[0]?>)" class='btn btn-info btn-sm' data-toggle='modal' data-target='#UpdateJobModal' type='button'>Update</button>
                <button onclick="deleteJob(<?=$company[0]?>)" class='btn btn-danger btn-sm' data-toggle='modal' data-target='#deleteJobModal' type='button'>Delete</button>
            </td>
            
        </tr>



            <?php } ?>
  </tbody>
</table>
</div>
  
<!--Delete Modal -->
<div class="modal fade" id="deleteJobModal" tabindex="-1" role="dialog" aria-labelledby="UpdateJobModalLable"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body">
      <form method="post">
                <div class="form-group">
                  <input type="hidden" name="delete_id" id="delete_id">
                    <h5>Are you sure? ???</h5>
                </div>
            <div class="modal-footer">
        <button class="btn btn-danger btn_delete">Delete job</button>
        <button class="btn btn-info">Close</button>
        </div>
      </form>
      </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="basicExampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add new job</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="post" action="">
        <div class="modal-body">
            <div class="form-group">
                <label>Name</label>
                <input type="text" class="form-control" name="title">
            </div>
            <div class="form-group">
                <label>Address</label>
                <input type="text" class="form-control" name="title">
            </div>
            <div class="form-group">
            <label>Salary</label>
            <input type="text" class="form-control" name="title">
            </div>
            <div class="form-group">
            <label>Working hours</label>
            <input type="text" class="form-control" name="title">
            </div>
        </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save</button>
      </div>
      </form>
    </div>
  </div>
</div>
<hr class="my-4">

<!-- Modal for Add Companies -->
<div class="modal fade" id="basicExampleModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel1">Add new company sd</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="post">
      <div class="modal-body">
                <div class="form-group">
                  <label>Name</label>
                  <input type="text" class="form-control" name="company_name">
                </div>
                <div class="form-group">
                  <label>Address</label>
                    <input type="text" class="form-control" name="address_company">
                </div>
              <div class="form-group">
                <label>City</label>
                <input type="text" class="form-control" name="city">
              </div>
              <div class="form-group">
                <label>Email</label>
                <input type="email" class="form-control" name="email">
              </div>
              <div class="form-group">
                <label>Password</label>
                <input type="password" class="form-control" name="password">
              </div>
            </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Add</button>
      </div>
    </form>
    </div>
  </div>
</div>
<hr class="my-4">

<!-- Modal for Add new Vacancy -->
<div class="modal fade" id="basicExampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel2" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel2">Add new Vacancy</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="post" action="">
        <div class="modal-body">
            <div class="form-group">
                <label>Name</label>
                <input type="text" class="form-control" name="vc_name">
            </div>
            <div class="form-group">
                <label>Requirements</label>
                <input type="text" class="form-control" name="vc_req">
            </div>
            <div class="form-group">
                <label>Salary</label>
                <input type="number" class="form-control" name="vc_salary">
            </div>
            <div class="form-group">
            <label>Company id</label>
            <input type="number" class="form-control" name="cp_id">
            </div>
          </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Add</button>
      </div>
      </form>
    </div>
  </div>
</div>
<hr class="my-4">

<!-- Modal for Edit Companies -->
<div class="modal fade" id="UpdateJobModal" tabindex="-1" role="dialog" aria-labelledby="UpdateJobModalLable"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="UpdateModaljobLable">Update Company ost</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form method="post"  id="update_form" action="/Midka/adminPage.php">
                <div class="form-group">
                  <input type="hidden" name="update_id" id="update_id">
                  <label for="update_name">Name</label>
                  <input type="text" class="form-control" name="update_name" id="update_name">
                </div>
                <div class="form-group">
                  <label for="update_address">Address</label>
                    <input type="text" class="form-control" name="update_address" id="update_address">
                </div>
                <div class="form-group">
                  <label for="update_city">City</label>
                    <input type="text" class="form-control" name="update_city" id="update_city">
                </div>
              <div class="form-group">
                <label for="update_email">Email</label>
                <input type="email" class="form-control" name="update_email" id="update_email">
              </div>
              <div class="form-group">
                <label for="update_password">Password</label>
                <input type="password" class="form-control" name="update_password" id="update_password">
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

<script src="assets/ajax.js"></script>
</body>
<!-- JS, Popper.js, and jQuery -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>    
<script type="text/javascript">
    const updateJob = (id) => {
        
        document.getElementById("update_id").value = id;
        document.getElementById("update_name").value =  document.getElementById("name_"+id).value;
        document.getElementById("update_address").value =  document.getElementById("address_"+id).value;
        document.getElementById("update_city").value =  document.getElementById("city_"+id).value;
        document.getElementById("update_email").value =  document.getElementById("email_"+id).value;
        document.getElementById("update_password").value =  document.getElementById("password_"+id).value;
    }
    const deleteJob = (id) => {
        document.getElementById("delete_id").value = id;

    }
</script>
</script>
</html>