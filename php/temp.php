<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h3>Hello you have filled the following,</h3>
    <?php
    echo "Email: " . $_COOKIE["email"] . "<br>";
    echo "Phone: " . $_COOKIE["phone"] . "<br>";
    echo "Workout: " . $_COOKIE["workout"] . "<br>";
    echo "Gender: " . $_COOKIE["gender"] . "<br>";
    echo "Sets: " . $_COOKIE["sets"] . "<br>";
    echo "Reps: " . $_COOKIE["reps"] . "<br>";
    echo "Time: " . $_COOKIE["time"] . "<br>";
    echo "Energy: " . $_COOKIE["energy"] . "<br>";
    ?>
</body>

</html>