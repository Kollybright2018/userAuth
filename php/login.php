<?php
session_start();
if(isset($_POST['submit'])){
    $username = $_POST['email'];;
    $password = $_POST['password'];

loginUser($email, $password);

}

function loginUser($email, $password){
    /*
        Finish this function to check if username and password 
    from file match that which is passed from the form
    */
    function validate($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);

        return $data;
    }

    $email = validate($_POST['email']);
    $password = validate($_POST['password']);

    $file = fopen('../storage/users.csv', 'r');
   
    while ($users = fgetcsv($file, 1000)) {
        // print_r (fgetcsv($file));
        // check weather there is user

        
        if ($users[0]) {
            if ($email == $users[1] && $password == $users[2]) {
                // save user detail to session
                $_SESSION['username'] = $users[0];
               // redirect user to dashboard
                header('location: ../dashboard.php');
                // stop execution
                exit;
            }
            else{
                  // invalid login redirect user to login page
                header('location: ../forms/login.html');
           
            }
            
        }
    } //while

$close = fclose($file);
}

echo "HANDLE THIS PAGE";

