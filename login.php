<?php
  session_start();
  if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'])
  {
      header('Location: index.php');
      exit();
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Responsive Login and Signup Form </title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="./css/bootstrap.css">
</head>
<body>
<section class="container-block forms">
    <div class="form login">
        <div class="form-content">
            <header>Login</header>
            <form action="login_check.php" method="post">
                <div class="mb-3">
                    <label for="username_login_input" class="form-label">Username</label>
                    <input type="text" class="form-control <?= isset($_SESSION['username_error']) ? 'is-invalid' : '' ?>" id="username_login_input" value="<?= $_SESSION['username'] ?? null ?>" name="username">
                    <div class="invalid-feedback"><?= $_SESSION['username_error'] ?? null ?></div>
                </div>
                <label for="password_login_input" class="form-label">Password</label>
                <div class="input-group mb-3">
                    <input type="password" class="form-control <?= isset($_SESSION['password_error']) ? 'is-invalid' : '' ?>" id="password_login_input" value="<?= $_SESSION['password'] ?? null ?>" name="password">
                    <span class="input-group-text" id="password"><i class="bi bi-eye-slash"></i></span>
                    <div class="invalid-feedback"><?= $_SESSION['password_error'] ?? null  ?> </div>
                </div>
                <div class="mb-3 form-check">
                    <input type="checkbox" class="form-check-input" id="checkbox_login_input" name="checkbox">
                    <label class="form-check-label" for="checkbox_login_input">Remember me</label>
                </div>
                <button type="submit" class="btn btn-primary" name="login">Submit</button>
            </form>
            <div class="form-link mt-3">
                <span>Don't have an account? <a href="register.php" class="link signup-link">Signup</a></span>
            </div>
        </div>
    </div>
</section>
<script src="./js/script.js"></script>
</body>
</html>
<?php
session_destroy()
?>