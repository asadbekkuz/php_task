<?php

session_start();
if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['login']))
{
    require_once 'connection.php';
    $username = stripcslashes(trim($_POST['username'])); // handle username
    $password = stripcslashes(trim($_POST['password'])); // handle password
    $checkbox = $_POST['checkbox'] ?? null; // handle checkbox if checked
    $sql = "SELECT password FROM user WHERE username = :username";
    try {
        /** @var PDO $pdo */
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':username'=>$username]);
        if($stmt->rowCount() > 0)
        {   
          $password_hash = $stmt->fetch(PDO::FETCH_ASSOC)['password'];
          if(password_verify($password,$password_hash))
          {
              if (isset($_POST["checkbox"])) {
                  // If "Remember Me" is checked, set a cookie with the username for hour
                  setcookie("remembered_username", $username, time() + 3600, "/");
                  setcookie("remembered_password", $password, time() + 3600, "/");
              } else {
                  // If not checked, delete the cookie if it exists
                  setcookie("remembered_username", "", time() - 3600, "/");
                  setcookie("remembered_password", "", time() - 3600, "/");
              }
              $_SESSION['loggedin'] = true;
              header('Location: index.php');
              exit();
          }else{
              $_SESSION['username_error'] = 'username or password incorrect';
              header('Location: login.php');
              exit();
          }
        }
    }catch (Exception $exception){
        echo $exception->getMessage();
        exit();
    }
}else{
    header('Location: login.php');
    exit();
}