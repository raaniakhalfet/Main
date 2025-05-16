<?php
session_start();

$errors = [
    'login' => $_SESSION['login_error'] ?? '',
    'register'=>$_SESSION['register_error '] ??''
];

$activeform = $_SESSION['active_form'] ??'login';

session_unset();

function showError($error) {
    return !empty($error) ? "<p class='error-message'>$error</p>" : '';
}

function isActiveForm($formName , $activeFrom){
    return $formName === $activeFrom ? 'active' : '';
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
     
    <div class="container"></div>
    <div class="form-box active <?= isActiveForm('login', $activeform) ; ?>" id="login-form">
        <form action="projet.php" method="post">
            <h2>login</h2>
            <?= showError($errors['login']); ?>
            <input type="email" name="email" placeholder="Email" required>
            <input type="mdp" name="mdp" placeholder="mdp" required>
            <button type="submit" name="login">login</button>
            <p>Don't have an account ?<a href="#" onclick="showForm('register-form')">Register</a></p>
        </form>
    </div>

    <div class="form-box<?= isActiveForm('register', $activeform) ; ?>" id="register-form">
        <form action="projet.php" method="post">
            <h2>Register</h2>
             <?= showError($errors['register']); ?>
            <input type="text" name="nom" placeholder="nom" required>
            <input type="email" name="email" placeholder="Email" required>
            <input type="mdp" name="mdp" placeholder="mdp" required>

            <button type="submit" name="register">Register</button>
            <p>Already have an account ?<a href="#" onclick="showForm('login-form')">login </a></p>
        </form>
    </div>

    <script src="script.js"></script>
</body>
</html>