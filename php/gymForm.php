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
    <div class="top-section">
        <a href="#" class="back"><i class="fas fa-arrow-left fa-lg" style="color:white"></i></a>
        <h2 class="header">Today's Workout</h2>
    </div>
    <div class="content">
        <form method="POST">
            <div class="mb-3">
                <label for="workout" class="form-label">Workout:</label>
                <select name="workout" id="workout" class="form-select">
                    <option value="Select" default>Select</option>
                    <option value="Hammer Curl">Hammer Curl</option>
                </select>
            </div>
            <div class="mb-3">
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
            </div>
            <div class="mb-3">
                <label for="energy" class="form-label">How Energetic do you feel? (0 to 100)</label>
                <input type="range" class="form-range" id="energy" min="0" max="100" value="20">
            </div>
            <div class="submission">
                <button type="submit" class="submit">Save</button>
            </div>
        </form>
    </div>
    <script src="../bootstrap-5.1.1-dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>