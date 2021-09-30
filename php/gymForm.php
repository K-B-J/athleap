<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Athleap: Gym Form</title>
    <link rel="stylesheet" href="../bootstrap-5.1.1-dist/css/bootstrap.min.css">
    <link href="../fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="../css/common.css">
</head>

<body>
    <?php
    if (isset($_POST["save"])) {
        $error_email = "";
        $error_phone = "";
        $error_workout = "";
        $error_gender = "";
        $error_feeling = "";
        $email = $_POST["email"];
        $phone = $_POST["phone"];
        $workout = $_POST["workout"];
        $gender = $_POST["gender"];
        $feeling = $_POST["feeling"];
        $error = false;
        if (!preg_match("^[a-zA-Z0-9_\.\+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-\.]+$", $email)) {
            $error_email = "Invalid Email!";
            $error = true;
        }
        if (!preg_match("^\d{10}$", $phone)) {
            $error_phone = "Invalid phone number!";
            $error = true;
        }
        if ($workout == ""){
            $error_workout = "Select an input";
            $error = true;
        }
        if ($gender == ""){
            $error_gender = "Select an input";
            $error = true;
        }
        if (!$error){
            header("Location: php/index.php");
        }
    }
    ?>
    <div class="top-section">
        <a href="#" class="back"><i class="fas fa-arrow-left fa-lg" style="color:white"></i></a>
        <h2 class="header">Today's Workout</h2>
    </div>
    <div class="content">
        <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>">
            <div class="mb-3">
                <label for="email" class="form-label">Email:</label>
                <input type="text" name="email" id="email" class="form-control">
            </div>
            <p class="small"><?php echo $error_email ?></p>
            <div class="mb-3">
                <label for="phone" class="form-label">Phone number:</label>
                <input type="number" name="phone" id="phone" class="form-control">
            </div>
            <p class="small"><?php echo $error_phone ?></p>
            <div class="mb-3">
                <label for="workout" class="form-label">Workout:</label>
                <select name="workout" id="workout" class="form-select">
                    <option value="" default>Select</option>
                    <option value="Hammer Curl">Hammer Curl</option>
                </select>
            </div>
            <p class="small"><?php echo $error_workout ?></p>
            <div class="mb-3">
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="gender" id="male">
                    <label class="form-check-label" for="male">
                        Male
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="gender" id="female">
                    <label class="form-check-label" for="female">
                        Female
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="gender" id="other">
                    <label class="form-check-label" for="other">
                        Other
                    </label>
                </div>
            </div>
            <p class="small"><?php echo $error_gender ?></p>
            <!-- <div class="mb-3">
                <label for="sets" class="form-label">Number of sets:</label>
                <input type="number" name="sets" id="sets" class="form-control">
            </div>
            <div class="mb-3">
                <label for="reps" class="form-label">Number of reps per set:</label>
                <input type="number" name="reps" id="reps" class="form-control">
            </div>
            <div class="mb-3">
                <label for="time" class="form-label">Total time taken to complete all sets: (in minutes)</label>
                <input type="number" name="time" id="time" class="form-control">
            </div> -->
            <div class="mb-3">
                <label for="energy" class="form-label">How Energetic do you feel? (0 to 100)</label>
                <input name="feeling" type="range" class="form-range" id="energy" min="0" max="100" value="20">
            </div>
            <p class="small"><?php echo $error_feeling ?></p>
            <div class="submission">
                <button type="submit" class="submit" name="save">Save</button>
            </div>
        </form>
    </div>
    <script src="../bootstrap-5.1.1-dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>