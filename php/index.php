<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Athleap: Home</title>
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
            <a class="my-brand navbar-brand" href="">Home</a>
        </div>
    </nav>

    <div class="container-fluid my-3">
        <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active"
                    aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1"
                    aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2"
                    aria-label="Slide 3"></button>
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
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions"
                data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions"
                data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>

    <div class="row my-5" id="nav-contents">
        <div class="col-md-3">
            <div class="card" id="card1">
                <div class="imgBx">
                    <img src="https://www.wpbeginner.com/wp-content/uploads/2018/07/whatisblog.png">
                </div>
                <div class="content">
                    <h2> <a href="blog.html" class="redir-anchor">Blog</a> </h2>
                    <p>
                        A space to read the most amazing blogs written by professionals, on topics of your interest. You
                        can read on topics such as yoga, aerobics, or even your favorite sport!
                    </p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card" id="card2">
                <div class="imgBx">
                    <img src="../assets/images/shop.jpg">
                </div>
                <div class="content">
                    <h2><a href="shop.html" class="redir-anchor">Shop</a></h2>
                    <p>
                        Struggling to find sports and fitness equipment to Grind? <br> Don't worry. <br> We are <br>
                        Your One Stop Shop for All Things Sports</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card" id="card3">
                <div class="imgBx">
                    <img
                        src="https://images.unsplash.com/photo-1511367461989-f85a21fda167?ixid=MnwxMjA3fDB8MHxzZWFyY2h8Mnx8cHJvZmlsZXxlbnwwfHwwfHw%3D&ixlib=rb-1.2.1&w=1000&q=80">
                </div>
                <div class="content">
                    <h2><a href="profile.html" class="redir-anchor">Profile</a></h2>
                    <p>
                        Use this site to its maximum capability by signing in and feeling the <br>
                        <strong>Magic</strong>
                    </p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card" id="card4">
                <div class="imgBx">
                    <img
                        src="https://d2slcw3kip6qmk.cloudfront.net/marketing/blog/2019Q1/giving-feedback/how-to-give-feedback-header@2x.png">
                </div>
                <div class="content">
                    <h2><a href="contact.html" class="redir-anchor">Feedback</a></h2>
                    <p>We really value your feedback. <br>It would be amazing if you could take a small survey form and
                        tell us how you like the website. Or even what change you would like to see. </p>
                </div>
            </div>
        </div>
    </div>


    <script src="../bootstrap-5.1.1-dist/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/sidebarHover.js"></script>
</body>

</html>