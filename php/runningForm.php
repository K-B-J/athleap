<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Athleap: Running Form</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@700&display=swap" rel="stylesheet">
    <link href="../bootstrap-5.1.1-dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="../fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="../assets/css/runningForm.css" rel="stylesheet">
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
    $error_distance = "";
    $error_elevation = "";
    $error_time = "";
    $error_energy = "";
    if (isset($_POST["save"])) {
        $distance = $_POST["distance"];
        $elevation = $_POST["elevation"];
        $time = $_POST["time"];
        $energy = $_POST["energy"];
        $error = false;
        if (($distance == "") || (is_float($distance)) || ((float)$distance <= 0)) {
            $error_distance = "Invalid input!";
            $error = true;
        }
        if (($elevation == "") || (is_int($elevation)) || ((int)$elevation <= 0)) {
            $error_elevation = "Invalid input!";
            $error = true;
        }
        if (($time == "") || (is_int($time)) || ((int)$time <= 0)) {
            $error_time = "Invalid input!";
            $error = true;
        }
        if (($energy == "") || (is_int($energy))) {
            $error_energy = "Invalid input!";
            $error = true;
        }
        if (!$error) {
            function calorie_calculator($age, $bmi, $distance, $elevation, $time, $energy)
            {
                if ($energy == 0) {
                    $energy += 1;
                }
                $calories = ($distance * $bmi * $elevation * 2.2) / (($age / 10) * ($time / 10) * ($energy / 10));
                return (int)floor($calories);
            }
            function fcoins_calculator($age, $calories, $previous_fcoins)
            {
                $fcoins = (int)floor($calories / $age / 4);
                if ($fcoins > $previous_fcoins) {
                    $fcoins += 1;
                }
                return $fcoins;
            }
            $distance = (float)$_POST["distance"];
            $elevation = (int)$_POST["elevation"];
            $time = (int)$_POST["time"];
            $energy = (int)$_POST["energy"];
            date_default_timezone_set("Indian/Mahe");
            $date = date("d/m/Y");
            $email = $_SESSION["email"];
            $age = $_SESSION["age"];
            $weight = $_SESSION["weight"];
            $height = $_SESSION["height"];
            $old_fcoins = $_SESSION["fcoins"];
            require '../vendor/autoload.php';
            $ATLAS_CREDENTIALS = getenv("ATLAS_CREDENTIALS");
            $connection = new MongoDB\Client($ATLAS_CREDENTIALS);
            $db = $connection->Athleap;
            // $collection = $db->Users;
            // $result = $collection->find(["email" => $email])->toArray();
            $bmi = $weight / (($height / 100) ** 2);
            $calories = calorie_calculator($age, $bmi, $distance, $elevation, $time, $energy);
            $collection = $db->Running;
            $result = $collection->find(["email" => $email])->toArray();
            $fcoins = fcoins_calculator($age, $calories, $result[sizeof($result) - 1]["fcoins"]);
            $collection = $db->Users;
            $new_fcoins = $old_fcoins + $fcoins;
            $_SESSION["fcoins"] = $new_fcoins;
            $collection->updateOne(["email" => $email], ['$set' => ["fcoins" => $new_fcoins]]);
            $_SESSION["calories"] = $calories;
            $_SESSION["excercise_fcoins"] = $fcoins;
            $collection = $db->Running;
            $collection->insertOne(["email" => $email, "date" => $date, "calories" => $calories, "fcoins" => $fcoins, "distance" => $distance, "elevation" => $elevation, "time" => $time, "energy" => $energy]);
            header("Location: afterForm.php");
        }
    }
    ?>
    <nav class="navbar my-navbar" id="navbar">
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
            <a class="my-brand navbar-brand" href="">Today's Workout</a>
            <div style="flex:1;"></div>
            <div class="mr-3">
                <div class="dropdown">
                    <button style="padding-right: 36px !important;" class="my-dropdown btn dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <?php echo $_SESSION["name"]; ?>
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item" href="logout.php">Logout</a>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <div class="form-container my-5">
        <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>">
            <div class="mb-3">
                <label for="distance" class="form-label">Total distance of the run:</label>
                <div class="input-group">
                    <input type="number" name="distance" id="distance" class="form-control" step="0.01" value="<?php echo (isset($_POST['distance'])) ? $_POST['distance'] : ""; ?>" required>
                    <span class="input-group-text" id="basic-addon2">kilometers</span>
                </div>
            </div>
            <?php
            if ($error_distance != "") {
                echo "<p class='small invalid-input'>" . $error_distance . "</p>";
            }
            ?>
            <div class="mb-3">
                <label for="elevation" class="form-label">Total elevation of the run:</label>
                <div class="input-group">
                    <input type="number" name="elevation" id="elevation" class="form-control" value="<?php echo (isset($_POST['elevation'])) ? $_POST['elevation'] : ""; ?>" required>
                    <span class="input-group-text" id="basic-addon2">meters</span>
                </div>
            </div>
            <?php
            if ($error_elevation != "") {
                echo "<p class='small invalid-input'>" . $error_elevation . "</p>";
            }
            ?>
            <div class="mb-3">
                <label for="time" class="form-label">Total time of the run:</label>
                <div class="input-group">
                    <input type="number" name="time" id="time" class="form-control" value="<?php echo (isset($_POST['time'])) ? $_POST['time'] : ""; ?>" required>
                    <span class="input-group-text" id="basic-addon2">minutes</span>
                </div>
            </div>
            <?php
            if ($error_time != "") {
                echo "<p class='small invalid-input'>" . $error_time . "</p>";
            }
            ?>
            <div class="mb-3">
                <label for="energy" class="form-label">How Energetic do you feel?</label>
                <div class="range-input">
                    <div>0</div>
                    <div class="range-bar">
                        <input name="energy" type="range" class="form-range" id="energy" min="0" max="100" value="<?php echo (isset($_POST['energy'])) ? $_POST['energy'] : ""; ?>" required>
                    </div>
                    <div>100</div>
                </div>
            </div>
            <?php
            if ($error_energy != "") {
                echo "<p class='small invalid-input'>" . $error_energy . "</p>";
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