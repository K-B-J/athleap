<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Athleap: Yoga Form</title>
    <link rel="icon" type="image/png" href="../assets/icons/favicon-32x32.png" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@700&display=swap" rel="stylesheet">
    <link href="../bootstrap-5.1.1-dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="../fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="../assets/css/yogaForm.css" rel="stylesheet">
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
    $durationErr = "";
    $yogaErr = "";
    $duration = "";
    $rating = "";
    $yoga = "";

    if (isset($_POST["save"])) {
        $duration = $_POST["duration"];
        $rating = $_POST["exerciseRate"];

        if (empty($_POST["duration"])) {
            $durationErr = "Duration cannot be empty";
        } else if (preg_match("/^[a-zA-Z]*$/", $_POST["duration"])) {
            $durationErr = "Duration cannot be letter";
        } else if ((int)($_POST["duration"]) <= 0) {
            $durationErr = "Duration should be greater than 0";
        } else {
            $duration = $_POST["duration"];
        }
        if (empty($_POST["yogaAsan"])) {
            $yogaErr = "Please select an Asana";
        } else {
            $yoga = $_POST["yogaAsan"];
        }

        if ($durationErr == "" && $yogaErr == "") {

            function calorie_calculator($wt, $yoga, $dur)
            {
                $met = 0;
                if ($yoga == "Nadisodhana") {
                    $met = 2;
                } else if ($yoga == "Hatha") {
                    $met = 2.5;
                } else if ($yoga == "Surya Namaskar") {
                    $met = 3.3;
                } else {
                    $met = 4;
                }
                return (($met * $wt * 3.5) / 200)*$dur;
            }

            function fcoins_calculator($age, $calories, $previous_fcoins)
            {
                $fcoins = ($calories/4) + (int)floor(($age / 10));
                if ($fcoins > $previous_fcoins) {
                    $fcoins += 1;
                }
                return floor($fcoins);
            }

            date_default_timezone_set("Indian/Mahe");
            $email = $_SESSION["email"];
            $age = $_SESSION["age"];
            $weight = $_SESSION["weight"];
            $old_fcoins = $_SESSION["fcoins"];
            date_default_timezone_set("Indian/Mahe");
            $date = date("d/m/Y");

            require '../vendor/autoload.php';
            $ATLAS_CREDENTIALS = getenv("ATLAS_CREDENTIALS");
            $connection = new MongoDB\Client($ATLAS_CREDENTIALS);
            $db = $connection->Athleap;
            $calories = calorie_calculator($weight, $yoga, $duration);
            $collection = $db->Yoga;
            $result = $collection->find(["email" => $email])->toArray();
            if(sizeof($result)>0){
                $fcoins = fcoins_calculator($age, $calories, $result[sizeof($result) - 1]["fcoins"]);
            }
            else{
                $fcoins = fcoins_calculator($age, $calories, 0);
            }
            $collection = $db->Users;
            $new_fcoins = $old_fcoins + $fcoins;
            $_SESSION["fcoins"] = $new_fcoins;
            $collection->updateOne(["email" => $email], ['$set' => ["fcoins" => $new_fcoins]]);
            $_SESSION["calories"] = $calories;
            $_SESSION["excercise_fcoins"] = $fcoins;
            $collection = $db->Yoga;
            $collection->insertOne(["email" => $email, "date" => $date, "calories" => $calories, "fcoins" => $fcoins, "yoga" => $yoga, "duration" => $duration, "energy" => $rating]);
            header("Location: afterForm.php");
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
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="mb-3">
                <label class="form-label" for="yogaAsan">Select Yoga Asan: </label>
                <select class="form-select" name="yogaAsan">
                    <option value="" <?php echo (isset($_POST['yogaAsan']) && $_POST['yogaAsan']=="") ? "SELECTED" : ""; ?>>SELECT</option>
                    <option value="Nadisodhana" <?php echo (isset($_POST['yogaAsan']) && $_POST['yogaAsan']=="Nadisodhana") ? "SELECTED" : ""; ?>>Nadisodhana</option>
                    <option value="Hatha" <?php echo (isset($_POST['yogaAsan']) && $_POST['yogaAsan']=="Hatha") ? "SELECTED" : ""; ?>>Hatha</option>
                    <option value="Surya Namaskar" <?php echo (isset($_POST['yogaAsan']) && $_POST['yogaAsan']=="Surya Namaskar") ? "SELECTED" : ""; ?>>Surya Namaskar</option>
                    <option value="Power Yoga" <?php echo (isset($_POST['yogaAsan']) && $_POST['yogaAsan']=="Power Yoga") ? "SELECTED" : ""; ?>>Power Yoga</option>
                </select>
                <?php
                if ($durationErr != "") {
                    echo '<small id="durationHelp" class="form-text" style="color: #FF2226">' . $yogaErr . '</small>';
                }
                ?>
            </div>
            <div class="mb-3">
                <label class="form-label" for="duration">Duration of exercise: </label>
                <div class="input-group">
                    <input type="text" id="duration" name="duration" class="form-control" value="<?php echo (isset($_POST['duration'])) ? $_POST['duration'] : ""; ?>">
                    <span class="input-group-text" id="basic-addon2">minutes</span>
                </div>
                <?php
                if ($durationErr != "") {
                    echo '<small id="durationHelp" class="form-text" style="color: #FF2226">' . $durationErr . '</small>';
                } else {
                    echo '<small id="durationHelp" class="form-text text-dark"></small>';
                }
                ?>
            </div>
            <div class="mb-3">
                <label class="form-label" for="exerciseRate">Rate your Exercise: </label>
                <div>
                    <div class="row">
                        <div class="col-1">
                            0
                        </div>
                        <div class="col-10">
                            <input type="range" class="form-range" min="0" max="5" step="1" id="exerciseRate" name="exerciseRate">
                        </div>
                        <div class="col-1">
                            5
                        </div>
                    </div>
                </div>
            </div>
            <div class="submission">
                <button type="submit" class="submit" name="save">Save</button>
            </div>
        </form>
    </div>

    <script src="../bootstrap-5.1.1-dist/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/sidebarHover.js"></script>
</body>

</html>