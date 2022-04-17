<?php
$username = $_POST['username'];
$password = $_POST['password'];
$gender = $_POST['gender'];
$email = $_POST['email'];
$phoneCode = $_POST['phoneCode'];
$phone = $_POST['phone']; 
if ((empty($username)) || (empty($password)) || (empty($gender)) || (empty($email)) || (empty($phoneCode)) || (empty($phone)))
{
    echo "All fields are required";
    die();
}
else{

    
    $host = "localhost";
 $dbUsername = "root";
 $dbPassword = "Mgfzd786@";
 $dbname = "project1";

 //create connection
 
 $conn = new mysqli($host,$dbUsername,$dbPassword,$dbname);

 if (mysqli_connect_error()){
     console.log(mysqli_connect_error());
     die('Connect Error('. mysqli_connect_error().')'. mysqli_connect_error());
 }else{
     $SELECT = "SELECT email from register where email = ? Limit 1";
     $INSERT = "INSERT into register (username, password, gender, email, phoneCode, phone) values(?, ?, ?, ?, ?, ?)";

     //prepare statement
     $stmt = $conn->prepare($SELECT);
     $stmt->bind_param("s", $email);
     $stmt->execute();
     $stmt->bind_result($email);
     $stmt->store_result();
     $rnum = $stmt->num_rows;

     if ($rnum==0)
     {
         $stmt->close();

         $stmt = $conn->prepare($INSERT);
         $stmt->bind_param("ssssii",$username, $password, $gender, $email, $phoneCode, $phone);
         $stmt->execute();
         echo "New record inserted succesfully";

     }
     else{
         echo "Someone already registered using this Email";
     }
     $stmt->close();
     $conn->close();
 }
}
?>