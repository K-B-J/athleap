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
    <link href="../css/gymStyles.css" rel="stylesheet">
</head>

<body>
    <?php
    if (isset($_POST["save"])) {
        $error_email = "";
        $error_phone = "";
        $error_workout = "";
        $error_gender = "";
        $error_sets = "";
        $error_reps = "";
        $error_time = "";
        $error_energy = "";
        $email = $_POST["email"];
        $phone = $_POST["phone"];
        $workout = $_POST["workout"];
        $gender = $_POST["gender"];
        $sets = $_POST["sets"];
        $reps = $_POST["reps"];
        $time = $_POST["time"];
        $energy = $_POST["energy"];
        $error = false;
        if (preg_match("{[a-zA-Z0-9_\.\+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-\.]}", $email) == 0) {
            $error_email = "Invalid input!";
            $error = true;
        }
        if (preg_match("{\d{10}}", $phone) == 0) {
            $error_phone = "Invalid input! (Enter 10 digit phone number)";
            $error = true;
        }
        if ($workout == "") {
            $error_workout = "Select an input!";
            $error = true;
        }
        if ($gender == "") {
            $error_gender = "Select an input!";
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
            setcookie("email", $email);
            setcookie("phone", $phone);
            setcookie("workout", $workout);
            setcookie("gender", $gender);
            setcookie("sets", $sets);
            setcookie("reps", $reps);
            setcookie("time", $time);
            setcookie("energy", $energy);
            header("Location: temp.php");
        }
    }
    ?>
    <div class="top-section">
        <a href="#" class="back"><i class="fas fa-bars fa-lg" style="color:white"></i></a>
        <h2 class="header">Today's Workout</h2>
    </div>
    <div class="form-container my-5">
        <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>">
            <div class="mb-3">
                <label for="email" class="form-label">Email:</label>
                <input type="email" name="email" id="email" class="form-control" value="<?php echo $_POST['email']; ?>" required>
            </div>
            <p class="small invalid-input"><?php echo $error_email ?></p>
            <div class="mb-3">
                <label for="phone" class="form-label">Phone number:</label>
                <input type="number" name="phone" id="phone" class="form-control" value="<?php echo $_POST['phone']; ?>" required>
            </div>
            <p class="small invalid-input"><?php echo $error_phone ?></p>
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
            <p class="small invalid-input"><?php echo $error_workout ?></p>
            <div class="mb-3">
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="gender" id="male" value="male" <?php echo ($_POST['gender'] == 'male') ? 'checked="checked"' : ''; ?> required>
                    <label class="form-check-label" for="male">
                        Male
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="gender" id="female" <?php echo ($_POST['gender'] == 'female') ? 'checked="checked"' : ''; ?> value="female">
                    <label class="form-check-label" for="female">
                        Female
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="gender" id="other" <?php echo ($_POST['gender'] == 'other') ? 'checked="checked"' : ''; ?> value="other">
                    <label class="form-check-label" for="other">
                        Other
                    </label>
                </div>
            </div>
            <p class="small invalid-input"><?php echo $error_gender ?></p>
            <div class="mb-3">
                <label for="sets" class="form-label">Number of sets:</label>
                <input type="number" name="sets" id="sets" class="form-control" value="<?php echo $_POST['sets']; ?>" required>
            </div>
            <p class="small invalid-input"><?php echo $error_sets ?></p>
            <div class="mb-3">
                <label for="reps" class="form-label">Number of reps per set:</label>
                <input type="number" name="reps" id="reps" class="form-control" value="<?php echo $_POST['reps']; ?>" required>
            </div>
            <p class="small invalid-input"><?php echo $error_reps ?></p>
            <div class="mb-3">
                <label for="time" class="form-label">Total time taken to complete all sets: (in minutes)</label>
                <input type="number" name="time" id="time" class="form-control" value="<?php echo $_POST['time']; ?>" required>
            </div>
            <p class="small invalid-input"><?php echo $error_time ?></p>
            <div class="mb-3">
                <label for="energy" class="form-label">How Energetic do you feel?</label>
                <div class="range-input">
                    <div>0</div>
                    <div class="range-bar">
                        <input name="energy" type="range" class="form-range" id="energy" min="0" max="100" value="<?php echo $_POST['energy']; ?>" required>
                    </div>
                    <div>100</div>
                </div>
            </div>
            <p class="small invalid-input"><?php echo $error_energy ?></p>
            <div class="submission">
                <button type="submit" class="submit" name="save">Save</button>
            </div>
        </form>
    </div>
    <script src="../bootstrap-5.1.1-dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>