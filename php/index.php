<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Athleap: Login</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@700&display=swap" rel="stylesheet">
    <link href="../bootstrap-5.1.1-dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="../fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="../assets/css/login.css" rel="stylesheet">
    <link rel="preload" as="image" href="../assets/icons/Home.svg">
    <link rel="preload" as="image" href="../assets/icons/Home selected.svg">
    <link rel="preload" as="image" href="../assets/icons/Yoga.svg">
    <link rel="preload" as="image" href="../assets/icons/Yoga selected.svg">
    <link rel="preload" as="image" href="../assets/icons/Running.svg">
    <link rel="preload" as="image" href="../assets/icons/Running selected.svg">
    <link rel="preload" as="image" href="../assets/icons/Workout.svg">
    <link rel="preload" as="image" href="../assets/icons/Workout selected.svg">
</head>

<body>
    <?php
    session_start();
    if (isset($_SESSION["email"])) {
        header("Location: home.php");
    }
    if (isset($_SESSION["registered"])) {
        unset($_SESSION["registered"]);
        echo "<script>alert('Registration Successful!')</script>";
    }
    if (isset($_SESSION["logout"])) {
        unset($_SESSION["logout"]);
        echo "<script>alert('You have been logged out successfully!')</script>";
    }
    $error_email = "";
    $error_password = "";
    if (isset($_POST["login"])) {
        $email = $_POST["email"];
        $password = $_POST["password"];
        $error = false;
        if (preg_match("{[a-zA-Z0-9_\.\+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-\.]}", $email) == 0) {
            $error_email = "Invalid input!";
            $error = true;
        } else if (!$error) {
            require '../vendor/autoload.php';
            $ATLAS_CREDENTIALS = getenv("ATLAS_CREDENTIALS");
            $connection = new MongoDB\Client($ATLAS_CREDENTIALS);
            $db = $connection->Athleap;
            $collection = $db->Users;
            $result = $collection->find(["email" => $email])->toArray();
            if (empty($result)) {
                $error_email = "No user registered with the following email.";
            } else {
                if ($result[0]["password"] == $password) {
                    $_SESSION["email"] = $email;
                    $_SESSION["name"] = $result[0]["name"];
                    header("Location: home.php");
                } else {
                    $error_password = "Incorrect password!";
                }
            }
        }
    }
    ?>
    <nav class="navbar my-navbar">
        <div class="container-fluid" style="justify-content:space-around;">
            <a class="my-brand navbar-brand" href="">LOGIN</a>
        </div>
    </nav>
    <div class="form-container my-5">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="mb-3">
                <label for="email" class="form-label">Email:</label>
                <input type="email" name="email" id="email" class="form-control" value="<?php echo (isset($_POST['email'])) ? $_POST['email'] : ""; ?>" required>
            </div>
            <?php
            if ($error_email != "") {
                echo "<p class='small invalid-input'>" . $error_email . "</p>";
            }
            ?>
            <div class="mb-3">
                <label class="form-label" for="password">Password: </label>
                <input type="password" name="password" id="password" class="form-control" required>
            </div>
            <?php
            if ($error_password != "") {
                echo "<p class='small invalid-input'>" . $error_password . "</p>";
            }
            ?>
            <div class="submission">
                <button type="submit" class="submit" name="login">Login</button>
            </div>
            <div class="register pt-2">
                <a class="register-link" href="./registerForm.php">Register Now!</a>
            </div>
        </form>
    </div>
    
    <script src="../bootstrap-5.1.1-dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>