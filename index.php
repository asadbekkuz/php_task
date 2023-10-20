<?php
session_start();
if (!isset($_SESSION['loggedin']) && $_SESSION['loggedin'] !== true) {
    header('Location: login.php');
    exit();
}

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Main me</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="./css/bootstrap.css">
</head>
<body>
<section class="container-block forms" style="display: flex;align-items: stretch; justify-content: space-evenly">
    <div class="form-link" style="z-index: 1000; position: absolute; right: 5px; top: 10px">
        <a href="logout.php" class="btn btn-danger">Log out</a>
    </div>
    <div class="form login" style="margin-top: 100px">
        <div class="form-content">
            <header>Word File Generate</header>
            <form action="create.php" method="post">
                <div class="mb-3">
                    <label for="name_input" class="form-label">Name</label>
                    <input type="text" class="form-control" id="name_input"  name="name" placeholder="your name">
                </div>
                <div class="mb-3">
                    <label for="surname_input" class="form-label">Surname</label>
                    <input type="text" class="form-control" id="surname_input"  name="surname" placeholder="your surname">
                </div>
                <div class="mb-3">
                    <label for="fathers_input" class="form-label">Your Father's Name</label>
                    <input type="text" class="form-control" id="fathers_input"  name="fathers_name" placeholder="your father's name">
                </div>
                <div class="mb-3">
                    <label for="dob_input" class="form-label">DOB</label>
                    <input type="text" class="form-control" id="dob_input"  name="dob" placeholder="date of birth">
                </div>

                <button type="submit" class="btn btn-outline-success" name="create">Create</button>
            </form>
        </div>
    </div>
</section>
</body>
</html>

