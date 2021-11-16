<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Athleap: Gym Form</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@700&display=swap" rel="stylesheet">
    <link href="../bootstrap-5.1.1-dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="../fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="../assets/css/gymForm.css" rel="stylesheet">
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
    $error_workout = "";
    $error_sets = "";
    $error_reps = "";
    $error_time = "";
    $error_energy = "";
    if (isset($_POST["save"])) {
        $workout = $_POST["workout"];
        $sets = $_POST["sets"];
        $reps = $_POST["reps"];
        $time = $_POST["time"];
        $energy = $_POST["energy"];
        $error = false;
        if ($workout == "") {
            $error_workout = "Select an input!";
            $error = true;
        }
        if (($sets == "") || (is_int($sets))) {
            $error_sets = "Invalid input!";
            $error = true;
        }
        if (($reps == "") || (is_int($reps))) {
            $error_reps = "Invalid input!";
            $error = true;
        }
        if (($time == "") || (is_int($time))) {
            $error_time = "Invalid input!";
            $error = true;
        }
        if (($energy == "") || (is_int($energy))) {
            $error_energy = "Invalid input!";
            $error = true;
        }
        if (!$error) {
            // Logic
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
                <label for="workout" class="form-label">Workout:</label>
                <select name="workout" id="workout" class="form-select" required>
                    <option value="" selected>Select</option>
                    <?php
                    $workout_list = ["Hammer Curl", "Biceps Curl", "Latteral Raise", "Lunge"];
                    if (isset($_POST["save"])) {
                        foreach ($workout_list as $i) {
                            if ($i == $workout) {
                                echo '<option value="' . $i . '" selected>' . $i . '</option>';
                            } else {
                                echo '<option value="' . $i . '">' . $i . '</option>';
                            }
                        }
                    } else {
                        foreach ($workout_list as $i) {
                            echo '<option value="' . $i . '">' . $i . '</option>';
                        }
                    }
                    ?>
                </select>
            </div>
            <?php
            if ($error_workout != "") {
                echo "<p class='small invalid-input'>" . $error_workout . "</p>";
            }
            ?>
            <div class="mb-3">
                <label for="sets" class="form-label">Number of sets:</label>
                <input type="number" name="sets" id="sets" class="form-control" value="<?php echo (isset($_POST['sets'])) ? $_POST['sets'] : ""; ?>" required>
            </div>
            <?php
            if ($error_sets != "") {
                echo "<p class='small invalid-input'>" . $error_sets . "</p>";
            }
            ?>
            <div class="mb-3">
                <label for="reps" class="form-label">Number of reps per set:</label>
                <input type="number" name="reps" id="reps" class="form-control" value="<?php echo (isset($_POST['reps'])) ? $_POST['reps'] : ""; ?>" required>
            </div>
            <?php
            if ($error_reps != "") {
                echo "<p class='small invalid-input'>" . $error_reps . "</p>";
            }
            ?>
            <div class="mb-3">
                <label for="time" class="form-label">Total time taken to complete all sets: (in minutes)</label>
                <input type="number" name="time" id="time" class="form-control" value="<?php echo (isset($_POST['time'])) ? $_POST['time'] : ""; ?>" required>
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