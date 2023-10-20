<?php
session_start();
if(isset($_POST['register']))
{
     require_once 'connection.php';
     $username = $_SESSION['username'] = stripcslashes(trim($_POST['username']));
     $password = $_SESSION['password'] = $_POST['password'];
     $password_confirm =  $_POST['password_confirm'];

     $sql = "SELECT username FROM user WHERE username = :username";
    /** @var PDO $pdo */
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':username' => $username]);
    if($stmt->rowCount() > 0)
     {
         $_SESSION['username_error'] = "username {$username} is already used";
         $_SESSION['username'] = $username;
         $_SESSION['password'] = $password;
         header('Location: register.php');
         exit();
     }
     // check username length equal or more than 8, and include one letter and number
     if(!preg_match('/^(?=.*[a-zA-Z])(?=.*[0-9])[a-zA-Z0-9]{8,}$/', $username))
     {
        $_SESSION['username_error'] = 'username must contain at least 8 characters, including numbers and letters';
        header('Location: register.php');
        exit();
     }
    
    // check password length equal 8, include letter and number
    if(!preg_match('/^(?=.*[A-Z])(?=.*\d).{8,}$/', $password))
    {
        $_SESSION['password_error'] = 'password must contain at least 8 characters, including one number and uppercase letter';
        header("Location: register.php");
        exit();
    }
    
    // check password_confirm and password is equal each other
    if($password_confirm !== $password) // check confirm password match password
    {
        $_SESSION['confirm_error'] = 'Password Confirm must match with Password';
        header("Location: register.php");
        exit();
    }
    
    $password_hash =  password_hash($password,PASSWORD_DEFAULT);


    $sql = 'INSERT INTO user(username,password,password_real) VALUES(:username,:password,:password_real)';
    /** @var PDO $pdo */
    $stmt = $pdo->prepare($sql);
    $isSaved = $stmt->execute([
        ':username' => $username,
        ':password' => $password_hash,
        ':password_real' => $password,
    ]);

    if($isSaved)
    {
        $_SESSION['username'] = $username;
        $_SESSION['password'] = $password;
        header('Location: login.php');
        exit();
    }
    
}
header('Location: register.php');
exit();
