<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<title>Registration</title>
</head>
<body>

        <?php
        require_once 'connection.php'; //подключаем скрипт 
      // Переменные с формы
     $link = mysqli_connect($host, $user, $password, $database);
    if(isset($_POST['name'])){
          
      
          $pass =htmlentities(mysqli_real_escape_string($link, $_POST['password']));
          $re_pass = htmlentities(mysqli_real_escape_string($link, $_POST['repassword']));
          $contact = htmlentities(mysqli_real_escape_string($link, $_POST['number']));
          $job = htmlentities(mysqli_real_escape_string($link, $_POST['job_type']));
         

          $name = htmlentities(mysqli_real_escape_string($link, $_POST['name']));
           $email = htmlentities(mysqli_real_escape_string($link, $_POST['email']));

              }

              if(!empty($_POST["name"])){

                $query = mysqli_query($link,"INSERT INTO job_seeker VALUES (null ,'$name','$contact','$email','$password')");
              }
           
             header("Location:http://localhost/Midka/adminPage.php");
              
    ?>

		
</html>