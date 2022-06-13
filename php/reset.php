<?php
if(isset($_POST['submit'])){

    function validate($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);

        return $data;
    }

    $email = validate($_POST['email']);
    $newpassword = validate($_POST['password']);

    resetPassword($email, $password);
}

function resetPassword($email, $newpassword){
    //open file and check if the username exist inside
    //if it does, replace the password
    $userList = array();
    // file path
    $csv_path = "../storage/users.csv";
    // get all user details from csv
    $file_res = fopen($csv_path, 'r');
    while ($users = fgetcsv($file_res, 1000)) {
        # check if line is not empty
        if (count($users) > 1) {
            // save all user list to an array {$userList}
            array_push($userList, $users);
        }
    };
    // close file stream
    fclose($file_res);

    // search for user email and replace password
    for ($i = 0; $i < count($userList); $i++) {
        # check if email match
        if ($userList[$i][1] == $email) {
            // change password
            $userList[$i][2] = $newpassword;

            echo "<pre>";
            var_dump($userList[$i]);
            echo "</pre>";

            // save modified user data int csv file
            $csv_path = "../storage/users.csv"; #csv path

            // open file stream [write data]
            $file_res = fopen($csv_path, 'w');
            // iterate modified data and save into 
            foreach ($userList as $user_data) {
                // save each data
                fputcsv($file_res, $user_data);
            }
            // close file stream
            fclose($file_res);

            // redirect user to login page after sucessfully changing password
            header('location: ../forms/login.html');
            
            // break loop
            break;
        } else {
            // if email not found
            if ($i == (count($userList) - 1)) echo "User does not exist";
        }
    }
    
}
echo "HANDLE THIS PAGE";


