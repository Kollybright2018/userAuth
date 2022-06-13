<?php

if(isset($_POST['submit'])){
    $username = $_POST['fullname'];
    $email = $_POST['email'];
    $password = $_POST['password'];

registerUser($username, $email, $password);

}

function registerUser($username, $email, $password){
    //save data into the file
  $file = fopen('../storage/users.csv', 'r');
    $data = [$username, $email, $password];
    if ($save_data = fputcsv($file, $data)) {
     echo "User Successfully registered"."<br>";
    }else{
        echo "Unable to register user, Try again";
    }
    $close = fclose($file) ;
 
}
// echo "HANDLE THIS PAGE";


