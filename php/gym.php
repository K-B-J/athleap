<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Athleap: Gym</title>
    <link rel="icon" type="image/png" href="../assets/icons/favicon-32x32.png" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@700&display=swap" rel="stylesheet">
    <link href="../bootstrap-5.1.1-dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="../fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="../assets/css/gym.css" rel="stylesheet">
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
    ?>
    <nav class="navbar my-navbar" id="navbar">
        <div class="container-fluid" style="justify-content: unset;">
            <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar">
                <i class="hamburger fas fa-bars fa-lg"></i>
            </button>
            <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title" id="offcanvasNavbarLabel" style="color: #707070;">Gym Records</h5>
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
                            <a class="nav-link active-link" href="">
                                <div style="height: 40px;">
                                    <img id="gymIcon" src="../assets/icons/Gym selected.svg" alt="Gym icon" style="line-height: 40px;">
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
            <a class="my-brand navbar-brand" href="">Gym Records</a>
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
    <div class="table-responsive">
        <table class="my-table table table-hover">
            <thead>
                <tr class="text-center">
                    <th scope="col">#</th>
                    <th scope="col">Date</th>
                    <th scope="col">Calories Burnt</th>
                    <th scope="col">FCoins Rewarded</th>
                    <th scope="col">Workout</th>
                    <th scope="col">Sets</th>
                    <th scope="col">Reps</th>
                    <th scope="col">Heaviness of the Dumbbell</th>
                    <th scope="col">Time Spent (minutes)</th>
                    <th scope="col">Energy Level</th>
                </tr>
            </thead>
            <tbody>
                <?php
                require '../vendor/autoload.php';
                $ATLAS_CREDENTIALS = getenv("ATLAS_CREDENTIALS");
                $connection = new MongoDB\Client($ATLAS_CREDENTIALS);
                $db = $connection->Athleap;
                $collection = $db->Gym;
                $email = $_SESSION["email"];
                $result = $collection->find(["email" => $email])->toArray();
                if (empty($result)) {
                    echo "<tr style='text-align:center;'><td colspan='10'>No Data!</td></tr>";
                } else {
                    for ($i = sizeof($result); $i > 0; $i--) {
                        $data = $result[$i - 1];
                        $date = $data['date'];
                        $calories = $data['calories'];
                        $fcoins = $data['fcoins'];
                        $workout = $data['workout'];
                        $sets = $data['sets'];
                        $reps = $data['reps'];
                        $dumbbell_weight = $data['dumbbell_weight'];
                        $time = $data['time'];
                        $energy = $data['energy'];
                        echo "<tr class='text-center'><th scope='row'>" . strval(sizeof($result) - $i + 1) . "</th><td>$date</td><td>$calories</td><td>$fcoins</td><td>$workout</td><td>$sets</td><td>$reps</td><td>$dumbbell_weight</td><td>$time</td><td>$energy</td></tr>";
                    }
                }
                ?>
            </tbody>
        </table>
    </div>
    <a href="gymForm.php" class="btn-circle"><i class="fa fa-plus"></i></a>

    <script src="../bootstrap-5.1.1-dist/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/sidebarHover.js"></script>
</body>

</html>