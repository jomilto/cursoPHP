<?php

use App\Models\Job;

if (!empty($_POST)){
    $job = new Job();
    $job->title = $_POST['title'];
    $job->description = $_POST['description'];
    $job->save();
    var_dump($_POST);
}

// uso de variables super globales
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Add Job</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/css/bootstrap.min.css" integrity="sha384-Smlep5jCw/wG7hdkwQ/Z5nLIefveQRIY9nfy6xoR1uRYBtpZgI6339F5dgvm/e9B"
    crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>Add Job</h2>
    <form action="addJob.php" method="post">
    <label for="title">Title</label>
    <input type="text" name="title" id="title"><br/>
    <label for="description">Description</label>
    <input type="text" name="description" id="description"><br/>
    <button type="submit">Save</button>
    </form>
</body>
</html>