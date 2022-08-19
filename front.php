<?php
// connect finctions
require_once "functions.php";
if(isset($_POST['submit'])){
    $username = $_POST['username'];
    $password = $_POST['password'];
    // test*
    //echo $username;
    //echo $password;

    // create array to save*
    $data = array(
        'username' => $username,
        'password' => $password
    );
    // test array*
    //print_r($data);

    $url = "https://afsaccess4.njit.edu/~arn2/middle.php";

    // curl*
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    $result = curl_exec($ch);
    curl_close($ch);
}
// echo $result;

$recieved_array = array();
$recieved_array = json_decode($result,true);
//echo "The Email Matched is ". $recieved_array['email_matched'].'<br>';
$email_recieved = $recieved_array['email_matched'];
//echo "The Password Matched is ". $recieved_array['password_matched'].'<br>';
$password_revieved = $recieved_array['password_matched'];
//echo "The Status is ". $recieved_array['status'].'<br>';
$status_recieved = $recieved_array['status'];

if ($status_recieved == "STUDENT"){
    // if login info is student send to student.php
    redirect('student.php');
}
if($status_recieved == "TEACHER"){
    // if login info is teacher send to teacher.php
    redirect('teacher.php');
}
if ($status_recieved == "NONE"){
    // if login info is neither create popup mssg
    echo"<h2 style='color:red;'><center>INVALID USERNAME OR PASSWORD</center></h2>";
}
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login Page</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <div class="loginbox">
        <h1>Login Here</h1>
        <form action method = "post">
            <p>Username</p>
            <input type="text" name="username" placeholder="Enter Username">
            <p>Password</p>
            <input type="password" name="password" placeholder="Enter Password">
            <input type="submit" name="submit" value="LOGIN">
        </form>
</body>

</html>