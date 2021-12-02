<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Athleap: Edit Profile</title>
    <link rel="icon" type="image/png" href="../assets/icons/favicon-32x32.png" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@700&display=swap" rel="stylesheet">
    <link href="../bootstrap-5.1.1-dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="../fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="../assets/css/editProfile.css" rel="stylesheet">
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
    if (!isset($_SESSION["email"])) {
        header("Location: index.php");
    }
    require '../vendor/autoload.php';
    $ATLAS_CREDENTIALS = getenv("ATLAS_CREDENTIALS");
    $connection = new MongoDB\Client($ATLAS_CREDENTIALS);
    $db = $connection->Athleap;
    $collection = $db->Users;
    $email = $_SESSION["email"];
    $result = $collection->find(["email" => $email])->toArray();
    $name = $result[0]["name"];
    $phone = $result[0]["phone"];
    $dob = $result[0]["dob"];
    $gender = $result[0]["gender"];
    $height = $result[0]["height"];
    $weight = $result[0]["weight"];
    $error_height = "";
    $error_weight = "";
    $error_password = "";
    if (isset($_POST["save"])) {
        $height = $_POST["height"];
        $weight = $_POST["weight"];
        $password = $_POST["password"];
        $confirmPassword = $_POST["confirm-password"];
        $error = false;
        if ($height <= 0) {
            $error_height = "That can't be your height! :O";
            $error = true;
        }
        if ($weight <= 0) {
            $error_weight = "That can't be your weight! :O";
            $error = true;
        }
        if ((($password != "") || ($confirmPassword != "")) && ($password != $confirmPassword)) {
            $error_password = "Passwords don't match!";
            $error = true;
        }
        if (!$error) {
            $collection->updateOne(["email" => $email], ['$set' => ["height" => $height]]);
            $collection->updateOne(["email" => $email], ['$set' => ["weight" => $weight]]);
            if ($password !=""){
                $collection->updateOne(["email" => $email], ['$set' => ["password" => $password]]);
            }
            $_SESSION["updated"] = true;
            header("Location: home.php");
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
                    <h5 class="offcanvas-title" id="offcanvasNavbarLabel" style="color: #707070;">Home</h5>
                    <button type="button" class="btn-close text-reset shadow-none" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <hr class="sidebar-divider" style="color:#707070; margin: 6px 12px;">
                <div class="offcanvas-body">
                    <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                        <li class="nav-item">
                            <a class="nav-link" href="home.php" onmouseover="home_hover();" onmouseout="home_unhover();">
                                <div style="height: 40px;">
                                    <img id="homeIcon" src="../assets/icons/Home.svg" alt="Home icon" style="line-height: 40px;">
                                    <span class="sidebar-text" style="vertical-align: middle;">Home</span>
                                </div>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="yoga.php" onmouseover="yoga_hover();" onmouseout="yoga_unhover();">
                                <div style="height: 40px;">
                                    <img id="yogaIcon" src="../assets/icons/Yoga.svg" alt="Yoga icon" style="line-height: 40px;">
                                    <span class="sidebar-text" style="vertical-align: middle;">Yoga</span>
                                </div>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="running.php" onmouseover="running_hover();" onmouseout="running_unhover();">
                                <div style="height: 40px;">
                                    <img id="runningIcon" src="../assets/icons/Running.svg" alt="Running icon" style="line-height: 40px;">
                                    <span class="sidebar-text" style="vertical-align: middle;">Running</span>
                                </div>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="gym.php" onmouseover="gym_hover();" onmouseout="gym_unhover();">
                                <div style="height: 40px;">
                                    <img id="gymIcon" src="../assets/icons/Gym.svg" alt="Gym icon" style="line-height: 40px;">
                                    <span class="sidebar-text" style="vertical-align: middle;">Gym</span>
                                </div>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="shop.php" onmouseover="shop_hover();" onmouseout="shop_unhover();">
                                <div style="height: 40px;">
                                    <i id="shopIcon" class="shop-icon fas fa-lg fa-shopping-cart"></i>
                                    <span class="sidebar-text" style="vertical-align: middle;">Shop</span>
                                </div>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <a class="my-brand navbar-brand" href="">Edit Profile</a>
            <div style="flex:1;"></div>
            <div class="mr-3">
                <div class="dropdown">
                    <button style="padding-right: 36px !important;" class="my-dropdown btn dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <?php echo $_SESSION["name"]; ?>
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item" href="">Edit Profile</a>
                        <a class="dropdown-item" href="logout.php">Logout</a>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <div class="form-container my-5">
        <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>">
            <div class="mb-3">
                <label for="name" class="form-label">Name:</label>
                <input type="text" name="name" id="name" class="form-control" value="<?php echo $name; ?>" disabled required>
            </div>
            <div class="mb-3">
                <label for="phone" class="form-label">Phone number:</label>
                <input type="number" name="phone" id="phone" class="form-control" value="<?php echo $phone; ?>" disabled required>
            </div>
            <div class="mb-3">
                <label for="dob" class="form-label">Date of Birth:</label>
                <input type="text" name="dob" id="dob" class="form-control" value="<?php echo $dob; ?>" disabled required>
            </div>
            <div class="mb-3">
                <label for="gender" class="form-label">Gender:</label>
                <div class="input-group">
                    <div class="form-check me-5">
                        <input class="form-check-input" type="radio" name="gender" id="gender1" value="male" <?php echo ($gender == 'male') ? 'checked="checked"' : ''; ?> disabled>
                        <label class="form-check-label" for="gender1">
                            Male
                        </label>
                    </div>
                    <div class="form-check me-5">
                        <input class="form-check-input" type="radio" name="gender" id="gender2" value="female" <?php echo ($gender == 'female') ? 'checked="checked"' : ''; ?> disabled>
                        <label class="form-check-label" for="gender2">
                            Female
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="gender" id="gender3" value="other" <?php echo ($gender == 'other') ? 'checked="checked"' : ''; ?> disabled>
                        <label class="form-check-label" for="gender3">
                            Other
                        </label>
                    </div>
                </div>
            </div>
            <div class="mb-3">
                <label for="height" class="form-label">Height:</label>
                <div class="input-group">
                    <input type="number" name="height" id="height" class="form-control" value="<?php echo $height; ?>" required>
                    <span class="input-group-text" id="basic-addon2">cm</span>
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
                    <input type="number" name="weight" id="weight" class="form-control" value="<?php echo $weight; ?>" required>
                    <span class="input-group-text" id="basic-addon2">kg</span>
                </div>
            </div>
            <?php
            if ($error_weight != "") {
                echo "<p class='small invalid-input'>" . $error_weight . "</p>";
            }
            ?>
            <div class="my-4">
                <h6 style="color:#FA9B70">Enter new password below only if you want to change your password, else these fields below can be left empty.</h6>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">New Password:</label>
                <input type="password" name="password" id="password" class="form-control">
            </div>
            <div class="mb-3">
                <label for="confirm-password" class="form-label">Confirm New Password:</label>
                <input type="password" name="confirm-password" id="confirm-password" class="form-control">
            </div>
            <?php
            if ($error_password != "") {
                echo "<p class='small invalid-input'>" . $error_password . "</p>";
            }
            ?>
            <div class="submission">
                <button type="submit" class="submit" name="save">Save</button>
            </div>
        </form>
    </div>

    <script src="../bootstrap-5.1.1-dist/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/sidebarHover.js"></script>
</body>

</html>