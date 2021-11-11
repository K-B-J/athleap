<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Athleap: Register</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@700&display=swap" rel="stylesheet">
    <link href="../bootstrap-5.1.1-dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="../fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="../assets/css/gymStyles.css" rel="stylesheet">
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
    $error_email = "";
    $error_phone = "";
    $error_password = "";
    $error_height = "";
    $error_weight = "";

    if (isset($_POST["save"])) {
        $email = $_POST["email"];
        $phone = $_POST["phone"];
        $password = $_POST["password"];
        $confirmPassword = $_POST["confirm-password"];
        $height = $_POST["user-height"];
        $weight = $_POST["weight"];
        $error = false;
        if (preg_match("{[a-zA-Z0-9_\.\+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-\.]}", $email) == 0) {
            $error_email = "Invalid input!";
            $error = true;
        } else if (preg_match("{\d{10}}", $phone) == 0) {
            $error_phone = "Invalid input! (Enter 10 digit phone number)";
            $error = true;
        } else if ($password != $confirmPassword) {
            $error_password = "Passwords don't match";
            $error = true;
        } else if ($height <= 0) {
            $error_height = "That can't be your height! :O";
            $error = true;
        } else if ($weight <= 0) {
            $error_weight = "That can't be your weight! :O";
            $error = true;
        } else if (!$error) {
            setcookie("email", $email);
            setcookie("phone", $phone);
            header("Location: index.php");
        }
    }
    ?>

    <nav class="navbar my-navbar">
        <div class="container-fluid" style="justify-content: unset;">
            <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar">
                <i class="hamburger fas fa-bars fa-lg"></i>
            </button>
            <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title" id="offcanvasNavbarLabel" style="color: #707070;">Today's Workout</h5>
                    <button type="button" class="btn-close text-reset shadow-none" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <hr class="sidebar-divider" style="color:#707070; margin: 6px 12px;">
                <div class="offcanvas-body">
                    <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                        <li class="nav-item">
                            <a class="nav-link" href="#" onmouseover="home_hover();" onmouseout="home_unhover();">
                                <div style="height: 40px;">
                                    <img id="homeIcon" src="../assets/icons/Home.svg" alt="Home icon" style="line-height: 40px;">
                                    <span class="sidebar-text" style="vertical-align: middle;">Home</span>
                                </div>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#" onmouseover="yoga_hover();" onmouseout="yoga_unhover();">
                                <div style="height: 40px;">
                                    <img id="yogaIcon" src="../assets/icons/Yoga.svg" alt="Yoga icon" style="line-height: 40px;">
                                    <span class="sidebar-text" style="vertical-align: middle;">Yoga</span>
                                </div>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#" onmouseover="running_hover();" onmouseout="running_unhover();">
                                <div style="height: 40px;">
                                    <img id="runningIcon" src="../assets/icons/Running.svg" alt="Home icon" style="line-height: 40px;">
                                    <span class="sidebar-text" style="vertical-align: middle;">Running</span>
                                </div>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active-link" href="#">
                                <div style="height: 40px;">
                                    <img id="workoutIcon" src="../assets/icons/Workout selected.svg" alt="Home icon" style="line-height: 40px;">
                                    <span class="sidebar-text" style="vertical-align: middle;">Workout</span>
                                </div>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <a class="my-brand navbar-brand" href="">Register</a>
        </div>
    </nav>

    <div class="form-container my-5">
        <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>">

            <div class="mb-3">
                <label for="email" class="form-label">Email:</label>
                <input type="email" name="email" id="email" class="form-control" required>
            </div>
            <?php
            if ($error_email != "") {
                echo "<p class='small invalid-input'>" . $error_email . "</p>";
            }
            ?>

            <div class="mb-3">
                <label for="phone" class="form-label">Phone number:</label>
                <input type="number" name="phone" id="phone" class="form-control" required>
            </div>
            <?php
            if ($error_phone != "") {
                echo "<p class='small invalid-input'>" . $error_phone . "</p>";
            }
            ?>

            <div class="mb-3">
                <label for="password" class="form-label">Password:</label>
                <input type="password" name="password" id="password" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="confirm-password" class="form-label">Confirm Password:</label>
                <input type="password" name="confirm-password" id="confirm-password" class="form-control" required>
            </div>
            <?php
            if ($error_password != "") {
                echo "<p class='small invalid-input'>" . $error_password . "</p>";
            }
            ?>

            <div class="mb-3">
                <label for="height" class="form-label">Height:</label>
                <div class="input-group">
                    <input type="number" name="user-height" id="user-height" class="form-control" required>
                    <span class="input-group-text" id="basic-addon2">m</span>
                </div>
            </div>
            <?php
            if ($error_height != "") {
                echo "<p class='small invalid-input'>" . $error_height . "</p>";
            }
            ?>

            <div class="mb-3">
                <label for="weight" class="form-label">Weight:</label>
                <div class="input-group">
                    <input type="number" name="weight" id="weight" class="form-control" required>
                    <span class="input-group-text" id="basic-addon2">kg</span>
                </div>
            </div>
            <?php
            if ($error_weight != "") {
                echo "<p class='small invalid-input'>" . $error_weight . "</p>";
            }
            ?>

            <div class="mb-3">
                <label for="gender" class="form-label">Select Gender:</label>
                <div class="input-group">
                    <div class="form-check me-5">
                        <input class="form-check-input" type="radio" name="gender" id="gender1" value="M" checked>
                        <label class="form-check-label" for="gender1">
                            Male
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="gender" id="gender2" value="F">
                        <label class="form-check-label" for="gender2">
                            Female
                        </label>
                    </div>
                </div>
            </div>

            <div class="submission">
                <button type="submit" class="submit" name="save">Register</button>
            </div>
        </form>
    </div>

    <script src="../bootstrap-5.1.1-dist/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/sidebarHover.js"></script>
</body>

</html>