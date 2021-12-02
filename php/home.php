<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Athleap: Home</title>
    <link rel="icon" type="image/png" href="../assets/icons/favicon-32x32.png" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@700&display=swap" rel="stylesheet">
    <link href="../bootstrap-5.1.1-dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="../fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="../assets/css/home.css" rel="stylesheet">
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
    if (isset($_SESSION["updated"])) {
        unset($_SESSION["updated"]);
        echo "<script>alert('Profile Updated Successfully!')</script>";
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
                            <a class="nav-link active-link" href="">
                                <div style="height: 40px;">
                                    <img id="homeIcon" src="../assets/icons/Home selected.svg" alt="Home icon" style="line-height: 40px;">
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
            <a class="my-brand navbar-brand" href="">Home</a>
            <div style="flex:1;"></div>
            <div class="mr-3">
                <div class="dropdown">
                    <button style="padding-right: 36px !important;" class="my-dropdown btn dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <?php echo $_SESSION["name"]; ?>
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item" href="editProfile.php">Edit Profile</a>
                        <a class="dropdown-item" href="logout.php">Logout</a>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <div class="container-fluid my-4">
        <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
            </div>
            <div class="carousel-inner" id="caraousel">
                <div class="carousel-item active">
                    <img src="../assets//images/yoga.jpg" class="d-block w-100" alt="...">
                    <div class="carousel-caption d-none d-md-block text-light">
                        <h3>Yoga</h3>
                        <h6>"Yoga is Essentially a practioce for your <strong>Soul</strong> working through the medium
                            of
                            your Body" <br>
                            -Tara Fraser</h6>
                    </div>
                </div>
                <div class="carousel-item ">
                    <img src="../assets//images/run.jpg" class="d-block w-100" alt="...">
                    <div class="carousel-caption d-none d-md-block">
                        <h3>Running</h3>
                        <h6>"The feeling you get from <strong>Running</strong> is far better than the feeling you get
                            from
                            sitting around wishing you were running" <br>
                            -Sarah Condor</h6>
                    </div>
                </div>
                <div class="carousel-item ">
                    <img src="../assets//images/sport.jpg" class="d-block w-100" alt="...">
                    <div class="carousel-caption d-none d-md-block">
                        <h3>Sports</h3>
                        <h6>"Never Say Never because limits, like fears, are often <strong>Illusions</strong> "<br>
                            -Michael Jordan</h6>
                    </div>
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>

    <div class="container text-center my-5">
        <div class="item" onmouseover="yoga_hover2();" onmouseout="yoga_unhover2();">
            <a class="nav-link" href="yoga.php" style="padding-top:36px; padding-bottom:64px;">
                <div style="height: 100px;">
                    <img id="yogaIcon2" src="../assets/icons/Yoga.svg" alt="Yoga icon" style="height: 100px;"> <br>
                    <span id="yogaName" style="font-size: 24px; padding-top:6px;">Yoga</span>
                </div>
            </a>
        </div>
        <div class="item" onmouseover="gym_hover2();" onmouseout="gym_unhover2();">
            <a class="nav-link" href="gym.php" style="padding-top:36px; padding-bottom:64px;">
                <div style="height: 100px;">
                    <img id="gymIcon2" src="../assets/icons/Gym.svg" alt="Gym icon" style="height: 100px;"> <br>
                    <span id="gymName" style="font-size: 24px; padding-top:6px;">Gym</span>
                </div>
            </a>
        </div>
        <div class="item" onmouseover="running_hover2();" onmouseout="running_unhover2();">
            <a class="nav-link" href="running.php" style="padding-top:36px; padding-bottom:64px;">
                <div style="height: 100px;">
                    <img id="runningIcon2" src="../assets/icons/Running.svg" alt="Running icon" style="height: 100px;"> <br>
                    <span id="runningName" style="font-size: 24px; padding-top:6px;">Running</span>
                </div>
            </a>
        </div>
        <div class="item" onmouseover="shop_hover2();" onmouseout="shop_unhover2();">
            <a class="nav-link" href="shop.php" style="padding-top:36px; padding-bottom:64px;">
                <div style="height: 100px;">
                    <i id="shopIcon2" class="shop-icon fas fa-lg fa-shopping-cart" style="font-size: 100px; margin-top: 15px; margin-block: 12px;"></i> <br>
                    <span id="shopName" style="font-size: 24px; padding-top:6px;">Shop</span>
                </div>
            </a>
        </div>
    </div>

    <script src="../bootstrap-5.1.1-dist/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/sidebarHover.js"></script>
</body>

</html>