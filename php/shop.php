<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Athleap: Shop</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@700&display=swap" rel="stylesheet">
    <link href="../bootstrap-5.1.1-dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="../fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="../assets/css/shop.css" rel="stylesheet">
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
    $shopItems = [
        [
            "image" => "http://pngimg.com/uploads/running_shoes/running_shoes_PNG5816.png",
            "title" => "Nike Shoes",
            "description" => "Are you all ready for this.The next era of style collides with comfort. These ZX 2K Boost Shoes build on a legacy of adidas innovation that started in the 80s and hasnt stopped. By combining energy returning cushioning with progressive styling, the ZX dynasty moves into the future withrefreshed spirit.",
            "sizes" => ["9", "10", "11", "12"],
            "price" => 100
        ],
        [
            "image" => "http://pngimg.com/uploads/barbell/barbell_PNG16339.png",
            "title" => "Barbell",
            "description" => "UA HOVR™ Machina are the best men's running shoes, and then some. Yes, they give you energy return and the speed of a Pebax® propulsion plate, but they also coach you in real-time when you connect them to UA MapMyRun®.",
            "sizes" => ["M", "L"],
            "price" => 20
        ],
        [
            "image" => "http://pngimg.com/uploads/football_boots/football_boots_PNG52.png",
            "title" => "Adidas Studs",
            "description" => "Royal Enterprises has created a genuine niche amongst the trusted companies in the industry. The ownership type of our firm is Sole Proprietorship (Individual). ",
            "sizes" => ["8", "9", "10", "11", "12"],
            "price" => 100
        ],
        [
            "image" => "http://pngimg.com/uploads/running_shoes/running_shoes_PNG5821.png",
            "title" => "Kids Shoes",
            "description" => "Royal Enterprises has created a genuine niche amongst the trusted companies in the industry. The ownership type of our firm is Sole Proprietorship (Individual). ",
            "sizes" => ["5", "6"],
            "price" => 50
        ],
    ];
    ?>


    <nav class="navbar my-navbar">
        <div class="container-fluid" style="justify-content: unset;">
            <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar">
                <i class="hamburger fas fa-bars fa-lg"></i>
            </button>
            <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title" id="offcanvasNavbarLabel" style="color: #707070;">Shop</h5>
                    <button type="button" class="btn-close text-reset shadow-none" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <hr class="sidebar-divider" style="color:#707070; margin: 6px 12px;">
                <div class="offcanvas-body">
                    <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                        <li class="nav-item">
                            <a class="nav-link" href="home.php" onmouseover="home_hover();" onmouseout="home_unhover();">
                                <div style="height: 40px;">
                                    <img id="homeIcon" src="../assets/icons/Home.svg" alt="Home icon" style="line-height: 40px;">
                                    <span class="sidebar-text" style="vertical-align: middle;">Shop</span>
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
            <a class="my-brand navbar-brand" href="">Shop</a>
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

    <div id="content1">
        <h3>Shop</h3>
        <h4>.Your Sweat Pays a Lot.</h4>
        <div class="container text-dark my-4 bg-dark">
            <div id="catalog my-5">
                &nbsp;
                <div class="row text-light products">
                    <?php

                    foreach ($shopItems as $item) {
                        echo '
                            <div class="col-3 shop-item">
                                <div class="content">
                                    <div class="card">
                                        <div class="imgBx">
                                            <img src="' . $item["image"] . '" alt="">
                                        </div>
                                        <div class="contentBx">
                                            <h2>' . $item["title"] . '</h2>
                                            <div class="size">
                                                <h3>Size :</h3>
                                                ';
                        foreach ($item['sizes'] as $i) {
                            echo "<span>" . $i . "</span>";
                        };

                        echo '</div>
                                            <div class="price">
                                                <h3>Price :</h3>
                                                <span>' . $item['price'] . '</span>
                                            </div>
                                            <a href="#"> + Buy now</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            ';
                    }


                    ?>
                    <!-- <div class="col-3 mx-5 my-3" ng-repeat="item in list">
                        <div class="content">
                            <div class="card">
                                <div class="imgBx">
                                    <img src="{{ item.image }}" alt="">
                                </div>
                                <div class="contentBx">
                                    <h2>{{ item.title }}</h2>
                                    <div class="size">
                                        <h3>Size :</h3>
                                        <span ng-repeat="i in item.sizes">{{ i }}</span>
                                    </div>
                                    <div class="price">
                                        <h3>Price :</h3>
                                        <span>$ {{ item.price }} </span>
                                    </div>
                                    <a href="#"> + Buy now</a>
                                </div>
                            </div>
                        </div>
                    </div> -->
                </div>
                <br>
            </div>
        </div>
    </div>

    <script src="../bootstrap-5.1.1-dist/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/sidebarHover.js"></script>
</body>