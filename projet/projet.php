<?php

session_start();
require_once 'config.php';

if (isset($_POST['register'])) {
    $nom = $_POST['nom'];
     $email= $_POST['email'];
    $password = password_hash($_POST['password'],PASSWORD_DEFAULT);

    $checkEmail = $conn->query("SELECT email FROM  adminn WHERE email = '$email'");
    if ($checkEmail->num_rows > 0) {
        $_SESSION['register_error'] = 'email is already registred!';
        $_SESSION['active_form'] = 'register';
    }
    else {
        $conn->query("INSERT INTO adminn (nom ,email , mdp) VALUES ('$nom' , '$email' , '$password')");
    }
    
    header("Location: index.php ");
    exit();
}
if (isset($_POST["login"])) {
    $email = $_POST["email"];
    $password = $_POST['password'];

    $result = $conn->query("SELECT * FROM adminn WHERE email = '$email'");
    if ($result->num_rows > 0) {
        $adminn = $result->fetch_assoc();
        if (password_verify($password, $adminn["password"])) {
            $_SESSION["name"] =$adminn ['nom'];
            $_SESSION['email'] =$adminn['email'];
             
            header("Location: admin_page.php");
            exit();
           
        }
    }
}

$_SESSION['login_error'] = 'incorrect email or password';
$_SESSION['active_form'] = 'login';
header('Location: index.php');
exit();

?>